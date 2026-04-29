<?php
include('db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - VELOUR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { color: black; }
        .header-name { color: black !important; }
        .nav-links a { color: black !important; }
        .content-section { max-width: 800px; margin: 60px auto; padding: 40px; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border-radius: 20px; color: black; line-height: 1.8; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .content-section h1 { color: #d4af37; margin-bottom: 20px; }
        .content-section h2 { color: #d4af37; margin-top: 30px; margin-bottom: 15px; font-size: 1.2rem; }
    </style>
</head>
<body>
<header>
    <nav>
        <div class="header-name">VELOUR</div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="product.php">Items</a>
            <a href="wishlist.php">WishList</a>
        </div>
    </nav>
</header>

<div class="content-section">
    <h1>Privacy Policy</h1>
    <p>Last updated: April 2026</p>
    
    <h2>1. Information We Collect</h2>
    <p>We collect information you provide directly to us, such as when you create an account, make a purchase, or contact our support team.</p>
    
    <h2>2. How We Use Your Information</h2>
    <p>We use the information we collect to process your orders, communicate with you about your account, and improve our services.</p>
    
    <h2>3. Information Sharing</h2>
    <p>We do not share your personal information with third parties except as necessary to fulfill your orders (e.g., with shipping carriers).</p>
    
    <h2>4. Data Security</h2>
    <p>We implement industry-standard security measures to protect your personal data from unauthorized access.</p>
</div>

<footer class="footer">
    <!-- 🎯 CANVAS FOR PHYSICS ICONS -->
<canvas id="footerCanvas"></canvas>

    <div class="footer-container">

        <!-- Logo / About -->
        <div class="footer-section">
            <h3>E-Commerce</h3>
            <p>Your trusted store for premium electronic products with best quality and deals.</p>
        </div>

        <!-- Quick Links -->
        <div class="footer-section">
            <h4>Quick Links</h4>
            <a href="index.php">Home</a>
            <a href="all_products.php">Items</a>
            <a href="logout.php">Log out</a>
        </div>

        <!-- Support -->
        <div class="footer-section">
            <h4>Support</h4>
            <a href="helpcenter.php">Help Center</a>
            <a href="privacypolicy.php">Privacy Policy</a>
            <a href="termscondition.php">Terms & Conditions</a>
        </div>

        <!-- Contact -->
        <div class="footer-section">
            <h4>Contact</h4>
            <p>Email: kgvala101@gmail.com | rudradevsinhsolanki@gmail.com</p>
            <p>Phone: +91 6354418815 | 9601012222</p>
        </div>

    </div>

    <!-- Bottom -->
    <div class="footer-bottom">
        <p>© 2026 E-Commerce. All rights reserved.</p>
    </div>

</footer>
<script id="v9l2ke">
const canvas = document.getElementById("footerCanvas");
const ctx = canvas.getContext("2d");

function resizeCanvas() {
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
}
resizeCanvas();
window.addEventListener("resize", resizeCanvas);

/* ICON IMAGES */
const icons = [
    "https://cdn-icons-png.flaticon.com/512/1170/1170678.png",
    "https://cdn-icons-png.flaticon.com/512/263/263142.png",
    "https://cdn-icons-png.flaticon.com/512/3081/3081559.png",
    "https://cdn-icons-png.flaticon.com/512/891/891462.png",
    "https://cdn-icons-png.flaticon.com/512/3144/3144456.png",
    "https://cdn-icons-png.flaticon.com/512/2331/2331966.png"
];

/* CREATE OBJECTS */
let balls = [];

icons.forEach((src) => {
    let img = new Image();
    img.src = src;

    balls.push({
        img: img,
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        dx: (Math.random() - 0.5) * 2,
        dy: (Math.random() - 0.5) * 2,
        size: 50
    });
});

/* ANIMATION LOOP */
function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    balls.forEach((b) => {

        // move
        b.x += b.dx;
        b.y += b.dy;

        // bounce (wall collision)
        if (b.x <= 0 || b.x + b.size >= canvas.width) {
            b.dx *= -1;
        }

        if (b.y <= 0 || b.y + b.size >= canvas.height) {
            b.dy *= -1;
        }

        // draw
        ctx.drawImage(b.img, b.x, b.y, b.size, b.size);
    });

    requestAnimationFrame(animate);
}

animate();
</script>
</body>
</html>
