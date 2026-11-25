<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>NovaApparel_Order_Slip_{{ $order->order_id }}</title>
    <style>
        @page {
            margin: 15mm 12mm 15mm 12mm;
            size: a4 portrait;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.3;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table {
            border-bottom: 2px solid #fbcfe8;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }
        .brand-badge {
            width: 36px;
            height: 36px;
            background-color: #db2777;
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            line-height: 36px;
            border-radius: 6px;
            display: inline-block;
        }
        .brand-title {
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
            letter-spacing: 0.5px;
            margin-left: 8px;
            display: inline-block;
            vertical-align: middle;
        }
        .sub-header {
            font-size: 10px;
            font-weight: bold;
            color: #db2777;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 4px;
        }
        .company-contact {
            font-size: 10.5px;
            color: #64748b;
            margin-top: 2px;
        }
        .slip-badge {
            background-color: #fce7f3;
            color: #9d174d;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 12px;
            display: inline-block;
        }
        .order-id {
            font-size: 18px;
            font-weight: bold;
            color: #db2777;
            margin: 3px 0 0 0;
        }
        .order-date {
            font-size: 10.5px;
            color: #64748b;
            margin-top: 2px;
        }
        .details-box {
            background-color: #fdf2f8;
            border: 1px solid #fbcfe8;
            border-radius: 6px;
            margin-bottom: 14px;
        }
        .details-box td {
            padding: 8px 12px;
            vertical-align: top;
        }
        .section-label {
            font-size: 9.5px;
            font-weight: bold;
            color: #be185d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .customer-name {
            font-size: 13.5px;
            font-weight: bold;
            color: #0f172a;
        }
        .business-name {
            font-size: 11.5px;
            font-weight: bold;
            color: #db2777;
        }
        .contact-info {
            font-size: 12px;
            font-weight: bold;
            color: #0f172a;
        }
        .location-info {
            font-size: 11px;
            color: #475569;
        }
        .items-table {
            border: 1.5px solid #64748b;
            margin-bottom: 14px;
        }
        .items-table th {
            background-color: #db2777;
            color: #ffffff;
            font-size: 10.5px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 7px 8px;
            border: 1.5px solid #9d174d;
            border-right: 1.5px solid #fbcfe8;
            text-align: left;
        }
        .items-table th:last-child {
            border-right: 1.5px solid #9d174d;
        }
        .items-table td {
            padding: 6px 8px;
            border: 1px solid #94a3b8;
            font-size: 11px;
            color: #0f172a;
        }
        .items-table tr.even td {
            background-color: #f8fafc;
        }
        .items-table tfoot td {
            padding: 7px 10px;
            font-size: 12px;
            background-color: #fce7f3;
            border-top: 2px solid #db2777;
            border-bottom: 1.5px solid #db2777;
            border-left: 1px solid #f472b6;
            border-right: 1px solid #f472b6;
        }
        .color-dot {
            display: inline-block;
            width: 9px;
            height: 9px;
            border-radius: 5px;
            margin-right: 4px;
            vertical-align: middle;
            border: 1px solid #cbd5e1;
        }
        .footer-table {
            border-top: 1px dashed #fbcfe8;
            padding-top: 8px;
            margin-top: 10px;
        }
        .footer-table td {
            vertical-align: bottom;
        }
        .terms-text {
            font-size: 9.5px;
            color: #64748b;
            line-height: 1.35;
        }
        .sig-label {
            font-size: 10.5px;
            font-weight: bold;
            color: #475569;
            margin-bottom: 24px;
            text-align: right;
        }
        .sig-line {
            font-size: 9.5px;
            color: #64748b;
            border-top: 1px solid #cbd5e1;
            padding-top: 2px;
            text-align: center;
            width: 140px;
            float: right;
        }
    </style>
</head>
<body>

    <!-- Header Table -->
    <table class="header-table">
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <table style="width: auto;">
                    <tr>
                        <td style="width: 40px; vertical-align: middle;">
                            <div class="brand-badge">N</div>
                        </td>
                        <td style="vertical-align: middle;">
                            <span class="brand-title">NOVAAPPAREL WHOLESALE</span>
                        </td>
                    </tr>
                </table>
                <div class="sub-header">Premium 4-Way Stretch Apparel • Wholesale Order Slip</div>
                <div class="company-contact">Apparel Distribution Hub • Contact: +91 90000 00000</div>
            </td>
            <td style="width: 40%; text-align: right; vertical-align: top;">
                <div><span class="slip-badge">Wholesale Order Slip</span></div>
                <div class="order-id">{{ $order->order_id }}</div>
                <div class="order-date">Date: {{ $order->created_at ? $order->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : date('d M Y, h:i A') }}</div>
            </td>
        </tr>
    </table>

    <!-- Retailer Details Box -->
    <table class="details-box">
        <tr>
            <td style="width: 50%;">
                <div class="section-label">Billed To (Retailer / Wholesaler)</div>
                <div class="customer-name">{{ $order->customer_name }}</div>
                <div class="business-name">{{ $order->business_name }}</div>
            </td>
            <td style="width: 50%; text-align: right;">
                <div class="section-label">Contact & Delivery</div>
                <div class="contact-info">Phone: {{ $order->phone }}</div>
                <div class="location-info">Location: {{ $order->location }}</div>
            </td>
        </tr>
    </table>

    <!-- Line Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 6%; text-align: center;">#</th>
                <th style="width: 44%;">Product Item</th>
                <th style="width: 24%;">Color Swatch</th>
                <th style="width: 14%;">Size Option</th>
                <th style="width: 12%; text-align: center;">Qty (Pcs)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $rawItems = $order->items_json ?? $order->items ?? [];
                $items = is_string($rawItems) ? json_decode($rawItems, true) : (is_array($rawItems) ? $rawItems : []);
                $totalPcs = 0;
            @endphp
            @forelse($items as $index => $item)
                @php
                    $qty = (int)($item['quantity'] ?? 1);
                    $totalPcs += $qty;
                @endphp
                <tr class="{{ $index % 2 === 1 ? 'even' : '' }}">
                    <td style="text-align: center; color: #64748b;">{{ $index + 1 }}</td>
                    <td style="font-weight: bold; color: #0f172a;">{{ $item['product'] ?? 'Cotton Leggings' }}</td>
                    <td>
                        <span class="color-dot" style="background-color: {{ $item['color_hex'] ?? '#db2777' }};"></span>
                        <span>{{ $item['color'] ?? 'Standard' }}</span>
                    </td>
                    <td style="font-weight: bold; color: #475569;">{{ $item['size'] ?? 'Free Size' }}</td>
                    <td style="text-align: center; font-weight: bold; color: #0f172a;">{{ $qty }} Pcs</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 14px; color: #94a3b8; font-style: italic;">
                        No product items listed for this order.
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right; font-weight: bold; color: #9d174d; font-size: 11.5px;">Total Quantity:</td>
                <td style="text-align: center; font-weight: bold; color: #be185d; font-size: 13px;">
                    {{ $totalPcs }} Pcs
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- Terms & Signatory Footer -->
    <table class="footer-table">
        <tr>
            <td style="width: 60%;">
                <div class="terms-text">
                    <strong style="color: #0f172a;">Order Notes & Terms:</strong><br>
                    • Verify garment items, sizes, and colors upon delivery.<br>
                    • Any discrepancies must be intimated within 48 hours.<br>
                    <span style="color: #db2777; font-weight: bold;">NovaApparel Wholesale — B2B Apparel Distribution</span>
                </div>
            </td>
            <td style="width: 40%;">
                <div class="sig-label">For NOVAAPPAREL WHOLESALE</div>
                <div class="sig-line">Authorized Signature</div>
            </td>
        </tr>
    </table>

</body>
</html>
