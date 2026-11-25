@php
    $orderRecord = isset($getRecord) && is_callable($getRecord) ? $getRecord() : ($record ?? null);
    if (!$orderRecord && isset($getRecord) && is_object($getRecord)) {
        $orderRecord = $getRecord;
    }

    $waMessage = '';
    if ($orderRecord) {
        $rawItems = $orderRecord->items_json ?? $orderRecord->items ?? [];
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

        $orderDate = $orderRecord->created_at ? $orderRecord->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : date('d M Y, h:i A');

        $waText = "🛍️ *MASTER CLOTHES - WHOLESALE ORDER SLIP*\n";
        $waText .= "-------------------------------------------\n";
        $waText .= "📋 *Order ID:* " . $orderRecord->order_id . "\n";
        $waText .= "📅 *Date:* " . $orderDate . "\n";
        $waText .= "👤 *Customer:* " . $orderRecord->customer_name . "\n";
        if (!empty($orderRecord->business_name)) {
            $waText .= "🏬 *Business:* " . $orderRecord->business_name . "\n";
        }
        $waText .= "📞 *Phone:* " . $orderRecord->phone . "\n";
        if (!empty($orderRecord->location)) {
            $waText .= "📍 *Delivery Location:* " . $orderRecord->location . "\n";
        }
        $waText .= "-------------------------------------------\n";
        $waText .= "📦 *ORDER ITEMS BREAKDOWN:*\n\n";
        $waText .= $itemsText;
        $waText .= "-------------------------------------------\n";
        $waText .= "✨ *TOTAL QUANTITY:* *{$totalPcs} Pcs*\n";
        $waText .= "-------------------------------------------\n";
        $waText .= "Thank you for doing business with *Master Clothes*! 🙏";
        $waMessage = $waText;
    }
@endphp

<style>
/* Base Universal Box-Sizing */
*, *::before, *::after {
    box-sizing: border-box;
}

/* Invoice Main Card Styling (Screen View) */
.viwin-invoice-card {
    background-color: #ffffff !important;
    color: #1e293b !important;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
    padding: clamp(14px, 3vw, 24px) !important;
    border-radius: 10px !important;
    border: 1.5px solid #fbcfe8 !important;
    box-shadow: 0 10px 25px -5px rgba(219, 39, 119, 0.1) !important;
    max-width: 860px !important;
    width: 100% !important;
    margin: 0 auto !important;
    text-align: left !important;
    box-sizing: border-box !important;
    overflow-x: auto !important;
}
@media (max-width: 640px) {
    .viwin-actions-bar { justify-content: stretch !important; }
    .viwin-btn { width: 100% !important; }
}

/* Header Table */
.viwin-header-table {
    width: 100% !important;
    table-layout: fixed !important;
    border-collapse: collapse !important;
    margin-bottom: 14px !important;
    border-bottom: 2px solid #db2777 !important;
    padding-bottom: 10px !important;
    box-sizing: border-box !important;
}

.viwin-header-table td {
    box-sizing: border-box !important;
}

