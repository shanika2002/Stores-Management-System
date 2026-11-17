<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Transaction Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            color: #333;
            padding: 15mm;
        }

        .container {
            width: 120mm; /* Slightly narrower than A4 for margins */
            margin: 0 auto;
            background: #fff;
            padding: 15mm;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 15mm;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10mm;
        }

        .logo img {
            width: 100px;
            height: auto;
            margin-bottom: 5mm;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-bottom: 10mm;
        }

        .generated-info {
            font-size: 11px;
            color: #777;
            text-align: right;
            margin-bottom: 15mm;
        }

        .details {
            font-size: 14px;
            margin-bottom: 15mm;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details tr {
            border-bottom: 1px solid #e0e0e0;
        }

        .details th, .details td {
            padding: 8px 12px;
            text-align: left;
            vertical-align: top;
        }

        .details th {
            font-weight: bold;
            color: #007bff;
            width: 35%;
            background: none;
        }

        .details td {
            width: 65%;
        }

        .details ul {
            list-style: none;
            padding-left: 0;
        }

        .details ul li {
            padding: 2px 0;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding-top: 10mm;
            border-top: 1px dashed #e0e0e0;
        }

        @media print {
            body {
                background: none;
                padding: 0;
            }
            .container {
                border: none;
                width: 100%;
                padding: 10mm;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ public_path('build/assets/images/logo.png') }}" alt="Company Logo">
            </div>
            <div class="company-name">
                Airport and Aviation Services (Sri Lanka) (Private) Limited
            </div>
        </div>

        <div class="title">Stock Transaction Receipt</div>
        <div class="generated-info">Generated on: {{ date('Y-m-d H:i:s') }}</div>

        <div class="details">
            <table>
                <tr>
                    <th>Reference</th>
                    <td>{{ $stock_transactions->first()->transaction_reference }}</td>
                </tr>
                <tr>
                    <th>Items</th>
                    <td>
                        <ul>
                            @foreach ($stock_transactions as $transaction)
                                <li>{{ $transaction->item->name }} (Qty: {{ $transaction->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Transaction Type</th>
                    <td>{{ $stock_transactions->first()->transaction_type }}</td>
                </tr>
                <tr>
                    <th>From Store</th>
                    <td>{{ $stock_transactions->first()->fromStore ? $stock_transactions->first()->fromStore->name : '-' }}</td>
                </tr>
                <tr>
                    <th>To Store</th>
                    <td>{{ $stock_transactions->first()->toStore->name }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $stock_transactions->first()->transaction_date }}</td>
                </tr>
                <tr>
                    <th>Employee</th>
                    <td>{{ $stock_transactions->first()->admin->name }}</td> <!-- Updated from employee to admin -->
                </tr>
                <tr>
                    <th>Manager</th>
                    <td>{{ $stock_transactions->first()->manager ? $stock_transactions->first()->manager->name : '-' }}</td> <!-- Updated to use admin -->
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for your transaction!</p>
        </div>
    </div>
</body>
</html>