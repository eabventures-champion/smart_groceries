const socket = io();

let visitorsList = [];
let activeChats = {};
let selectedVisitor = null;
let joinedRooms = new Set();

// Register agent
socket.emit('register-agent', { name: 'Support Agent' });

// Sound notification
const notificationSound = new Audio('https://assets.mixkit.co/active_storage/sfx/2357/2357-84.wav');

// DOM Elements
const visitorsContainer = document.getElementById('visitors-list');
const visitorsCountEl = document.getElementById('visitors-count');
const chatEmptyWindow = document.getElementById('chat-empty-window');
const chatActiveWindow = document.getElementById('chat-active-window');
const activeVisitorName = document.getElementById('active-visitor-name');
const activeVisitorStatus = document.getElementById('active-visitor-status');
const joinChatBtn = document.getElementById('join-chat-action');
const chatMessagesList = document.getElementById('dashboard-messages-list');
const chatInput = document.getElementById('dashboard-chat-input');
const sendBtn = document.getElementById('dashboard-send-btn');

// Details Panel Elements
const detailsContent = document.getElementById('visitor-details-content');
const detailsEmpty = document.getElementById('visitor-details-empty');
const detailAvatarText = document.getElementById('detail-avatar-text');
const detailName = document.getElementById('detail-name');
const detailEmail = document.getElementById('detail-email');
const detailUrl = document.getElementById('detail-url');
const detailIp = document.getElementById('detail-ip');
const detailUa = document.getElementById('detail-ua');

// Receive visitor list updates
socket.on('update-visitors', (data) => {
    visitorsList = data;
    visitorsCountEl.textContent = visitorsList.length;
    renderVisitors();
});

// Receive active chats list updates
socket.on('update-active-chats', (data) => {
    data.forEach(chat => {
        activeChats[chat.roomId] = chat;
    });
    renderVisitors();
    if (selectedVisitor) {
        renderMessages(selectedVisitor.roomId);
    }
});

// A new visitor started a chat
socket.on('chat-initiated', (chat) => {
    activeChats[chat.roomId] = chat;
    try {
        notificationSound.play();
    } catch (e) {}
    renderVisitors();
});

// Receive chat message
socket.on('chat-message-received', (data) => {
    const { roomId, message } = data;
    if (activeChats[roomId]) {
        // Push message to local activeChats memory
        if (!activeChats[roomId].messages) activeChats[roomId].messages = [];
        activeChats[roomId].messages.push(message);

        // If it's not the current active room, increment unread messages count
        if (!selectedVisitor || selectedVisitor.roomId !== roomId) {
            if (!activeChats[roomId].unread) activeChats[roomId].unread = 0;
            activeChats[roomId].unread++;
            try {
                notificationSound.play();
            } catch (e) {}
        } else {
            // Render directly
            renderMessages(roomId);
        }
        renderVisitors();
    }
});

function renderVisitors() {
    if (visitorsList.length === 0) {
        visitorsContainer.innerHTML = '<div class="no-visitors">No visitors online</div>';
        return;
    }

    visitorsContainer.innerHTML = '';
    visitorsList.forEach(visitor => {
        const isSelected = selectedVisitor && selectedVisitor.id === visitor.id;
        const chat = activeChats[visitor.roomId];
        const hasChat = visitor.chatStarted && chat;
        const lastMsg = hasChat && chat.messages.length > 0 ? chat.messages[chat.messages.length - 1].text : '';
        const unreadCount = chat && chat.unread ? chat.unread : 0;

        const visitorEl = document.createElement('div');
        visitorEl.className = `visitor-item ${isSelected ? 'selected' : ''}`;
        visitorEl.innerHTML = `
            <div class="visitor-item-avatar">
                ${visitor.name.substring(0, 2).toUpperCase()}
                <span class="visitor-status-indicator ${visitor.status === 'online' ? 'online' : 'offline'}"></span>
            </div>
            <div class="visitor-item-info">
                <div class="visitor-item-header">
                    <span class="visitor-item-name">${visitor.name}</span>
                    ${unreadCount > 0 ? `<span class="unread-badge">${unreadCount}</span>` : ''}
                </div>
                <div class="visitor-item-preview">${lastMsg || 'Browsing site...'}</div>
            </div>
        `;

        visitorEl.addEventListener('click', () => {
            selectVisitor(visitor);
        });

        visitorsContainer.appendChild(visitorEl);
    });
}