.viwin-emblem-badge {
    width: 42px !important;
    height: 42px !important;
    background: linear-gradient(135deg, #ec4899, #be185d) !important;
    color: #ffffff !important;
    font-weight: 800 !important;
    font-size: 22px !important;
    border-radius: 8px !important;
    text-align: center !important;
    line-height: 42px !important;
    display: inline-block !important;
    vertical-align: middle !important;
    box-shadow: 0 4px 6px -1px rgba(236, 72, 153, 0.3) !important;
}

.viwin-brand-title {
    font-size: 21px !important;
    font-weight: 800 !important;
    color: #0f172a !important;
    margin: 0 !important;
    letter-spacing: 0.5px !important;
    display: inline-block !important;
    vertical-align: middle !important;
    margin-left: 10px !important;
}

.viwin-tax-badge {
    background-color: #fce7f3 !important;
    color: #9d174d !important;
    font-size: 11px !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    padding: 4px 12px !important;
    border-radius: 20px !important;
    letter-spacing: 0.5px !important;
    display: inline-block !important;
    margin-bottom: 4px !important;
}

/* Retailer & Delivery Details Box Table */
.viwin-details-box {
    width: 100% !important;
    table-layout: fixed !important;
    border-collapse: collapse !important;
    background-color: #fdf2f8 !important;
    border: 1.5px solid #f472b6 !important;
    border-radius: 8px !important;
    margin-bottom: 14px !important;
    box-sizing: border-box !important;
}

.viwin-details-box td {
    padding: 10px 16px !important;
    vertical-align: top !important;
    width: 50% !important;
    box-sizing: border-box !important;
}

.viwin-section-label {
    font-size: 10.5px !important;
    font-weight: 800 !important;
    color: #be185d !important;
    text-transform: uppercase !important;
    letter-spacing: 0.6px !important;
    margin-bottom: 4px !important;
}

/* Product Items Table - Crisp High-Contrast Grid Lines */
.viwin-items-table {
    width: 100% !important;
    table-layout: fixed !important;
    border-collapse: collapse !important;
    margin-bottom: 14px !important;
    border: 1.5px solid #64748b !important;
    box-sizing: border-box !important;
}

.viwin-items-table th {
    background-color: #db2777 !important;
    color: #ffffff !important;
    font-size: 11.5px !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    padding: 8px 10px !important;
    text-align: left !important;
    letter-spacing: 0.5px !important;
    border: 1.5px solid #9d174d !important;
    border-right: 1.5px solid #fbcfe8 !important;
    box-sizing: border-box !important;
    line-height: 1.2 !important;
}

.viwin-items-table th:last-child {
    border-right: 1.5px solid #9d174d !important;
}

.viwin-items-table td {
    padding: 7px 10px !important;
    border: 1px solid #94a3b8 !important;
    font-size: 12px !important;
    color: #0f172a !important;
    box-sizing: border-box !important;
    line-height: 1.3 !important;
}

.viwin-items-table tr:nth-child(even) td {
    background-color: #f8fafc !important;
}

.viwin-items-table tfoot tr td {
    background-color: #fce7f3 !important;
    border-top: 2px solid #db2777 !important;
    border-bottom: 1.5px solid #db2777 !important;
    border-left: 1px solid #f472b6 !important;
    border-right: 1px solid #f472b6 !important;
    padding: 8px 12px !important;
    font-size: 14px !important;
    box-sizing: border-box !important;
}

/* Distinct Action Buttons Bar */
.viwin-actions-bar {
    margin-top: 16px !important;
    padding-top: 14px !important;
    border-top: 1px solid #e2e8f0 !important;
    display: flex !important;
    justify-content: flex-end !important;
    align-items: center !important;
    gap: 12px !important;
    flex-wrap: wrap !important;
}

.viwin-btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    padding: 10px 20px !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    border-radius: 8px !important;
    text-decoration: none !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.2s ease-in-out !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12) !important;
}

.viwin-btn-pdf {
    background-color: #db2777 !important;
    color: #ffffff !important;
}
.viwin-btn-pdf:hover {
    background-color: #be185d !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 10px rgba(219, 39, 119, 0.3) !important;
}

.viwin-btn-print {
    background-color: #1e293b !important;
    color: #ffffff !important;
}
.viwin-btn-print:hover {
    background-color: #0f172a !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 10px rgba(30, 41, 59, 0.3) !important;
}

.viwin-btn-wa {
    background-color: #059669 !important;
    color: #ffffff !important;
}
.viwin-btn-wa:hover {
    background-color: #047857 !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 4px 10px rgba(5, 150, 105, 0.3) !important;
}

.viwin-btn-back {
    background-color: #64748b !important;
    color: #ffffff !important;
}
.viwin-btn-back:hover {
    background-color: #475569 !important;
    transform: translateY(-1px) !important;
}

/* High-Quality Print Styles (Eliminates All Dark Outer Margins) */
@page {
    size: A4 portrait;
    margin: 8mm 10mm;
}

