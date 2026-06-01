# Laravel 13.9.0 Ritel

A modern retail management system built with Laravel 13.9.0 and Vite, designed to help businesses manage customers, products, and sales transactions efficiently through a responsive and user-friendly interface.

## Backend API

This application is designed to work with a Golang REST API backend for data management, authentication, and database operations.

To connect this frontend application to the backend service, please refer to the following repository:

Backend API Repository:
https://github.com/EbenEzerManurung/API_GOLANG

The Golang API provides database connectivity, authentication services, customer management, product management, transaction processing, and other business-related operations required by the Laravel 13.9.0 Ritel application.

![Laravel](https://img.shields.io/badge/Laravel 13.9.0-blue)
![Vite](https://img.shields.io/badge/Vite-Latest-purple)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-38BDF8)
![PWA](https://img.shields.io/badge/PWA-Enabled-green)
![License](https://img.shields.io/badge/License-MIT-yellow)

---

## Project Overview

Laravel 13.9.0 Ritel is a Progressive Web Application (PWA) that provides a complete retail management solution for small and medium-sized businesses. The application offers customer management, product inventory management, transaction processing, reporting, and role-based authentication.

The project aims to demonstrate modern frontend development practices using Laravel 13.9.0, Vite, Tailwind CSS, and Progressive Web App technologies while delivering practical business functionality.

---

## Objectives

The main goals of Laravel 13.9.0 Ritel are:

* Simplify daily retail operations.
* Improve transaction efficiency.
* Provide secure role-based access.
* Support mobile and desktop devices.
* Deliver a fast and responsive user experience.
* Demonstrate modern Laravel 13.9.0 application architecture.
* Enable offline-capable Progressive Web App functionality.

---

## Technology Stack

### Frontend

* Laravel 13.9.0
* Vite
* Laravel 13.9.0 Router
* Tailwind CSS
* Heroicons
* SweetAlert2

### Progressive Web App

* Service Workers
* Manifest.json
* Offline Support
* Installable Application

### Data Export

* XLSX Excel Export

---

## Features

### Multi-Role Authentication

Supports two user roles:

* Admin
* Cashier

Features:

* Secure Login
* Role-Based Route Protection
* Session Management
* Protected Pages

---

### Dashboard

Real-time business statistics:

* Total Customers
* Total Products
* Total Transactions
* Total Revenue

---

### Customer Management (Admin & Cashier)

Features:

* Create Customer
* View Customer
* Update Customer
* Delete Customer
* Customer Search
* Pagination (10 records per page)
* Export to Excel
* Form Validation
* Soft Delete (Inactive Customer)

Search by:

* Customer Name
* Customer Code
* Phone Number

---

### Features:

* Create Product
* View Product
* Update Product
* Delete Product
* Product Search
* Pagination
* Export to Excel

Pricing Types:

| Code | Type            | Discount |
| ---- | --------------- | -------- |
| R    | Regular         | 0%       |
| SW   | Special Weekday | 25%      |
| D    | Discount        | 35%      |

---

### Transaction Management

Available for Admin and Cashier.

Features:

* Select Customer
* Add Multiple Products
* Shopping Cart
* Quantity Update
* Remove Products
* Automatic Total Calculation
* Stock Validation
* Multiple Payment Methods

Payment Methods:

* Cash
* QRIS
* Bank Transfer

---

### Transaction History

Features:

* View Transaction Records
* Search Transactions
* Pagination
* Export to Excel

---

### Progressive Web App (PWA)

Features:

* Installable on Desktop
* Installable on Mobile Devices
* Offline Support
* Service Workers
* Manifest Configuration
* Custom "R" Application Icon

---

### Modern UI/UX

Features:

* Responsive Design
* Mobile Friendly
* Tailwind CSS Styling
* Loading Spinner
* SweetAlert2 Notifications
* Heroicons
* Modern Gradient Design

---

## Application Modules

```text
Authentication
├── Admin
└── Cashier


Progressive Web App
```

---

## Installation

Clone the repository:

```bash
git clone https://github.com/EbenEzerManurung/Laravel 13.9.0-ritel.git
```

Navigate to the project directory:

```bash
cd Laravel 13.9.0-ritel
```

Install dependencies:

```bash
composer install
```

```bash
npm install
```

Run development server:

```bash
php artisan service
```
Or 
```bash
php artisan ser --port=3000
```

---

## Screenshots

Add screenshots of:

* Login Page
* Dashboard
* Customer Management
* Product Management
* Transaction Page
* Transaction History

screenshots:
# \# Lighthouse

# <img width="832" height="229" alt="image" src="https://github.com/user-attachments/assets/669d9bae-4d1e-4687-a7d2-b16d8fcb419c" />


# \# Dashboard

# <img width="1918" height="891" alt="image" src="https://github.com/user-attachments/assets/90ff8dae-2210-4e0e-a7e1-ad1eeb1ee25b" />

<img width="1918" height="931" alt="image" src="https://github.com/user-attachments/assets/86bbaecb-e4b5-4721-bbe4-300fe2b9ba50" />

# \# Customer
<img width="1876" height="939" alt="image" src="https://github.com/user-attachments/assets/6d43a2c1-6732-4e62-b827-7014648b6cf1" />

# \# Produk
<img width="1912" height="925" alt="image" src="https://github.com/user-attachments/assets/1b2fb797-63b3-4993-91bd-1803729152ea" />

# \# Transaksi
<img width="1876" height="943" alt="image" src="https://github.com/user-attachments/assets/2b03c657-3ecf-4f0e-83a3-042865b50a2c" />


# \# Riwayat Transaksi (Transaction history)
<img width="1909" height="955" alt="image" src="https://github.com/user-attachments/assets/88bbee33-b1e4-4aa1-9040-aacbf5a84f4a" />


```



