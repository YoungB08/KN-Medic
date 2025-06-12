<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/config.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/models/user.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'; ?>
<?php if(UserModel::isLogin() == 0) return $KNCMS->msg_warning("Vui lòng đăng nhập", hUrl('Login'), 1000);
?>
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message {
        animation: fadeInUp 0.3s ease;
    }

    .chat-container {
        scroll-behavior: smooth;
        overflow-y: auto;
    }

    .message {
        max-width: 60%;
        /* hoặc 70% */
        word-wrap: break-word;
    }

    .message-left {
        align-self: flex-start;
    }

    .message-right {
        align-self: flex-end;
    }

    .message-right {
        background: linear-gradient(135deg, #8B0000, #a83232);
        color: white;
    }

    .message-left {
        background: #111;
        color: white;
    }

    .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #8B0000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .chat-area {
        height: calc(100vh - 120px);
        /* Trừ header + search bar */
        padding: 16px;
        overflow-y: auto;
    }
</style>
<div class="h-screen flex flex-col" style="width: 100%; height: 92%;" data-id="7x277w0e" data-line="20-118">
    <!-- Chat header -->
    <div class="bg-black/80 py-4 px-6 border-b border-primary/30 flex items-center justify-between" data-id="mfygirw5" data-line="22-35">
        <div class="flex items-center space-x-3" data-id="7lquuto7" data-line="23-31">
            <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center" data-id="91o6mjt9" data-line="24-26">
                <i class="fas fa-user text-primary" data-id="of6l3jn7" data-line="25-25"></i>
            </div>
            <div data-id="wvnsslg4" data-line="27-30">
                <h2 class="font-semibold" data-id="6uvjygy4" data-line="28-28">Chat Conversation</h2>
                <p class="text-xs text-gray-400" data-id="djs0cdkb" data-line="29-29">Client A &amp; Client B</p>
            </div>
        </div>
        <button class="text-gray-400 hover:text-white" data-id="mp56mql1" data-line="32-34">
            <i class="fas fa-ellipsis-v" data-id="hdaocy29" data-line="33-33"></i>
        </button>
    </div>

    <!-- Chat messages container -->
    <div id="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-4" data-id="t6k61tdy" data-line="38-102">

    </div>

    <!-- Input area -->
    <!-- Form chat -->
    <div class="bg-black/80 p-4 border-t border-primary/30">
        <form id="chatForm" class="flex items-center space-x-2" method="post">
            <div class="flex-1 relative">
                <input id="messageInput" type="text" placeholder="Type your message..."
                    style="color: black;"
                    class="w-full bg-dark/70 border border-primary/30 rounded-full py-2 px-4 focus:outline-none focus:ring-1 focus:ring-primary/50">
            </div>
            <button type="submit" class="w-10 h-10 rounded-full bg-primary flex items-center justify-center hover:bg-primary/80 transition">
                <i class="fas fa-paper-plane text-white"></i>
            </button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/ajax/chat.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/user.php'; ?>

<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>