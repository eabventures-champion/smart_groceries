@extends('front.master')
@section('title')
 Expert Bookings
@endsection
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    /* ── Fonts & Colors ───────────────────────────── */
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

    .bookings-page-bg { background: #f8fafb; }

    /* ── Premium Card Container ───────────────────── */
    .bookings-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #f1f2f4;
        box-shadow: 0 4px 24px rgba(0,0,0,0.04), 0 1px 4px rgba(0,0,0,0.02);
        overflow: hidden;
    }

    /* ── Card Header ──────────────────────────────── */
    .bookings-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 28px 32px 24px;
        border-bottom: 1px solid #f1f2f4;
    }
    .bookings-icon-badge {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: rgba(124, 58, 237, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #7c3aed;
    }
    .bookings-icon-badge i {
        font-size: 22px;
    }
    .bookings-header-text h3 {
        margin: 0 0 2px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 22px;
        color: #253D4E;
        line-height: 1.2;
    }
    .bookings-header-text p {
        margin: 0;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: #7e8a9a;
        font-weight: 500;
    }

    /* ── Desktop Table ────────────────────────────── */
    .bookings-table-wrap {
        padding: 8px 0 0;
    }
    .bookings-table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Inter', sans-serif;
    }
    .bookings-table thead th {
        background: #f8f9fa;
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 12px;
        color: #7e8a9a;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 14px 20px;
        border: none;
        white-space: nowrap;
    }
    .bookings-table thead th:first-child { padding-left: 32px; }
    .bookings-table thead th:last-child { padding-right: 32px; }
    .bookings-table tbody tr {
        border-bottom: 1px solid #f1f2f4;
        transition: background 0.15s ease;
    }
    .bookings-table tbody tr:last-child { border-bottom: none; }
    .bookings-table tbody tr:hover { background: #fafbfc; }
    .bookings-table tbody td {
        padding: 16px 20px;
        font-size: 14px;
        color: #253D4E;
        font-weight: 500;
        vertical-align: middle;
    }
    .bookings-table tbody td:first-child { padding-left: 32px; }
    .bookings-table tbody td:last-child { padding-right: 32px; }
    
    .bookings-table .sn-cell {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        color: #b0b7c3;
        font-size: 13px;
    }
    .bookings-table .expert-cell {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: #253D4E;
        font-size: 15px;
    }
    .bookings-table .category-badge {
        font-size: 10.5px;
        font-weight: 700;
        background: #fef3c7;
        color: #d97706;
        padding: 3px 8px;
        border-radius: 6px;
        margin-left: 6px;
        font-family: 'Inter', sans-serif;
        vertical-align: middle;
    }
    .bookings-table .date-cell {
        font-weight: 600;
        color: #4a5568;
    }
    .bookings-table .time-badge {
        font-size: 11px;
        font-weight: 600;
        background: #f1f5f9;
        color: #475569;
        padding: 3px 8px;
        border-radius: 6px;
        margin-left: 6px;
    }
    .bookings-table .notes-text {
        font-size: 13px;
        color: #64748b;
        font-weight: 400;
        font-style: italic;
        line-height: 1.4;
    }
    .bookings-table .feedback-box {
        font-size: 12.5px;
        color: #1e3a8a;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 500;
        line-height: 1.4;
    }

    /* ── Status Badges ────────────────────────────── */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        line-height: 1;
        white-space: nowrap;
    }
    .status-badge .badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .status-pending { background: #fffbeb; color: #d97706; }
    .status-pending .badge-dot { background: #d97706; }
    .status-confirmed { background: #eff6ff; color: #2563eb; }
    .status-confirmed .badge-dot { background: #2563eb; }
    .status-completed { background: #f1f5f9; color: #475569; }
    .status-completed .badge-dot { background: #475569; }
    .status-cancelled { background: #fef2f2; color: #dc2626; }
    .status-cancelled .badge-dot { background: #dc2626; }

    /* ── Empty State ──────────────────────────────── */
    .bookings-empty {
        padding: 80px 32px;
        text-align: center;
    }
    .bookings-empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #faf5ff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: #7c3aed;
    }
    .bookings-empty-icon i {
        font-size: 32px;
    }
    .bookings-empty h4 {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: #253D4E;
        margin: 0 0 6px;
    }
    .bookings-empty p {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        color: #94a3b8;
        margin: 0;
    }

    /* ── Mobile Cards ─────────────────────────────── */
    .mobile-booking-card {
        background: #fff;
        border: 1px solid #f1f2f4;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.03);
        overflow: hidden;
        margin-bottom: 16px;
        transition: box-shadow 0.2s ease;
    }
    .mobile-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        background: #f8f9fb;
        border-bottom: 1px solid #f1f2f4;
    }
    .mobile-card-expert {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 14px;
        color: #253D4E;
    }
    .mobile-card-body { padding: 16px 18px; }
    .mobile-card-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .mobile-card-row:last-child { margin-bottom: 0; }
    .mobile-card-label {
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: #94a3b8;
        font-weight: 500;
    }
    .mobile-card-value {
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: #253D4E;
        font-weight: 600;
    }
    .mobile-card-notes-box {
        margin-top: 12px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 10px;
        padding: 12px;
    }
    .mobile-card-notes-label {
        font-size: 11px;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .mobile-card-notes-text {
        font-size: 12.5px;
        color: #475569;
        font-weight: 500;
        line-height: 1.4;
        font-style: italic;
    }
    .mobile-card-feedback-box {
        margin-top: 10px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 12px;
    }
    .mobile-card-feedback-label {
        font-size: 11px;
        color: #1d4ed8;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .mobile-card-feedback-text {
        font-size: 12.5px;
        color: #1e3a8a;
        font-weight: 600;
        line-height: 1.4;
    }

    @media (max-width: 767.98px) {
        .bookings-card-header {
            padding: 20px 18px 18px;
            gap: 12px;
        }
        .bookings-icon-badge {
            width: 44px;
            height: 44px;
            border-radius: 12px;
        }
        .bookings-icon-badge i { font-size: 18px; }
        .bookings-header-text h3 { font-size: 18px; }
        .bookings-header-text p { font-size: 12px; }
        .bookings-empty { padding: 50px 20px; }
    }
</style>

<div class="page-content pt-50 pb-50 account-mobile-padding bookings-page-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    @include('front.user.dashboard_sidebar_menu')
                    <div class="col-md-9">
                        <div class="bookings-card">
                            {{-- Card Header --}}
                            <div class="bookings-card-header">
                                <div class="bookings-icon-badge">
                                    <i class="fa-solid fa-user-doctor"></i>
                                </div>
                                <div class="bookings-header-text">
                                    <h3>Expert Bookings</h3>
                                    <p>{{ count($bookings) }} {{ Str::plural('booking', count($bookings)) }} scheduled</p>
                                </div>
                            </div>

                            @if(count($bookings) > 0)
                                {{-- ═══ Desktop Table ═══ --}}
                                <div class="bookings-table-wrap d-none d-md-block">
                                    <table class="bookings-table">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Expert Name</th>
                                                <th>Consult Date</th>
                                                <th>Status</th>
                                                <th>Notes</th>
                                                <th>Expert Feedback</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bookings as $key => $booking)
                                            <tr>
                                                <td class="sn-cell">{{ $key + 1 }}</td>
                                                <td>
                                                    <span class="expert-cell">{{ $booking->expert_name }}</span>
                                                    <span class="category-badge">{{ $booking->expert_category }}</span>
                                                </td>
                                                <td>
                                                    <span class="date-cell">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</span>
                                                    <span class="time-badge">{{ $booking->booking_time }}</span>
                                                </td>
                                                <td>
                                                    @if($booking->status == 'pending')
                                                        <span class="status-badge status-pending"><span class="badge-dot"></span>Pending</span>
                                                    @elseif($booking->status == 'confirmed')
                                                        <span class="status-badge status-confirmed"><span class="badge-dot"></span>Confirmed</span>
                                                    @elseif($booking->status == 'completed')
                                                        <span class="status-badge status-completed"><span class="badge-dot"></span>Completed</span>
                                                    @else
                                                        <span class="status-badge status-cancelled"><span class="badge-dot"></span>{{ ucfirst($booking->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="notes-text" title="{{ $booking->notes }}">
                                                        {{ $booking->notes ? Str::limit($booking->notes, 50) : 'No notes' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($booking->expert_feedback)
                                                        <div class="feedback-box">
                                                            {{ $booking->expert_feedback }}
                                                        </div>
                                                    @else
                                                        <span class="text-muted" style="font-size: 12px; font-weight: 500;">Waiting for review...</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- ═══ Mobile Cards ═══ --}}
                                <div class="d-block d-md-none" style="padding: 16px;">
                                    @foreach($bookings as $key => $booking)
                                    <div class="mobile-booking-card">
                                        <div class="mobile-card-header">
                                            <span class="mobile-card-expert">{{ $booking->expert_name }}</span>
                                            <span class="category-badge" style="margin-left:0;">{{ $booking->expert_category }}</span>
                                        </div>
                                        <div class="mobile-card-body">
                                            <div class="mobile-card-row">
                                                <span class="mobile-card-label">Date</span>
                                                <span class="mobile-card-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</span>
                                            </div>
                                            <div class="mobile-card-row">
                                                <span class="mobile-card-label">Time Slot</span>
                                                <span class="mobile-card-value">{{ $booking->booking_time }}</span>
                                            </div>
                                            <div class="mobile-card-row">
                                                <span class="mobile-card-label">Status</span>
                                                <div>
                                                    @if($booking->status == 'pending')
                                                        <span class="status-badge status-pending"><span class="badge-dot"></span>Pending</span>
                                                    @elseif($booking->status == 'confirmed')
                                                        <span class="status-badge status-confirmed"><span class="badge-dot"></span>Confirmed</span>
                                                    @elseif($booking->status == 'completed')
                                                        <span class="status-badge status-completed"><span class="badge-dot"></span>Completed</span>
                                                    @else
                                                        <span class="status-badge status-cancelled"><span class="badge-dot"></span>{{ ucfirst($booking->status) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($booking->notes)
                                            <div class="mobile-card-notes-box">
                                                <div class="mobile-card-notes-label">Notes</div>
                                                <div class="mobile-card-notes-text">{{ $booking->notes }}</div>
                                            </div>
                                            @endif
                                            @if($booking->expert_feedback)
                                            <div class="mobile-card-feedback-box">
                                                <div class="mobile-card-feedback-label">Feedback</div>
                                                <div class="mobile-card-feedback-text">{{ $booking->expert_feedback }}</div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                {{-- ═══ Empty State ═══ --}}
                                <div class="bookings-empty">
                                    <div class="bookings-empty-icon">
                                        <i class="fa-solid fa-calendar-xmark"></i>
                                    </div>
                                    <h4>No expert bookings</h4>
                                    <p>You haven't scheduled any expert consultations yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
