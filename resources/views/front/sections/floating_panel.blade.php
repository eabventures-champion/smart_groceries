<!-- Static Vertical Floating SG Panel -->
<style>
    /* Premium Design System Overrides */
    #sg-floating-dock {
        position: fixed !important;
        right: 0 !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        z-index: 9999 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        background: rgba(255, 255, 255, 0.92) !important;
        backdrop-filter: blur(16px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(16px) saturate(180%) !important;
        border: 2px solid #bbf7d0 !important;
        border-right: none !important;
        padding: 20px 8px !important;
        border-radius: 20px 0 0 20px !important;
        box-shadow: -4px 0 25px rgba(0, 0, 0, 0.06) !important;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    #sg-floating-dock.sg-dock-hidden {
        transform: translateY(-50%) translateX(110%) !important;
        pointer-events: none !important;
    }
    
    #sg-restore-handle {
        position: fixed !important;
        right: 0 !important;
        top: 55% !important;
        z-index: 9998 !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        background: #3BB77E !important; /* Nest theme primary green */
        color: white !important;
        padding: 14px 6px !important;
        border-radius: 10px 0 0 10px !important;
        cursor: pointer !important;
        box-shadow: -2px 0 12px rgba(59, 183, 126, 0.3) !important;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    #sg-restore-handle.sg-restore-hidden {
        transform: translateX(110%) !important;
    }
    
    #sg-floating-drawer {
        position: fixed !important;
        right: -450px;
        top: 0 !important;
        bottom: 0 !important;
        width: 420px !important;
        max-width: 100%;
        z-index: 10000 !important;
        background: rgba(255, 255, 255, 0.96) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        border-left: 1px solid rgba(229, 231, 235, 0.8) !important;
        box-shadow: -10px 0 35px rgba(0, 0, 0, 0.1) !important;
        transition: right 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
        display: flex !important;
        flex-direction: column !important;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    }

    #sg-floating-drawer.open {
        right: 0 !important;
    }

    #sg-floating-dock.sg-dock-shifted {
        transform: translateY(-50%) translateX(-420px) !important;
    }

    .sg-vertical-text {
        writing-mode: vertical-rl;
        text-orientation: mixed;
        transform: rotate(180deg);
    }

    /* Tabs & Navigation inside dock */
    .sg-dock-btn {
        background: transparent !important;
        border: none !important;
        outline: none !important;
        padding: 12px !important;
        border-radius: 12px !important;
        color: #718096 !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .sg-dock-btn:hover {
        background-color: rgba(59, 183, 126, 0.1) !important;
        color: #3BB77E !important;
    }
    
    /* Active indicator label */
    .sg-tooltip {
        position: absolute !important;
        right: 55px !important;
        background: #1a202c !important;
        color: white !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        padding: 6px 12px !important;
        border-radius: 6px !important;
        opacity: 0 !important;
        transform: scale(0.9) translateY(-50%) !important;
        top: 50% !important;
        transition: all 0.2s ease !important;
        pointer-events: none !important;
        white-space: nowrap !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }
    .sg-dock-btn:hover .sg-tooltip {
        opacity: 1 !important;
        transform: scale(1) translateY(-50%) !important;
    }

    /* Drawer layout styling */
    .sg-drawer-header {
        background: linear-gradient(135deg, #3BB77E 0%, #2fa56f 100%) !important;
        color: white !important;
        padding: 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }
    #sg-drawer-title {
        color: #ffffff !important;
    }
    #sg-drawer-subtitle {
        color: #e2e8f0 !important; /* Ash color close to white */
    }
    /* Selection styles inside green elements for visibility */
    .sg-drawer-header ::selection, .sg-drawer-header *::selection,
    .sg-dock-btn ::selection, .sg-dock-btn *::selection,
    .sg-btn-primary ::selection, .sg-btn-primary *::selection,
    .sg-cat-pill.active ::selection, .sg-cat-pill.active *::selection,
    #sg-drawer-title::selection, #sg-drawer-title *::selection,
    #sg-drawer-subtitle::selection, #sg-drawer-subtitle *::selection {
        background: #185a3c !important;
        color: #ffffff !important;
    }
    .sg-drawer-header ::-moz-selection, .sg-drawer-header *::-moz-selection,
    .sg-dock-btn ::-moz-selection, .sg-dock-btn *::-moz-selection,
    .sg-btn-primary ::-moz-selection, .sg-btn-primary *::-moz-selection,
    .sg-cat-pill.active ::-moz-selection, .sg-cat-pill.active *::-moz-selection,
    #sg-drawer-title::-moz-selection, #sg-drawer-title *::-moz-selection,
    #sg-drawer-subtitle::-moz-selection, #sg-drawer-subtitle *::-moz-selection {
        background: #185a3c !important;
        color: #ffffff !important;
    }
    
    .sg-drawer-close {
        background: rgba(255, 255, 255, 0.15) !important;
        border: none !important;
        color: white !important;
        padding: 8px !important;
        border-radius: 8px !important;
        cursor: pointer !important;
        transition: all 0.2s !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .sg-drawer-close:hover {
        background: rgba(255, 255, 255, 0.25) !important;
    }

    .sg-drawer-body {
        flex: 1 !important;
        overflow-y: auto !important;
        padding: 20px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 20px !important;
    }

    /* Content Cards styling */
    .sg-card {
        background: white !important;
        border: 1px solid #edf2f7 !important;
        border-radius: 16px !important;
        padding: 16px !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02) !important;
        transition: all 0.2s ease !important;
    }
    .sg-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
        border-color: rgba(59, 183, 126, 0.2) !important;
    }

    .sg-badge {
        display: inline-block !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        padding: 4px 8px !important;
        border-radius: 9999px !important;
        text-transform: uppercase !important;
    }
    .sg-badge-success { background: #e6fffa !important; color: #319795 !important; border: 1px solid #b2f5ea !important; }
    .sg-badge-warning { background: #fffaf0 !important; color: #dd6b20 !important; border: 1px solid #fbd38d !important; }
    .sg-badge-danger { background: #fff5f5 !important; color: #e53e3e !important; border: 1px solid #fed7d7 !important; }
    .sg-badge-info { background: #ebf8ff !important; color: #3182ce !important; border: 1px solid #bee3f8 !important; }

    /* Button system */
    .sg-btn-primary {
        background-color: #3BB77E !important;
        color: white !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        padding: 10px 16px !important;
        border-radius: 10px !important;
        border: none !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        width: 100% !important;
        box-shadow: 0 4px 10px rgba(59, 183, 126, 0.2) !important;
    }
    .sg-btn-primary:hover {
        background-color: #2fa56f !important;
        box-shadow: 0 4px 14px rgba(59, 183, 126, 0.3) !important;
    }
    .sg-btn-primary:disabled {
        background-color: #cbd5e0 !important;
        cursor: not-allowed !important;
        box-shadow: none !important;
    }

    .sg-btn-outline {
        background-color: transparent !important;
        color: #3BB77E !important;
        border: 1px solid rgba(59, 183, 126, 0.3) !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        padding: 10px 16px !important;
        border-radius: 10px !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
    }
    .sg-btn-outline:hover {
        background-color: rgba(59, 183, 126, 0.05) !important;
        border-color: #3BB77E !important;
    }

    /* Form Fields */
    .sg-form-group {
        margin-bottom: 14px !important;
    }
    .sg-form-label {
        display: block !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        color: #4a5568 !important;
        margin-bottom: 6px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }
    .sg-input, .sg-select, .sg-textarea {
        width: 100% !important;
        font-size: 12px !important;
        padding: 10px !important;
        border-radius: 8px !important;
        border: 1px solid #cbd5e0 !important;
        background-color: #fff !important;
        color: #2d3748 !important;
        transition: all 0.2s !important;
        box-sizing: border-box !important;
    }
    .sg-input:focus, .sg-select:focus, .sg-textarea:focus {
        border-color: #3BB77E !important;
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.15) !important;
    }

    /* Expert Categories */
    .sg-expert-cat-bar {
        display: flex !important;
        gap: 6px !important;
        overflow-x: auto !important;
        padding-bottom: 6px !important;
        border-bottom: 1px solid #edf2f7 !important;
        scrollbar-width: none !important;
    }
    .sg-expert-cat-bar::-webkit-scrollbar { display: none; }
    
    .sg-cat-pill {
        padding: 6px 12px !important;
        background: #f7fafc !important;
        color: #4a5568 !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        cursor: pointer !important;
        transition: all 0.2s !important;
        white-space: nowrap !important;
    }
    .sg-cat-pill:hover { background: #edf2f7 !important; }
    .sg-cat-pill.active {
        background: #3BB77E !important;
        color: white !important;
        border-color: #3BB77E !important;
    }

    /* Scrollbar */
    .sg-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .sg-scrollbar::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.01);
    }
    .sg-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(59, 183, 126, 0.25);
        border-radius: 4px;
    }
    .sg-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(59, 183, 126, 0.4);
    }

    /* Sub-panels (readers/booking overlays) */
    .sg-sub-panel {
        position: absolute !important;
        inset: 0 !important;
        top: 68px !important; /* height of header */
        background: white !important;
        z-index: 50 !important;
        display: flex !important;
        flex-direction: column !important;
        box-shadow: inset 0 4px 10px rgba(0,0,0,0.05) !important;
    }
    .sg-sub-panel.hidden {
        display: none !important;
    }

    .sg-pulse-dot {
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: sg-pulse 1.6s infinite;
    }
    @keyframes sg-pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    /* Timeline Stepper */
    .sg-timeline {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        font-size: 8px !important;
        font-weight: 900 !important;
        text-transform: uppercase !important;
        color: #a0aec0 !important;
        letter-spacing: 0.5px !important;
        padding-top: 8px !important;
    }
    .sg-step {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        gap: 4px !important;
    }
    .sg-step-circle {
        width: 20px !important;
        height: 20px !important;
        border-radius: 50% !important;
        border: 2px solid #e2e8f0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 9px !important;
        background: white !important;
    }
    .sg-step.active { color: #3BB77E !important; }
    .sg-step.active .sg-step-circle {
        border-color: #3BB77E !important;
        color: #3BB77E !important;
        background: #f0fdf4 !important;
    }
    .sg-step-line {
        flex: 1 !important;
        height: 2px !important;
        background: #edf2f7 !important;
        margin: 0 8px !important;
        margin-top: -12px !important;
    }

    /* Mobile responsiveness styles */
    @media (max-width: 640px) {
        #sg-floating-drawer {
            width: 100% !important;
            right: -100%;
            border-left: none !important;
        }
        #sg-floating-drawer.open {
            right: 0 !important;
        }
        
        #sg-floating-dock {
            bottom: 20px !important;
            top: auto !important;
            left: 50% !important;
            right: auto !important;
            transform: translateX(-50%) !important;
            flex-direction: row !important;
            border-radius: 9999px !important;
            padding: 8px 16px !important;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.18) !important;
            border: 2px solid #bbf7d0 !important;
        }
        #sg-floating-dock.sg-dock-shifted {
            transform: translateX(-50%) !important;
        }
        #sg-floating-dock.sg-dock-hidden {
            transform: translateX(-50%) translateY(150%) !important;
            pointer-events: none !important;
        }

        #sg-floating-dock .flex-col {
            flex-direction: row !important;
            gap: 12px !important;
        }
        .sg-dock-btn {
            padding: 10px !important;
        }
        .sg-vertical-text {
            writing-mode: horizontal-tb !important;
            transform: none !important;
        }
        #sg-hide-btn {
            border-top: none !important;
            border-left: 1px solid #edf2f7 !important;
            padding-left: 12px !important;
            margin-top: 0 !important;
            width: auto !important;
        }
        
        #sg-restore-handle {
            top: auto !important;
            bottom: 20px !important;
            left: 50% !important;
            right: auto !important;
            transform: translateX(-50%) !important;
            padding: 12px 18px !important;
            border-radius: 9999px !important;
            flex-direction: row !important;
            gap: 8px !important;
            box-shadow: 0 4px 18px rgba(59, 183, 126, 0.4) !important;
        }
        #sg-restore-handle.sg-restore-hidden {
            transform: translateX(-50%) translateY(150%) !important;
        }
    }

    /* Blog Category Filter & Scrollbar Hiding */
    .sg-category-pill {
        display: inline-block !important;
        padding: 6px 14px !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        border-radius: 20px !important;
        background-color: #f3f4f6 !important;
        color: #4b5563 !important;
        cursor: pointer !important;
        transition: all 0.2s ease-in-out !important;
        border: 1px solid transparent !important;
        user-select: none !important;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02) !important;
    }
    .sg-category-pill:hover {
        background-color: #e5e7eb !important;
        color: #1f2937 !important;
    }
    .sg-category-pill.active {
        background-color: #3BB77E !important;
        color: #ffffff !important;
        box-shadow: 0 2px 8px rgba(59, 183, 126, 0.25) !important;
    }
    .sg-hide-scrollbar::-webkit-scrollbar {
        display: none !important;
    }
    .sg-hide-scrollbar {
        -ms-overflow-style: none !important;
        scrollbar-width: none !important;
    }
