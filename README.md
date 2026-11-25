# Master Clothes Admin — Enterprise B2B Wholesale Operations Portal

A full-stack wholesale apparel operations & order management portal built with **Laravel 12**, **Filament 5**, **Livewire**, **SQLite**, and **DomPDF**.

## Key Features
- **Filament 5 Admin Panel (`/admin`)**: Full CRUD for Products, 24 Color Swatches, 11 Size Tiers, Wholesale Customers, Multi-Line Orders, and Inquiries.
- **Interactive Order Builder**: Multi-item Filament Repeater with dynamic unit pricing and real-time grand total computation.
- **Order Slip, Print & PDF Export**: Built-in A4 Wholesale Order Slip viewer, browser Print Sheet (`/orders/{id}/print`), DomPDF download/stream (`/orders/{id}/pdf`), and 1-click WhatsApp summary sharing.
- **Built-in Profile & Password Manager**: Update admin profile, email, and password directly inside the panel.
- **Zero-Setup SQLite + Docker Render Ready**: Runs locally via 1-click `.bat` launcher or deploys directly to Render via `Dockerfile`.

## Quick Start (Local Windows)
Double-click **`START_ADMIN_PORTAL.bat`** — it starts the Laravel server on `http://127.0.0.1:8000` and automatically opens `/admin` in Chrome.

Or via terminal:
```bash
php artisan migrate --seed
php artisan serve
```

## Render Cloud Deployment (Docker)
1. Create a **New Web Service** on Render connected to this repository.
2. **Environment / Language:** `Docker` (auto-detected from `Dockerfile`).
3. **Health Check Path:** `/up`
4. **Environment Variables:**
   - `APP_NAME` = `Master Clothes Admin`
   - `APP_ENV` = `production`
   - `APP_DEBUG` = `false`
   - `APP_URL` = `https://<your-service>.onrender.com`
   - `APP_KEY` = *(optional — auto-generated on boot if omitted, or paste `base64:...`)*
   - `DB_CONNECTION` = `sqlite`

## Demo Admin Login
- **URL:** `/admin`
- **Email:** `admin@masterclothes.demo`
- **Password:** `admin123`
