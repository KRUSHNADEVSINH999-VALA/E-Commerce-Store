-- Create Database
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(100),
    stock INT DEFAULT 10,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10, 2),
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Order Items
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Sample Data (Based on index.html)
INSERT INTO products (name, price, image) VALUES
('Wireless Headphones', 2999, 'image/wireless-headphone.jpeg'),
('Smart Watch', 4499, 'image/smart-watch.jpeg'),
('Bluetooth Speaker', 1999, 'image/bluetooth-speaker.jpeg'),
('Gaming Mouse', 1299, 'image/gaming-mouse.jpeg'),
('Mechanical Keyboard', 3499, 'image/mechanical-keyboard.jpeg'),
('LED Monitor', 9999, 'image/led-monitor.jpeg'),
('Iphone 15', 45999, 'image/iphn15.jpeg'),
('Iphone 15 Pro', 60999, 'image/iphn15pro.jpeg'),
('Samsung Galaxy S24', 100000, 'image/s24.jpeg'),
('Samsung Galaxy S24 Ultra', 120000, 'image/s24ultra.jpeg'),
('AC', 80000, 'image/ac.jpeg'),
('Buds', 999, 'image/buds.jpeg'),
('Ceiling Fan', 1899, 'image/c-fan.jpeg'),
('Ceiling Light', 599, 'image/c-light.jpeg'),
('Camera Drone', 8000, 'image/drone.jpeg'),
('DSLR Camera', 20000, 'image/DSLR.jpeg'),
('Fridge', 65000, 'image/fridge.jpeg'),
('Laptop', 99999, 'image/laptop.jpeg'),
('Mixer', 899, 'image/mixer.jpeg'),
('LED Tv', 23599, 'image/led-tv.jpeg'),
('Powerbank', 1000, 'image/powerbank.jpeg'),
('PS 5 Console', 100000, 'image/ps5.jpeg'),
('Waching Machine', 49999, 'image/washing machine.jpeg'),
('Wifi Router', 3999, 'image/wifi.jpeg'),
('Wireless CCTV Camera', 1599, 'image/wireless-cctv.jpeg');

-- Sample Admin User (password: admin123)
INSERT INTO users (fullname, email, password, role) VALUES
('Admin User', 'admin@gmail.com', '$2y$10$8Wk8fE2s2q.f4Y7nJk.pUeWz9Z0zX.ZqQ.R0k5Y8k5y8k5y8k5y8k', 'admin');
