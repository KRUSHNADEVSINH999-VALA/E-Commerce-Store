<?php
include('db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #f5f5f5; }
        .help-container { max-width: 1000px; margin: 60px auto; padding: 20px; }
        .help-container h1 { text-align: center; margin-bottom: 40px; color: #1a1a1a; }
        .help-box { background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(15px); padding: 25px; border-radius: 12px; margin-bottom: 25px; border: 1px solid rgba(0,0,0,0.1); transition: 0.3s; }
        .help-box:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .help-box h2 { color: #d4af37; margin-bottom: 15px; }
        .help-box ul { padding-left: 20px; }
        .help-box li { margin-bottom: 10px; color: #333; }
        .help-box p { color: #333; margin: 8px 0; }
    </style>
</head>
<body>
<div class="bg-floating">
    <img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png" class="bg-icon b1">
    <img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" class="bg-icon b2">
    <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" class="bg-icon b3">
    <img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" class="bg-icon b4">
    <img src="https://cdn-icons-png.flaticon.com/512/3144/3144456.png" class="bg-icon b5">
    <img src="https://cdn-icons-png.flaticon.com/512/2331/2331966.png" class="bg-icon b6">
</div>
<header>
    <nav>
        <div class="header-name">VELOUR</div>
        <div class="search-box">
            <form action="product.php" method="GET">
                <input type="text" name="search" placeholder="Search products...">
            </form>
        </div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="product.php">Items</a>
            <a href="wishlist.php">WishList</a>
            <a href="cart.php" class="cart-icon">
                🛒 <span class="badge" id="cart-count">0</span>
            </a>
            <div class="user-menu">
                <span class="user-emoji">👤</span>
                <div class="dropdown">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <p style="padding: 10px; color: white;">Hi, <?php echo $_SESSION['user_name']; ?></p>
                        <a href="orders.php">My Orders</a>
                        <a href="wishlist.php">Wishlist</a>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                            <a href="admin/admin.php">Admin Panel</a>
                        <?php endif; ?>
                        <div class="divider"></div>
                        <a href="logout.php" class="logout-link">Logout</a>
                    <?php else: ?>
                        <a href="Auth.php">Login / Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="help-container">
    <h1>Help Center</h1>
    <div class="help-box">
        <h2>Common Questions</h2>
        <ul>
            <li>How to place an order?</li>
            <li>How to track my order?</li>
            <li>How to request a refund?</li>
            <li>How to cancel an order?</li>
            <li>How to update my profile details?</li>
        </ul>
    </div>
    <div class="help-box">
        <h2>Contact Support</h2>
        <p>Email: kgvala101@gmail.com</p>
        <p>Phone: +91 6354418815</p>
        <p>Email: rudradevsinhsolanki@gmail.com</p>
        <p>Phone: +91 9601012222</p>
        <p>Support Hours: 9 AM – 9 PM (All Days)</p>
    </div>
    <div class="help-box">
        <h2>Shipping & Delivery</h2>
        <p>We provide fast and reliable delivery across India. Orders are typically delivered within 3–7 business days.</p>
    </div>
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