</style>

<!-- Floating Vertical Tab Dock -->
<div id="sg-floating-dock">
    <div class="flex-col" style="display: flex; flex-direction: column; align-items: center; gap: 8px; width: 100%;">
        <!-- Brand Label -->
        <div style="display: flex; align-items: center; gap: 4px; border-bottom: 1px solid #edf2f7; padding-bottom: 8px; width: 100%; justify-content: center;">
            <span style="font-size: 13px; font-weight: 900; color: #3BB77E; letter-spacing: 0.5px;">SG</span>
        </div>

        <!-- Tab 1: Connect to Expert -->
        <button onclick="toggleSgDrawer('expert')" class="sg-dock-btn" title="Connect to an Expert">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
            </svg>
            <span class="sg-tooltip">Connect to Expert</span>
        </button>

        <!-- Tab 2: Blog -->
        <button onclick="toggleSgDrawer('blog')" class="sg-dock-btn" title="SG Blog / News">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
            </svg>
            <span class="sg-tooltip">Blog & News</span>
        </button>

        <!-- Tab 3: Affiliate -->
        <button onclick="toggleSgDrawer('affiliate')" class="sg-dock-btn" title="Affiliate Programme">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.214-.145c.456-.31.867-.68 1.218-1.102m3.67 4.909a8.803 8.803 0 002.235-4.503m0 0a8.974 8.974 0 00-2.327-4.53M10.974 4.56a8.3 8.3 0 012.019-.37m0 0a8.284 8.284 0 012.235.37m-4.254-.37a8.974 8.974 0 00-2.285 4.53m0 0A8.803 8.803 0 0010.97 13.12M12 2.25a9.75 9.75 0 110 19.5 9.75 9.75 0 010-19.5z" />
            </svg>
            <span class="sg-tooltip">Affiliate Programme</span>
        </button>

        <!-- Tab 4: Request Item -->
        <button onclick="toggleSgDrawer('request')" class="sg-dock-btn" title="Request an Item">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            <span class="sg-tooltip">Request an Item</span>
        </button>

        <!-- Hide/Toggle Tab -->
        <button id="sg-hide-btn" style="background: transparent; border: none; padding: 10px; cursor: pointer; color: #a0aec0;" title="Hide SG Panel">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 16px; height: 16px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<!-- Tiny Restoring Handle (Visible only when dock is hidden) -->
<div id="sg-restore-handle" class="sg-restore-hidden">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 16px; height: 16px;">
        <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
    </svg>
    <span class="sg-vertical-text" style="font-size: 9px; font-weight: 900; letter-spacing: 0.5px; margin: 4px 0;">SG Panel</span>
</div>

