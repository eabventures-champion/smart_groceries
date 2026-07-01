<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Low Stock Alert</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f6f9fc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 0 auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #eef2f5;
        }
        .header {
            background-color: #dc3545;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
            color: #495057;
            line-height: 1.6;
        }
        .product-card {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #dc3545;
        }
        .product-card table {
            width: 100%;
            border-collapse: collapse;
        }
        .product-card td {
            padding: 6px 0;
        }
        .product-card td.label {
            font-weight: 600;
            color: #6c757d;
            width: 30%;
        }
        .product-card td.value {
            color: #212529;
            font-weight: 700;
        }
        .btn {
            display: inline-block;
            background-color: #3bb77e;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 700;
            margin-top: 15px;
            text-align: center;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #adb5bd;
            border-top: 1px solid #eef2f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚠️ Low Stock Alert</h1>
        </div>
        <div class="content">
            <p>Hello Admin,</p>
            <p>This is an automated alert to notify you that the following product has reached or fallen below the minimum safety stock level of <strong>10 units</strong>:</p>
            
            <div class="product-card">
                <table>
                    <tr>
                        <td class="label">Product Name:</td>
                        <td class="value">{{ $product->product_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Category:</td>
                        <td class="value">{{ $product->category?->category_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Current Stock:</td>
                        <td class="value" style="color: #dc3545;">{{ $stock }} units</td>
                    </tr>
                    <tr>
                        <td class="label">Product SKU:</td>
                        <td class="value">{{ $product->product_code ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <p>Please log in to the admin panel to update the stock or place a refill order as soon as possible.</p>
            
            <p style="text-align: center;">
                <a href="{{ url('/admin/dashboard') }}" class="btn">Go to Admin Dashboard</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Smart Groceries. All rights reserved.
        </div>
    </div>
</body>
</html>
