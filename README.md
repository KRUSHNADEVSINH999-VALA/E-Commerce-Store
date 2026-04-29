# VELOUR E-Commerce Mini Website

A dynamic, database-driven E-Commerce platform built using PHP and MySQL. This project covers core web development concepts including CRUD operations, session management, and relational database integration.

---

## 🚀 Project Overview

VELOUR is a premium electronic products store where users can browse featured items, manage a shopping cart, and maintain a wishlist. Admins have a dedicated dashboard to manage the product inventory, track orders, and view registered users.

---

## 📂 Database Structure

The project uses a MySQL database named `ecommerce_db` with the following key tables:

- **users**: Stores user credentials, contact info, and roles (`admin`, `user`)
- **products**: Contains details like name, price, image paths, and stock levels
- **orders**: Tracks customer purchases, total amounts, and order status
- **order_items**: Links products to specific orders for detailed tracking

---

## ✨ Features Implemented

### For Users:

- **Authentication**: Secure Login and Registration system with session persistence  
- **Dynamic Browsing**: Real-time product search and category listing directly from the database  
- **Shopping Cart**: Client-side cart using `localStorage` for immediate feedback, synced with the database on checkout  
- **Wishlist**: Personal wishlist for saving favorite items  
- **Interactive UI**: Physics-based animated footer and sleek glass-morphism design  

---

### For Admins (CRUD):

- **Dashboard**: High-level overview of site activity  

#### Product Management:
- **Create**: Add new electronic items with custom pricing and images  
- **Read**: View existing inventory with live data  
- **Update**: Edit product details instantly  
- **Delete**: Remove outdated or out-of-stock products  

- **Order Tracking**: Manage and review customer orders  

---

## 🔐 Session Management

The project uses PHP sessions to manage:

- User authentication (login/logout)  
- Admin access control  
- Cart data handling during user interaction  

---

## 📸 Project Screenshots

---

### 🔹 Landing Page

![Landing Page 1](lp1.png)

<br>

![Landing Page 2](lp2.png)

<br><br>

---

### 🔹 Role Selection

![Role Selection](r.png)

<br><br>

---

## 🔐 Admin Panel

### Authentication

![Admin Login](aa.png)

<br>

### Dashboard

![Admin Dashboard](ad.png)

<br>

### Product Management

![Product Management](apm.png)

<br>

### Orders Management

![Orders Management](aom.png)

<br>

### Users Management

![Users Management](aum.png)

<br><br>

---

## 👤 User Panel

### Authentication

![User Login](ul.png)

<br>

![User Signup](us.png)

<br>

### Home Page

![Home Page](uh.png)

<br>

![Home Page](uh2.png)

<br>

### Items Page

![Items Page](ui.png)

<br>

### Wishlist

![Wishlist](uw.png)

<br>

### Product Details

![Product Details](upd.png)

<br>

### Shopping Cart

![Cart](usc.png)

<br>

### Order Confirmation

![Order Confirmation](upc.png)

<br>

### Help Center

![Help Center](hc.png)

<br>

### Privacy Policy

![Privacy Policy](pp.png)

<br>

### Terms & Conditions

![Terms](tc.png)

<br><br>

---

## 🛢️ Database (phpMyAdmin)

![Database Structure](db.png)

---

## 🛠️ Steps to Run Locally

1. **Environment Setup**: Install XAMPP or WAMP server  

2. **Database Import**:
   - Open PHPMyAdmin and create a database named `ecommerce_db`  
   - Import the `database_fixed.sql` file provided in the repository  

3. **Configuration**:
   - Place the project folder in the `htdocs` directory of your XAMPP installation  
   - Ensure the `db.php` file has the correct database credentials (host, user, password, dbname)  

4. **Accessing the Site**:
   - Open your browser and go to `http://localhost/ecommerce/index.php`  
   - Use the **Admin Panel** link (if logged in as admin) to manage products  

---

## 🎓 Academic Context

This project was developed as part of an Activity Learning Assignment, demonstrating practical exposure to:

- PHP/MySQL integration  
- Session-based access control  
- Responsive UI/UX design  
- Database-driven dynamic content

---

## 👥 Team Members

| Name | Enrollment No | Role |
|------|-------------|------|
| KRUSHNADEVSINH G. VALA | 240905090058 | Backend Development, Database Design, UI,  Frontend Connectivity, Debugging, Responsive - Grid Line CSS  |
| RUDRADEVSINH S. SOLANKI | 240905090047 | Frontend Design, UX, Product Finding, Price maker, Theme Oriented, Research |

---

---

## 🙌 Acknowledgment

Thank you for exploring our E-Commerce Mini Website project. This work reflects our practical understanding of full-stack development using PHP and MySQL.

---
