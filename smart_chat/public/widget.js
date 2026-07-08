(function() {
    // Automatically detect the script's source origin to use as the SERVER_URL
    const currentScript = document.currentScript || document.querySelector('script[src*="widget.js"]');
    const SERVER_URL = currentScript ? new URL(currentScript.src).origin : 'http://localhost:3000';
    
    // 1. Inject Stylesheet
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = `${SERVER_URL}/widget.css`;
    document.head.appendChild(link);

    // 2. Load Socket.io client dynamically
    const script = document.createElement('script');
    script.src = `${SERVER_URL}/socket.io/socket.io.js`;
    document.head.appendChild(script);

    script.onload = () => {
        initChatWidget();
    };

    function initChatWidget() {
        const socket = io(SERVER_URL);
        
        // Retrieve or generate visitor ID
        let visitorId = localStorage.getItem('chat_visitor_id');
        if (!visitorId) {
            visitorId = 'v-' + Math.random().toString(36).substring(2, 9) + '-' + Date.now();
            localStorage.setItem('chat_visitor_id', visitorId);
        }

        // Retrieve pre-chat values if already filled
        let visitorName = localStorage.getItem('chat_visitor_name') || '';
        let visitorEmail = localStorage.getItem('chat_visitor_email') || '';
        let chatStarted = localStorage.getItem('chat_started') === 'true';
        let roomId = `room-${visitorId}`;

        // 3. Inject Widget HTML Elements
        const widgetContainer = document.createElement('div');
        widgetContainer.id = 'smart-chat-widget';
        widgetContainer.innerHTML = `
            <!-- Chat Trigger Button -->
            <div id="chat-trigger-btn" class="chat-trigger">
                <span class="chat-icon">💬</span>
                <span class="chat-badge" style="display: none;">0</span>
            </div>

            <!-- Chat Window -->
            <div id="chat-window" class="chat-window-hidden">
                <div class="chat-header">
                    <div class="chat-header-info">
                        <div class="chat-avatar">🟢</div>
                        <div>
                            <div class="chat-title">Live Support</div>
                            <div class="chat-subtitle">Ask us anything!</div>
                        </div>
                    </div>
                    <button id="chat-close-btn" class="chat-close">✕</button>
                </div>
                
                <!-- Chat Screens -->
                <div id="chat-screen-pre" class="chat-body" style="${chatStarted ? 'display: none;' : ''}">
                    <p class="pre-form-intro">Hello! Please fill out the form below to start chatting with an agent.</p>
                    <div class="chat-form-group">
                        <label>Your Name *</label>
                        <input type="text" id="visitor-name" placeholder="John Doe" value="${visitorName}" required />
                    </div>
                    <div class="chat-form-group">
                        <label>Email Address *</label>
                        <input type="email" id="visitor-email" placeholder="john@example.com" value="${visitorEmail}" required />
                    </div>
                    <button id="start-chat-btn" class="chat-submit-btn">Start Chat</button>
                </div>

                <div id="chat-screen-main" class="chat-body" style="${chatStarted ? 'display: flex;' : 'display: none;'}">
                    <div id="chat-messages-list" class="messages-list">
                        <div class="message system-msg">Welcome to Smart Groceries Live Support!</div>
                    </div>
                    <div class="chat-footer">
                        <input type="text" id="chat-input" placeholder="Type a message..." />
                        <button id="chat-send-btn" class="chat-send">Send</button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(widgetContainer);

        // Elements
        const triggerBtn = document.getElementById('chat-trigger-btn');
        const closeBtn = document.getElementById('chat-close-btn');
        const chatWindow = document.getElementById('chat-window');
        const startChatBtn = document.getElementById('start-chat-btn');
        const sendBtn = document.getElementById('chat-send-btn');
        const chatInput = document.getElementById('chat-input');
        const messagesList = document.getElementById('chat-messages-list');
        const badge = triggerBtn.querySelector('.chat-badge');

        let unreadCount = 0;

        // Register visitor function
        function registerVisitor() {
            socket.emit('register-visitor', {
                visitorId: visitorId,
                name: visitorName,
                email: visitorEmail,
                chatStarted: chatStarted,
                url: window.location.href
            });
        }

        // Register visitor on socket load or immediately if already connected
        if (socket.connected) {
            registerVisitor();
        } else {
            socket.on('connect', registerVisitor);
        }

        // Toggle Chat Window
        triggerBtn.addEventListener('click', () => {
            chatWindow.classList.toggle('chat-window-hidden');
            chatWindow.classList.toggle('chat-window-visible');
            if (chatWindow.classList.contains('chat-window-visible')) {
                unreadCount = 0;
                badge.style.display = 'none';
                badge.textContent = '0';
            }
        });

        closeBtn.addEventListener('click', () => {
            chatWindow.classList.remove('chat-window-visible');
            chatWindow.classList.add('chat-window-hidden');
        });

        // Start Chat Submit
        startChatBtn.addEventListener('click', () => {
            const nameInput = document.getElementById('visitor-name');
            const emailInput = document.getElementById('visitor-email');

            if (!nameInput.value.trim() || !emailInput.value.trim()) {
                alert('Please fill out all fields.');
                return;
            }

            visitorName = nameInput.value.trim();
            visitorEmail = emailInput.value.trim();
            chatStarted = true;

            localStorage.setItem('chat_visitor_name', visitorName);
            localStorage.setItem('chat_visitor_email', visitorEmail);
            localStorage.setItem('chat_started', 'true');

            document.getElementById('chat-screen-pre').style.display = 'none';
            document.getElementById('chat-screen-main').style.display = 'flex';

            socket.emit('start-chat', {
                name: visitorName,
                email: visitorEmail
            });

            // Log chat started to Laravel backend database
            fetch('/chat-analytics/update?type=started');
        });

        // Send Message
        function sendMessage() {
            const text = chatInput.value.trim();
            if (text.length > 0) {
                socket.emit('send-message', {
                    roomId: roomId,
                    sender: 'visitor',
                    senderName: visitorName || 'Visitor',
                    text: text
                });
                chatInput.value = '';
            }
        }

        sendBtn.addEventListener('click', sendMessage);
        chatInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        // Receive Message
        socket.on('receive-message', (msg) => {
            const msgEl = document.createElement('div');
            msgEl.className = `message ${msg.sender === 'visitor' ? 'msg-outgoing' : 'msg-incoming'}`;
            msgEl.innerHTML = `
                <div class="msg-sender">${msg.sender === 'visitor' ? 'You' : msg.senderName}</div>
                <div class="msg-text">${msg.text}</div>
                <div class="msg-time">${msg.timestamp}</div>
            `;
            messagesList.appendChild(msgEl);
            messagesList.scrollTop = messagesList.scrollHeight;

            // Trigger unread notification count
            if (chatWindow.classList.contains('chat-window-hidden') && msg.sender === 'agent') {
                unreadCount++;
                badge.style.display = 'flex';
                badge.textContent = unreadCount;
            }
        });

        // Agent Joined room
        socket.on('agent-joined', (data) => {
            const sysEl = document.createElement('div');
            sysEl.className = 'message system-msg';
            sysEl.textContent = `${data.name} has joined the chat support.`;
            messagesList.appendChild(sysEl);
            messagesList.scrollTop = messagesList.scrollHeight;
        });
    }
})();
