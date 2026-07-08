const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const cors = require('cors');
const path = require('path');

const app = express();
app.use(cors());
app.use(express.static(path.join(__dirname, 'public')));

const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});

// In-memory data store
const visitors = {}; // visitorId -> visitorDetails
const socketVisitorMap = {}; // socketId -> visitorId
const activeChats = {}; // roomId -> { visitor: {}, messages: [], answered: false, missedCounted: false }
const agents = {}; // socketId -> agentDetails

// Analytics stats
const stats = {
    visitorsToday: 0,
    pageViewsToday: 0,
    chatsAnswered: 0,
    chatsMissed: 0
};
const uniqueVisitorIPs = new Set();
const liveHistory = []; // Array of { time: '14:20:10', count: X }

// Sample live visitor count every 15 seconds for the chart (keep last 20 samples)
setInterval(() => {
    const onlineCount = Object.values(visitors).filter(v => v.status === 'online').length;
    const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    liveHistory.push({ time: timeStr, count: onlineCount });
    if (liveHistory.length > 20) {
        liveHistory.shift();
    }
    // Broadcast live stats update to agents
    io.to('agents-group').emit('update-live-stats', { liveHistory, stats });
}, 15000);

io.on('connection', (socket) => {
    // Determine connection type (visitor or agent)
    socket.on('register-visitor', (data) => {
        const visitorId = data.visitorId || socket.id;
        const roomId = `room-${visitorId}`;
        
        // Track analytics
        stats.pageViewsToday++;
        const ip = socket.handshake.address;
        if (!uniqueVisitorIPs.has(ip)) {
            uniqueVisitorIPs.add(ip);
            stats.visitorsToday++;
        }

        let existingVisitor = visitors[visitorId];

        if (existingVisitor) {
            // Reconnecting/Navigating visitor: Keep connection details & don't trigger new doorbell alert
            existingVisitor.socketId = socket.id;
            existingVisitor.url = data.url || existingVisitor.url;
            existingVisitor.status = 'online';
            
            socketVisitorMap[socket.id] = visitorId;
        } else {
            // Brand new visitor
            visitors[visitorId] = {
                id: visitorId,
                socketId: socket.id,
                roomId: roomId,
                name: data.name || `Visitor #${visitorId.substring(2, 6)}`,
                email: data.email || '',
                url: data.url || '',
                ip: ip,
                userAgent: socket.handshake.headers['user-agent'] || 'Unknown',
                status: 'online',
                chatStarted: data.chatStarted || false,
                connectedAt: Date.now()
            };
            socketVisitorMap[socket.id] = visitorId;
            
            // Notify agents about new visitor
            io.to('agents-group').emit('visitor-joined', visitors[visitorId]);
        }

        socket.join(roomId);
        
        // Notify all agents about visitor list and stats
        io.emit('update-visitors', Object.values(visitors));
        io.to('agents-group').emit('update-live-stats', { liveHistory, stats });
    });

    socket.on('register-agent', (data) => {
        agents[socket.id] = {
            id: socket.id,
            name: data.name || 'Support Agent'
        };
        // Join agent to all active chat rooms they want to monitor
        socket.join('agents-group');
        
        // Send current list of visitors and active chats and stats to the agent
        socket.emit('update-visitors', Object.values(visitors));
        socket.emit('update-active-chats', Object.values(activeChats));
        socket.emit('update-live-stats', { liveHistory, stats });
    });

    // Start a chat from visitor side
    socket.on('start-chat', (data) => {
        const visitorId = socketVisitorMap[socket.id];
        const visitor = visitors[visitorId];
        if (visitor) {
            visitor.chatStarted = true;
            visitor.name = data.name || visitor.name;
            visitor.email = data.email || visitor.email;
            
            const roomId = visitor.roomId;
            if (!activeChats[roomId]) {
                activeChats[roomId] = {
                    roomId: roomId,
                    visitor: visitor,
                    messages: [],
                    answered: false,
                    missedCounted: false
                };
            }
            io.to('agents-group').emit('chat-initiated', activeChats[roomId]);
            io.emit('update-visitors', Object.values(visitors));
        }
    });

    // Send Message
    socket.on('send-message', (data) => {
        const { roomId, sender, senderName, text } = data;
        const chat = activeChats[roomId];
        if (chat) {
            const message = {
                sender: sender,
                senderName: senderName,
                text: text,
                timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            };
            chat.messages.push(message);
            
            // Broadcast to the specific room (visitor + agents who joined it)
            io.to(roomId).emit('receive-message', message);
            
            // Also notify all agents in their group (for overview/notifications)
            io.to('agents-group').emit('chat-message-received', { roomId, message });
        }
    });

    // Agent joins a visitor's room to start talking
    socket.on('agent-join-room', (data) => {
        const { roomId } = data;
        socket.join(roomId);
        
        // Notify the visitor that an agent has joined the chat
        const agentName = agents[socket.id] ? agents[socket.id].name : 'Support Agent';
        io.to(roomId).emit('agent-joined', { name: agentName });

        // Update stats
        const chat = activeChats[roomId];
        if (chat && !chat.answered) {
            chat.answered = true;
            stats.chatsAnswered++;
            io.to('agents-group').emit('update-live-stats', { liveHistory, stats });
        }
    });

    socket.on('disconnect', () => {
        const visitorId = socketVisitorMap[socket.id];
        if (visitorId && visitors[visitorId]) {
            const visitor = visitors[visitorId];
            
            // Only set offline if the active socket matches the disconnecting one
            if (visitor.socketId === socket.id) {
                visitor.status = 'offline';
                
                // Wait 10 seconds before cleaning up to handle page navigation or reload
                setTimeout(() => {
                    if (visitors[visitorId] && visitors[visitorId].status === 'offline') {
                        delete visitors[visitorId];
                        delete socketVisitorMap[socket.id];
                        
                        // Keep chat history but mark visitor as offline
                        if (activeChats[visitor.roomId]) {
                            activeChats[visitor.roomId].visitor.status = 'offline';
                            
                            // Check if it was started but never answered
                            if (activeChats[visitor.roomId].visitor.chatStarted && !activeChats[visitor.roomId].answered && !activeChats[visitor.roomId].missedCounted) {
                                activeChats[visitor.roomId].missedCounted = true;
                                stats.chatsMissed++;
                            }
                        }
                        io.emit('update-visitors', Object.values(visitors));
                        io.to('agents-group').emit('update-active-chats', Object.values(activeChats));
                        io.to('agents-group').emit('update-live-stats', { liveHistory, stats });
                    }
                }, 10000);
            }
            
            io.emit('update-visitors', Object.values(visitors));
        } else if (agents[socket.id]) {
            delete agents[socket.id];
        }
    });
});

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`Smart Chat Server running on http://localhost:${PORT}`);
});
