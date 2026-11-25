<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovaApparel Admin — Wholesale Apparel & Order Portal</title>
    <style>
        :root {
            --bg: #0f172a;
            --panel: #1e293b;
            --border: #334155;
            --pink: #db2777;
            --pink-hover: #be185d;
            --text: #f8fafc;
            --muted: #94a3b8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        body { background: radial-gradient(circle at top right, rgba(219,39,119,0.18), transparent 45%), var(--bg); color: var(--text); min-height: 100dvh; display: flex; align-items: center; justify-content: center; padding: clamp(1rem, 3vw, 2rem); }
        .container { width: 100%; max-width: 960px; display: flex; flex-direction: column; gap: 1.75rem; }
        .hero { background: var(--panel); border: 1px solid var(--border); border-radius: 20px; padding: clamp(1.5rem, 4vw, 2.75rem); display: flex; flex-direction: column; gap: 1.25rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); }
        .brand-row { display: flex; align-items: center; gap: 0.85rem; flex-wrap: wrap; }
        .badge-logo { width: 46px; height: 46px; border-radius: 12px; background: linear-gradient(135deg, #ec4899, #be185d); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; color: #fff; }
        .pill { background: rgba(219,39,119,0.15); border: 1px solid rgba(219,39,119,0.35); color: #f472b6; font-size: 0.78rem; font-weight: 700; padding: 0.3rem 0.75rem; border-radius: 999px; text-transform: uppercase; letter-spacing: 0.5px; }
        h1 { font-size: clamp(1.6rem, 4vw, 2.4rem); font-weight: 800; line-height: 1.2; }
        p.sub { color: var(--muted); font-size: clamp(0.95rem, 2vw, 1.05rem); line-height: 1.6; max-width: 680px; }
        .actions { display: flex; gap: 0.85rem; flex-wrap: wrap; margin-top: 0.25rem; }
        .btn-primary { background: linear-gradient(135deg, #ec4899, #db2777); color: #fff; text-decoration: none; font-weight: 700; padding: 0.85rem 1.5rem; border-radius: 10px; display: inline-flex; align-items: center; gap: 0.5rem; transition: transform 0.15s; }
        .btn-primary:hover { transform: translateY(-2px); background: var(--pink-hover); }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr)); gap: 1rem; }
        .card { background: var(--panel); border: 1px solid var(--border); border-radius: 14px; padding: 1.25rem; display: flex; flex-direction: column; gap: 0.45rem; }
        .card h3 { font-size: 1rem; font-weight: 700; color: #f472b6; }
        .card p { font-size: 0.86rem; color: var(--muted); line-height: 1.5; }
    </style>
</head>
<body>
    <main class="container">
        <section class="hero">
            <div class="brand-row">
                <div class="badge-logo">N</div>
                <span class="pill">Laravel 12 • Filament 5 • DomPDF</span>
            </div>
            <h1>NovaApparel Wholesale Admin Portal</h1>
            <p class="sub">
                Enterprise B2B wholesale order booking, product catalog, color swatch &amp; size matrix management, retailer directory, and automated A4 PDF Order Slip generation.
            </p>
            <div class="actions">
                <a href="/admin" class="btn-primary">Open Admin Portal &rarr;</a>
            </div>
        </section>

        <section class="grid">
            <div class="card">
                <h3>Catalog &amp; Swatches</h3>
                <p>Manage wholesale apparel SKUs, 24 color swatches with hex codes, and 11 size tiers.</p>
            </div>
            <div class="card">
                <h3>Live Order Builder</h3>
                <p>Multi-line Filament repeater forms with automatic total calculation and retailer autofill.</p>
            </div>
            <div class="card">
                <h3>PDF &amp; Print Engine</h3>
                <p>One-click A4 Order Slip export via DomPDF, browser print sheets, and WhatsApp summaries.</p>
            </div>
        </section>
    </main>
</body>
</html>
