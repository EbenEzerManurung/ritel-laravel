
# 🛍️ Laravel Ritel – Retail Management System

[![Laravel](https://img.shields.io/badge/Laravel-13.9.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-38BDF8?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![PWA](https://img.shields.io/badge/PWA-Enabled-5A0FC8?style=for-the-badge&logo=pwa&logoColor=white)](https://web.dev/progressive-web-apps/)
![RESTful API](https://img.shields.io/badge/API-RESTful-success?style=for-the-badge)
![Go](https://img.shields.io/badge/Go-1.22-00ADD8?style=for-the-badge\&logo=go)
![Gin](https://img.shields.io/badge/Gin-Web_Framework-00ADD8?style=for-the-badge)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)](LICENSE)

---

## Backend API

This application is designed to work with a Golang REST API backend for data management, authentication, and database operations.

To connect this frontend application to the backend service, please refer to the following repository:

Backend API Repository:
https://github.com/EbenEzerManurung/API_GOLANG

The Golang API provides database connectivity, authentication services, customer management, product management, transaction processing, and other business-related operations required by the Ritel Laravel application.

## 📋 Overview

**Laravel Ritel** is a full-stack **Progressive Web Application (PWA)** built with **Laravel 13.9.0** and **Tailwind CSS**, **Go (Gin Framework)**, **MySQL**,designed as a comprehensive retail management solution for small and medium-sized businesses.

The system streamlines daily operations by centralizing customer management, product inventory, transaction processing, sales reporting, and role-based access control into a single, intuitive platform. With **offline-first capabilities** and **mobile-installable functionality**, it delivers a native app experience directly through the browser.

---

# 🏗 Project Architecture

```text
                 Progressive Web App (PWA)
                               │
                        Laravel 13 Frontend
                               │
                     RESTful API (JSON over HTTP)
                               │
                  Go Backend (Gin Framework)
                               │
                            GORM ORM
                               │
                             MySQL
```

---

## 🎯 Objectives

| Objective | Description |
|-----------|-------------|
| **Operational Efficiency** | Simplify and accelerate daily retail workflows |
| **Transaction Accuracy** | Automate calculations and stock validation to reduce human error |
| **Data Centralization** | Unify customer, product, and sales data in one secure system |
| **Access Control** | Implement role-based authentication (Admin / Cashier) |
| **Cross-Platform** | Support desktop, tablet, and mobile devices seamlessly |
| **Offline Resilience** | Enable offline usage through Service Worker caching |
| **Modern Architecture** | Demonstrate best practices in Laravel 13 + Tailwind CSS development |

---

## 🧱 Technology Stack

### Backend
| Technology | Version | Purpose |
|------------|---------|---------|
| **Go (Gin Framework)** |
| **MySQL** | 8.0+ |



### Frontend
| Technology | Version | Purpose |
|------------|---------|---------|
| **Tailwind CSS** | 4.x | Utility-first CSS Framework – Responsive UI |
| **Blade Templates** | – | Laravel's Templating Engine |
| **Alpine.js** | – | Lightweight JavaScript Framework for Interactivity |
| **Heroicons** | – | SVG Icon Library |
| **SweetAlert2** | – | Beautiful Alert & Modal Dialogs |

### Progressive Web App (PWA)
| Feature | Implementation |
|---------|----------------|
| **Service Workers** | Background caching for offline support |
| **Web App Manifest** | `manifest.json` – Installable on Desktop & Mobile |
| **Offline Mode** | Cached assets and API fallback strategies |
| **App Icon** | Custom "R" branding icon |

### Data Export
| Format | Library |
|--------|---------|
| **Excel (.xlsx)** | Maatwebsite Laravel Excel |

---

## ✨ Features

### 🔐 Multi-Role Authentication
- Secure Login / Logout
- Role-Based Route Protection (Middleware)
- Session Management
- Two User Roles:
  - **Admin** – Full system access
  - **Cashier** – Limited to transaction and customer operations

### 📊 Dashboard
Real-time business intelligence at a glance:
- Total Customers
- Total Products
- Total Transactions
- Total Revenue

### 👥 Customer Management
| Feature | Description |
|---------|-------------|
| CRUD Operations | Create, Read, Update, Delete |
| Search | By Name, Customer Code, or Phone Number |
| Pagination | 10 records per page |
| Export | Export customer list to Excel |
| Validation | Server-side and client-side validation |
| Soft Delete | Mark as inactive without permanent removal |

### 📦 Product Management
| Feature | Description |
|---------|-------------|
| CRUD Operations | Create, Read, Update, Delete |
| Search | By Product Name, Code, or Category |
| Pricing Types | Regular (R), Special Weekday (SW), Discount (D) |
| Discount Rates | 0%, 25%, 35% respectively |
| Export | Export product list to Excel |

### 🛒 Transaction Management
- Select Customer (existing or new)
- Add Multiple Products to Cart
- Adjust Quantities in Real-Time
- Automatic Price & Total Calculation
- Stock Validation (prevents overselling)
- Multiple Payment Methods:
  - 💵 Cash
  - 📱 QRIS
  - 🏦 Bank Transfer
- Generate Transaction Receipt

### 📜 Transaction History
- View All Transaction Records
- Search Transactions
- Pagination Support
- Export to Excel

### 📱 Progressive Web App (PWA)
- Installable on **Desktop** (Chrome, Edge)
- Installable on **Mobile** (Android, iOS via Safari)
- Offline Support with Service Workers
- Fast Loading with Caching Strategies
- Custom "R" Application Icon
- Native App-like Experience

### 🎨 Modern UI/UX
- Fully Responsive Design (Mobile-First)
- Tailwind CSS Utility Styling
- Loading Spinners
- SweetAlert2 Notifications
- Heroicons
- Gradient Design Elements
- Smooth Transitions & Animations

---

## 🗂️ Application Architecture

The application follows a **modular MVC (Model-View-Controller)** architecture with clear separation of concerns between presentation, business logic, and data.

### Steps

Clone the repository
   ```bash
   git clone https://github.com/EbenEzerManurung/Church_schedulesystemMisa_Paroki_LaravelPWA.git
   cd Church_schedulesystemMisa_Paroki_LaravelPWA

   Navigate to the project directory:

```bash
cd Church_schedulesystemMisa_Paroki_LaravelPWA
```

Restore dependencies:

```bash
composer install
```
```bash
cp .env.example .env
php artisan key:generate
```
Migrate and Seeder:

```bash
php artisan migrate --seed
```

Run the application:
```bash
 npm install
```
```bash
npm run dev
```

```bash
php artisan ser
or by port
php artisan ser --port=9000
```

## Screenshots

Add screenshots of:

* Login Page
* Dashboard
* Customer Management
* Product Management
* Transaction Page
* Transaction History

# Screenshots

# \# Lighthouse:
<img width="894" height="199" alt="image" src="https://github.com/user-attachments/assets/8cbf36d6-a1f9-484a-a412-7d287f1e9fde" />

# \# Dashboard:
<img width="1912" height="871" alt="image" src="https://github.com/user-attachments/assets/3897ac4e-7c11-414c-9b31-e19a90e2a8a1" />

<img width="1876" height="841" alt="image" src="https://github.com/user-attachments/assets/f289f1da-c46b-4945-ab10-5f52beabf144" />

# \# Customer
<img width="1918" height="903" alt="image" src="https://github.com/user-attachments/assets/b21f4021-d8e3-45e6-92ce-598e2e906843" />

# \# Produk
<img width="1914" height="924" alt="image" src="https://github.com/user-attachments/assets/cc169e41-b3a2-46a4-89c1-306db770fa8f" />

# \# Transaksi
<img width="1912" height="933" alt="image" src="https://github.com/user-attachments/assets/832a6fa3-b689-4af6-aa12-cee06514c9b5" />

# \# Riwayat Transaksi (Transaction history)
<img width="1909" height="939" alt="image" src="https://github.com/user-attachments/assets/96dbc1f1-7ab7-439d-b913-b44d1f69c780" />

# License

MIT License

---

# Author

**Eben Nezer Manurung**




