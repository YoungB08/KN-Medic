<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/models/user.php'; ?>
<script>
function loadMessages(messages) {
    const container = $('#chatMessages');
    container.empty();

    messages.forEach(msg => {
        // Ép kiểu ai sang number để so sánh chính xác
        const isAI = (Number(msg.ai) === 1);

        let messageHtml = '';

        if (!isAI) {
            messageHtml = `
<div class="flex items-start justify-end">
    <div class="max-w-xs md:max-w-md">
        <div class="bg-gradient-to-r from-primary/80 to-primary/50 rounded-l-2xl rounded-br-2xl px-4 py-2">
            <p class="text-sm">${escapeHtml(msg.msg)}</p>
            <p class="text-xs text-gray-200 mt-1">${msg.time}</p>
        </div>
    </div>
    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary/70 flex items-center justify-center ml-3">
        <span class="text-xs font-bold text-white">B</span>
    </div>
</div>`;
        } else {
            messageHtml = `
<div class="flex items-start">
    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary/30 flex items-center justify-center mr-3">
        <span class="text-xs font-bold">A</span>
    </div>
    <div class="max-w-xs md:max-w-md">
        <div class="bg-black/50 rounded-r-2xl rounded-bl-2xl px-4 py-2">
            <p class="text-sm">${escapeHtml(msg.msg)}</p>
            <p class="text-xs text-gray-400 mt-1">${msg.time}</p>
        </div>
    </div>
</div>`;
        }
        container.append(messageHtml);
    });

    if (container.length && container[0].scrollHeight !== undefined) {
        container.scrollTop(container[0].scrollHeight);
    }
}

// Hàm escape HTML để an toàn
function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
let lastMsgId = null;

function fetchMessagesAndUpdate(url, uid) {
    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: { uid: uid },
        success: function(data) {
            if (data.length === 0) return;

            const newestMsg = data[data.length - 1];
            if (newestMsg.id !== lastMsgId) {
                lastMsgId = newestMsg.id;
                loadMessages(data);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading messages:', error);
        }
    });
}

// Gọi lần đầu ngay khi tải trang hoặc bắt đầu chat
fetchMessagesAndUpdate('/API/GetMessages', <?= UserModel::GetUserInfo($_SESSION['user'])['id'] ?>);

// Kiểm tra mỗi 1 giây xem có tin nhắn mới không
setInterval(() => {
    fetchMessagesAndUpdate('/API/GetMessages', <?=UserModel::GetUserInfo($_SESSION['user'])['id'] ?>);
}, 1000);

$(function() {
    let lastMessage = '';

    $('#messageInput').on('input', function() {
        lastMessage = $(this).val();
    }); // fix tam thoi

    $('#chatForm').on('submit', function(e) {
        e.preventDefault();

        const message = lastMessage.trim();
        console.log("msg:", message);

        if (message === '') {
            console.warn('Input rỗng.');
            return;
        }
        $('#messageInput').val('').focus();
        $.ajax({
            url: 'API/SendAI-Chat',
            method: 'POST',
            dataType: 'json',
            data: {
                content: message,
                user: <?= UserModel::GetUserInfo($_SESSION['user'])['id'] ?>
            },
            success: function(res) {
                console.log(res);
                lastMessage = '';
            }
        });
    });

});
</script>