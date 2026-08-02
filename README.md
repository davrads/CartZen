# 🛒 CartZen - Multi-Vendor E-Commerce Platform

CartZen is a modern **multi-vendor e-commerce platform** built with **Laravel 12** that enables multiple vendors to sell products through a centralized online marketplace. The platform provides dedicated dashboards and role-based functionalities for **Customers**, **Vendors**, and **Administrators**, ensuring secure and efficient marketplace management.


## 📖 Project Overview

CartZen was developed as a team-based internship project following the **Laravel MVC Architecture**. It offers a complete shopping ecosystem where customers can browse products, vendors can manage their online stores, and administrators can oversee the entire marketplace from a centralized dashboard.


## 🎯 Project Objectives

- Develop a scalable multi-vendor marketplace.
- Provide separate dashboards for Customers, Vendors, and Administrators.
- Implement secure role-based authentication and authorization.
- Deliver a responsive and user-friendly shopping experience.
- Enable efficient product, inventory, and order management.
- Integrate secure online payment using Khalti.
- Build a maintainable application using Laravel MVC architecture.


# ✨ Core Features

## 👤 Authentication & User Management

- Google Authentication
- Secure Login & Registration
- Role-Based Access Control (Admin, Vendor, Customer)
- Customer Profile Management
- Vendor Profile Management
- Address Management


## 🏪 Vendor Management

- Vendor Registration
- Vendor Verification & Approval
- Store Profile Management
- Vendor Dashboard
- Product Management
- Product Variant Management
- Product Image Management
- Inventory Management
- Order Management


## 🛍️ Shopping Experience

- Browse Products
- Search Products
- Category Browsing
- Vendor Store Pages
- Product Detail Page
- Shopping Cart
- Wishlist
- Checkout Process
- Khalti Payment Integration
- Cash on Delivery (COD)
- Order Tracking
- Product Reviews & Ratings


## 📦 Product Management

- Category Management
- Product CRUD Operations
- Product Images
- Product Variants
- Inventory Stock Tracking
- Flash Sale Management


## ⚙️ Administration

- Dashboard Overview
- User Management
- Vendor Approval & Management
- Category Management
- Product Monitoring
- Flash Sale Management
- Order Management
- Review Management


# 👥 User Roles

## Administrator

- Verify Vendors
- Manage Vendors
- Manage Categories
- Manage Products
- Manage Flash Sales
- Manage Orders
- Manage Reviews
- Monitor Platform Activities


## Vendor

- Manage Store Profile
- Manage Products
- Manage Product Variants
- Manage Product Images
- Manage Inventory
- Process Customer Orders
- View Dashboard


## Customer

- Register/Login
- Browse Products
- Search Products
- Manage Wishlist
- Manage Shopping Cart
- Checkout Products 
- Make Payments
- Track Orders
- Submit Reviews & Ratings


# 🛠️ Technology Stack

## Backend

- PHP 8.2
- Laravel 12
- Laravel Eloquent ORM

## Frontend

- Laravel Blade
- Tailwind CSS
- HTML
- JavaScript

## Admin & Vendor Panel

- Filament

## Database

- MySQL

## Payment Gateway

- Khalti Payment Gateway

## Development Tools

- Git & GitHub
- Composer
- npm
- Visual Studio Code


# 🏗️ System Architecture

The application follows the **Laravel MVC (Model–View–Controller)** architecture.

```
Customer / Vendor / Admin
            │
            ▼
Laravel Blade (Presentation Layer)
            │
            ▼
Laravel Routes
            │
            ▼
Controllers
            │
            ▼
Business Logic & Middleware
            │
            ▼
Eloquent Models
            │
            ▼
MySQL Database
            │
            ▼
External Services
(Khalti Payment Gateway)


# 🗄️ Database Modules

The system consists of the following major modules:

- Users
- Customer Profiles
- Vendor Profiles
- Categories
- Products
- Product Images
- Product Variants
- Flash Sales
- Shopping Cart
- Cart Items
- Orders
- Order Items
- Reviews
- Addresses


# 🔒 Security Features

- Role-Based Access Control
- Secure Authentication
- Password Hashing
- CSRF Protection
- Route Middleware Protection
- Vendor Verification Workflow
- Input Validation
- Session Management
- Database Integrity using Foreign Keys
- Secure Khalti Payment Integration


# 📱 Responsive Design

The application is fully responsive and optimized for:

- Desktop
- Tablet
- Mobile Devices


# 🚀 Future Enhancements

The following features are planned for future releases:

- Sales Analytics Dashboard
- Inventory Analytics
- Vendor Performance Reports
- Enhanced Reviews & Ratings
- Email Notifications
- SMS Notifications
- Mobile Application
- Advanced Reporting
- Additional Payment Gateways


# 📚 Development Methodology

The project was developed using the **Agile Software Development Methodology**, allowing iterative development, continuous testing, and regular feature enhancements throughout the internship period.


# 📌 Expected Outcome

CartZen provides a complete and scalable multi-vendor marketplace where:

- Customers can conveniently discover and purchase products.
- Vendors can efficiently manage their online stores.
- Administrators can effectively monitor and control marketplace operations.

The platform demonstrates modern web development practices using Laravel and serves as a strong foundation for future expansion.


## 👨‍💻 Development Team

Developed as an internship project by a collaborative development team using Git for version control and Agile development practices.


## 📄 License

This project was developed for educational and internship purposes.