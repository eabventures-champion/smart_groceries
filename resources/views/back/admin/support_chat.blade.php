@extends('back.admin.master')

@section('content')
<div class="page-content" style="padding: 1.5rem;">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">Live Support</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tawk.to Live Chat</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Tawk.to Dashboard Card -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <!-- Card Header with gradient -->
                <div class="card-header border-0 text-white py-4" style="background: linear-gradient(135deg, #1abc9c 0%, #16a085 50%, #0d7a65 100%);">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div style="background: rgba(255,255,255,0.2); border-radius: 12px; padding: 12px;">
                                <i class="bx bx-chat" style="font-size: 28px;"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 text-white fw-bold">Tawk.to Live Chat</h4>
                                <p class="mb-0 text-white-50" style="font-size: 14px;">Smart Groceries Customer Support</p>
                            </div>
                        </div>
                        <a href="https://dashboard.tawk.to/#/dashboard/6a4fa09ba6558f1d451fdc7b"
                           target="_blank"
                           class="btn btn-light btn-lg px-4 d-flex align-items-center gap-2"
                           style="border-radius: 10px; font-weight: 600; color: #0d7a65;">
                            <i class="bx bx-link-external"></i>
                            Open Tawk.to Dashboard
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Quick Action Buttons -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-3 col-sm-6">
                            <a href="https://dashboard.tawk.to/#/dashboard/6a4fa09ba6558f1d451fdc7b"
                               target="_blank" class="text-decoration-none">
                                <div class="card border h-100 text-center p-3 hover-shadow" style="border-radius: 12px; transition: all 0.3s; cursor: pointer;">
                                    <div style="background: #e8f8f5; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                                        <i class="bx bx-bar-chart-alt-2" style="font-size: 24px; color: #1abc9c;"></i>
                                    </div>
                                    <h6 class="mb-1 text-dark">Dashboard</h6>
                                    <small class="text-muted">View analytics & stats</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="https://dashboard.tawk.to/#/chat/6a4fa09ba6558f1d451fdc7b"
                               target="_blank" class="text-decoration-none">
                                <div class="card border h-100 text-center p-3 hover-shadow" style="border-radius: 12px; transition: all 0.3s; cursor: pointer;">
                                    <div style="background: #eaf4fe; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                                        <i class="bx bx-message-dots" style="font-size: 24px; color: #3498db;"></i>
                                    </div>
                                    <h6 class="mb-1 text-dark">Live Chats</h6>
                                    <small class="text-muted">Answer customer chats</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="https://dashboard.tawk.to/#/reporting/6a4fa09ba6558f1d451fdc7b"
                               target="_blank" class="text-decoration-none">
                                <div class="card border h-100 text-center p-3 hover-shadow" style="border-radius: 12px; transition: all 0.3s; cursor: pointer;">
                                    <div style="background: #fef5e7; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                                        <i class="bx bx-line-chart" style="font-size: 24px; color: #f39c12;"></i>
                                    </div>
                                    <h6 class="mb-1 text-dark">Reports</h6>
                                    <small class="text-muted">Chat history & reports</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="https://dashboard.tawk.to/#/admin/6a4fa09ba6558f1d451fdc7b/chat-widget"
                               target="_blank" class="text-decoration-none">
                                <div class="card border h-100 text-center p-3 hover-shadow" style="border-radius: 12px; transition: all 0.3s; cursor: pointer;">
                                    <div style="background: #f4ecf7; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                                        <i class="bx bx-cog" style="font-size: 24px; color: #9b59b6;"></i>
                                    </div>
                                    <h6 class="mb-1 text-dark">Settings</h6>
                                    <small class="text-muted">Widget customization</small>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Info Section -->
                    <div class="card border-0" style="background: #f8f9fa; border-radius: 12px;">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="bx bx-info-circle text-primary me-2"></i>How it works</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start gap-2">
                                        <span class="badge rounded-circle bg-success" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">1</span>
                                        <div>
                                            <strong>Customers visit your site</strong>
                                            <p class="text-muted mb-0" style="font-size: 13px;">The tawk.to chat bubble appears on all pages of smartgroceries.org</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start gap-2">
                                        <span class="badge rounded-circle bg-success" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">2</span>
                                        <div>
                                            <strong>They start a chat</strong>
                                            <p class="text-muted mb-0" style="font-size: 13px;">Customers click the chat bubble to ask questions or request help</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start gap-2">
                                        <span class="badge rounded-circle bg-success" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">3</span>
                                        <div>
                                            <strong>You reply from tawk.to</strong>
                                            <p class="text-muted mb-0" style="font-size: 13px;">Open the dashboard above or use the <a href="https://www.tawk.to/software/mobile-apps/" target="_blank">tawk.to mobile app</a> to reply</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tip: Mobile App -->
                    <div class="mt-3 p-3 border rounded-3 d-flex align-items-center gap-3" style="background: #fff3cd; border-color: #ffc107 !important;">
                        <i class="bx bx-mobile-alt" style="font-size: 28px; color: #856404;"></i>
                        <div>
                            <strong style="color: #856404;">💡 Pro Tip:</strong>
                            <span style="color: #664d03;">Download the <a href="https://www.tawk.to/software/mobile-apps/" target="_blank" style="color: #856404; font-weight: 600;">tawk.to mobile app</a> (iOS & Android) to receive chat notifications and reply to customers on the go!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        transform: translateY(-2px);
        border-color: #1abc9c !important;
    }
</style>
@endsection
