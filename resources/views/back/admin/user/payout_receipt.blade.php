<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout Receipt - #PAY-{{ $payout->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #2D3748;
            margin: 0;
            padding: 40px;
            background: #ffffff;
        }
        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            position: relative;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #EDF2F7;
            padding-bottom: 30px;
            margin-bottom: 30px;
        }
        .logo-section h2 {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            color: #3BB77E;
            margin: 0 0 5px;
            font-size: 26px;
        }
        .logo-section p {
            margin: 0;
            font-size: 13px;
            color: #718096;
            font-weight: 500;
        }
        .receipt-details {
            text-align: right;
        }
        .receipt-details h1 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 20px;
            color: #2D3748;
            margin: 0 0 8px;
        }
        .receipt-details p {
            margin: 0 0 4px;
            font-size: 13px;
            color: #718096;
            font-weight: 500;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }
        .info-block h3 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            color: #A0AEC0;
            margin: 0 0 12px;
            letter-spacing: 0.5px;
        }
        .info-block p {
            margin: 0 0 6px;
            font-size: 14px;
            font-weight: 600;
        }
        .info-block span {
            color: #718096;
            font-size: 13px;
            font-weight: 500;
        }
        .payout-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        .payout-table th {
            background: #F7FAFC;
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            color: #718096;
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #E2E8F0;
        }
        .payout-table td {
            padding: 16px;
            border-bottom: 1px solid #EDF2F7;
            font-size: 14px;
            font-weight: 500;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .status-pending { background: #FEF3C7; color: #D97706; }
        .status-completed { background: #D1FAE5; color: #059669; }
        .status-rejected { background: #FEE2E2; color: #DC2626; }
        
        .amount-row td {
            font-size: 18px;
            font-weight: 800;
            color: #3BB77E;
        }
        .footer {
            border-top: 2px solid #EDF2F7;
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 40px;
        }
        .footer-note {
            max-width: 450px;
        }
        .footer-note h4 {
            margin: 0 0 6px;
            font-size: 13px;
            font-weight: 700;
        }
        .footer-note p {
            margin: 0;
            font-size: 12px;
            color: #718096;
            line-height: 1.5;
        }
        .signature-block {
            text-align: center;
            width: 180px;
        }
        .signature-line {
            border-bottom: 1px solid #718096;
            margin-bottom: 8px;
            height: 40px;
        }
        .signature-block p {
            margin: 0;
            font-size: 12px;
            color: #718096;
            font-weight: 600;
        }
        
        /* Action buttons */
        .actions-bar {
            max-width: 800px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }
        .btn-primary {
            background: #3BB77E;
            color: white;
        }
        .btn-primary:hover { background: #2E9E6B; }
        .btn-secondary {
            background: #EDF2F7;
            color: #4A5568;
        }
        .btn-secondary:hover { background: #E2E8F0; }

        @media print {
            body {
                padding: 0;
            }
            .receipt-container {
                border: none;
                box-shadow: none;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="actions-bar no-print">
        <a href="javascript:window.history.back();" class="btn btn-secondary">
            ← Back
        </a>
        <button onclick="window.print();" class="btn btn-primary">
            Print Receipt
        </button>
    </div>

    <div class="receipt-container">
        <div class="header">
            <div class="logo-section">
                <h2>Smart Groceries</h2>
                <p>Your fast & friendly grocery delivery service</p>
                <p style="margin-top: 5px; font-size: 11px;">Accra, Ghana • support@smartgroceries.com</p>
            </div>
            <div class="receipt-details">
                <h1>REDRAWAL RECEIPT</h1>
                <p><strong>Transaction ID:</strong> #PAY-{{ $payout->id }}</p>
                <p><strong>Date:</strong> {{ $payout->created_at ? $payout->created_at->format('d M Y, h:i A') : 'N/A' }}</p>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-block">
                <h3>Affiliate Recipient</h3>
                <p>{{ $payout->user->name ?? 'N/A' }}</p>
                <span>Email: {{ $payout->user->email ?? 'N/A' }}</span><br>
                <span>Referral Code: {{ $payout->user->referral_code ?? 'N/A' }}</span>
            </div>
            <div class="info-block">
                <h3>Payout Details</h3>
                <p>Payment Method: {{ $payout->payment_method }}</p>
                <span>Status: </span>
                <span class="status-badge status-{{ $payout->status }}">{{ $payout->status }}</span>
            </div>
        </div>

        <table class="payout-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Reference</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Affiliate Earnings Redrawal Request</td>
                    <td>Momo / Payout Transfer</td>
                    <td style="text-align: right; font-weight: 600;">Gh {{ number_format($payout->amount, 2) }}</td>
                </tr>
                <tr class="amount-row">
                    <td colspan="2" style="text-align: right; font-weight: 700; border-bottom: none;">Total Payout Amount:</td>
                    <td style="text-align: right; border-bottom: none;">Gh {{ number_format($payout->amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <div class="footer-note">
                <h4>Thank you for partnering with us!</h4>
                <p>This is a system-generated electronic receipt for your affiliate redrawal request. For inquiries or support regarding payouts, please reach out to smart groceries administration with the transaction ID listed above.</p>
            </div>
            <div class="signature-block">
                <div class="signature-line"></div>
                <p>Authorized Signature</p>
            </div>
        </div>
    </div>

</body>
</html>
