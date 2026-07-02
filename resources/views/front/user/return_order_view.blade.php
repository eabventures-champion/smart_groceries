@extends('front.master')
@section('title')
 Returned Orders
@endsection
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    /* ── Fonts & Colors ───────────────────────────── */
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

    .returns-page-bg { background: #f8fafb; }

    /* ── Premium Card Container ───────────────────── */
    .returns-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #f1f2f4;
        box-shadow: 0 4px 24px rgba(0,0,0,0.04), 0 1px 4px rgba(0,0,0,0.02);
        overflow: hidden;
    }

    /* ── Card Header ──────────────────────────────── */
    .returns-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 28px 32px 24px;
        border-bottom: 1px solid #f1f2f4;
    }
    .returns-icon-badge {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: rgba(239, 68, 68, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #ef4444;
    }
    .returns-icon-badge i {
        font-size: 22px;
    }
    .returns-header-text h3 {
        margin: 0 0 2px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 22px;
        color: #253D4E;
        line-height: 1.2;
    }
    .returns-header-text p {
        margin: 0;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: #7e8a9a;
        font-weight: 500;
    }

    /* ── Desktop Table ────────────────────────────── */
    .returns-table-wrap {
        padding: 8px 0 0;
    }
    .returns-table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Inter', sans-serif;
    }
    .returns-table thead th {
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
    .returns-table thead th:first-child { padding-left: 32px; }
    .returns-table thead th:last-child { padding-right: 32px; text-align: right; }
    .returns-table tbody tr {
        border-bottom: 1px solid #f1f2f4;
        transition: background 0.15s ease;
    }
    .returns-table tbody tr:last-child { border-bottom: none; }
    .returns-table tbody tr:hover { background: #fafbfc; }
    .returns-table tbody td {
        padding: 16px 20px;
        font-size: 14px;
        color: #253D4E;
        font-weight: 500;
        vertical-align: middle;
        white-space: nowrap;
    }
    .returns-table tbody td:first-child { padding-left: 32px; }
    .returns-table tbody td:last-child { padding-right: 32px; text-align: right; }
    
    .returns-table .sn-cell {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        color: #b0b7c3;
        font-size: 13px;
    }
    .returns-table .date-cell {
        font-weight: 500;
        color: #4a5568;
    }
    .returns-table .amount-cell {
        font-weight: 700;
        color: #253D4E;
    }
    .returns-table .invoice-cell {
        font-family: 'SFMono-Regular', 'Fira Code', 'Fira Mono', 'Roboto Mono', monospace;
        font-size: 12.5px;
        color: #64748b;
        background: #f7f8fa;
        padding: 5px 10px;
        border-radius: 6px;
        display: inline-block;
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    .returns-table .reason-cell {
        font-size: 13px;
        color: #ef4444;
        background: #fef2f2;
        padding: 6px 12px;
        border-radius: 8px;
        display: inline-block;
        font-weight: 600;
        border: 1px solid #fee2e2;
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .returns-table .time-cell {
        font-size: 13px;
        color: #94a3b8;
        font-weight: 500;
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
    .status-resolved { background: #f0fdf4; color: #16a34a; }
    .status-resolved .badge-dot { background: #16a34a; }
    .status-denied { background: #fef2f2; color: #dc2626; }
    .status-denied .badge-dot { background: #dc2626; }

    /* ── Empty State ──────────────────────────────── */
    .returns-empty {
        padding: 80px 32px;
        text-align: center;
    }
    .returns-empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #fef2f2;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: #ef4444;
    }
    .returns-empty-icon i {
        font-size: 32px;
    }
    .returns-empty h4 {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: #253D4E;
        margin: 0 0 6px;
    }
    .returns-empty p {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        color: #94a3b8;
        margin: 0;
    }

    /* ── Mobile Cards ─────────────────────────────── */
    .mobile-return-card {
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
    .mobile-card-invoice {
        font-family: 'SFMono-Regular', 'Fira Code', 'Roboto Mono', monospace;
        font-weight: 600;
        font-size: 13px;
        color: #253D4E;
    }
    .mobile-card-time {
        font-family: 'Inter', sans-serif;
        font-size: 11px;
        color: #94a3b8;
        font-weight: 500;
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
    .mobile-card-reason-box {
        margin-top: 12px;
        background: #fef2f2;
        border: 1px solid #fee2e2;
        border-radius: 10px;
        padding: 12px 14px;
    }
    .mobile-card-reason-label {
        font-size: 11px;
        color: #ef4444;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .mobile-card-reason-text {
        font-size: 13px;
        color: #b91c1c;
        font-weight: 600;
        line-height: 1.4;
    }

    @media (max-width: 767.98px) {
        .returns-card-header {
            padding: 20px 18px 18px;
            gap: 12px;
        }
        .returns-icon-badge {
            width: 44px;
            height: 44px;
            border-radius: 12px;
        }
        .returns-icon-badge i { font-size: 18px; }
        .returns-header-text h3 { font-size: 18px; }
        .returns-header-text p { font-size: 12px; }
        .returns-empty { padding: 50px 20px; }
    }
</style>

<div class="page-content pt-50 pb-50 account-mobile-padding returns-page-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    @include('front.user.dashboard_sidebar_menu')
                    <div class="col-md-9">
                        <div class="returns-card">
                            {{-- Card Header --}}
                            <div class="returns-card-header">
                                <div class="returns-icon-badge">
                                    <i class="fa-solid fa-truck-ramp-box"></i>
                                </div>
                                <div class="returns-header-text">
                                    <h3>Returned Orders</h3>
                                    <p>{{ count($orders) }} {{ Str::plural('order', count($orders)) }} returned</p>
                                </div>
                            </div>

                            @if(count($orders) > 0)
                                {{-- ═══ Desktop Table ═══ --}}
                                <div class="returns-table-wrap d-none d-md-block">
                                    <table class="returns-table">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Invoice</th>
                                                <th>Return Reason</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $key => $order)
                                            <tr>
                                                <td class="sn-cell">{{ $key + 1 }}</td>
                                                <td class="date-cell">{{ $order->order_date }}</td>
                                                <td class="amount-cell">Gh {{ number_format($order->amount, 2) }}</td>
                                                <td><span class="invoice-cell">{{ $order->invoice_no }}</span></td>
                                                <td><span class="reason-cell" title="{{ $order->return_reason }}">{{ $order->return_reason }}</span></td>
                                                <td>
                                                    @if($order->return_order == 1)
                                                        <span class="status-badge status-pending"><span class="badge-dot"></span>Pending</span>
                                                    @elseif($order->return_order == 2)
                                                        <span class="status-badge status-resolved"><span class="badge-dot"></span>Resolved</span>
                                                    @elseif($order->return_order == 3)
                                                        <span class="status-badge status-denied"><span class="badge-dot"></span>Not Approved</span>
                                                    @endif
                                                </td>
                                                <td class="time-cell">{{ ($order->updated_at)->diffForHumans() }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- ═══ Mobile Cards ═══ --}}
                                <div class="d-block d-md-none" style="padding: 16px;">
                                    @foreach($orders as $key => $order)
                                    <div class="mobile-return-card">
                                        <div class="mobile-card-header">
                                            <span class="mobile-card-invoice">#{{ $order->invoice_no }}</span>
                                            <span class="mobile-card-time">{{ ($order->updated_at)->diffForHumans() }}</span>
                                        </div>
                                        <div class="mobile-card-body">
                                            <div class="mobile-card-row">
                                                <span class="mobile-card-label">Date</span>
                                                <span class="mobile-card-value">{{ $order->order_date }}</span>
                                            </div>
                                            <div class="mobile-card-row">
                                                <span class="mobile-card-label">Total Amount</span>
                                                <span class="mobile-card-value">Gh {{ number_format($order->amount, 2) }}</span>
                                            </div>
                                            <div class="mobile-card-row">
                                                <span class="mobile-card-label">Status</span>
                                                <div>
                                                    @if($order->return_order == 1)
                                                        <span class="status-badge status-pending"><span class="badge-dot"></span>Pending</span>
                                                    @elseif($order->return_order == 2)
                                                        <span class="status-badge status-resolved"><span class="badge-dot"></span>Resolved</span>
                                                    @elseif($order->return_order == 3)
                                                        <span class="status-badge status-denied"><span class="badge-dot"></span>Not Approved</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($order->return_reason)
                                            <div class="mobile-card-reason-box">
                                                <div class="mobile-card-reason-label">
                                                    <i class="fa-solid fa-circle-info"></i> Reason
                                                </div>
                                                <div class="mobile-card-reason-text">
                                                    {{ $order->return_reason }}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                {{-- ═══ Empty State ═══ --}}
                                <div class="returns-empty">
                                    <div class="returns-empty-icon">
                                        <i class="fa-solid fa-box-open"></i>
                                    </div>
                                    <h4>No return orders</h4>
                                    <p>Your returned orders will be listed here.</p>
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
