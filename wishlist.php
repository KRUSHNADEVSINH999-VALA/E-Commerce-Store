<?php
include('db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - VELOUR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #f8f9fa; }
        .wishlist-section { min-height: 80vh; padding: 100px 20px 60px; max-width: 1200px; margin: auto; }
        .wishlist-header { text-align: center; margin-bottom: 50px; }
        .wishlist-header h2 { font-size: 2.5rem; color: #1a1a1a; letter-spacing: 2px; }
        .empty-message { text-align: center; padding: 50px; background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px; }
        .product-card { background: white; border-radius: 20px; padding: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.3s; position: relative; }
        .product-card:hover { transform: translateY(-10px); }
        .product-card img { width: 100%; height: 200px; object-fit: cover; border-radius: 15px; margin-bottom: 15px; }
        .product-card h3 { font-size: 1.1rem; margin-bottom: 10px; color: #1a1a1a; }
        .price { color: #d4af37; font-weight: 600; font-size: 1.2rem; margin-bottom: 15px; }
        .card-actions { display: flex; flex-direction: column; gap: 10px; }
        .add-to-cart-btn { background: #1a1a1a; color: white; border: none; padding: 10px; border-radius: 25px; cursor: pointer; transition: 0.3s; font-weight: 600; }
        .add-to-cart-btn:hover { background: #d4af37; }
        .remove-wish-btn { background: #ff4d4d; color: white; border: none; padding: 10px; border-radius: 25px; cursor: pointer; transition: 0.3s; font-weight: 600; }
        .remove-wish-btn:hover { background: #cc0000; }
    </style>
</head>
<body>
    <div class="bg-floating">
        <img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png" class="bg-icon b1">
        <img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" class="bg-icon b2">
        <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" class="bg-icon b3">
        <img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" class="bg-icon b4">
    </div>

    <header>
        <nav>
            <div class="header-name">VELOUR</div>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="all_products.php">Items</a>
                <a href="wishlist.php" class="active">WishList</a>
                <a href="cart.php" class="cart-icon">
                    <span class="cart-emoji">🛒</span>
                    <span class="badge" id="cart-count">0</span>
                </a>
                <div class="user-menu">
                    <span class="user-emoji">👤</span>
                    <div class="dropdown">
                        <?php if(isset($_SESSION['user_id'])): ?>
                            
                            <a href="orders.php">My Orders</a>
                            <a href="wishlist.php">Wishlist</a>
                            <?php if($_SESSION['role'] == 'admin'): ?>
                                
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

    <section class="wishlist-section">
        <div class="wishlist-header">
            <h2>My Wishlist</h2>
        </div>
        <div class="product-grid" id="wishlist-grid">
            <!-- Wishlist items will be loaded here -->
        </div>
    </section>

    <footer class="footer">
        <!-- 🎯 CANVAS FOR PHYSICS ICONS -->
        <canvas id="footerCanvas"></canvas>

        <div class="footer-container">
            <!-- Logo / About -->
            <div class="footer-section">
                <h3>E-Commerce</h3>
                <p>Premium electronic products with best quality and deals.</p>
            </div>

            <!-- Quick Links -->
            <div class="footer-section">
                <h4>Quick Links</h4>
                <a href="index.php">Home</a>
                <a href="all_products.php">Items</a>
                <a href="wishlist.php">Wishlist</a>
            </div>

            <!-- Support -->
            <div class="footer-section">
                <h4>Support</h4>
                <a href="helpcenter.php">Help Center</a>
                <a href="privacypolicy.php">Privacy Policy</a>
                <a href="termscondition.php">Terms & Conditions</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 E-Commerce. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            document.getElementById("cart-count").innerText = cart.length;
        }

        function loadWishlist() {
            let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
            const grid = document.getElementById("wishlist-grid");

            if (wishlist.length === 0) {
                grid.innerHTML = '<div class="empty-message"><p>Your wishlist is empty.</p><a href="all_products.php" style="color:#d4af37; font-weight:600; text-decoration:none;">Go Shopping</a></div>';
                grid.style.display = 'block';
                return;
            }

            grid.style.display = 'grid';
            grid.innerHTML = "";
            wishlist.forEach((item, index) => {
                const card = document.createElement("div");
                card.className = "product-card";
                card.innerHTML = `
                    <img src="${item.image}" alt="${item.name}">
                    <h3>${item.name}</h3>
                    <p class="price">₹${item.price.toLocaleString()}</p>
                    <div class="card-actions">
                        <button class="add-to-cart-btn" onclick="addToCart('${item.id}', '${item.name}', ${item.price})">Add to Cart</button>
                        <button class="remove-wish-btn" onclick="removeFromWishlist(${index})">Remove</button>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        function addToCart(id, name, price) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.push({ id, name, price });
            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartCount();
            alert(name + " added to cart!");
        }

        function removeFromWishlist(index) {
            let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
            wishlist.splice(index, 1);
            localStorage.setItem("wishlist", JSON.stringify(wishlist));
            loadWishlist();
        }

        updateCartCount();
        loadWishlist();

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
                b.x += b.dx;
                b.y += b.dy;
                if (b.x <= 0 || b.x + b.size >= canvas.width) b.dx *= -1;
                if (b.y <= 0 || b.y + b.size >= canvas.height) b.dy *= -1;
                ctx.drawImage(b.img, b.x, b.y, b.size, b.size);
            });
            requestAnimationFrame(animate);
        }
        animate();
    </script>
</body>
</html>
