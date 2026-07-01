@extends('front.master')
@section('content')
@section('title')
 Returned Orders
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* ───── Return Orders Page Styles ───── */
    .ro-page-wrap {
        background: #f8fafb;
        min-height: 60vh;
    }

    .ro-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #f1f2f4;
        box-shadow: 0 4px 24px rgba(0,0,0,0.04);
        overflow: hidden;
    }

    .ro-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 28px 32px 24px 32px;
        border-bottom: 1px solid #f1f2f4;
    }

    .ro-icon-badge {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(239, 68, 68, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .ro-icon-badge i {
        font-size: 20px;
        color: #ef4444;
    }

    .ro-header-text h3 {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 22px;
        color: #253D4E;
        margin: 0 0 2px 0;
        line-height: 1.2;
    }

    .ro-header-text p {
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 13px;
        color: #94a3b8;
        margin: 0;
    }

    .ro-card-body {
        padding: 8px 0 0 0;
    }

    /* ───── Desktop Table ───── */
    .ro-table-wrap {
        padding: 0 24px 24px 24px;
    }

    .ro-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-family: 'Inter', sans-serif;
    }

    .ro-table thead th {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 14px 16px;
        background: #f8f9fa;
        border: none;
        white-space: nowrap;
    }

    .ro-table thead th:first-child {
        border-radius: 10px 0 0 10px;
    }

    .ro-table thead th:last-child {
        border-radius: 0 10px 10px 0;
    }

    .ro-table tbody tr {
        transition: background 0.15s ease;
    }

    .ro-table tbody tr:hover {
        background: #fafbfc;
    }

    .ro-table tbody td {
        padding: 16px 16px;
        border-bottom: 1px solid #f1f2f4;
        font-size: 13.5px;
        color: #475569;
        font-weight: 500;
        vertical-align: middle;
    }

    .ro-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ro-sn {
        font-family: 'Outfit', sans-serif;
        font-weight: 600;
        color: #94a3b8;
        font-size: 13px;
    }

    .ro-date {
        color: #475569;
        font-weight: 500;
    }

    .ro-amount {
        font-weight: 700;
        color: #253D4E;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
    }

    .ro-invoice {
        font-family: 'SF Mono', 'Fira Code', 'Consolas', monospace;
        font-size: 12.5px;
        color: #64748b;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .ro-reason-chip {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        background: #fef2f2;
        color: #dc2626;
        font-size: 12px;
        font-weight: 600;
        max-width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.5;
    }

    .ro-time {
        font-size: 12.5px;
        color: #94a3b8;
        font-weight: 500;
    }

    /* ───── Status Badges ───── */
    .ro-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        white-space: nowrap;
        line-height: 1.4;
    }

    .ro-badge-pending {
        background: #fffbeb;
        color: #d97706;
    }

    .ro-badge-resolved {
        background: #f0fdf4;
        color: #16a34a;
    }

    .ro-badge-denied {
        background: #fef2f2;
        color: #dc2626;
    }

    .ro-badge i {
        font-size: 10px;
    }

    /* ───── Mobile Cards ───── */
    .ro-mobile-card {
        background: #fff;
        border: 1px solid #f1f2f4;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        overflow: hidden;
        margin-bottom: 16px;
    }

    .ro-mobile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 18px;
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
        border-bottom: 1px solid #f1f2f4;
    }

    .ro-mobile-invoice {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 14px;
        color: #253D4E;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .ro-mobile-invoice i {
        color: #ef4444;
        font-size: 12px;
    }

    .ro-mobile-time {
        font-family: 'Inter', sans-serif;
        font-size: 11px;
        color: #94a3b8;
        font-weight: 500;
    }

    .ro-mobile-body {
        padding: 18px;
    }

    .ro-mobile-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .ro-mobile-row:last-child {
        margin-bottom: 0;
    }

    .ro-mobile-label {
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: #94a3b8;
        font-weight: 500;
    }

    .ro-mobile-value {
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        color: #253D4E;
        font-weight: 600;
    }

    .ro-mobile-amount {
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        color: #253D4E;
        font-weight: 700;
    }

    .ro-mobile-reason-box {
        margin-top: 14px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 12px;
        padding: 12px 16px;
    }

    .ro-mobile-reason-label {
        font-family: 'Outfit', sans-serif;
        font-size: 10px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ro-mobile-reason-label i {
        color: #ef4444;
        font-size: 11px;
    }

    .ro-mobile-reason-text {
        font-family: 'Inter', sans-serif;
        font-size: 12.5px;
        color: #7f1d1d;
        font-weight: 600;
        line-height: 1.5;
    }

    /* ───── Empty State ───── */
    .ro-empty {
        text-align: center;
        padding: 70px 30px;
    }

    .ro-empty-icon {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        background: #f1f5f9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .ro-empty-icon i {
        font-size: 28px;
        color: #cbd5e1;
    }

    .ro-empty h4 {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: #253D4E;
        margin-bottom: 6px;
    }

    .ro-empty p {
        font-family: 'Inter', sans-serif;
        font-size: 13.5px;
        color: #94a3b8;
        font-weight: 500;
        margin: 0;
    }

    /* ───── Responsive ───── */
    @media (max-width: 767.98px) {
        .ro-card-header {
            padding: 20px 20px 18px 20px;
            gap: 12px;
        }

        .ro-icon-badge {
            width: 42px;
            height: 42px;
            border-radius: 12px;
        }

        .ro-icon-badge i {
            font-size: 17px;
        }

        .ro-header-text h3 {
            font-size: 18px;
        }

        .ro-header-text p {
            font-size: 12px;
        }

        .ro-card-body {
            padding: 16px 16px 8px 16px;
        }

        .ro-empty {
            padding: 50px 24px;
        }
    }
</style>

<div class="page-content pt-50 pb-50 account-mobile-padding ro-page-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    @include('front.user.dashboard_sidebar_menu')
                    <div class="col-md-9">
                        <div class="tab-content account dashboard-content">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="ro-card">
                                    {{-- Card Header --}}
                                    <div class="ro-card-header">
                                        <div class="ro-icon-badge">
                                            <i class="fa-solid fa-rotate-left"></i>
                                        </div>
                                        <div class="ro-header-text">
                                            <h3>Return Orders</h3>
                                            <p>{{ count($orders) }} {{ Str::plural('return request', count($orders)) }} found</p>
                                        </div>
                                    </div>

                                    <div class="ro-card-body">
                                        @if(count($orders) > 0)
                                            {{-- ───── Desktop Table ───── --}}
                                            <div class="ro-table-wrap d-none d-md-block">
                                                <table class="ro-table">
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
                                                            <td><span class="ro-sn">{{ $key + 1 }}</span></td>
                                                            <td><span class="ro-date">{{ $order->order_date }}</span></td>
                                                            <td><span class="ro-amount">Gh {{ number_format($order->amount, 2) }}</span></td>
                                                            <td><span class="ro-invoice">{{ $order->invoice_no }}</span></td>
                                                            <td><span class="ro-reason-chip" title="{{ $order->return_reason }}">{{ $order->return_reason }}</span></td>
                                                            <td>
                                                                @if($order->return_order == 1)
                                                                    <span class="ro-badge ro-badge-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                                                                @elseif($order->return_order == 2)
                                                                    <span class="ro-badge ro-badge-resolved"><i class="fa-solid fa-circle-check"></i> Issue Resolved</span>
                                                                @elseif($order->return_order == 3)
                                                                    <span class="ro-badge ro-badge-denied"><i class="fa-solid fa-circle-xmark"></i> Request Not Granted</span>
                                                                @endif
                                                            </td>
                                                            <td><span class="ro-time">{{ ($order->updated_at)->diffForHumans() }}</span></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            {{-- ───── Mobile Cards ───── --}}
                                            <div class="d-block d-md-none">
                                                @foreach($orders as $key => $order)
                                                <div class="ro-mobile-card">
                                                    <div class="ro-mobile-header">
                                                        <span class="ro-mobile-invoice">
                                                            <i class="fa-solid fa-rotate-left"></i> #{{ $order->invoice_no }}
                                                        </span>
                                                        <span class="ro-mobile-time">{{ ($order->updated_at)->diffForHumans() }}</span>
                                                    </div>
                                                    <div class="ro-mobile-body">
                                                        <div class="ro-mobile-row">
                                                            <span class="ro-mobile-label">Date</span>
                                                            <span class="ro-mobile-value">{{ $order->order_date }}</span>
                                                        </div>
                                                        <div class="ro-mobile-row">
                                                            <span class="ro-mobile-label">Total Amount</span>
                                                            <span class="ro-mobile-amount">Gh {{ number_format($order->amount, 2) }}</span>
                                                        </div>
                                                        <div class="ro-mobile-row">
                                                            <span class="ro-mobile-label">Status</span>
                                                            <div>
                                                                @if($order->return_order == 1)
                                                                    <span class="ro-badge ro-badge-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                                                                @elseif($order->return_order == 2)
                                                                    <span class="ro-badge ro-badge-resolved"><i class="fa-solid fa-circle-check"></i> Issue Resolved</span>
                                                                @elseif($order->return_order == 3)
                                                                    <span class="ro-badge ro-badge-denied"><i class="fa-solid fa-circle-xmark"></i> Request Not Granted</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        @if($order->return_reason)
                                                        <div class="ro-mobile-reason-box">
                                                            <div class="ro-mobile-reason-label">
                                                                <i class="fa-solid fa-exclamation-circle"></i> Return Reason
                                                            </div>
                                                            <div class="ro-mobile-reason-text">
                                                                {{ $order->return_reason }}
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        @else
                                            {{-- ───── Empty State ───── --}}
                                            <div class="ro-empty">
                                                <div class="ro-empty-icon">
                                                    <i class="fa-solid fa-truck-fast"></i>
                                                </div>
                                                <h4>No return orders found</h4>
                                                <p>You haven't submitted any return requests yet.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
