# Ritel Laravel 

A modern retail management system built with Laravel 13.9.0, designed to help businesses manage customers, products, and sales transactions efficiently through a responsive and user-friendly interface.

## Backend API

This application is designed to work with a Golang REST API backend for data management, authentication, and database operations.

To connect this frontend application to the backend service, please refer to the following repository:

Backend API Repository:
https://github.com/EbenEzerManurung/API_GOLANG

The Golang API provides database connectivity, authentication services, customer management, product management, transaction processing, and other business-related operations required by the Laravel 13.9.0 Ritel application.

![Laravel](https://img.shields.io/badge/Laravel 13.9.0-blue)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-38BDF8)
![PWA](https://img.shields.io/badge/PWA-Enabled-green)
![License](https://img.shields.io/badge/License-MIT-yellow)

---

## Project Overview

Laravel 13.9.0 Ritel is a Progressive Web Application (PWA) that provides a complete retail management solution for small and medium-sized businesses. The application offers customer management, product inventory management, transaction processing, reporting, and role-based authentication.

The project aims to demonstrate modern frontend development practices using Laravel 13.9.0,Tailwind CSS, and Progressive Web App technologies while delivering practical business functionality.

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

# <img width="894" height="199" alt="image" src="https://github.com/user-attachments/assets/6760ec51-1787-402f-99d8-b91ffb9b5cf1" />

# \# Dashboard

# <img width="1912" height="871" alt="image" src="https://github.com/user-attachments/assets/bc5cc015-2f88-4dee-ae11-a490ddf68095" />

<img width="1876" height="841" alt="image" src="https://github.com/user-attachments/assets/b989ce19-f76e-447c-b213-24aca57ae4da" />


# \# Customer
<img width="1918" height="903" alt="image" src="https://github.com/user-attachments/assets/2ce0fd44-96c3-46d8-b163-35c4f9d2fb49" />


# \# Produk
<img width="1914" height="924" alt="image" src="https://github.com/user-attachments/assets/f652c7f4-94eb-47bc-9455-2ff59894966e" />


# \# Transaksi
<img width="1912" height="933" alt="image" src="https://github.com/user-attachments/assets/c6dcb513-eac2-49bc-b074-faa1c34c3f23" />


# \# Riwayat Transaksi (Transaction history)
<img width="1909" height="939" alt="image" src="https://github.com/user-attachments/assets/ced84e81-9601-4239-b20b-70cbb5b20968" />



```