function selectVisitor(visitor) {
    selectedVisitor = visitor;
    
    // Clear unread counts
    if (activeChats[visitor.roomId]) {
        activeChats[visitor.roomId].unread = 0;
    }

    // Toggle Panels
    chatEmptyWindow.style.display = 'none';
    chatActiveWindow.style.display = 'flex';
    detailsEmpty.style.display = 'none';
    detailsContent.style.display = 'block';

    // Set Info
    activeVisitorName.textContent = visitor.name;
    activeVisitorStatus.className = `active-chat-subtitle ${visitor.status === 'online' ? 'status-online' : 'status-offline'}`;
    activeVisitorStatus.textContent = visitor.status === 'online' ? 'Online' : 'Offline';

    // Enable/disable inputs based on Join state
    const isJoined = joinedRooms.has(visitor.roomId);
    if (isJoined) {
        joinChatBtn.style.display = 'none';
        chatInput.disabled = false;
        sendBtn.disabled = false;
        chatInput.placeholder = "Type your reply here...";
    } else {
        joinChatBtn.style.display = 'block';
        chatInput.disabled = true;
        sendBtn.disabled = true;
        chatInput.placeholder = "Click 'Join Conversation' to message this visitor";
    }

    // Load details panel
    detailAvatarText.textContent = visitor.name.substring(0, 2).toUpperCase();
    detailName.textContent = visitor.name;
    detailEmail.textContent = visitor.email || 'Not provided';
    detailUrl.innerHTML = `<a href="${visitor.url}" target="_blank">${visitor.url}</a>`;
    detailIp.textContent = visitor.ip || 'Localhost';
    detailUa.textContent = visitor.userAgent;

    renderMessages(visitor.roomId);
    renderVisitors();
}

function renderMessages(roomId) {
    chatMessagesList.innerHTML = '';
    const chat = activeChats[roomId];
    
    if (!chat || chat.messages.length === 0) {
        chatMessagesList.innerHTML = '<div class="no-messages-alert">No messages yet.</div>';
        return;
    }

    chat.messages.forEach(msg => {
        const msgEl = document.createElement('div');
        msgEl.className = `dashboard-message ${msg.sender === 'agent' ? 'msg-outgoing' : 'msg-incoming'}`;
        msgEl.innerHTML = `
            <div class="msg-sender-name">${msg.sender === 'agent' ? 'You' : msg.senderName}</div>
            <div class="msg-text-content">${msg.text}</div>
            <div class="msg-timestamp">${msg.timestamp}</div>
        `;
        chatMessagesList.appendChild(msgEl);
    });

    chatMessagesList.scrollTop = chatMessagesList.scrollHeight;
}

// Join chat button action
joinChatBtn.addEventListener('click', () => {
    if (selectedVisitor) {
        const roomId = selectedVisitor.roomId;
        socket.emit('agent-join-room', { roomId: roomId });
        joinedRooms.add(roomId);

        joinChatBtn.style.display = 'none';
        chatInput.disabled = false;
        sendBtn.disabled = false;
        chatInput.placeholder = "Type your reply here...";
        chatInput.focus();
    }
});

// Send message action
function sendAgentMessage() {
    const text = chatInput.value.trim();
    if (text.length > 0 && selectedVisitor) {
        socket.emit('send-message', {
            roomId: selectedVisitor.roomId,
            sender: 'agent',
            senderName: 'Support Agent',
            text: text
        });
        chatInput.value = '';
    }
}

sendBtn.addEventListener('click', sendAgentMessage);
chatInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') sendAgentMessage();
});
