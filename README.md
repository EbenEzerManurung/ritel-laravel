# ⛪️ Church Schedule System - Misa Paroki

[![Laravel](https://img.shields.io/badge/Laravel-13.9.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-38BDF8?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Chart.js](https://img.shields.io/badge/Chart.js-4.x-FF6384?style=for-the-badge&logo=chart.js&logoColor=white)](https://www.chartjs.org/)
[![PWA](https://img.shields.io/badge/PWA-Enabled-5A0FC8?style=for-the-badge&logo=pwa&logoColor=white)](https://web.dev/progressive-web-apps/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)](LICENSE)

---

## 📋 Overview

**Church Schedule System - Misa Paroki** is a web-based Progressive Web Application (PWA) built with **Laravel 13.9.0** and **Tailwind CSS**, designed to manage worship schedules, duty assignments, and service personnel coordination for parish churches.

The system enables super administrators, diocese administrators, church administrators, and regular users to efficiently organize liturgical services, track assignments, and monitor service participation across multiple parishes.

---

## 🎯 Objectives

| Objective | Description |
|-----------|-------------|
| **Efficient Scheduling** | Simplify the creation and management of worship schedules |
| **Service Assignment** | Assign duties to church members for each Mass/service |
| **Real-time Status Tracking** | Monitor assignment status: pending, accepted, rejected, completed |
| **Role-based Access** | Different permissions for Super Admin, Diocese Admin, Church Admin, PIC, and Regular User |
| **Data Visualization** | Charts and statistics for monitoring workload and participation |
| **Upcoming Reminders** | Display assignments within the next 12 days |
| **Offline Ready** | PWA support for offline access via service workers |
| **Cross-platform** | Responsive design for desktop, tablet, and mobile devices |

---

## 🧱 Technology Stack

### Backend
| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 13.9.0 | PHP Framework – MVC Architecture, Routing, ORM, Authentication |
| **MySQL** | 8.0+ | Relational Database |
| **Eloquent ORM** | – | Database interaction using Active Record pattern |

### Frontend
| Technology | Version | Purpose |
|------------|---------|---------|
| **Tailwind CSS** | 4.x | Utility-first CSS framework |
| **Blade Templates** | – | Laravel's templating engine |
| **Alpine.js** | – | Lightweight JavaScript for interactivity |
| **Chart.js** | 4.x | Data visualization (bar, doughnut, line charts) |
| **Heroicons** | – | SVG icon library |
| **SweetAlert2** | – | Beautiful alerts and modal dialogs |

### Progressive Web App (PWA)
| Feature | Implementation |
|---------|----------------|
| **Service Workers** | Background caching for offline support |
| **Web App Manifest** | `manifest.json` – Installable on desktop & mobile |
| **Offline Mode** | Cached assets and fallback strategies |
| **App Icon** | Custom "Church" branding icon |

### Data Export
| Format | Library |
|--------|---------|
| **Excel (.xlsx)** | Maatwebsite Laravel Excel |

---

## ✨ Features

### 🔐 Multi-Role Authentication
- Secure Login / Logout
- Role-based route protection (Middleware)
- Session management
- Five user roles with specific permissions:

| Role | Access Level |
|------|--------------|
| **Super Admin** | Full system access – manages dioceses, churches, users, schedules, duties |
| **Diocese Admin** | Manages churches within their diocese |
| **Church Admin** | Manages schedules, duties, and assignments for a specific church |
| **PIC (Coordinator)** | Views and responds to assignments (e.g., choir, lectors) |
| **Regular User** | Views and accepts/rejects own assignments |

### 📊 Dashboard
- **Greeting** – Personalized welcome with user name and role
- **Key Statistics** (Super Admin):
  - Total Dioceses
  - Total Churches
  - Total Users
  - Total Schedules
- **Assignment Statistics**:
  - Pending
  - Accepted
  - Rejected
  - Completed (including accepted past events)
- **Interactive Charts**:
  - Assignment Statistics (bar chart)
  - Status Distribution (doughnut chart)
  - Assignments per Church (line chart)
- **Real-time Clock** – Current date and time display

### 📅 Worship Schedule Management
- View all worship schedules (e.g., Sunday Mass, Weekday Mass)
- Schedule name, description, and active status
- Display in compact list on dashboard

### 📋 Duty Assignment Management
- **For Regular Users & PICs**:
  - View personal assignments
  - Display upcoming assignments (max 12 days ahead)
  - Status: Pending / Accepted
  - Clear indicators for "Today" and "Tomorrow"
- **For Admins (Super, Diocese, Church)**:
  - View all assignments grouped by duty type
  - Show assigned personnel for each duty
  - Display nearest schedule per person
  - Filter assignments within 12 days

### 🏛️ Church & Diocese Management
- **Super Admin**: Create, update, delete dioceses and churches
- **Diocese Admin**: Manage churches within their diocese
- **Church Admin**: Manage schedules and assignments for their church
- List churches with staff and schedule counts

### 📈 Statistics & Charts
- **Growth indicators** – Month-over-month growth for key metrics
- **Status percentages** – Visual distribution of assignments
- **Church trends** – Assignment activity per church (monthly)

### 📱 Progressive Web App (PWA)
- Installable on **Desktop** (Chrome, Edge)
- Installable on **Mobile** (Android, iOS via Safari)
- **Offline Support** with Service Workers
- Fast loading with caching strategies
- Custom application icon
- Native app-like experience

### 🎨 Modern UI/UX
- Fully responsive design (mobile-first)
- Tailwind CSS utility styling
- Loading spinners
- SweetAlert2 notifications
- Heroicons
- Gradient design elements
- Smooth transitions and animations
- "Today" / "Tomorrow" indicators on assignments

---

## 🗂️ Application Architecture

The application follows a **modular MVC architecture** with clear separation of concerns.
Church Schedule System - Misa Paroki
│
├── 📁 Presentation Layer (Frontend)
│ ├── Blade Templates (.blade.php)
│ │ ├── layouts/
│ │ │ └── app.blade.php (Main layout)
│ │ ├── dashboard/
│ │ │ └── index.blade.php
│ │ ├── assignments/
│ │ │ ├── index.blade.php
│ │ │ └── show.blade.php
│ │ ├── schedules/
│ │ │ ├── index.blade.php
│ │ │ └── create.blade.php
│ │ ├── churches/
│ │ │ └── index.blade.php
│ │ └── users/
│ │ └── index.blade.php
│ ├── Tailwind CSS (styles/app.css)
│ ├── Alpine.js (interactivity)
│ ├── Chart.js (visualization)
│ └── PWA Assets
│ ├── manifest.json
│ ├── service-worker.js
│ └── icons/
│
├── 📁 Application Layer (Backend - Laravel)
│ ├── Controllers (app/Http/Controllers/)
│ │ ├── Admin/
│ │ │ ├── DashboardController.php
│ │ │ ├── DioceseController.php
│ │ │ ├── ChurchController.php
│ │ │ └── UserController.php
│ │ ├── AssignmentController.php
│ │ ├── ScheduleController.php
│ │ ├── DutyController.php
│ │ └── Auth/
│ │ └── LoginController.php
│ ├── Models (app/Models/)
│ │ ├── User.php (Eloquent Model)
│ │ ├── Diocese.php
│ │ ├── Church.php
│ │ ├── Schedule.php
│ │ ├── Duty.php
│ │ ├── DutyAssignment.php
│ │ └── Role.php
│ ├── Middleware (app/Http/Middleware/)
│ │ ├── Authenticate.php
│ │ ├── IsAdmin.php
│ │ ├── IsDioceseAdmin.php
│ │ └── IsChurchAdmin.php
│ ├── Routes (routes/)
│ │ ├── web.php (Main routes)
│ │ └── api.php (API routes)
│ ├── Policies (app/Policies/)
│ │ ├── ChurchPolicy.php
│ │ └── AssignmentPolicy.php
│ ├── Requests (app/Http/Requests/)
│ │ ├── StoreAssignmentRequest.php
│ │ └── UpdateAssignmentRequest.php
│ └── Exceptions (app/Exceptions/)
│
├── 📁 Data Layer
│ ├── Migrations (database/migrations/)
│ │ ├── create_users_table.php
│ │ ├── create_dioceses_table.php
│ │ ├── create_churches_table.php
│ │ ├── create_schedules_table.php
│ │ ├── create_duties_table.php
│ │ └── create_duty_assignments_table.php
│ ├── Seeders (database/seeders/)
│ │ ├── DatabaseSeeder.php
│ │ ├── RoleSeeder.php
│ │ ├── UserSeeder.php
│ │ └── DioceseSeeder.php
│ └── Factories (database/factories/)
│ ├── ChurchFactory.php
│ └── AssignmentFactory.php
│
└── 📁 Database
└── MySQL 8.0+
├── users
├── dioceses
├── churches
├── schedules
├── duties
└── duty_assignments

text

### 🔄 Data Flow
User Request → Routes (web.php)

Middleware → Route Protection

Controller → Business Logic

Model → Database Interaction (Eloquent ORM)

Response → View (Blade) + Data

Frontend → Chart.js / Alpine.js for interactivity

PWA → Service Worker caching for offline mode

text

### 🧑‍💻 Role-Based Access Control (RBAC)

| Action | Super Admin | Diocese Admin | Church Admin | PIC | Regular User |
|--------|-------------|---------------|--------------|-----|--------------|
| View Dashboard | ✅ | ✅ | ✅ | ✅ | ✅ |
| Manage Dioceses | ✅ | ❌ | ❌ | ❌ | ❌ |
| Manage Churches | ✅ | ✅ (within diocese) | ❌ | ❌ | ❌ |
| Manage Schedules | ✅ | ✅ (within diocese) | ✅ (own church) | ❌ | ❌ |
| Manage Duties | ✅ | ✅ (within diocese) | ✅ (own church) | ❌ | ❌ |
| Assign Duties | ✅ | ✅ (within diocese) | ✅ (own church) | ❌ | ❌ |
| View Assignments | ✅ (all) | ✅ (diocese) | ✅ (own church) | ✅ (own) | ✅ (own) |
| Accept/Reject Assignments | ✅ | ✅ | ✅ | ✅ | ✅ |
| View Statistics | ✅ | ✅ (diocese) | ✅ (own church) | ❌ | ❌ |
| Export Data | ✅ | ✅ | ✅ | ❌ | ❌ |

---

## 📦 Installation

1. **Clone the repository**
```bash
git clone https://github.com/your-username/church-schedule-system.git
cd church-schedule-system
Install dependencies

bash
composer install
npm install && npm run build
Environment setup

bash
cp .env.example .env
php artisan key:generate
Configure database connection in .env file:

text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=church_schedule
DB_USERNAME=root
DB_PASSWORD=
Run migrations & seeders

bash
php artisan migrate --seed
Start the development server

bash
php artisan serve
Access the application at http://localhost:8000

Build frontend assets (development)

bash
npm run dev
Build frontend assets (production)

bash
npm run build
🔧 Testing Credentials (Seeder)
Role	Email	Password	Description
Super Admin	admin@church.com	password123	Full system access, manages dioceses, churches, users, and all assignments
Diocese Admin	admin.bogor@keuskupan.com	password123	Manages churches within the Bogor diocese
Church Admin	admin.bogor@gereja.com	password123	Manages schedules, duties, and assignments for a specific church
PIC Choir Coordinator	samuel.koor@group.com	password123	Can view and respond to choir-related assignments
Regular User	ebenmanurung@gmail.com	password123	Standard user – views and accepts/rejects own assignments
📸 Screenshots
Dashboard
