<!-- footer.php -->
<script data-id="1syig1ir" data-line="120-137">
    // Auto-scroll to latest message
    const messagesContainer = document.getElementById('messages');
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // Simple form submission handler
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        const input = this.querySelector('input');
        const message = input.value.trim();

        if (message) {
            input.value = '';
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    });
</script>
</div>
<nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-dark-800 shadow-lg border-t border-dark-700 z-10" data-id="f3x51dni" data-line="368-387">
    <div class="flex justify-around" data-id="vdd07qfr" data-line="369-386">
        <a href="#" class="flex flex-col items-center py-3 px-4 text-primary" data-id="yjxjxx4o" data-line="370-373">
            <i class="fas fa-home text-xl" data-id="uphn44d1" data-line="371-371"></i>
            <span class="text-xs mt-1" data-id="39f8oodv" data-line="372-372">Home</span>
        </a>
        <a href="#" class="flex flex-col items-center py-3 px-4 text-gray-400 hover:text-primary" data-id="4nym3jvc" data-line="374-377">
            <i class="fas fa-users text-xl" data-id="sushfd7p" data-line="375-375"></i>
            <span class="text-xs mt-1" data-id="mc3kgplp" data-line="376-376">Users</span>
        </a>
        <a href="#" class="flex flex-col items-center py-3 px-4 text-gray-400 hover:text-primary" data-id="jgfk0f1z" data-line="378-381">
            <i class="fas fa-file-alt text-xl" data-id="7uj6tb2w" data-line="379-379"></i>
            <span class="text-xs mt-1" data-id="rgc2z6hd" data-line="380-380">Posts</span>
        </a>
        <a href="#" class="flex flex-col items-center py-3 px-4 text-gray-400 hover:text-primary" data-id="oznl4t84" data-line="382-385">
            <i class="fas fa-cog text-xl" data-id="dp36owqc" data-line="383-383"></i>
            <span class="text-xs mt-1" data-id="tvv8tvsk" data-line="384-384">Settings</span>
        </a>
    </div>
</nav>

</body>