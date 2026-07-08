@extends('back.admin.master')

@section('content')
<div class="page-content" style="padding: 1.5rem 1.5rem 0 1.5rem;">
    <!-- Top Action Bar & Tabs -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <!-- Breadcrumb on left -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-0">
            <div class="breadcrumb-title pe-3">Live Support</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Support Chat</li>
                    </ol>
                </nav>
            </div>
        </div>
        
        <!-- Toggle Tabs and Timeframe selector on right -->
        <div class="d-flex flex-wrap align-items-center gap-3">
            <select class="form-select" id="dashboard-timeframe" style="width: 190px; border-radius: 8px; font-weight: 700; height: 38px; border-color: #3bb77e; color: #2e7d32;">
                <option value="live" selected>Live Now</option>
                <option value="this_week">This Week</option>
                <option value="last_week">Last Week</option>
                <option value="this_month">This Month</option>
                <option value="last_month">Last Month</option>
                <option value="last_12_months">Last 12 Months</option>
            </select>

            <div class="d-flex align-items-center gap-2" id="support-tabs-container">
                <button type="button" class="btn btn-outline-success active" id="btn-tab-dashboard" style="font-weight: 700; border-radius: 8px;">
                    <i class="bx bx-tachometer"></i> Dashboard Overview
                </button>
                <button type="button" class="btn btn-outline-success" id="btn-tab-chat" style="font-weight: 700; border-radius: 8px;">
                    <i class="bx bx-chat"></i> Live Chat Console
                </button>
            </div>
        </div>
    </div>

    <!-- Panel 1: Stats Dashboard Overview -->
    <div id="panel-dashboard-overview" class="row">
        <!-- 4 Stats Cards -->
        <div class="col-12 col-md-3 mb-3">
            <div class="card shadow-none border mb-0" style="border-radius: 12px; height: 100%;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-secondary mb-1" id="card-live-label" style="font-size: 13px; font-weight: 600;">Live Visitors</p>
                            <h3 class="mb-0" id="card-live-count" style="font-weight: 700; color: #2d3748;">0</h3>
                        </div>
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: linear-gradient(135deg, #3bb77e 0%, #2e7d32 100%);">
                            <i id="card-live-icon" class="bx bx-group" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-3 mb-3">
            <div class="card shadow-none border mb-0" style="border-radius: 12px; height: 100%;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-secondary mb-1" style="font-size: 13px; font-weight: 600;">Unique Visitors Today</p>
                            <h3 class="mb-0" id="card-unique-count" style="font-weight: 700; color: #2d3748;">0</h3>
                        </div>
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">
                            <i class="bx bx-user-check" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-3 mb-3">
            <div class="card shadow-none border mb-0" style="border-radius: 12px; height: 100%;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-secondary mb-1" style="font-size: 13px; font-weight: 600;">Page Views Today</p>
                            <h3 class="mb-0" id="card-views-count" style="font-weight: 700; color: #2d3748;">0</h3>
                        </div>
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);">
                            <i class="bx bx-show-alt" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3 mb-3">
            <div class="card shadow-none border mb-0" style="border-radius: 12px; height: 100%;">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-secondary mb-1" style="font-size: 13px; font-weight: 600;">Chats (Answered / Missed)</p>
                            <h3 class="mb-0" style="font-weight: 700; color: #2d3748;">
                                <span id="card-chats-answered" class="text-success">0</span> 
                                <span style="font-size: 18px; font-weight: 400; color: #cbd5e1;">/</span> 
                                <span id="card-chats-missed" class="text-danger">0</span>
                            </h3>
                        </div>
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: linear-gradient(135deg, #6b7280 0%, #374151 100%);">
                            <i class="bx bx-conversation" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Chart Panel -->
        <div class="col-12 mb-3">
            <div class="card shadow-none border mb-0" style="border-radius: 12px;">
                <div class="card-header bg-transparent border-bottom" style="padding: 15px 24px;">
                    <h5 class="mb-0" id="chart-title-label" style="font-weight: 700; color: #2d3748;"><i class="bx bx-trending-up text-success"></i> Live Visitors Timeline</h5>
                </div>
                <div class="card-body" style="padding: 24px;">
                    <div style="height: 320px; position: relative;">
                        <canvas id="liveVisitorsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Monitoring List Table -->
        <div class="col-12 mb-3" id="live-monitoring-container">
            <div class="card shadow-none border mb-0" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between" style="padding: 15px 24px;">
                    <h5 class="mb-0" style="font-weight: 700; color: #2d3748;"><i class="bx bx-show-alt text-success"></i> Live Monitoring</h5>
                    <span class="badge bg-success" id="monitoring-badge-count" style="font-weight: 700;">0 Active</span>
                </div>
                <div class="card-body" style="padding: 0;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="border-collapse: collapse; width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th style="padding: 14px 24px; font-size: 12px; text-transform: uppercase; font-weight: 700; color: #64748b;">Visitor</th>
                                    <th style="padding: 14px 24px; font-size: 12px; text-transform: uppercase; font-weight: 700; color: #64748b;">IP Address</th>
                                    <th style="padding: 14px 24px; font-size: 12px; text-transform: uppercase; font-weight: 700; color: #64748b;">Current Page</th>
                                    <th style="padding: 14px 24px; font-size: 12px; text-transform: uppercase; font-weight: 700; color: #64748b;">Active Duration</th>
                                    <th style="padding: 14px 24px; font-size: 12px; text-transform: uppercase; font-weight: 700; color: #64748b; text-align: right;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="monitoring-table-body">
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-secondary" style="font-style: italic;">No active visitors online.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel 2: Live Chat Console (Hidden by default) -->
    <div id="panel-chat-console" class="card shadow-none border" style="border-radius: 12px; margin-bottom: 0; overflow: hidden; display: none;">
        <div class="dashboard-container">
            <!-- Sidebar: Navigation & Visitor List -->
            <div class="sidebar">
                <div class="agent-profile">
                    <div class="agent-avatar">SA</div>
                    <div class="agent-info">
                        <div class="agent-name">Support Agent</div>
                        <div class="agent-status"><span class="status-dot"></span> Online</div>
                    </div>
                </div>

                <div class="visitor-section-title">Active Visitors (<span id="visitors-count">0</span>)</div>
                <div id="visitors-list" class="visitors-list">
                    <div class="no-visitors">No visitors online</div>
                </div>
            </div>

            <!-- Main Panel: Chat Window -->
            <div class="chat-main">
                <!-- Chat Active Window -->
                <div id="chat-active-window" style="display: none;">
                    <div class="chat-main-header">
                        <div>
                            <h4 id="active-visitor-name" class="active-chat-title">Visitor Name</h4>
                            <p id="active-visitor-status" class="active-chat-subtitle">Online</p>
                        </div>
                        <button class="join-chat-btn" id="join-chat-action">Join Conversation</button>
                    </div>

                    <div id="dashboard-messages-list" class="dashboard-messages">
                        <!-- Dynamically populated -->
                    </div>

                    <div class="chat-main-footer">
                        <input type="text" id="dashboard-chat-input" placeholder="Type your reply here..." disabled />
                        <button id="dashboard-send-btn" class="dashboard-send-btn" disabled>Send</button>
                    </div>
                </div>

                <!-- Chat Empty State -->
                <div id="chat-empty-window" class="chat-empty-state">
                    <div class="empty-icon"><i class="fa-regular fa-comments"></i></div>
                    <h3>Select a visitor to start chatting</h3>
                    <p>Monitor active website visitors and click "Join Conversation" to reply.</p>
                </div>
            </div>

            <!-- Right Panel: Visitor details metadata -->
            <div class="details-panel">
                <div class="panel-header">Visitor Information</div>
                
                <div id="visitor-details-content" style="display: none;">
                    <div class="detail-avatar" id="detail-avatar-text">VI</div>
                    
                    <div class="detail-section">
                        <div class="detail-label">Name</div>
                        <div class="detail-value" id="detail-name">Martha Fiawoyi</div>
                    </div>
                    
                    <div class="detail-section">
                        <div class="detail-label">Email</div>
                        <div class="detail-value" id="detail-email">fiawoyimartha@gmail.com</div>
                    </div>

                    <div class="detail-section">
                        <div class="detail-label">Current Page</div>
                        <div class="detail-value" id="detail-url"><a href="#" target="_blank">http://localhost:8000/</a></div>
                    </div>

                    <div class="detail-section">
                        <div class="detail-label">IP Address</div>
                        <div class="detail-value" id="detail-ip">127.0.0.1</div>
                    </div>

                    <div class="detail-section">
                        <div class="detail-label">Browser / User Agent</div>
                        <div class="detail-value" id="detail-ua">Chrome / Windows</div>
                    </div>
                </div>

                <div id="visitor-details-empty" class="visitor-details-empty">
                    Select an active visitor to view metadata details.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles for Native Chat Panel -->
<style>
    .dashboard-container {
        display: flex;
        height: calc(100vh - 190px);
        min-height: 500px;
        overflow: hidden;
    }

    /* Sidebar Panel */
    .sidebar {
        width: 260px;
        background: #1e293b;
        color: white;
        display: flex;
        flex-direction: column;
        border-right: 1px solid #e2e8f0;
    }

    .agent-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        background: rgba(255,255,255,0.02);
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .agent-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #3bb77e;
        color: white;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .agent-name {
        font-size: 13px;
        font-weight: 600;
    }

    .agent-status {
        font-size: 10px;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-top: 2px;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #3bb77e;
        display: inline-block;
    }

    .visitor-section-title {
        font-size: 10px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        padding: 16px 20px 8px;
        letter-spacing: 0.5px;
    }

    .visitors-list {
        flex: 1;
        overflow-y: auto;
    }

    .no-visitors {
        padding: 30px 20px;
        text-align: center;
        color: #94a3b8;
        font-size: 12px;
    }

    .visitor-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        cursor: pointer;
        transition: background 0.2s ease;
        border-left: 3px solid transparent;
    }

    .visitor-item:hover {
        background: rgba(255,255,255,0.03);
    }

    .visitor-item.selected {
        background: rgba(255,255,255,0.06);
        border-left-color: #3bb77e;
    }

    .visitor-item-avatar {
        position: relative;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        color: #94a3b8;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .visitor-status-indicator {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        border: 2px solid #1e293b;
    }

    .visitor-status-indicator.online { background: #3bb77e; }
    .visitor-status-indicator.offline { background: #94a3b8; }

    .visitor-item-info {
        flex: 1;
        min-width: 0;
    }

    .visitor-item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2px;
    }

    .visitor-item-name {
        font-size: 12.5px;
        font-weight: 600;
        color: #f1f5f9;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .unread-badge {
        background: #d9534f;
        color: white;
        font-size: 9px;
        font-weight: 700;
        padding: 1px 5px;
        border-radius: 10px;
    }

    .visitor-item-preview {
        font-size: 11.5px;
        color: #94a3b8;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Main Chat Panel */
    .chat-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #f8f9fa;
    }

    .chat-empty-state {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        padding: 40px;
        text-align: center;
    }

    .empty-icon {
        font-size: 50px;
        margin-bottom: 12px;
        color: #cbd5e1;
    }

    .chat-empty-state h3 {
        font-weight: 700;
        color: #334155;
        margin: 0 0 8px 0;
    }

    #chat-active-window {
        flex: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .chat-main-header {
        background: white;
        padding: 12px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .active-chat-title {
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 2px 0;
        color: #1e293b;
    }

    .active-chat-subtitle {
        font-size: 11.5px;
        margin: 0;
    }

    .status-online { color: #3bb77e; font-weight: 600; }
    .status-offline { color: #64748b; }

    .join-chat-btn {
        background: #3bb77e;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-weight: 700;
        font-size: 12.5px;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .join-chat-btn:hover {
        background: #2e7d32;
    }

    .dashboard-messages {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        background: #f1f5f9;
    }

    .dashboard-message {
        max-width: 70%;
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.4;
        word-break: break-word;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .dashboard-message.msg-incoming {
        align-self: flex-start;
        background: white;
        color: #334155;
        border-bottom-left-radius: 3px;
    }

    .dashboard-message.msg-outgoing {
        align-self: flex-end;
        background: #3bb77e;
        color: white;
        border-bottom-right-radius: 3px;
    }

    .msg-sender-name {
        font-size: 9px;
        font-weight: 700;
        margin-bottom: 3px;
        opacity: 0.8;
    }

    .msg-text-content {
        font-weight: 500;
    }

    .msg-timestamp {
        font-size: 8.5px;
        text-align: right;
        margin-top: 4px;
        opacity: 0.6;
    }

    .no-messages-alert {
        align-self: center;
        color: #64748b;
        font-size: 12.5px;
        font-style: italic;
        margin-top: 40px;
    }

    .chat-main-footer {
        background: white;
        padding: 16px 24px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .chat-main-footer input {
        flex: 1;
        height: 40px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        padding: 0 14px;
        font-size: 13px;
        background: #f8fafc;
        box-sizing: border-box;
    }

    .chat-main-footer input:focus {
        outline: none;
        border-color: #3bb77e;
        background: white;
    }

    .dashboard-send-btn {
        background: #3bb77e;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0 20px;
        height: 40px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .dashboard-send-btn:hover:not(:disabled) {
        background: #2e7d32;
    }

    .dashboard-send-btn:disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
    }

    /* Details Panel */
    .details-panel {
        width: 250px;
        background: white;
        border-left: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
    }

    .panel-header {
        padding: 16px 20px;
        font-weight: 700;
        font-size: 14px;
        border-bottom: 1px solid #e2e8f0;
        color: #1e293b;
    }

    #visitor-details-content {
        padding: 20px;
        overflow-y: auto;
        flex: 1;
    }

    .detail-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .detail-section {
        margin-bottom: 16px;
    }

    .detail-label {
        font-size: 9.5px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 12.5px;
        font-weight: 600;
        color: #334155;
        word-break: break-all;
    }

    .detail-value a {
        color: #3bb77e;
        text-decoration: none;
    }

    .detail-value a:hover {
        text-decoration: underline;
    }

    .visitor-details-empty {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #94a3b8;
        font-size: 12.5px;
        padding: 20px;
    }
</style>

<!-- Chart.js and Socket.io Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const socket = io('http://localhost:3000');

        let visitorsList = [];
        let activeChats = {};
        let selectedVisitor = null;
        let joinedRooms = new Set();

        // -------------------------
        // 1. Tab Switching Actions
        // -------------------------
        const btnTabDashboard = document.getElementById('btn-tab-dashboard');
        const btnTabChat = document.getElementById('btn-tab-chat');
        const panelDashboard = document.getElementById('panel-dashboard-overview');
        const panelChat = document.getElementById('panel-chat-console');

        btnTabDashboard.addEventListener('click', () => {
            btnTabDashboard.classList.add('active');
            btnTabChat.classList.remove('active');
            panelDashboard.style.display = 'flex';
            panelChat.style.display = 'none';
        });

        btnTabChat.addEventListener('click', () => {
            btnTabChat.classList.add('active');
            btnTabDashboard.classList.remove('active');
            panelDashboard.style.display = 'none';
            panelChat.style.display = 'flex';
            
            // Re-render chat messages if visitor is selected
            if (selectedVisitor) {
                renderMessages(selectedVisitor.roomId);
            }
        });

        // -------------------------
        // 2. Chart.js Initialization
        // -------------------------
        const chartCtx = document.getElementById('liveVisitorsChart').getContext('2d');
        const liveChart = new Chart(chartCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Online Visitors',
                    data: [],
                    borderColor: '#3bb77e',
                    backgroundColor: 'rgba(59, 183, 126, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            precision: 0,
                            callback: function(value) {
                                if (value % 1 === 0) {
                                    return value;
                                }
                            }
                        }
                    }],
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                            }
                        }
                    }
                }
            }
        });

        // Register agent
        socket.emit('register-agent', { name: 'Support Agent' });

        // Sound notification
        const notificationSound = new Audio('https://assets.mixkit.co/active_storage/sfx/2357/2357-84.wav');

        // Synthetic Doorbell Sound Generator (Ding-Dong) using Web Audio API
        function playDoorbell() {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (!AudioContext) return;
                const ctx = new AudioContext();
                
                const now = ctx.currentTime;
                
                // --- Note 1: DING ---
                const osc1 = ctx.createOscillator();
                const gain1 = ctx.createGain();
                osc1.type = 'sine';
                osc1.frequency.setValueAtTime(659.25, now); // E5 note (high pitch)
                
                // Decay envelope for Ding
                gain1.gain.setValueAtTime(0.35, now);
                gain1.gain.exponentialRampToValueAtTime(0.001, now + 1.2);
                
                osc1.connect(gain1);
                gain1.connect(ctx.destination);
                
                // --- Note 2: DONG ---
                const osc2 = ctx.createOscillator();
                const gain2 = ctx.createGain();
                osc2.type = 'sine';
                osc2.frequency.setValueAtTime(523.25, now + 0.35); // C5 note (lower pitch)
                
                // Decay envelope for Dong
                gain2.gain.setValueAtTime(0.001, now);
                gain2.gain.setValueAtTime(0.35, now + 0.35); // Fade in quickly at start of Dong
                gain2.gain.exponentialRampToValueAtTime(0.001, now + 1.8);
                
                osc2.connect(gain2);
                gain2.connect(ctx.destination);
                
                // Play note sequences
                osc1.start(now);
                osc1.stop(now + 1.2);
                
                osc2.start(now + 0.35);
                osc2.stop(now + 1.8);
            } catch (e) {
                console.log("Web Audio doorbell play failed:", e);
            }
        }

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

        // Timeframe elements
        const timeframeSelector = document.getElementById('dashboard-timeframe');
        const cardLiveLabel = document.getElementById('card-live-label');
        const cardLiveIcon = document.getElementById('card-live-icon');
        const cardLiveCount = document.getElementById('card-live-count');
        const cardUniqueCount = document.getElementById('card-unique-count');
        const cardViewsCount = document.getElementById('card-views-count');
        const cardChatsAnswered = document.getElementById('card-chats-answered');
        const cardChatsMissed = document.getElementById('card-chats-missed');
        const chartTitleLabel = document.getElementById('chart-title-label');

        const timeframesData = @json($timeframes);

        let liveStats = {
            liveCount: 0,
            uniqueCount: 0,
            viewsCount: 0,
            answered: 0,
            missed: 0,
            chartLabels: [],
            chartData: []
        };

        // Receive real-time analytics updates
        socket.on('update-live-stats', (data) => {
            const { liveHistory, stats } = data;
            
            // Update live cache
            liveStats.liveCount = liveHistory.length > 0 ? liveHistory[liveHistory.length - 1].count : 0;
            liveStats.uniqueCount = stats.visitorsToday;
            liveStats.viewsCount = stats.pageViewsToday;
            liveStats.answered = stats.chatsAnswered;
            liveStats.missed = stats.chatsMissed;
            liveStats.chartLabels = liveHistory.map(h => h.time);
            liveStats.chartData = liveHistory.map(h => h.count);

            // Update DOM only if selector is on "live"
            if (timeframeSelector.value === 'live') {
                cardLiveCount.textContent = liveStats.liveCount;
                cardUniqueCount.textContent = liveStats.uniqueCount;
                cardViewsCount.textContent = liveStats.viewsCount;
                cardChatsAnswered.textContent = liveStats.answered;
                cardChatsMissed.textContent = liveStats.missed;

                liveChart.data.labels = liveStats.chartLabels;
                liveChart.data.datasets[0].data = liveStats.chartData;
                liveChart.update();
            }
        });

        // Timeframe selector handler
        timeframeSelector.addEventListener('change', function() {
            const val = this.value;
            
            if (val === 'live') {
                cardLiveLabel.textContent = "Live Visitors";
                cardLiveIcon.className = "bx bx-group";
                chartTitleLabel.innerHTML = '<i class="bx bx-trending-up text-success"></i> Live Visitors Timeline';
                document.getElementById('live-monitoring-container').style.display = 'block';
                
                cardLiveCount.textContent = liveStats.liveCount;
                cardUniqueCount.textContent = liveStats.uniqueCount;
                cardViewsCount.textContent = liveStats.viewsCount;
                cardChatsAnswered.textContent = liveStats.answered;
                cardChatsMissed.textContent = liveStats.missed;

                liveChart.data.labels = liveStats.chartLabels;
                liveChart.data.datasets[0].data = liveStats.chartData;
                liveChart.update();
            } else {
                const data = timeframesData[val];
                if (data) {
                    cardLiveLabel.textContent = "Total Registered Users";
                    cardLiveIcon.className = "bx bx-user-plus";
                    document.getElementById('live-monitoring-container').style.display = 'none';
                    
                    const prettyTitles = {
                        'this_week': 'This Week\'s Timeline',
                        'last_week': 'Last Week\'s Timeline',
                        'this_month': 'This Month\'s Timeline',
                        'last_month': 'Last Month\'s Timeline',
                        'last_12_months': 'Last 12 Months\' Timeline'
                    };
                    chartTitleLabel.innerHTML = `<i class="bx bx-calendar-event text-success"></i> ${prettyTitles[val]}`;

                    cardLiveCount.textContent = data.users;
                    cardUniqueCount.textContent = data.stats.unique_visitors;
                    cardViewsCount.textContent = data.stats.page_views;
                    cardChatsAnswered.textContent = data.stats.chats_answered;
                    cardChatsMissed.textContent = data.stats.chats_missed;

                    // Plot historical charts
                    if (data.chart.labels.length === 0) {
                        // Generate mock display line for empty analytics database
                        let mockLabels = [];
                        let mockData = [];
                        if (val === 'this_week' || val === 'last_week') {
                            mockLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                            mockData = [0, 0, 0, 0, 0, 0, 0];
                        } else if (val === 'this_month' || val === 'last_month') {
                            mockLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
                            mockData = [0, 0, 0, 0];
                        } else {
                            mockLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                            mockData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                        }
                        liveChart.data.labels = mockLabels;
                        liveChart.data.datasets[0].data = mockData;
                    } else {
                        liveChart.data.labels = data.chart.labels;
                        liveChart.data.datasets[0].data = data.chart.data;
                    }
                    liveChart.update();
                }
            }
        });

        // Sound alert for new visitor landing on site
        socket.on('visitor-joined', (visitor) => {
            playDoorbell();
        });

        // Receive visitor list updates
        socket.on('update-visitors', (data) => {
            visitorsList = data;
            visitorsCountEl.textContent = visitorsList.length;
            renderVisitors();
            renderMonitoringTable();
        });

        // Live Monitoring List Renderer
        function renderMonitoringTable() {
            const tableBody = document.getElementById('monitoring-table-body');
            const badgeCount = document.getElementById('monitoring-badge-count');
            
            const activeOnline = visitorsList.filter(v => v.status === 'online');
            badgeCount.textContent = `${activeOnline.length} Active`;
            
            if (activeOnline.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center py-4 text-secondary" style="font-style: italic;">No active visitors online.</td>
                    </tr>
                `;
                return;
            }

            tableBody.innerHTML = '';
            activeOnline.forEach(visitor => {
                const diffMs = Date.now() - (visitor.connectedAt || Date.now());
                const diffSec = Math.floor(diffMs / 1000);
                const min = String(Math.floor(diffSec / 60)).padStart(2, '0');
                const sec = String(diffSec % 60).padStart(2, '0');
                const durationStr = `${min}:${sec}`;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td style="padding: 14px 24px;">
                        <div class="d-flex align-items-center gap-2">
                            <span class="status-dot" style="width: 8px; height: 8px; border-radius: 50%; background: #3bb77e; display: inline-block;"></span>
                            <span style="font-weight: 600; color: #334155;">${visitor.name}</span>
                        </div>
                    </td>
                    <td style="padding: 14px 24px; color: #64748b; font-family: monospace; font-size: 13px;">
                        ${visitor.ip || '127.0.0.1'}
                    </td>
                    <td style="padding: 14px 24px; font-size: 13px;">
                        <a href="${visitor.url}" target="_blank" style="color: #3bb77e; text-decoration: none; font-weight: 500;">
                            ${visitor.url}
                        </a>
                    </td>
                    <td style="padding: 14px 24px; color: #475569; font-weight: 500;" class="duration-cell">
                        ${durationStr}
                    </td>
                    <td style="padding: 14px 24px; text-align: right;">
                        <button class="btn btn-sm btn-success btn-chat-now" data-id="${visitor.id}" style="border-radius: 6px; font-weight: 700; font-size: 12px; background: #3bb77e; border-color: #3bb77e; padding: 6px 12px;">
                            <i class="bx bx-chat"></i> Chat Now
                        </button>
                    </td>
                `;

                row.querySelector('.btn-chat-now').addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const visitorObj = visitorsList.find(v => v.id === id);
                    if (visitorObj) {
                        btnTabChat.click();
                        selectVisitor(visitorObj);
                    }
                });

                tableBody.appendChild(row);
            });
        }

        // Keep active durations counting up every second
        setInterval(() => {
            if (timeframeSelector.value === 'live' && panelDashboard.style.display !== 'none') {
                const durationCells = document.querySelectorAll('#monitoring-table-body tr');
                durationCells.forEach((row, index) => {
                    const activeOnline = visitorsList.filter(v => v.status === 'online');
                    const visitor = activeOnline[index];
                    if (visitor) {
                        const cell = row.querySelector('.duration-cell');
                        if (cell) {
                            const diffMs = Date.now() - (visitor.connectedAt || Date.now());
                            const diffSec = Math.floor(diffMs / 1000);
                            const min = String(Math.floor(diffSec / 60)).padStart(2, '0');
                            const sec = String(diffSec % 60).padStart(2, '0');
                            cell.textContent = `${min}:${sec}`;
                        }
                    }
                });
            }
        }, 1000);

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
                if (!activeChats[roomId].messages) activeChats[roomId].messages = [];
                activeChats[roomId].messages.push(message);

                if (!selectedVisitor || selectedVisitor.roomId !== roomId) {
                    if (!activeChats[roomId].unread) activeChats[roomId].unread = 0;
                    activeChats[roomId].unread++;
                    try {
                        notificationSound.play();
                    } catch (e) {}
                } else {
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
            
            if (activeChats[visitor.roomId]) {
                activeChats[visitor.roomId].unread = 0;
            }

            chatEmptyWindow.style.display = 'none';
            chatActiveWindow.style.display = 'flex';
            detailsEmpty.style.display = 'none';
            detailsContent.style.display = 'block';

            activeVisitorName.textContent = visitor.name;
            activeVisitorStatus.className = `active-chat-subtitle ${visitor.status === 'online' ? 'status-online' : 'status-offline'}`;
            activeVisitorStatus.textContent = visitor.status === 'online' ? 'Online' : 'Offline';

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

                // Update chat answered status in Laravel backend database
                fetch(`/chat-analytics/update?type=answered&ip=${encodeURIComponent(selectedVisitor.ip)}`);
            }
        });

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
    });
</script>
@endsection
