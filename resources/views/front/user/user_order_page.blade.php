@extends('front.master')
@section('title')
 My Orders
@endsection
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    /* ── Fonts ────────────────────────────────────── */
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

    .orders-page-bg { background: #f8fafb; }

    /* ── Premium Card Container ───────────────────── */
    .orders-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #f1f2f4;
        box-shadow: 0 4px 24px rgba(0,0,0,0.04), 0 1px 4px rgba(0,0,0,0.02);
        overflow: hidden;
    }

    /* ── Card Header ──────────────────────────────── */
    .orders-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 28px 32px 24px;
        border-bottom: 1px solid #f1f2f4;
    }
    .orders-icon-badge {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, #3bb77e 0%, #29a56c 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(59,183,126,0.25);
    }
    .orders-icon-badge i {
        font-size: 22px;
        color: #fff;
    }
    .orders-header-text h3 {
        margin: 0 0 2px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 22px;
        color: #253D4E;
        line-height: 1.2;
    }
    .orders-header-text p {
        margin: 0;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: #7e8a9a;
        font-weight: 500;
    }

    /* ── Desktop Table ────────────────────────────── */
    .orders-table-wrap {
        padding: 8px 0 0;
    }
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Inter', sans-serif;
    }
    .orders-table thead th {
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
    .orders-table thead th:first-child { padding-left: 32px; }
    .orders-table thead th:last-child { padding-right: 32px; text-align: right; }
    .orders-table tbody tr {
        border-bottom: 1px solid #f1f2f4;
        transition: background 0.15s ease;
    }
    .orders-table tbody tr:last-child { border-bottom: none; }
    .orders-table tbody tr:hover { background: #fafbfc; }
    .orders-table tbody td {
        padding: 16px 20px;
        font-size: 14px;
        color: #253D4E;
        font-weight: 500;
        vertical-align: middle;
        white-space: nowrap;
    }
    .orders-table tbody td:first-child { padding-left: 32px; }
    .orders-table tbody td:last-child { padding-right: 32px; text-align: right; }
    .orders-table .sn-cell {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        color: #b0b7c3;
        font-size: 13px;
    }
    .orders-table .date-cell {
        font-weight: 500;
        color: #4a5568;
    }
    .orders-table .amount-cell {
        font-weight: 700;
        color: #3bb77e;
        font-family: 'Inter', sans-serif;
    }
    .orders-table .invoice-cell {
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
    .orders-table .time-cell {
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
    .status-queued { background: #fef2f2; color: #dc2626; }
    .status-queued .badge-dot { background: #dc2626; }
    .status-pending { background: #fffbeb; color: #d97706; }
    .status-pending .badge-dot { background: #d97706; }
    .status-confirmed { background: #eff6ff; color: #2563eb; }
    .status-confirmed .badge-dot { background: #2563eb; }
    .status-processing { background: #f5f3ff; color: #7c3aed; }
    .status-processing .badge-dot { background: #7c3aed; }
    .status-delivering { background: #ecfdf5; color: #059669; }
    .status-delivering .badge-dot { background: #059669; }
    .status-delivered { background: #f0fdf4; color: #16a34a; }
    .status-delivered .badge-dot { background: #16a34a; }
    .status-return-pending { background: #fffbeb; color: #d97706; }
    .status-return-pending .badge-dot { background: #d97706; }
    .status-return-approved { background: #eff6ff; color: #2563eb; }
    .status-return-approved .badge-dot { background: #2563eb; }
    .status-return-denied { background: #fef2f2; color: #dc2626; }
    .status-return-denied .badge-dot { background: #dc2626; }

    /* ── Action Buttons ───────────────────────────── */
    .action-btns { display: flex; align-items: center; justify-content: flex-end; gap: 6px; }
    .action-btn-view,
    .action-btn-download,
    .action-btn-confirm {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        font-size: 14px;
    }
    .action-btn-view {
        background: #3bb77e;
        color: #fff;
        box-shadow: 0 2px 8px rgba(59,183,126,0.2);
    }
    .action-btn-view:hover {
        background: #2da56e;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59,183,126,0.3);
        color: #fff;
    }
    .action-btn-download {
        background: #fff;
        color: #64748b;
        border: 1.5px solid #e2e8f0;
    }
    .action-btn-download:hover {
        background: #f8fafc;
        color: #334155;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }
    .action-btn-confirm {
        width: auto;
        padding: 0 14px;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #3bb77e 0%, #29a56c 100%);
        color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(59,183,126,0.2);
    }
    .action-btn-confirm:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(59,183,126,0.35);
        color: #fff;
    }

    /* ── Empty State ──────────────────────────────── */
    .orders-empty {
        padding: 80px 32px;
        text-align: center;
    }
    .orders-empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #f0fdf4;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    .orders-empty-icon i {
        font-size: 32px;
        color: #3bb77e;
    }
    .orders-empty h4 {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: #253D4E;
        margin: 0 0 6px;
    }
    .orders-empty p {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        color: #94a3b8;
        margin: 0;
    }

    /* ── Mobile Cards ─────────────────────────────── */
    .mobile-order-card {
        background: #fff;
        border: 1px solid #f1f2f4;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.03);
        overflow: hidden;
        margin-bottom: 16px;
        transition: box-shadow 0.2s ease;
    }
    .mobile-order-card:active { box-shadow: 0 2px 6px rgba(0,0,0,0.06); }
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
    .mobile-card-amount {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 15px;
        color: #3bb77e;
    }
    .mobile-card-divider {
        height: 1px;
        background: #f1f2f4;
        margin: 14px 0;
    }
    .mobile-card-actions {
        display: flex;
        gap: 8px;
    }
    .mobile-action-view,
    .mobile-action-download {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 14px;
        border-radius: 10px;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }
    .mobile-action-view {
        background: #3bb77e;
        color: #fff;
    }
    .mobile-action-view:hover { background: #2da56e; color: #fff; }
    .mobile-action-download {
        background: #f7f8fa;
        color: #4a5568;
        border: 1.5px solid #e2e8f0;
    }
    .mobile-action-download:hover { background: #eef0f4; color: #253D4E; }
    .mobile-confirm-btn {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 10px;
        padding: 11px 14px;
        border-radius: 10px;
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        font-weight: 700;
        background: linear-gradient(135deg, #3bb77e 0%, #29a56c 100%);
        color: #fff;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(59,183,126,0.2);
    }
    .mobile-confirm-btn:hover {
        box-shadow: 0 4px 14px rgba(59,183,126,0.35);
    }

    /* ── Responsive tweaks ────────────────────────── */
    @media (max-width: 767.98px) {
        .orders-card-header {
            padding: 20px 18px 18px;
            gap: 12px;
        }
        .orders-icon-badge {
            width: 44px;
            height: 44px;
            border-radius: 12px;
        }
        .orders-icon-badge i { font-size: 18px; }
        .orders-header-text h3 { font-size: 18px; }
        .orders-header-text p { font-size: 12px; }
        .orders-empty { padding: 50px 20px; }
    }
</style>

<div class="page-content pt-50 pb-50 account-mobile-padding orders-page-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    @include('front.user.dashboard_sidebar_menu')
                    <div class="col-md-9">
                        <div class="orders-card">
                            {{-- Card Header --}}
                            <div class="orders-card-header">
                                <div class="orders-icon-badge">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </div>
                                <div class="orders-header-text">
                                    <h3>Your Orders</h3>
                                    <p>{{ count($orders) }} {{ Str::plural('order', count($orders)) }} placed</p>
                                </div>
                            </div>

                            @if(count($orders) > 0)
                                {{-- ═══ Desktop Table ═══ --}}
                                <div class="orders-table-wrap d-none d-md-block">
                                    <table class="orders-table">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Invoice</th>
                                                <th>Status</th>
                                                <th>Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $key => $order)
                                            <tr>
                                                <td class="sn-cell">{{ $key + 1 }}</td>
                                                <td class="date-cell">{{ $order->order_date }}</td>
                                                <td class="amount-cell">Gh {{ number_format($order->amount, 2) }}</td>
                                                <td><span class="invoice-cell">{{ $order->invoice_no }}</span></td>
                                                <td>
                                                    @if($order->status == 'queued')
                                                        <span class="status-badge status-queued"><span class="badge-dot"></span>Queued</span>
                                                    @elseif($order->status == 'pending')
                                                        <span class="status-badge status-pending"><span class="badge-dot"></span>Pending</span>
                                                    @elseif($order->status == 'confirmed')
                                                        <span class="status-badge status-confirmed"><span class="badge-dot"></span>Confirmed</span>
                                                    @elseif($order->status == 'processing')
                                                        <span class="status-badge status-processing"><span class="badge-dot"></span>Processing</span>
                                                    @elseif($order->status == 'delivering')
                                                        <span class="status-badge status-delivering"><span class="badge-dot"></span>Out for Delivery</span>
                                                    @elseif($order->status == 'delivered')
                                                        <span class="status-badge status-delivered"><span class="badge-dot"></span>Delivered</span>
                                                        @if($order->return_order == 1)
                                                            <span class="status-badge status-return-pending" style="margin-left: 4px;"><span class="badge-dot"></span>Return Pending</span>
                                                        @elseif($order->return_order == 2)
                                                            <span class="status-badge status-return-approved" style="margin-left: 4px;"><span class="badge-dot"></span>Returned Approved</span>
                                                        @elseif($order->return_order == 3)
                                                            <span class="status-badge status-return-denied" style="margin-left: 4px;"><span class="badge-dot"></span>Return Not Approved</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="time-cell">
                                                    @if($order->status == 'queued' || $order->status == 'pending')
                                                        {{ ($order->created_at)->diffForHumans() }}
                                                    @elseif($order->status == 'confirmed')
                                                        {{ Carbon\Carbon::parse($order->confirmed_date)->diffForHumans() }}
                                                    @elseif($order->status == 'processing')
                                                        {{ Carbon\Carbon::parse($order->processing_date)->diffForHumans() }}
                                                    @elseif($order->status == 'delivering')
                                                        {{ $order->shipped_date ? Carbon\Carbon::parse($order->shipped_date)->diffForHumans() : 'Just now' }}
                                                    @else
                                                        {{ Carbon\Carbon::parse($order->delivered_date)->diffForHumans() }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-btns">
                                                        <a title="View Details" href="{{ url('user/order_details/'.$order->id) }}" class="action-btn-view">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                        <a title="Download Invoice" href="{{ url('user/invoice_download/'.$order->id) }}" class="action-btn-download">
                                                            <i class="fa-solid fa-download"></i>
                                                        </a>
                                                        @if($order->status == 'delivering')
                                                        <form action="{{ route('user.confirm.delivery', $order->id) }}" method="POST" style="display:inline; margin:0;" onsubmit="return confirm('Are you sure you have received this delivery?');">
                                                            @csrf
                                                            <button type="submit" title="Confirm Receipt" class="action-btn-confirm">
                                                                <i class="fa-solid fa-check"></i> Confirm
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- ═══ Mobile Cards ═══ --}}
                                <div class="d-block d-md-none" style="padding: 16px;">
                                    @foreach($orders as $key => $order)
                                    <div class="mobile-order-card">
                                        <div class="mobile-card-header">
                                            <span class="mobile-card-invoice">#{{ $order->invoice_no }}</span>
                                            <span class="mobile-card-time">
                                                @if($order->status == 'queued' || $order->status == 'pending')
                                                    {{ ($order->created_at)->diffForHumans() }}
                                                @elseif($order->status == 'confirmed')
                                                    {{ Carbon\Carbon::parse($order->confirmed_date)->diffForHumans() }}
                                                @elseif($order->status == 'processing')
                                                    {{ Carbon\Carbon::parse($order->processing_date)->diffForHumans() }}
                                                @elseif($order->status == 'delivering')
                                                    {{ $order->shipped_date ? Carbon\Carbon::parse($order->shipped_date)->diffForHumans() : 'Just now' }}
                                                @else
                                                    {{ Carbon\Carbon::parse($order->delivered_date)->diffForHumans() }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="mobile-card-body">
                                            <div class="mobile-card-row">
                                                <span class="mobile-card-label">Date</span>
                                                <span class="mobile-card-value">{{ $order->order_date }}</span>
                                            </div>
                                            <div class="mobile-card-row">
                                                <span class="mobile-card-label">Total Amount</span>
                                                <span class="mobile-card-amount">Gh {{ number_format($order->amount, 2) }}</span>
                                            </div>
                                            <div class="mobile-card-row">
                                                <span class="mobile-card-label">Status</span>
                                                <div>
                                                    @if($order->status == 'queued')
                                                        <span class="status-badge status-queued"><span class="badge-dot"></span>Queued</span>
                                                    @elseif($order->status == 'pending')
                                                        <span class="status-badge status-pending"><span class="badge-dot"></span>Pending</span>
                                                    @elseif($order->status == 'confirmed')
                                                        <span class="status-badge status-confirmed"><span class="badge-dot"></span>Confirmed</span>
                                                    @elseif($order->status == 'processing')
                                                        <span class="status-badge status-processing"><span class="badge-dot"></span>Processing</span>
                                                    @elseif($order->status == 'delivering')
                                                        <span class="status-badge status-delivering"><span class="badge-dot"></span>Out for Delivery</span>
                                                    @elseif($order->status == 'delivered')
                                                        <span class="status-badge status-delivered"><span class="badge-dot"></span>Delivered</span>
                                                        @if($order->return_order == 1)
                                                            <span class="status-badge status-return-pending" style="margin-top: 4px;"><span class="badge-dot"></span>Return Pending</span>
                                                        @elseif($order->return_order == 2)
                                                            <span class="status-badge status-return-approved" style="margin-top: 4px;"><span class="badge-dot"></span>Returned Approved</span>
                                                        @elseif($order->return_order == 3)
                                                            <span class="status-badge status-return-denied" style="margin-top: 4px;"><span class="badge-dot"></span>Return Not Approved</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mobile-card-divider"></div>
                                            <div class="mobile-card-actions">
                                                <a href="{{ url('user/order_details/'.$order->id) }}" class="mobile-action-view">
                                                    <i class="fa-solid fa-eye"></i> View Details
                                                </a>
                                                <a href="{{ url('user/invoice_download/'.$order->id) }}" class="mobile-action-download">
                                                    <i class="fa-solid fa-download"></i> Invoice
                                                </a>
                                            </div>
                                            @if($order->status == 'delivering')
                                            <form action="{{ route('user.confirm.delivery', $order->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Are you sure you have received this delivery?');">
                                                @csrf
                                                <button type="submit" class="mobile-confirm-btn">
                                                    <i class="fa-solid fa-check"></i> Confirm Receipt
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                {{-- ═══ Empty State ═══ --}}
                                <div class="orders-empty">
                                    <div class="orders-empty-icon">
                                        <i class="fa-solid fa-basket-shopping"></i>
                                    </div>
                                    <h4>No orders yet</h4>
                                    <p>When you place an order, it will appear here.</p>
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