<!-- Sliding Side Drawer Panel -->
<div id="sg-floating-drawer">
    <!-- Header -->
    <div class="sg-drawer-header">
        <div>
            <h2 id="sg-drawer-title" style="margin: 0; font-size: 16px; font-weight: 800; letter-spacing: 0.3px; color: #ffffff !important;">Smart Groceries</h2>
            <p id="sg-drawer-subtitle" style="margin: 3px 0 0 0; font-size: 11px; color: rgba(255, 255, 255, 0.85) !important; font-weight: 500;">Campus & Lifestyle Hub</p>
        </div>
        <button onclick="closeSgDrawer()" class="sg-drawer-close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width: 18px; height: 18px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Main Drawer Content Area -->
    <div class="sg-drawer-body sg-scrollbar">
        
        <!-- ==================== TAB 1: CONNECT TO EXPERT ==================== -->
        <div id="sg-tab-content-expert" class="sg-tab-content" style="display: flex; flex-direction: column; gap: 16px; width: 100%;">
            <div style="background-color: #f0fdf4; border: 1px solid #dcfce7; border-radius: 12px; padding: 12px; display: flex; gap: 12px;">
                <div style="font-size: 20px;">🛡️</div>
                <div>
                    <h4 style="margin: 0 0 4px 0; font-size: 13px; font-weight: 700; color: #166534;">Verified Consultations</h4>
                    <p style="margin: 0; font-size: 11px; color: #166534; line-height: 1.4;">Access certified health & wellness professionals to keep your diet and academic lifestyle on track.</p>
                </div>
            </div>

            <!-- Expert Category Tabs (dynamic) -->
            <div id="experts-categories-bar" class="sg-expert-cat-bar">
                <!-- Loaded dynamically via AJAX -->
            </div>

            <!-- Loading spinner for experts -->
            <div id="experts-loader" style="display: none; text-align: center; padding: 30px 0;">
                <div style="display: inline-block; width: 28px; height: 28px; border: 3px solid #e2e8f0; border-top-color: #3BB77E; border-radius: 50%; animation: sg-spin 0.6s linear infinite;"></div>
                <p style="margin: 8px 0 0; font-size: 11px; color: #a0aec0;">Loading experts…</p>
            </div>

            <!-- Expert Cards list (dynamic) -->
            <div id="experts-list" style="display: flex; flex-direction: column; gap: 14px;">
                <!-- Loaded dynamically via AJAX -->
            </div>

            <!-- Booking Tracker Link -->
            <div style="margin-top: 16px; text-align: center; border-top: 1px solid #edf2f7; padding-top: 14px;">
                <button onclick="openBookingTracker()" class="sg-btn-outline" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 10px;">
                    📅 Track Booking Status
                </button>
            </div>

            <!-- Health Articles & Reminders (dynamic) -->
            <div id="health-tips-section" style="border-top: 1px solid #edf2f7; margin-top: 12px; padding-top: 14px; display: none;">
                <h4 style="margin: 0 0 10px 0; font-size: 11px; font-weight: 900; color: #4a5568; text-transform: uppercase; letter-spacing: 0.5px;">Health Articles & Reminders</h4>
                <div id="health-tips-container" style="display: flex; flex-direction: column; gap: 10px;">
                    <!-- Loaded dynamically via AJAX -->
                </div>
            </div>

            <!-- Booking form overlay -->
            <div id="booking-form-container" class="sg-sub-panel hidden">
                <div style="padding: 14px 20px; border-bottom: 1px solid #edf2f7; background: #f7fafc; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h4 style="margin: 0; font-size: 13px; font-weight: 800; color: #2d3748;">Book Session</h4>
                        <p id="booking-target" style="margin: 2px 0 0 0; font-size: 10px; color: #718096; font-weight: 500;"></p>
                    </div>
                    <button onclick="closeBookingForm()" style="background: #e2e8f0; border: none; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #4a5568; font-weight: bold; font-size: 11px;">×</button>
                </div>
                <form id="expert-booking-form" style="padding: 20px; flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 14px;">
                    @csrf
                    <input type="hidden" name="expert_category" id="booking-expert-category">
                    <input type="hidden" name="expert_name" id="booking-expert-name">
                    
                    <div class="sg-form-group">
                        <label class="sg-form-label">Full Name</label>
                        <input type="text" name="user_name" required value="{{ Auth::user()->name ?? '' }}" class="sg-input">
                    </div>
                    
                    <div class="sg-form-group">
                        <label class="sg-form-label">Email Address</label>
                        <input type="email" name="user_email" required value="{{ Auth::user()->email ?? '' }}" class="sg-input">
                    </div>

                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <div class="sg-form-group" style="flex: 1; min-width: 130px;">
                            <label class="sg-form-label">Consult Date</label>
                            <input type="date" id="booking-date-input" name="booking_date" required min="{{ date('Y-m-d') }}" class="sg-input">
                            <div id="booking-date-hint" style="font-size: 9px; color: #3BB77E; margin-top: 4px; font-weight: 600;"></div>
                        </div>
                        <div class="sg-form-group" style="flex: 1; min-width: 130px;">
                            <label class="sg-form-label">Time Slot</label>
                            <select name="booking_time" required class="sg-select">
                                <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                                <option value="11:30 AM - 12:30 PM">11:30 AM - 12:30 PM</option>
                                <option value="2:00 PM - 3:00 PM">2:00 PM - 3:00 PM</option>
                                <option value="3:30 PM - 4:30 PM">3:30 PM - 4:30 PM</option>
                            </select>
                        </div>
                    </div>

                    <div class="sg-form-group">
                        <label class="sg-form-label">Special Notes / Diet issues</label>
                        <textarea name="notes" placeholder="Describe any food allergies, weight goals, or general issues..." class="sg-textarea" style="height: 70px; resize: none;"></textarea>
                    </div>

                    <button type="submit" class="sg-btn-primary">Confirm Book Request</button>
                </form>
            </div>

            <!-- Booking status tracker overlay -->
            <div id="booking-tracker-container" class="sg-sub-panel hidden">
                <div style="padding: 14px 20px; border-bottom: 1px solid #edf2f7; background: #f7fafc; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h4 style="margin: 0; font-size: 13px; font-weight: 800; color: #2d3748;">Track Booking Status</h4>
                        <p style="margin: 2px 0 0 0; font-size: 10px; color: #718096; font-weight: 500;">Check status of your consult requests</p>
                    </div>
                    <button onclick="closeBookingTracker()" style="background: #e2e8f0; border: none; border-radius: 50%; width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #4a5568; font-weight: bold; font-size: 11px;">×</button>
                </div>
                <div style="padding: 20px; flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 14px;">
                    <div class="sg-form-group">
                        <label class="sg-form-label">Enter Booking Email Address</label>
                        <div style="display: flex; gap: 8px; width: 100%; align-items: center;">
                            <input type="email" id="tracker-search-email" placeholder="e.g. user@example.com" class="sg-input" style="flex: 1; width: 100%; min-width: 0;" value="{{ Auth::user()->email ?? '' }}">
                            <button onclick="searchBookingsByEmail()" class="sg-btn-primary" style="width: auto !important; padding: 10px 16px !important; flex-shrink: 0;">Check</button>
                        </div>
                    </div>
                    <div id="tracker-loader" style="display: none; text-align: center; padding: 20px 0;">
                        <div style="display: inline-block; width: 20px; height: 20px; border: 2px solid #e2e8f0; border-top-color: #3BB77E; border-radius: 50%; animation: sg-spin 0.6s linear infinite;"></div>
                    </div>
                    <div id="tracker-results-list" style="display: flex; flex-direction: column; gap: 12px; margin-top: 10px;">
                        <!-- Results populated via AJAX -->
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== TAB 2: BLOG NEWS HUB ==================== -->
        <div id="sg-tab-content-blog" class="sg-tab-content" style="display: none; flex-direction: column; gap: 14px; width: 100%;">
            <!-- Category Filter Pills -->
            <div id="blog-categories-container" class="sg-hide-scrollbar" style="display: none; gap: 8px; overflow-x: auto; padding: 2px 2px 8px 2px; white-space: nowrap; border-bottom: 1px solid rgba(229, 231, 235, 0.5); margin-bottom: 4px;">
                <!-- Dynamically generated category pills -->
            </div>

            <div id="blogs-loader" style="text-align: center; padding: 20px 0;">
                <div style="display: inline-block; border: 3px solid #f3f3f3; border-top: 3px solid #3BB77E; border-radius: 50%; width: 24px; height: 24px; animation: sg-spin 1s linear infinite;"></div>
                <p style="font-size: 11px; color: #a0aec0; margin-top: 8px; font-weight: 500;">Loading fresh articles...</p>
            </div>
            
            <div id="blogs-container" style="display: flex; flex-direction: column; gap: 14px;">
                <!-- Filled via AJAX -->
            </div>

            <!-- Blog Post Reader -->
            <div id="blog-reader" class="sg-sub-panel hidden">
                <div style="padding: 10px 20px; border-bottom: 1px solid #edf2f7; background: #f7fafc; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10;">
                    <button onclick="closeBlogReader()" style="background: transparent; border: none; color: #3BB77E; font-size: 11px; font-weight: 900; cursor: pointer; text-transform: uppercase; display: flex; align-items: center; gap: 4px;">
                        ← Back
                    </button>
                    <span id="blog-read-category" class="sg-badge sg-badge-success" style="font-size: 8px;">Category</span>
                </div>
                <div class="sg-scrollbar" style="padding: 20px; flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 14px;">
                    <img id="blog-read-image" src="" alt="Blog Banner" style="width: 100%; height: 160px; object-fit: cover; border-radius: 12px; border: 1px solid #edf2f7;">
                    <h3 id="blog-read-title" style="margin: 0; font-size: 15px; font-weight: 800; color: #2d3748; line-height: 1.4;">Post Title</h3>
                    <div style="display: flex; justify-content: space-between; font-size: 10px; color: #a0aec0; font-weight: 600; border-bottom: 1px solid #edf2f7; padding-bottom: 10px;">
                        <span id="blog-read-author">Author</span>
                        <span id="blog-read-date">Date</span>
                    </div>
                    <div id="blog-read-content" style="font-size: 11px; color: #4a5568; line-height: 1.6; padding-bottom: 10px;">
                        <!-- Full markup content -->
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== TAB 3: AFFILIATE PROGRAMME ==================== -->
        <div id="sg-tab-content-affiliate" class="sg-tab-content" style="display: none; flex-direction: column; gap: 16px; width: 100%;">
            <!-- Loader -->
            <div id="affiliate-loader" style="text-align: center; padding: 20px 0;">
                <div style="display: inline-block; border: 3px solid #f3f3f3; border-top: 3px solid #3BB77E; border-radius: 50%; width: 24px; height: 24px; animation: sg-spin 1s linear infinite;"></div>
                <p style="font-size: 11px; color: #a0aec0; margin-top: 8px; font-weight: 500;">Connecting to affiliate portal...</p>
            </div>

            <!-- Guest (Unauth) -->
            <div id="affiliate-guest" style="display: none; text-align: center; padding: 30px 10px; flex-direction: column; align-items: center; gap: 12px;">
                <div style="font-size: 44px; margin: 0;">🎁</div>
                <h3 style="margin: 0; font-size: 14px; font-weight: 800; color: #2d3748;">Earn Referrals Cash!</h3>
                <p style="margin: 0; font-size: 11px; color: #718096; line-height: 1.5; padding: 0 10px;">Help friends shop smart. You earn Gh 15.00 cash directly in your wallet for every successful sign-up referral!</p>
                <div style="display: flex; flex-direction: column; gap: 8px; width: 100%; margin-top: 14px;">
                    <a href="/login" class="sg-btn-primary" style="text-decoration: none;">Log In to Account</a>
                    <a href="/register" class="sg-btn-outline" style="text-decoration: none;">Create Student Account</a>
                </div>
            </div>

            <!-- Member (Auth) -->
            <div id="affiliate-member" style="display: none; flex-direction: column; gap: 16px;">
                <!-- Stats Dashboard Grid -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; text-align: center;">
                    <div style="background: #f7fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 10px;">
                        <span style="font-size: 9px; font-weight: 700; color: #718096; text-transform: uppercase;">Referred</span>
                        <div id="aff-stat-count" style="font-size: 15px; font-weight: 900; color: #2d3748; margin-top: 4px;">0</div>
                    </div>
                    <div style="background: #f0fdf4; border: 1px solid #dcfce7; border-radius: 12px; padding: 10px;">
                        <span style="font-size: 9px; font-weight: 700; color: #166534; text-transform: uppercase;">Balance</span>
                        <div style="font-size: 12px; font-weight: 900; color: #166534; margin-top: 4px;">Gh <span id="aff-stat-balance">0.00</span></div>
                    </div>
                    <div style="background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: 12px; padding: 10px;">
                        <span style="font-size: 9px; font-weight: 700; color: #0f766e; text-transform: uppercase;">Total Paid</span>
                        <div style="font-size: 12px; font-weight: 900; color: #0f766e; margin-top: 4px;">Gh <span id="aff-stat-total">0.00</span></div>
                    </div>
                </div>

                <!-- Referral code display -->
                <div class="sg-card" style="display: flex; flex-direction: column; gap: 10px;">
                    <h4 style="margin: 0; font-size: 12px; font-weight: 800; color: #2d3748; display: flex; align-items: center; gap: 6px;">
                        <span>Your Referral Code:</span>
                        <span id="aff-ref-code" style="background: #ebf8ff; border: 1px solid #bee3f8; color: #2b6cb0; font-size: 10px; font-weight: 800; padding: 2px 6px; border-radius: 4px;">SG-XXXX</span>
                    </h4>
                    <div style="display: flex; flex-direction: column; gap: 4px; margin-top: 4px;">
                        <span style="font-size: 9px; font-weight: 700; color: #a0aec0; text-transform: uppercase; letter-spacing: 0.5px;">Share referral link</span>
                        <div style="display: flex; gap: 6px;">
                            <input type="text" id="aff-ref-link" readonly value="" class="sg-input" style="padding: 8px; font-size: 10px; font-weight: 500; font-family: monospace; background: #f7fafc; flex: 1;">
                            <button onclick="copyAffRefLink()" class="sg-btn-primary" style="width: auto; padding: 8px 14px;">Copy</button>
                        </div>
                    </div>
                </div>

                <!-- Withdrawal Request Form -->
                <div class="sg-card" style="background: #fcfcfd; display: flex; flex-direction: column; gap: 12px;">
                    <h4 style="margin: 0; font-size: 12px; font-weight: 800; color: #2d3748;">Withdraw Earnings</h4>
                    <form id="affiliate-payout-form" style="display: flex; flex-direction: column; gap: 12px; margin: 0;">
                        @csrf
                        <div style="display: flex; gap: 10px;">
                            <div style="flex: 1;">
                                <label class="sg-form-label" style="font-size: 9px; margin-bottom: 4px;">Amount (Gh)</label>
                                <input type="number" name="amount" id="payout-amount" required min="50" step="any" placeholder="Gh 50" class="sg-input" style="padding: 8px;">
                            </div>
                            <div style="flex: 1;">
                                <label class="sg-form-label" style="font-size: 9px; margin-bottom: 4px;">MoMo / Payout</label>
                                <select name="payment_method" required class="sg-select" style="padding: 8px;">
                                    <option value="Mobile Money (MoMo)">Mobile Money</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="PayPal">PayPal</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="sg-btn-primary" style="padding: 8px 14px;">Request Cashout</button>
                    </form>
                </div>

                <!-- Transaction logs list -->
                <div>
                    <h4 style="margin: 0 0 8px 0; font-size: 11px; font-weight: 900; color: #4a5568; text-transform: uppercase; letter-spacing: 0.5px;">Payout History</h4>
                    <div id="affiliate-payouts-list" style="display: flex; flex-direction: column; gap: 8px; max-height: 120px; overflow-y: auto; padding-right: 4px;" class="sg-scrollbar">
                        <!-- Loaded dynamically -->
                    </div>
                </div>

                <!-- Promo tips -->
                <div style="background-color: #fffbeb; border: 1px solid #fef3c7; border-radius: 12px; padding: 12px; font-size: 10px; color: #92400e; line-height: 1.4;">
                    <strong>💡 Promotion Tip:</strong> Send your code directly to hostel groups! Students ordering groceries together in bulk is the easiest way to stack up referral credits.
                </div>
            </div>
        </div>

        <!-- ==================== TAB 4: REQUEST AN ITEM ==================== -->
        <div id="sg-tab-content-request" class="sg-tab-content" style="display: none; flex-direction: column; gap: 16px; width: 100%;">
            <div style="background-color: #eef2ff; border: 1px solid #e0e7ff; border-radius: 12px; padding: 12px; display: flex; gap: 12px;">
                <div style="font-size: 20px;">🎒</div>
                <div>
                    <h4 style="margin: 0 0 4px 0; font-size: 13px; font-weight: 700; color: #3730a3;">Catalog Sourcing Request</h4>
                    <p style="margin: 0; font-size: 11px; color: #3730a3; line-height: 1.4;">Can't find a grocery item or product brand? Request it below, and the SG sourcing team will buy it and deliver to you.</p>
                </div>
            </div>

            <!-- Form -->
            <form id="item-request-form" style="display: flex; flex-direction: column; gap: 12px;" class="sg-card">
                @csrf
                <div class="sg-form-group" style="margin: 0;">
                    <label class="sg-form-label">Product Name</label>
                    <input type="text" name="product_name" required placeholder="Lactose-free Milk, Special seasoning brand..." class="sg-input">
                </div>
                
                <div style="display: flex; gap: 10px;">
                    <div class="sg-form-group" style="flex: 1; margin: 0;">
                        <label class="sg-form-label">Quantity</label>
                        <input type="number" name="quantity" required min="1" value="1" class="sg-input">
                    </div>
                    <div class="sg-form-group" style="flex: 2; margin: 0;">
                        <label class="sg-form-label">Allow Substitutes?</label>
                        <select name="allow_sub" class="sg-select">
                            <option value="1">Substitutes allowed</option>
                            <option value="0">Strictly this brand</option>
                        </select>
                    </div>
                </div>

                <div class="sg-form-group" style="margin: 0;">
                    <label class="sg-form-label">Special Sourcing Notes</label>
                    <textarea name="special_note" placeholder="Hostel detail, brand, size (e.g. 500g, box of 12)..." class="sg-textarea" style="height: 60px; resize: none;"></textarea>
                </div>

                <button type="submit" class="sg-btn-primary">Submit Request</button>
            </form>

            <!-- Previous requests tracking list -->
            <div>
                <h4 style="margin: 0 0 8px 0; font-size: 11px; font-weight: 900; color: #4a5568; text-transform: uppercase; letter-spacing: 0.5px;">Your Sourcing Requests</h4>
                <div id="item-requests-list" style="display: flex; flex-direction: column; gap: 12px;" class="sg-scrollbar">
                    <!-- Dynamic -->
                </div>
            </div>
        </div>

        <!-- ==================== ARTICLE VIEWER SUBPANEL ==================== -->
        <div id="health-article-reader" class="sg-sub-panel hidden">
            <div style="padding: 10px 20px; border-bottom: 1px solid #edf2f7; background: #f7fafc; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 10;">
                <button onclick="closeHealthArticle()" style="background: transparent; border: none; color: #3BB77E; font-size: 11px; font-weight: 900; cursor: pointer; text-transform: uppercase; display: flex; align-items: center; gap: 4px;">
                    ← Back
                </button>
                <span class="sg-badge sg-badge-success" style="font-size: 8px;">Health Tip</span>
            </div>
            <div class="sg-scrollbar" style="padding: 20px; flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 12px;">
                <h3 id="article-read-title" style="margin: 0; font-size: 14px; font-weight: 800; color: #2d3748; line-height: 1.4;">Article Title</h3>
                <div id="article-read-content" style="font-size: 11px; color: #4a5568; line-height: 1.6;">
                    <!-- Content -->
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- Scripts for Floating Panel Operations -->
<script>
    // Global active drawer tab
    let sgActiveTab = null;

    // Toggle drawer open or close
    function toggleSgDrawer(tabName) {
        const drawer = $('#sg-floating-drawer');
        const dock = $('#sg-floating-dock');
        
        // If drawer is closed, slide it open
        if (!drawer.hasClass('open')) {
            drawer.addClass('open');
            // If screen is wider than 640px, shift the dock to the left
            if (window.innerWidth > 640) {
                dock.addClass('sg-dock-shifted');
            }
        }

        // Activate the tab
        activateSgTab(tabName);
    }

    // Close drawer
    function closeSgDrawer() {
        const drawer = $('#sg-floating-drawer');
        const dock = $('#sg-floating-dock');
        
        drawer.removeClass('open');
        dock.removeClass('sg-dock-shifted');
        sgActiveTab = null;
        
        // Hide sub panels
        closeBookingForm();
        closeBlogReader();
        closeHealthArticle();
    }

    // Switch between Tab contents inside the drawer
    function activateSgTab(tabName) {
        sgActiveTab = tabName;
        
        // Hide all contents
        $('.sg-tab-content').css('display', 'none');
        
        // Show target content
        $('#sg-tab-content-' + tabName).css('display', 'flex');

        // Set Header Title & Subtitle based on tab
        const titleNode = $('#sg-drawer-title');
        const subtitleNode = $('#sg-drawer-subtitle');

        if (tabName === 'expert') {
            titleNode.text('Connect to an Expert');
            subtitleNode.text('Campus Life & Health consultations');
            loadExpertsData(); // Fetch experts, categories, and tips
        } else if (tabName === 'blog') {
            titleNode.text('SG News & Blogs');
            subtitleNode.text('Tips, hacks, and campus updates');
            loadBlogPosts(); // Fetch blogs
        } else if (tabName === 'affiliate') {
            titleNode.text('Affiliate Programme');
            subtitleNode.text('Refer friends and earn cash commissions');
            loadAffStats(); // Fetch affiliate stats
        } else if (tabName === 'request') {
            titleNode.text('Request an Item');
            subtitleNode.text('Sourcing custom products for you');
            loadItemRequests(); // Fetch previous requests
        }
    }

    // Filter experts on the Connect to Expert tab
    function filterExperts(category, clickedBtn) {
        // Toggle active button styling
        $('#experts-categories-bar .sg-cat-pill').removeClass('active');
        if (clickedBtn) {
            $(clickedBtn).addClass('active');
        }

        if (category === 'all') {
            $('.expert-card').css('display', 'block');
        } else {
            $('.expert-card').css('display', 'none');
            $(`.expert-card[data-category="${category}"]`).css('display', 'block');
        }
    }

    // Cache to avoid re-fetching on every tab switch
    let sgExpertDataLoaded = false;

    // Load experts, categories, and health tips from the API
    function loadExpertsData() {
        if (sgExpertDataLoaded) return;

        $('#experts-loader').css('display', 'block');
        $('#experts-list').html('');
        $('#experts-categories-bar').html('');
        $('#health-tips-section').css('display', 'none');

        $.ajax({
            url: '/floating-panel/expert-data',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#experts-loader').css('display', 'none');
                if (response.success) {
                    sgExpertDataLoaded = true;
                    window.sgExperts = response.experts;
                    renderCategoryPills(response.categories);
                    renderExpertCards(response.experts);
                    renderHealthTips(response.tips);
                }
            },
            error: function() {
                $('#experts-loader').css('display', 'none');
                $('#experts-list').html('<p style="font-size: 11px; color: #e53e3e; text-align: center; padding: 20px 0;">Failed to load expert data. Please try again.</p>');
            }
        });
    }

    function renderCategoryPills(categories) {
        let pillsHtml = '<button onclick="filterExperts(\'all\', this)" class="sg-cat-pill active">All</button>';
        $.each(categories, function(i, cat) {
            pillsHtml += `<button onclick="filterExperts('${cat.code}', this)" class="sg-cat-pill">${cat.name}</button>`;
        });
        $('#experts-categories-bar').html(pillsHtml);
    }

    function renderExpertCards(experts) {
        let cardsHtml = '';
        $.each(experts, function(i, expert) {
            const catCode = expert.category ? expert.category.code : '';
            const catName = expert.category ? expert.category.name : 'Expert';
            const badgeStyle = expert.category ? expert.category.badge_style : 'secondary';
            const waMsg = encodeURIComponent(expert.whatsapp_message || ('Hi ' + expert.name + ', I am chatting via Smart Groceries.'));
            const waLink = 'https://wa.me/' + expert.whatsapp_number + '?text=' + waMsg;

            cardsHtml += `
                <div class="sg-card expert-card" data-category="${catCode}">
                    <div style="display: flex; gap: 12px;">
                        <div style="position: relative; width: 44px; height: 44px; background: ${expert.avatar_bg_color}; border: 1px solid rgba(0,0,0,0.08); color: ${expert.avatar_text_color}; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 16px; flex-shrink: 0;">
                            ${expert.initials}
                            <span class="sg-pulse-dot" style="position: absolute; bottom: 0; right: 0; width: 10px; height: 10px; background: #10b981; border: 2px solid white; border-radius: 50%;"></span>
                        </div>
                        <div style="flex: 1; min-width: 0; width: 100%;">
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;">
                                <h3 style="margin: 0; font-size: 13px; font-weight: 800; color: #2d3748;">${expert.name}</h3>
                                <span class="sg-badge sg-badge-${badgeStyle}" style="flex-shrink: 0; font-size: 8px;">${catName}</span>
                            </div>
                            <p style="margin: 6px 0 0 0; font-size: 11px; color: #718096; line-height: 1.4;">${expert.specialty_description}</p>
                            <div style="display: flex; align-items: center; gap: 4px; margin-top: 8px; font-size: 10px; color: #a0aec0; font-weight: 600;">
                                📅 ${expert.availability_schedule}
                            </div>
                            <div style="display: flex; gap: 8px; margin-top: 12px;">
                                <button onclick="openBookingForm(${expert.id})" class="sg-btn-primary" style="flex: 1; padding: 8px 12px;">Book Session</button>
                                <a href="${waLink}" target="_blank" class="sg-btn-outline" style="padding: 8px 12px;">Chat</a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        if (cardsHtml === '') {
            cardsHtml = '<p style="font-size: 11px; color: #a0aec0; text-align: center; padding: 20px 0;">No expert profiles available yet.</p>';
        }
        $('#experts-list').html(cardsHtml);
    }

    function renderHealthTips(tips) {
        if (!tips || tips.length === 0) {
            $('#health-tips-section').css('display', 'none');
            return;
        }
        // Store tips data for the reader
        window.sgHealthTipsData = {};
        let tipsHtml = '';
        $.each(tips, function(i, tip) {
            window.sgHealthTipsData[tip.type_slug] = tip;
            tipsHtml += `
                <div onclick="showHealthArticle('${tip.type_slug}')" class="sg-card" style="padding: 10px; cursor: pointer; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 20px;">${tip.icon || '📄'}</span>
                    <div>
                        <h5 style="margin: 0; font-size: 11px; font-weight: 700; color: #2d3748;">${tip.title}</h5>
                        <p style="margin: 1px 0 0 0; font-size: 9px; color: #a0aec0;">Click to read tips and guidance.</p>
                    </div>
                </div>
            `;
        });
        $('#health-tips-container').html(tipsHtml);
        $('#health-tips-section').css('display', 'block');
    }

    // Booking form toggle
    function openBookingForm(expertId) {
        if (!window.sgExperts) return;
        const expert = window.sgExperts.find(e => e.id === expertId);
        if (!expert) return;

        const catName = expert.category ? expert.category.name : 'Expert';

        $('#booking-target').text(`Consultation with ${expert.name} (${catName})`);
        $('#booking-expert-name').val(expert.name);
        $('#booking-expert-category').val(catName);

        // Store the active expert's details on the input
        $('#booking-date-input').data('availability', expert.availability_details);
        $('#booking-date-input').data('expert-id', expertId);
        $('#booking-date-input').val(''); // reset selected date

        // Generate time slots
        const details = expert.availability_details;
        let hintText = '';
        
        if (details && details.days && details.start_time && details.end_time) {
            const formattedDays = details.days.join(', ');
            const startTimeFormatted = format24HourTo12Hour(details.start_time);
            const endTimeFormatted = format24HourTo12Hour(details.end_time);
            hintText = `Available: ${formattedDays} (${startTimeFormatted} - ${endTimeFormatted})`;
        } else {
            // Fallback for legacy text
            hintText = `Available: ${expert.availability_schedule}`;
        }

        $('#booking-date-hint').text(hintText);
        
        // Initial slots (with no date selected)
        updateAvailableTimeSlots(expert, '');

        $('#booking-form-container').removeClass('hidden').css('display', 'flex');
    }

    // Update available time slots, blocking confirmed slots for selectedDate
    function updateAvailableTimeSlots(expert, selectedDate) {
        if (!expert) return;

        const details = expert.availability_details;
        let slots = [];
        
        if (details && details.days && details.start_time && details.end_time) {
            slots = generateDynamicTimeSlots(details.start_time, details.end_time);
        } else {
            // Fallback for legacy text
            slots = [
                "10:00 AM - 11:00 AM",
                "11:30 AM - 12:30 PM",
                "2:00 PM - 3:00 PM",
                "3:30 PM - 4:30 PM"
            ];
        }

        // Filter out confirmed slots for the selected date
        if (selectedDate && expert.confirmed_bookings && expert.confirmed_bookings.length > 0) {
            const confirmedTimesForDate = expert.confirmed_bookings
                .filter(b => b.booking_date === selectedDate)
                .map(b => b.booking_time);
                
            slots = slots.filter(slot => !confirmedTimesForDate.includes(slot));
        }

        let timeOptionsHtml = '';
        if (slots.length > 0) {
            $.each(slots, function(i, slot) {
                timeOptionsHtml += `<option value="${slot}">${slot}</option>`;
            });
        } else {
            timeOptionsHtml = '<option value="" disabled>No available time slots for this date</option>';
        }

        $('select[name="booking_time"]').html(timeOptionsHtml);
    }

    // Close booking form
    function closeBookingForm() {
        $('#booking-form-container').addClass('hidden').css('display', 'none');
        $('#booking-date-hint').text('');
        const formEl = $('#expert-booking-form')[0];
        if (formEl) {
            formEl.reset();
        }
    }

    // Open Booking Tracker overlay
    function openBookingTracker() {
        $('#booking-tracker-container').removeClass('hidden').css('display', 'flex');
        // Auto-search if email is already filled (logged-in user)
        const email = $('#tracker-search-email').val();
        if (email) {
            searchBookingsByEmail();
        }
    }

    // Close Booking Tracker overlay
    function closeBookingTracker() {
        $('#booking-tracker-container').addClass('hidden').css('display', 'none');
        $('#tracker-results-list').html('');
    }

    // Search bookings via AJAX by email
    function searchBookingsByEmail() {
        const email = $('#tracker-search-email').val();
        if (!email) {
            alert('Please enter your booking email address.');
            return;
        }

        $('#tracker-loader').show();
        $('#tracker-results-list').html('');

        $.ajax({
            url: '/floating-panel/track-bookings',
            type: 'GET',
            data: { email: email },
            dataType: 'json',
            success: function(response) {
                $('#tracker-loader').hide();
                if (response.success && response.bookings.length > 0) {
                    let resultsHtml = '';
                    $.each(response.bookings, function(i, b) {
                        const date = new Date(b.booking_date).toLocaleDateString('en-US', {
                            year: 'numeric', month: 'short', day: 'numeric'
                        });
                        
                        let badgeClass = 'sg-badge-info';
                        if (b.status === 'confirmed') badgeClass = 'sg-badge-success';
                        else if (b.status === 'pending') badgeClass = 'sg-badge-warning';
                        else if (b.status === 'completed') badgeClass = 'sg-badge-secondary';

                        resultsHtml += `
                            <div class="sg-card" style="padding: 12px; display: flex; flex-direction: column; gap: 6px;">
                                <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;">
                                    <div>
                                        <h5 style="margin: 0; font-size: 11px; font-weight: 800; color: #2d3748;">${b.expert_name}</h5>
                                        <span style="font-size: 8px; font-weight: 800; color: #3BB77E; text-transform: uppercase; letter-spacing: 0.5px;">${b.expert_category}</span>
                                    </div>
                                    <span class="sg-badge ${badgeClass}" style="font-size: 8px; flex-shrink: 0;">${b.status}</span>
                                </div>
                                <div style="font-size: 10px; color: #718096; font-weight: 600; margin-top: 4px; display: flex; flex-direction: column; gap: 2px;">
                                    <span>📅 Date: ${date}</span>
                                    <span>⏰ Time: ${b.booking_time}</span>
                                </div>
                                ${b.notes ? `
                                <div style="font-size: 9px; color: #a0aec0; background: #f7fafc; padding: 6px; border-radius: 4px; border: 1px solid #edf2f7; margin-top: 4px; font-style: italic;">
                                    Notes: ${b.notes}
                                </div>
                                ` : ''}
                                ${b.expert_feedback ? `
                                <div style="font-size: 9px; color: #1e3a8a; background: #eff6ff; padding: 8px; border-radius: 6px; border: 1px solid #dbeafe; margin-top: 4px; font-weight: 600; line-height: 1.3;">
                                    💬 Reschedule/Feedback: ${b.expert_feedback}
                                </div>
                                ` : ''}
                            </div>
                        `;
                    });
                    $('#tracker-results-list').html(resultsHtml);
                } else {
                    $('#tracker-results-list').html('<p style="font-size: 11px; color: #a0aec0; text-align: center; padding: 20px 0;">No bookings found for this email address.</p>');
                }
            },
            error: function(xhr) {
                $('#tracker-loader').hide();
                const err = xhr.responseJSON && xhr.responseJSON.errors ? xhr.responseJSON.errors.join(', ') : 'Failed to retrieve bookings.';
                $('#tracker-results-list').html(`<p style="font-size: 11px; color: #e53e3e; text-align: center; padding: 20px 0;">${err}</p>`);
            }
        });
    }

    function format24HourTo12Hour(timeStr) {
        if (!timeStr) return '';
        const parts = timeStr.split(':');
        let hours = parseInt(parts[0], 10);
        const minutes = parseInt(parts[1], 10) || 0;
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        const minutesStr = minutes < 10 ? '0' + minutes : minutes;
        return `${hours}:${minutesStr} ${ampm}`;
    }

    function generateDynamicTimeSlots(startTimeStr, endTimeStr) {
        const slots = [];
        const parseTimeToMinutes = (timeStr) => {
            const parts = timeStr.split(':');
            return parseInt(parts[0], 10) * 60 + (parseInt(parts[1], 10) || 0);
        };
        const formatMinutesToTime = (totalMinutes) => {
            let hours = Math.floor(totalMinutes / 60) % 24;
            const minutes = totalMinutes % 60;
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            const minutesStr = minutes < 10 ? '0' + minutes : minutes;
            return `${hours}:${minutesStr} ${ampm}`;
        };

        let startMinutes = parseTimeToMinutes(startTimeStr);
        const endMinutes = parseTimeToMinutes(endTimeStr);
        const slotDuration = 60; // 1 hour slots
        
        while (startMinutes + slotDuration <= endMinutes) {
            const slotStart = formatMinutesToTime(startMinutes);
            const slotEnd = formatMinutesToTime(startMinutes + slotDuration);
            slots.push(`${slotStart} - ${slotEnd}`);
            startMinutes += slotDuration;
        }

        return slots;
    }

    // Listen for changes on the consult date picker
    $(document).on('change', '#booking-date-input', function() {
        const dateVal = $(this).val();
        const expertId = $(this).data('expert-id');
        const expert = window.sgExperts ? window.sgExperts.find(e => e.id === expertId) : null;
        
        if (!dateVal) {
            if (expert) {
                updateAvailableTimeSlots(expert, '');
            }
            return;
        }

        const details = $(this).data('availability');
        if (!details || !details.days) {
            // Allow legacy or fallback without validation
            if (expert) {
                updateAvailableTimeSlots(expert, dateVal);
            }
            return;
        }

        // Parse date without timezone shifts
        const parts = dateVal.split('-');
        const year = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1;
        const day = parseInt(parts[2], 10);
        const localDate = new Date(year, month, day);

        const dayOfWeekNum = localDate.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday
        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        const selectedDayName = dayNames[dayOfWeekNum];

        // Check if selectedDayName is in the expert's available days
        if (!details.days.includes(selectedDayName)) {
            // Map keys to long day names for a nice alert message
            const dayMap = {
                'Mon': 'Monday', 'Tue': 'Tuesday', 'Wed': 'Wednesday', 'Thu': 'Thursday',
                'Fri': 'Friday', 'Sat': 'Saturday', 'Sun': 'Sunday'
            };
            const longDays = details.days.map(d => dayMap[d] || d).join(', ');
            alert(`This expert is not available on ${dayMap[selectedDayName] || selectedDayName}s.\n\nPlease choose from their available days: ${longDays}.`);
            $(this).val('');
            if (expert) {
                updateAvailableTimeSlots(expert, '');
            }
        } else {
            if (expert) {
                updateAvailableTimeSlots(expert, dateVal);
            }
        }
    });

    // Blog operations
    function loadBlogPosts() {
        $('#blogs-loader').css('display', 'block');
        $('#blog-categories-container').hide();
        $('#blogs-container').html('');

        $.ajax({
            url: '/floating-panel/blogs',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#blogs-loader').css('display', 'none');
                if (response.success && response.blogs.length > 0) {
                    window.allBlogPosts = response.blogs;
                    
                    // Extract unique categories
                    const categories = ['All'];
                    $.each(response.blogs, function(i, blog) {
                        if (blog.category && !categories.includes(blog.category)) {
                            categories.push(blog.category);
                        }
                    });

                    // Render category pills
                    let pillsHtml = '';
                    $.each(categories, function(i, cat) {
                        const activeClass = i === 0 ? 'active' : '';
                        pillsHtml += `<span class="sg-category-pill ${activeClass}" data-category="${cat}">${cat}</span>`;
                    });

                    $('#blog-categories-container').html(pillsHtml).css('display', 'flex');
                    renderFilteredBlogs('All');
                } else {
                    $('#blog-categories-container').hide();
                    $('#blogs-container').html('<p style="font-size: 11px; color: #a0aec0; text-align: center; padding: 20px 0;">No blog posts available.</p>');
                }
            },
            error: function() {
                $('#blogs-loader').css('display', 'none');
                $('#blog-categories-container').hide();
                $('#blogs-container').html('<p style="font-size: 11px; color: #e53e3e; text-align: center; padding: 20px 0;">Failed to fetch blog posts.</p>');
            }
        });
    }

    function renderFilteredBlogs(category) {
        if (!window.allBlogPosts || window.allBlogPosts.length === 0) {
            $('#blogs-container').html('<p style="font-size: 11px; color: #a0aec0; text-align: center; padding: 20px 0;">No blog posts available.</p>');
            return;
        }

        let filtered = window.allBlogPosts;
        if (category !== 'All') {
            filtered = window.allBlogPosts.filter(b => b.category === category);
        }

        if (filtered.length === 0) {
            $('#blogs-container').html('<p style="font-size: 11px; color: #a0aec0; text-align: center; padding: 20px 0;">No posts found in this category.</p>');
            return;
        }

        let blogsHtml = '';
        $.each(filtered, function(i, blog) {
            const date = new Date(blog.created_at).toLocaleDateString('en-US', {
                year: 'numeric', month: 'short', day: 'numeric'
            });
            blogsHtml += `
                <div onclick="readBlogPost(${JSON.stringify(blog).replace(/"/g, '&quot;')})" class="sg-card" style="padding: 12px; cursor: pointer; display: flex; gap: 12px;">
                    <img src="${blog.image}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; flex-shrink: 0;" alt="Blog Image">
                    <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <span style="font-size: 8px; font-weight: 800; color: #3BB77E; text-transform: uppercase; letter-spacing: 0.5px;">${blog.category}</span>
                            <h4 style="margin: 2px 0 0 0; font-size: 11px; font-weight: 800; color: #2d3748; line-height: 1.3; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">${blog.title}</h4>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-size: 9px; color: #a0aec0; font-weight: 600; margin-top: 6px;">
                            <span>${blog.author.split(' ')[0]}</span>
                            <span>${date}</span>
                        </div>
                    </div>
                </div>
            `;
        });
        $('#blogs-container').html(blogsHtml);
    }

    $(document).on('click', '.sg-category-pill', function() {
        $('#blog-categories-container .sg-category-pill').removeClass('active');
        $(this).addClass('active');
        const category = $(this).attr('data-category');
        renderFilteredBlogs(category);
    });

    function readBlogPost(blog) {
        const date = new Date(blog.created_at).toLocaleDateString('en-US', {
            year: 'numeric', month: 'short', day: 'numeric'
        });
        $('#blog-read-category').text(blog.category);
        $('#blog-read-image').attr('src', blog.image);
        $('#blog-read-title').text(blog.title);
        $('#blog-read-author').text(`By ${blog.author}`);
        $('#blog-read-date').text(date);
        $('#blog-read-content').html(blog.content);

        $('#blog-reader').removeClass('hidden').css('display', 'flex');
    }

    function closeBlogReader() {
        $('#blog-reader').addClass('hidden').css('display', 'none');
    }

    // Health Articles viewer (dynamic from DB)
    function showHealthArticle(typeSlug) {
        const article = window.sgHealthTipsData ? window.sgHealthTipsData[typeSlug] : null;
        if (article) {
            $('#article-read-title').text(article.title);
            $('#article-read-content').html(article.content);
            $('#health-article-reader').removeClass('hidden').css('display', 'flex');
        }
    }

    function closeHealthArticle() {
        $('#health-article-reader').addClass('hidden').css('display', 'none');
    }

    // Affiliate operations
    function loadAffStats() {
        $('#affiliate-loader').css('display', 'block');
        $('#affiliate-guest').css('display', 'none');
        $('#affiliate-member').css('display', 'none');

        $.ajax({
            url: '/floating-panel/affiliate-stats',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#affiliate-loader').css('display', 'none');
                if (!response.authenticated) {
                    $('#affiliate-guest').css('display', 'flex');
                } else {
                    // Load stats
                    $('#aff-stat-count').text(response.referral_count);
                    $('#aff-stat-balance').text(response.referral_balance);
                    $('#aff-stat-total').text(response.total_earned);
                    $('#aff-ref-code').text(response.referral_code);
                    $('#aff-ref-link').val(response.referral_link);

                    // Load payouts
                    let payoutsHtml = '';
                    if (response.payouts.length > 0) {
                        $.each(response.payouts, function(i, payout) {
                            const date = new Date(payout.created_at).toLocaleDateString('en-US', {
                                month: 'short', day: 'numeric', year: '2-digit'
                            });
                            let statusClass = 'sg-badge-info';
                            if (payout.status === 'completed') statusClass = 'sg-badge-success';
                            else if (payout.status === 'pending') statusClass = 'sg-badge-warning';
                            
                            payoutsHtml += `
                                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #edf2f7; padding-bottom: 8px;">
                                    <div>
                                        <div style="font-size: 11px; font-weight: 800; color: #2d3748;">Gh ${parseFloat(payout.amount).toFixed(2)}</div>
                                        <div style="font-size: 9px; color: #a0aec0; font-weight: 600;">${payout.payment_method} • ${date}</div>
                                    </div>
                                    <span class="sg-badge ${statusClass}" style="font-size: 8px;">${payout.status}</span>
                                </div>
                            `;
                        });
                        $('#affiliate-payouts-list').html(payoutsHtml);
                    } else {
                        $('#affiliate-payouts-list').html('<p style="font-size: 10px; color: #a0aec0; text-align: center; padding: 12px 0;">No withdrawal requests yet.</p>');
                    }

                    $('#affiliate-member').css('display', 'flex');
                }
            },
            error: function() {
                $('#affiliate-loader').css('display', 'none');
                $('#affiliate-guest').css('display', 'flex');
            }
        });
    }

    function copyAffRefLink() {
        const copyText = document.getElementById("aff-ref-link");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);

        // Show SweetAlert2 toast if available
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Referral link copied!',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            alert("Referral link copied to clipboard!");
        }
    }

    // Product Sourcing Requests operations
    function loadItemRequests() {
        $('#item-requests-list').html('<div style="text-align: center; padding: 12px 0;"><div style="display: inline-block; border: 2px solid #f3f3f3; border-top: 2px solid #3BB77E; border-radius: 50%; width: 18px; height: 18px; animation: sg-spin 1s linear infinite;"></div></div>');

        $.ajax({
            url: '/floating-panel/item-requests',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.requests.length > 0) {
                    let reqsHtml = '';
                    $.each(response.requests, function(i, req) {
                        const date = new Date(req.created_at).toLocaleDateString('en-US', {
                            month: 'short', day: 'numeric'
                        });
                        
                        let statusColor = 'sg-badge-info';
                        let step1 = 'active';
                        let step2 = '';
                        let step3 = '';
                        
                        if (req.status === 'under_review') {
                            statusColor = 'sg-badge-warning';
                            step2 = 'active';
                        } else if (req.status === 'sourced') {
                            statusColor = 'sg-badge-success';
                            step2 = 'active';
                            step3 = 'active';
                        } else if (req.status === 'unavailable') {
                            statusColor = 'sg-badge-danger';
                            step2 = 'active';
                            step3 = 'active';
                        }

                        reqsHtml += `
                            <div class="sg-card" style="display: flex; flex-direction: column; gap: 10px; padding: 12px;">
                                <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px;">
                                    <div>
                                        <h5 style="margin: 0; font-size: 11px; font-weight: 800; color: #2d3748;">${req.product_name}</h5>
                                        <span style="font-size: 9px; color: #a0aec0; font-weight: 700;">Qty: ${req.quantity} • ${date}</span>
                                    </div>
                                    <span class="sg-badge ${statusColor}" style="font-size: 8px;">${req.status.replace('_', ' ')}</span>
                                </div>
                                
                                ${req.special_note ? `<p style="margin: 0; font-size: 10px; color: #718096; background: #f7fafc; padding: 8px; border-radius: 6px; border: 1px solid #edf2f7; line-height: 1.4; font-style: italic;">${req.special_note}</p>` : ''}
                                
                                <!-- Timeline Stepper -->
                                <div class="sg-timeline">
                                    <div class="sg-step ${step1}">
                                        <div class="sg-step-circle">✓</div>
                                        <span>Sent</span>
                                    </div>
                                    <div class="sg-step-line"></div>
                                    <div class="sg-step ${step2}">
                                        <div class="sg-step-circle">✓</div>
                                        <span>Review</span>
                                    </div>
                                    <div class="sg-step-line"></div>
                                    <div class="sg-step ${step3}">
                                        <div class="sg-step-circle">✓</div>
                                        <span>Sourced</span>
                                    </div>
                                </div>
                                
                                ${req.admin_response ? `
                                    <div style="background-color: #f0fdf4; border: 1px solid #dcfce7; color: #166534; font-size: 10px; padding: 8px; border-radius: 8px; line-height: 1.4; margin-top: 4px;">
                                        <strong>SG Team:</strong> ${req.admin_response}
                                    </div>
                                ` : ''}
                            </div>
                        `;
                    });
                    $('#item-requests-list').html(reqsHtml);
                } else {
                    $('#item-requests-list').html('<p style="font-size: 11px; color: #a0aec0; text-align: center; padding: 16px 0;">You have not requested any custom products yet.</p>');
                }
            },
            error: function() {
                $('#item-requests-list').html('<p style="font-size: 11px; color: #e53e3e; text-align: center; padding: 16px 0;">Failed to load requests.</p>');
            }
        });
    }

    // Animation frames keyframes
    const styleSpin = document.createElement('style');
    styleSpin.innerHTML = `@keyframes sg-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }`;
    document.head.appendChild(styleSpin);

    // jQuery submissions handling
    $(document).ready(function() {
        // Capture referral code from URL parameters to LocalStorage
        const urlParams = new URLSearchParams(window.location.search);
        const ref = urlParams.get('ref');
        if (ref) {
            localStorage.setItem('sg_referral_code', ref);
        }

        // If on registration page, inject hidden referral code input dynamically
        if (window.location.pathname.includes('/register')) {
            const storedRef = localStorage.getItem('sg_referral_code');
            if (storedRef) {
                // Find form and append hidden input
                $('form').each(function() {
                    if ($(this).attr('action') && $(this).attr('action').includes('/register') || $(this).find('input[name="password_confirmation"]').length > 0) {
                        if ($(this).find('input[name="ref"]').length === 0) {
                            $(this).append(`<input type="hidden" name="ref" value="${storedRef}">`);
                        }
                    }
                });
            }
        }

        // Persistent Hide/Restore layout state using localStorage
        const panelState = localStorage.getItem('sg_panel_state');
        if (panelState === 'hidden') {
            $('#sg-floating-dock').addClass('sg-dock-hidden');
            $('#sg-restore-handle').removeClass('sg-restore-hidden');
        } else {
            $('#sg-floating-dock').removeClass('sg-dock-hidden');
            $('#sg-restore-handle').addClass('sg-restore-hidden');
        }

        // Hide Click Handler
        $('#sg-hide-btn').on('click', function(e) {
            e.stopPropagation();
            closeSgDrawer();
            $('#sg-floating-dock').addClass('sg-dock-hidden');
            $('#sg-restore-handle').removeClass('sg-restore-hidden');
            localStorage.setItem('sg_panel_state', 'hidden');
        });

        // Restore Click Handler
        $('#sg-restore-handle').on('click', function() {
            $('#sg-floating-dock').removeClass('sg-dock-hidden');
            $('#sg-restore-handle').addClass('sg-restore-hidden');
            localStorage.setItem('sg_panel_state', 'visible');
        });

        // Submit Expert Booking Form
        $('#expert-booking-form').on('submit', function(e) {
            e.preventDefault();
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Booking Session...');

            $.ajax({
                url: '/floating-panel/book-expert',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    submitBtn.prop('disabled', false).text('Confirm Book Request');
                    try {
                        closeSgDrawer();
                    } catch (e) {
                        console.error("Error closing drawer: ", e);
                    }
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Consult Booked!',
                            text: response.message,
                            confirmButtonColor: '#3BB77E'
                        });
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false).text('Confirm Book Request');
                    let errors = ['Failed to book appointment. Please try again.'];
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        errors = xhr.responseJSON.errors;
                    }
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Booking Error',
                            text: errors.join('\n'),
                            confirmButtonColor: '#e53e3e'
                        });
                    } else {
                        alert(errors.join('\n'));
                    }
                }
            });
        });

        // Submit Custom Product Request Form
        $('#item-request-form').on('submit', function(e) {
            e.preventDefault();
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Submitting Request...');

            $.ajax({
                url: '/floating-panel/request-item',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    submitBtn.prop('disabled', false).text('Submit Request');
                    const formEl = $('#item-request-form')[0];
                    if (formEl) {
                        formEl.reset();
                    }
                    loadItemRequests(); // Refresh logs

                    try {
                        closeSgDrawer();
                    } catch (e) {
                        console.error("Error closing drawer: ", e);
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Request Received!',
                            text: response.message,
                            confirmButtonColor: '#3BB77E'
                        });
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false).text('Submit Request');
                    let errors = ['Failed to submit request. Please try again.'];
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        errors = xhr.responseJSON.errors;
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Submission Failed',
                            text: errors.join('\n'),
                            confirmButtonColor: '#e53e3e'
                        });
                    } else {
                        alert(errors.join('\n'));
                    }
                }
            });
        });

        // Submit Affiliate Payout Form
        $(document).on('submit', '#affiliate-payout-form', function(e) {
            e.preventDefault();
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Processing Cashout...');

            $.ajax({
                url: '/floating-panel/affiliate-payout',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    submitBtn.prop('disabled', false).text('Request Cashout');
                    $('#payout-amount').val('');
                    loadAffStats(); // Refresh stats and transaction logs

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Payout Requested!',
                            text: response.message,
                            confirmButtonColor: '#3BB77E'
                        });
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false).text('Request Cashout');
                    let message = 'Failed to submit payout request. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        message = xhr.responseJSON.errors.join('\n');
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Payout Error',
                            text: message,
                            confirmButtonColor: '#e53e3e'
                        });
                    } else {
                        alert(message);
                    }
                }
            });
        });
    });
</script>
