<p align="center">
  <div align="center">
    <h1 align="center" style="font-size: 2.5rem; font-weight: 800; color: #e11d48;">MeroZodi 2.0</h1>
    <p align="center"><strong>Next-Gen Nepali Matrimonial & Matchmaking Platform</strong></p>
    <p align="center">
      <a href="https://merozodi.com"><strong>merozodi.com</strong></a>
    </p>
  </div>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire 3">
  <img src="https://img.shields.io/badge/Filament-3.x-FFA000?style=for-the-badge&logo=filament&logoColor=white" alt="Filament PHP v3">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Laravel_Reverb-WebSockets-6366F1?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Reverb">
</p>

---

## 📌 About MeroZodi

**MeroZodi 2.0** is an enterprise-grade, culturally attuned matrimonial platform specifically engineered for Nepali singles residing in Nepal and across the global Nepali diaspora (Australia, USA, UK, Canada, Japan, UAE, etc.).

Powered by the **TALL Stack** (Tailwind CSS, Alpine.js, Laravel 12, Livewire 3), **Laravel Reverb WebSockets**, and **Filament PHP v3**, MeroZodi delivers instant reactive matchmaking, sub-100ms discovery filters, real-time messaging, encrypted 1-on-1 virtual video dating, and automated payment processing for Nepal's leading digital wallets (**eSewa**, **Khalti**, **Fonepay**, **ConnectIPS**).

---

## 🚀 Key Features

- 💖 **5-Step Onboarding Wizard**: Progressive profile onboarding capturing account demographics, cultural/caste details, horoscope/Rashi, lifestyle, career, and family lineage.
- 🔍 **5-Tier Matchmaking & Search Engine**:
  - Quick Basic Search (Age, Religion, Caste, Location)
  - Custom Multi-Criteria Search (Income, Profession, Diet, Manglik status)
  - Mutual Match Engine (Two-way mutual preference matching)
  - Reverse Match Discovery
  - Saved Search Alerts
- 💬 **Real-Time Messaging (Laravel Reverb)**: Self-hosted WebSocket instant chat with typing indicators, delivery receipts, and Alpine.js emoji picker.
- 📹 **Encrypted Video Dating (Jitsi Meet)**: 1-on-1 private virtual video dating rooms without sharing personal phone numbers.
- 🇳🇵 **Nepali Payment Gateway Suite**:
  - **eSewa ePay v2** (HMAC-SHA256 signature verification)
  - **Khalti EPayment v2** (REST API `pidx` verification)
  - **Fonepay Direct** (Dynamic Merchant QR checkout)
  - **ConnectIPS** (NCHL inter-bank transfer with PKCS#12 signing)
  - Automated 13% VAT invoice generation
- 🛡️ **Filament PHP v3 Admin Backoffice**: User management, National ID/Citizenship KYC verification queue with document viewer, banner ads management, matrimony events manager, and financial analytics.

---

## 🏗️ Architecture & Technology Stack

| Layer | Technology |
| :--- | :--- |
| **Backend Framework** | Laravel 12 (PHP 8.3+) |
| **Reactive Frontend Engine** | Livewire 3 + Alpine.js |
| **UI Components & Styles** | Tailwind CSS + DaisyUI |
| **Admin Panel** | Filament PHP v3 |
| **WebSocket Engine** | Laravel Reverb (Port 8080) |
| **Video Calling** | Jitsi Meet WebRTC API |
| **Database** | MySQL 8.0 / SQLite + Redis 7 |

---

## 🛠️ Quickstart & Installation

### Prerequisites
- PHP 8.2 or 8.3+ with `pdo`, `mbstring`, `openssl`, `curl`, `fileinfo` extensions
- Composer 2.x
- Node.js 18+ & npm
- Git

### Installation Steps

```bash
# 1. Clone the repository
git clone https://github.com/shahimahesh4/merozodi.git
cd merozodi

# 2. Install Dependencies
composer install
npm install

# 3. Setup Environment Configuration
cp .env.example .env
php artisan key:generate

# 4. Run Migrations & Seeders
php artisan migrate:fresh --seed --force

# 5. Build Frontend Assets
npm run build

# 6. Start Development Server
php artisan serve
```

---

## 🔑 Default Credentials

### Filament Admin Backoffice
- **URL**: [http://localhost:8000/admin](http://localhost:8000/admin) (or `/stnapanel`)
- **Email**: `shahimahesh4@gmail.com`
- **Password**: `Mahesh@9843##`

### Test User Accounts
- `aayush@example.com` / `password` (Male, Brahmin, Kathmandu)
- `priya@example.com` / `password` (Female, Chhetri, Sydney, Australia)
- `rohan@example.com` / `password` (Male, Newar, Lalitpur)
- `sneha@example.com` / `password` (Female, Gurung, Pokhara)

---

## 📖 Complete Documentation & Technical Specifications

For full architectural diagrams, database schema dictionaries, payment gateway flows, and production deployment topology, see:
- [PROJECT_PLANNING_AND_SPECIFICATION.md](PROJECT_PLANNING_AND_SPECIFICATION.md)
- `MeroZodi_2.0_Project_Planning_and_Implementation.docx`

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).