@media print {
    *, *::before, *::after {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    html, body, 
    .fi-layout, .fi-main-ctn, .fi-main, .fi-page, .fi-page-content, 
    .fi-sc, .fi-grid, .fi-grid-col, .fi-infolist, .fi-in-entry-wrp, 
    [data-field-wrapper], .fi-simple-layout, .fi-simple-main-ctn, 
    .fi-simple-main, .fi-page-main, .fi-body {
        background: #ffffff !important;
        background-color: #ffffff !important;
        color: #0f172a !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
        width: 100% !important;
    }

    .fi-sidebar, .fi-topbar, .fi-breadcrumbs, .fi-header, .fi-page-header, 
    .viwin-actions-bar, .fi-ac, .fi-form-actions, [x-ref="sidebar"], 
    header.fi-header, nav.fi-breadcrumbs {
        display: none !important;
    }

    .viwin-invoice-card {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 auto !important;
        max-width: 100% !important;
        width: 100% !important;
        background: #ffffff !important;
    }

    .viwin-items-table {
        border: 1.5px solid #334155 !important;
        page-break-inside: auto !important;
    }

    .viwin-items-table th {
        background-color: #db2777 !important;
        color: #ffffff !important;
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
    }
}
</style>

<div class="viwin-invoice-card" id="invoice-card-content">
    @if($orderRecord)
        <!-- Header Section -->
        <table class="viwin-header-table">
            <tr>
                <td style="vertical-align: top; width: 56%; padding-right: 8px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span class="viwin-emblem-badge">M</span>
                        <span class="viwin-brand-title">MASTER CLOTHES</span>
                    </div>
                    <p style="margin: 4px 0 0 0; font-size: 11.5px; font-weight: 700; color: #db2777; text-transform: uppercase; letter-spacing: 0.4px;">
                        Premium 4-Way Stretch Apparel • Wholesale Order Slip
                    </p>
                    <p style="margin: 3px 0 0 0; font-size: 11.5px; color: #64748b;">
                        Apparel Distribution Hub • Contact: +91 90000 00000
                    </p>
                </td>
                <td style="vertical-align: top; text-align: right; width: 44%; padding-left: 8px;">
                    <span class="viwin-tax-badge">Wholesale Order Slip</span>
                    <h3 style="margin: 3px 0 0 0; font-size: 20px; font-weight: 800; color: #db2777; letter-spacing: 0.5px;">{{ $orderRecord->order_id }}</h3>
                    <p style="margin: 3px 0 0 0; font-size: 11.5px; color: #64748b;">
                        Date: {{ $orderRecord->created_at ? $orderRecord->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : date('d M Y, h:i A') }}
                    </p>
                </td>
            </tr>
        </table>

        <!-- Retailer Details Box -->
        <table class="viwin-details-box">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <div class="viwin-section-label">Billed To (Retailer / Wholesaler)</div>
                    <div style="font-size: 15px; font-weight: 800; color: #0f172a; margin-top: 2px;">{{ $orderRecord->customer_name }}</div>
                    <div style="font-size: 13px; font-weight: 700; color: #db2777; margin-top: 2px;">{{ $orderRecord->business_name }}</div>
                </td>
                <td style="width: 50%; text-align: right; vertical-align: top;">
                    <div class="viwin-section-label">Contact & Delivery</div>
                    <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-top: 2px;">📞 {{ $orderRecord->phone }}</div>
                    <div style="font-size: 12.5px; font-weight: 600; color: #475569; margin-top: 2px;">📍 {{ $orderRecord->location }}</div>
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
                    $rawItems = $orderRecord->items_json ?? $orderRecord->items ?? [];
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
                                <span style="display: inline-block; width: 11px; height: 11px; border-radius: 50%; border: 1px solid #cbd5e1; background-color: {{ $item['color_hex'] ?? '#db2777' }};"></span>
                                <span>{{ $item['color'] ?? 'Standard' }}</span>
                            </span>
                        </td>
                        <td style="font-weight: 600; color: #475569;">{{ $item['size'] ?? 'Free Size' }}</td>
                        <td style="text-align: center; font-weight: 800; color: #0f172a; font-size: 12.5px;">{{ $qty }} Pcs</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 16px; color: #94a3b8; font-style: italic;">
                            No product items listed for this order.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: 800; color: #9d174d; font-size: 13.5px;">Total Quantity:</td>
                    <td style="text-align: center; font-weight: 900; color: #be185d; font-size: 15px;">
                        {{ $totalPcs }} Pcs
                    </td>
                </tr>
            </tfoot>
        </table>

        <!-- Action Buttons Bar -->
        <div class="viwin-actions-bar">
            <button type="button" id="btn-download-pdf" onclick="handleDownloadPdf()" class="viwin-btn viwin-btn-pdf">
                📥 Download Order Slip (PDF)
            </button>

            <button type="button" id="btn-print-slip" onclick="handlePrintSlip()" class="viwin-btn viwin-btn-print">
                🖨️ Print Order Slip
            </button>

            <button type="button" id="btn-share-wa" onclick="handleShareWhatsApp()" class="viwin-btn viwin-btn-wa">
                📲 Share via WhatsApp
            </button>

            <a href="/admin/orders" class="viwin-btn viwin-btn-back">
                ⬅ Back to Orders
            </a>
        </div>

        <script>
        function getOrderPdfBlob(orderId, orderDbId, callback, errorCallback) {
            const pdfUrl = '/orders/' + orderDbId + '/pdf';
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

        window.handleDownloadPdf = function() {
            const btn = document.getElementById('btn-download-pdf');
            const orig = btn ? btn.innerHTML : '';
            if (btn) {
                btn.innerHTML = '⏳ Downloading PDF...';
                btn.disabled = true;
            }

            const orderId = '{{ $orderRecord ? $orderRecord->order_id : "MC-ORDER" }}';
            const orderDbId = '{{ $orderRecord ? $orderRecord->id : "" }}';

            const downloadUrl = '/orders/' + orderDbId + '/pdf?download=1';
            const a = document.createElement('a');
            a.href = downloadUrl;
            a.download = 'MasterClothes_Order_Slip_' + orderId + '.pdf';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);

            if (btn) {
                btn.innerHTML = '✅ Downloaded!';
            }

            setTimeout(function() {
                window.location.href = '/admin/orders';
            }, 800);
        };

        window.handlePrintSlip = function() {
            const btn = document.getElementById('btn-print-slip');
            if (btn) btn.innerHTML = '🖨️ Opening Print Sheet...';

            const orderDbId = '{{ $orderRecord ? $orderRecord->id : "" }}';
            window.location.href = '/orders/' + orderDbId + '/print?auto_print=1';
        };

        window.handleShareWhatsApp = function() {
            const btn = document.getElementById('btn-share-wa');
            const orig = btn ? btn.innerHTML : '';
            if (btn) {
                btn.innerHTML = '⏳ Opening WhatsApp...';
            }

            const phone = "{{ preg_replace('/[^0-9]/', '', $orderRecord ? ($orderRecord->phone ?? '') : '') }}";
            const message = {!! json_encode($waMessage ?? '') !!};
            const waUrl = 'https://api.whatsapp.com/send?phone=91' + phone + '&text=' + encodeURIComponent(message);

            window.open(waUrl, '_blank');

            if (btn) {
                setTimeout(function() {
                    btn.innerHTML = orig;
                }, 1500);
            }
        };

        function checkAutoShare() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('share') === '1') {
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
                setTimeout(function() {
                    if (typeof window.handleShareWhatsApp === 'function') {
                        window.handleShareWhatsApp();
                    }
                }, 400);
            }
        }

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            checkAutoShare();
        } else {
            document.addEventListener('DOMContentLoaded', checkAutoShare);
        }
        document.addEventListener('livewire:navigated', checkAutoShare);
        document.addEventListener('livewire:initialized', checkAutoShare);
        </script>
    @endif
</div>
