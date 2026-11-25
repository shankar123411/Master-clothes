@php
    $rawItems = $order->items_json ?? $order->items ?? [];
    $items = is_string($rawItems) ? json_decode($rawItems, true) : (is_array($rawItems) ? $rawItems : []);
    $totalPcs = 0;
    $itemsText = "";
    
    if (!empty($items)) {
        foreach ($items as $idx => $it) {
            $q = (int)($it['quantity'] ?? 1);
            $totalPcs += $q;
            $num = $idx + 1;
            $product = $it['product'] ?? 'Cotton Leggings';
            $color = $it['color'] ?? 'Standard';
            $size = $it['size'] ?? 'Free Size';
            $itemsText .= "  {$num}. *{$product}*\n";
            $itemsText .= "     • Color: {$color}\n";
            $itemsText .= "     • Size: {$size}\n";
            $itemsText .= "     • Qty: *{$q} Pcs*\n\n";
        }
    } else {
        $itemsText = "  • No product items listed.\n\n";
    }

    $orderDate = $order->created_at ? $order->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : date('d M Y, h:i A');

    $waText = "🛍️ *MASTER CLOTHES - WHOLESALE ORDER SLIP*\n";
    $waText .= "-------------------------------------------\n";
    $waText .= "📋 *Order ID:* " . $order->order_id . "\n";
    $waText .= "📅 *Date:* " . $orderDate . "\n";
    $waText .= "👤 *Customer:* " . $order->customer_name . "\n";
    if (!empty($order->business_name)) {
        $waText .= "🏬 *Business:* " . $order->business_name . "\n";
    }
    $waText .= "📞 *Phone:* " . $order->phone . "\n";
    if (!empty($order->location)) {
        $waText .= "📍 *Delivery Location:* " . $order->location . "\n";
    }
    $waText .= "-------------------------------------------\n";
    $waText .= "📦 *ORDER ITEMS BREAKDOWN:*\n\n";
    $waText .= $itemsText;
    $waText .= "-------------------------------------------\n";
    $waText .= "✨ *TOTAL QUANTITY:* *{$totalPcs} Pcs*\n";
    $waText .= "-------------------------------------------\n";
    $waText .= "Thank you for doing business with *Master Clothes*! 🙏";
    $waMessage = $waText;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasterClothes_Order_Slip_{{ $order->order_id }}</title>
    <style>
        *, *::before, *::after {
            box-sizing: border-box !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @page {
            size: A4 portrait;
            margin: 6mm 8mm;
        }

        html, body {
            background-color: #ffffff !important;
            color: #1e293b !important;
            margin: 0 !important;
            padding: 0 !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
            width: 100% !important;
        }

        /* Screen Wrapper */
        .print-page-wrapper {
            background-color: #f1f5f9;
            min-height: 100vh;
            padding: 20px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Floating Toolbar (Screen only) */
        .print-toolbar {
            width: 100%;
            max-width: 860px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            background: #ffffff;
            padding: 10px 18px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }
        @media (max-width: 640px) {
            .viwin-invoice-sheet { padding: 14px !important; overflow-x: auto !important; }
            .print-btn { width: 100%; justify-content: center; }
        }

        .print-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 700;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-print {
            background-color: #db2777;
            color: #ffffff;
        }
        .btn-print:hover {
            background-color: #be185d;
        }

        .btn-close {
            background-color: #64748b;
            color: #ffffff;
        }
        .btn-close:hover {
            background-color: #475569;
        }

        /* Invoice Container - Proportional to fill A4 Page Height */
        .viwin-invoice-sheet {
            background-color: #ffffff !important;
            width: 100% !important;
            max-width: 860px !important;
            padding: 22px 24px !important;
            border-radius: 10px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid #fbcfe8 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            box-sizing: border-box !important;
        }

        /* Header Table */
        .viwin-header-table {
            width: 100% !important;
            table-layout: fixed !important;
            border-collapse: collapse !important;
            margin-bottom: 12px !important;
            border-bottom: 2px solid #fbcfe8 !important;
            padding-bottom: 10px !important;
        }

        .viwin-emblem-badge {
            width: 44px !important;
            height: 44px !important;
            background: linear-gradient(135deg, #ec4899, #be185d) !important;
            background-color: #db2777 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            font-size: 24px !important;
            border-radius: 8px !important;
            text-align: center !important;
            line-height: 44px !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }

        .viwin-brand-title {
            font-size: 23px !important;
            font-weight: 800 !important;
            color: #0f172a !important;
            margin: 0 0 0 10px !important;
            letter-spacing: 0.5px !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }

        .viwin-tax-badge {
            background-color: #fce7f3 !important;
            color: #9d174d !important;
            font-size: 11px !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            padding: 4px 12px !important;
            border-radius: 20px !important;
            display: inline-block !important;
            margin-bottom: 3px !important;
        }

        /* Retailer Details Box */
        .viwin-details-box {
            width: 100% !important;
            table-layout: fixed !important;
            border-collapse: collapse !important;
            background-color: #fdf2f8 !important;
            border: 1px solid #fbcfe8 !important;
            border-radius: 8px !important;
            margin-bottom: 12px !important;
        }

        .viwin-details-box td {
            padding: 10px 16px !important;
            vertical-align: top !important;
            width: 50% !important;
        }

        .viwin-section-label {
            font-size: 11px !important;
            font-weight: 800 !important;
            color: #be185d !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            margin-bottom: 3px !important;
        }

        /* Line Items Table - Crisp High-Contrast Grid Lines */
        .viwin-items-table {
            width: 100% !important;
            table-layout: fixed !important;
            border-collapse: collapse !important;
            margin-bottom: 14px !important;
            border: 1.5px solid #64748b !important;
        }

        .viwin-items-table th {
            background-color: #db2777 !important;
            color: #ffffff !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            padding: 9px 10px !important;
            text-align: left !important;
            letter-spacing: 0.5px !important;
            border: 1.5px solid #9d174d !important;
            border-right: 1.5px solid #fbcfe8 !important;
            line-height: 1.2 !important;
        }

        .viwin-items-table th:last-child {
            border-right: 1.5px solid #9d174d !important;
        }

        .viwin-items-table td {
            padding: 8px 10px !important;
            border: 1px solid #94a3b8 !important;
            font-size: 12.5px !important;
            color: #0f172a !important;
            line-height: 1.3 !important;
        }

        .viwin-items-table tr:nth-child(even) td {
            background-color: #f8fafc !important;
        }

        .viwin-items-table tfoot tr td {
            padding: 10px 12px !important;
            font-size: 14.5px !important;
            background-color: #fce7f3 !important;
            border-top: 2px solid #db2777 !important;
            border-bottom: 1.5px solid #db2777 !important;
            border-left: 1px solid #f472b6 !important;
            border-right: 1px solid #f472b6 !important;
        }

        /* Terms & Signatory Section */
        .viwin-footer-table {
            width: 100% !important;
            table-layout: fixed !important;
            border-collapse: collapse !important;
            border-top: 1.5px dashed #fbcfe8 !important;
            padding-top: 10px !important;
            margin-top: 4px !important;
        }

        .viwin-footer-table td {
            vertical-align: bottom !important;
        }

        /* Print Media Styles */
        @media print {
            *, *::before, *::after {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            html, body {
                background: #ffffff !important;
                background-color: #ffffff !important;
                color: #0f172a !important;
                margin: 0 !important;
                padding: 0 !important;
                height: 100% !important;
            }

            .print-page-wrapper {
                background: #ffffff !important;
                background-color: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
                height: 100% !important;
                display: block !important;
            }

            .print-toolbar {
                display: none !important;
            }

            .viwin-invoice-sheet {
                padding: 0 !important;
                border: none !important;
                box-shadow: none !important;
                max-width: 100% !important;
                width: 100% !important;
                height: auto !important;
                background: #ffffff !important;
            }

            .viwin-items-table {
                border: 1.5px solid #334155 !important;
                page-break-inside: auto !important;
            }

            .viwin-items-table th {
                border: 1.5px solid #9d174d !important;
                border-right: 1.5px solid #fbcfe8 !important;
            }

            .viwin-items-table td {
                border: 1px solid #64748b !important;
                color: #0f172a !important;
            }

            .viwin-items-table tr {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            .viwin-items-table thead {
                display: table-header-group !important;
            }

            .viwin-items-table tfoot {
                display: table-footer-group !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
        }
    </style>
</head>
<body>

<div class="print-page-wrapper">
    <!-- Action Bar for Screen View -->
    <div class="print-toolbar">
        <div>
            <strong style="color: #db2777; font-size: 14px;">Master Clothes Wholesale Order Slip</strong>
            <span style="color: #64748b; font-size: 13px; margin-left: 8px;">Order: {{ $order->order_id }}</span>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <button type="button" id="btn-share-wa" onclick="shareOrderSlipPdf()" class="print-btn" style="background-color: #059669; color: #ffffff;">📲 Share PDF via WhatsApp</button>
            <button type="button" id="btn-download-pdf" onclick="downloadOrderSlipPdf()" class="print-btn" style="background-color: #db2777; color: #ffffff;">📥 Download Order Slip (PDF)</button>
            <button onclick="handlePrintSlip()" class="print-btn" style="background-color: #1e293b; color: #ffffff;">🖨️ Print Slip</button>
            <button onclick="window.location.href='/admin/orders'" class="print-btn btn-close">⬅ Back to Orders</button>
        </div>
    </div>

    <!-- Invoice Sheet -->
    <div class="viwin-invoice-sheet" id="order-slip-sheet">
        <!-- Top Section -->
        <div>
            <!-- Header Section -->
            <table class="viwin-header-table">
                <tr>
                    <td style="vertical-align: top; width: 56%; padding-right: 8px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span class="viwin-emblem-badge">M</span>
                            <span class="viwin-brand-title">MASTER CLOTHES</span>
                        </div>
                        <p style="margin: 4px 0 0 0; font-size: 12px; font-weight: 700; color: #db2777; text-transform: uppercase; letter-spacing: 0.4px;">
                            Premium 4-Way Stretch Apparel • Wholesale Order Slip
                        </p>
                        <p style="margin: 3px 0 0 0; font-size: 12px; color: #64748b;">
                            Apparel Distribution Hub • Contact: +91 90000 00000
                        </p>
                    </td>
                    <td style="vertical-align: top; text-align: right; width: 44%; padding-left: 8px;">
                        <span class="viwin-tax-badge">Wholesale Order Slip</span>
                        <h3 style="margin: 3px 0 0 0; font-size: 22px; font-weight: 800; color: #db2777; letter-spacing: 0.5px;">{{ $order->order_id }}</h3>
                        <p style="margin: 3px 0 0 0; font-size: 12px; color: #64748b;">
                            Date: {{ $order->created_at ? $order->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : date('d M Y, h:i A') }}
                        </p>
                    </td>
                </tr>
            </table>

            <!-- Retailer Details Box -->
            <table class="viwin-details-box">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <div class="viwin-section-label">Billed To (Retailer / Wholesaler)</div>
                        <div style="font-size: 16px; font-weight: 800; color: #0f172a; margin-top: 2px;">{{ $order->customer_name }}</div>
                        <div style="font-size: 14px; font-weight: 700; color: #db2777; margin-top: 2px;">{{ $order->business_name }}</div>
                    </td>
                    <td style="width: 50%; text-align: right; vertical-align: top;">
                        <div class="viwin-section-label">Contact & Delivery</div>
                        <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 2px;">📞 {{ $order->phone }}</div>
                        <div style="font-size: 13px; font-weight: 600; color: #475569; margin-top: 2px;">📍 {{ $order->location }}</div>
                    </td>
                </tr>
            </table>

            <!-- Line Items Table (Order Slip Mode) -->
            <table class="viwin-items-table">
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
                        <tr>
                            <td style="text-align: center; font-family: monospace; color: #64748b;">{{ $index + 1 }}</td>
                            <td style="font-weight: 700; color: #0f172a;">{{ $item['product'] ?? 'Cotton Leggings' }}</td>
                            <td>
                                <span style="display: inline-flex; align-items: center; gap: 6px;">
                                    <span style="display: inline-block; width: 12px; height: 12px; border-radius: 50%; border: 1px solid #cbd5e1; background-color: {{ $item['color_hex'] ?? '#db2777' }};"></span>
                                    <span>{{ $item['color'] ?? 'Standard' }}</span>
                                </span>
                            </td>
                            <td style="font-weight: 600; color: #475569;">{{ $item['size'] ?? 'Free Size' }}</td>
                            <td style="text-align: center; font-weight: 800; color: #0f172a; font-size: 13px;">{{ $qty }} Pcs</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px; color: #94a3b8; font-style: italic;">
                                No product items listed for this order.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: 800; color: #9d174d; font-size: 14px;">Total Quantity:</td>
                        <td style="text-align: center; font-weight: 900; color: #be185d; font-size: 16px;">
                            {{ $totalPcs }} Pcs
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Terms & Signatory Footer to Fill A4 Page Beautifully -->
        <table class="viwin-footer-table">
            <tr>
                <td style="width: 60%; padding-top: 6px;">
                    <div style="font-size: 11px; color: #64748b; line-height: 1.4;">
                        <strong style="color: #0f172a;">Order Notes & Terms:</strong><br>
                        • Verify garment items, sizes, and colors upon delivery.<br>
                        • Any issues must be intimated within 48 hours.<br>
                        <span style="color: #db2777; font-weight: 700;">Master Clothes — B2B Wholesale Apparel Distribution</span>
                    </div>
                </td>
                <td style="width: 40%; text-align: right; padding-top: 6px;">
                    <div style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 28px;">For MASTER CLOTHES</div>
                    <div style="font-size: 11px; color: #64748b; border-top: 1px solid #cbd5e1; display: inline-block; padding-top: 3px; min-width: 150px; text-align: center;">
                        Authorized Signature
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<script>
function getOrderPdfBlob(callback, errorCallback) {
    const pdfUrl = '/orders/{{ $order->id }}/pdf';
    fetch(pdfUrl)
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Server returned HTTP ' + response.status);
            }
            return response.blob();
        })
        .then(function(blob) {
            callback(blob);
        })
        .catch(function(err) {
            console.error('PDF fetch error:', err);
            if (errorCallback) errorCallback(err);
        });
}

function handlePrintSlip() {
    const returnToOrders = function() {
        window.removeEventListener('afterprint', returnToOrders);
        window.location.href = '/admin/orders';
    };
    window.addEventListener('afterprint', returnToOrders);
    window.print();
}

function downloadOrderSlipPdf() {
    const btn = document.getElementById('btn-download-pdf');
    const orig = btn ? btn.innerHTML : '';
    if (btn) btn.innerHTML = '⏳ Downloading PDF...';
    
    const downloadUrl = '/orders/{{ $order->id }}/pdf?download=1';
    const a = document.createElement('a');
    a.href = downloadUrl;
    a.download = 'MasterClothes_Order_Slip_{{ $order->order_id }}.pdf';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);

    if (btn) btn.innerHTML = '✅ Downloaded!';
    setTimeout(function() {
        window.location.href = '/admin/orders';
    }, 800);
}

function shareOrderSlipPdf() {
    const btn = document.getElementById('btn-share-wa');
    const orig = btn ? btn.innerHTML : '';
    if (btn) btn.innerHTML = '⏳ Opening WhatsApp...';

    const phone = "{{ preg_replace('/[^0-9]/', '', $order->phone ?? '') }}";
    const message = {!! json_encode($waMessage ?? '') !!};
    const waUrl = 'https://api.whatsapp.com/send?phone=91' + phone + '&text=' + encodeURIComponent(message);

    window.open(waUrl, '_blank');

    if (btn) {
        setTimeout(function() {
            btn.innerHTML = orig;
        }, 1500);
    }
}

window.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('auto_print') === '1') {
        setTimeout(handlePrintSlip, 350);
    } else if (urlParams.get('share') === 'whatsapp') {
        setTimeout(shareOrderSlipPdf, 500);
    } else if (urlParams.get('download') === '1') {
        setTimeout(downloadOrderSlipPdf, 500);
    }
});
</script>

</body>
</html>
