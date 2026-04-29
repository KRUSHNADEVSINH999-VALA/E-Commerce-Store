<?php
include('db.php');
session_start();

if (isset($_POST['place_order'])) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Please login to place order']);
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $total = $_POST['total'];
    $items = json_decode($_POST['items'], true);

    $query = "INSERT INTO orders (user_id, total_amount, status) VALUES ('$user_id', '$total', 'pending')";
    if (mysqli_query($conn, $query)) {
        $order_id = mysqli_insert_id($conn);
        foreach ($items as $item) {
            $product_id = isset($item['id']) ? $item['id'] : 0;
            $price = $item['price'];
            $qty = 1;
            mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$qty', '$price')");
        }
        echo json_encode(['status' => 'success', 'message' => 'Order placed successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to place order']);
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - VELOUR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { background: #f8f9fa; }
        .cart-section { max-width: 1000px; margin: 80px auto; padding: 20px; }
        .cart-container { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .cart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        .cart-header h1 { font-size: 2rem; color: #1a1a1a; }
        .cart-item { display: grid; grid-template-columns: 2fr 1fr 1fr; align-items: center; padding: 20px 0; border-bottom: 1px solid #eee; }
        .item-info h3 { margin: 0; font-size: 1.1rem; color: #333; }
        .item-price { font-weight: 600; color: #d4af37; font-size: 1.1rem; }
        .remove-btn { background: #ff4d4d; color: white; border: none; padding: 8px 15px; border-radius: 10px; cursor: pointer; transition: 0.3s; width: fit-content; }
        .remove-btn:hover { background: #ff3333; transform: scale(1.05); }
        .cart-footer { margin-top: 40px; display: flex; flex-direction: column; align-items: flex-end; }
        .total-box { font-size: 1.5rem; margin-bottom: 20px; color: #1a1a1a; }
        .total-box span { font-weight: 600; color: #d4af37; }
        .checkout-btn { background: #1a1a1a; color: white; padding: 15px 50px; border: none; border-radius: 30px; font-size: 1.1rem; cursor: pointer; transition: 0.3s; font-weight: 600; letter-spacing: 1px; }
        .checkout-btn:hover { background: #d4af37; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2); }
        .empty-cart { text-align: center; padding: 50px 0; }
        .empty-cart p { font-size: 1.2rem; color: #666; margin-bottom: 20px; }
        .shop-link { color: #d4af37; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
<header>
    <nav>
        <div class="header-name">VELOUR</div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="all_products.php">Items</a>
            <a href="wishlist.php">WishList</a>
        </div>
    </nav>
</header>

<section class="cart-section">
    <div class="cart-container">
        <div class="cart-header">
            <h1>Shopping Cart</h1>
            <span id="item-count">0 Items</span>
        </div>

        <div class="cart-item">
            <div style="font-weight: 600;">Product</div>
            <div style="font-weight: 600; text-align: center;">Price</div>
            <div style="font-weight: 600; text-align: right;">Action</div>
        </div>
        <div id="cart-items-list">
            <!-- Items will be injected here -->
        </div>

        <div class="cart-footer" id="cart-footer" style="display: none;">
            <div class="total-box">Total Amount: <span>₹<span id="cart-total-amount">0</span></span></div>
            <button class="checkout-btn" onclick="placeOrder()">PLACE ORDER</button>
        </div>
        
        <div id="empty-cart-msg" class="empty-cart" style="display: none;">
            <p>Your cart is currently empty.</p>
            <a href="all_products.php" class="shop-link">Return to Shop</a>
        </div>
    </div>
</section>

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
            b.x += b.dx;
            b.y += b.dy;
            if (b.x <= 0 || b.x + b.size >= canvas.width) b.dx *= -1;
            if (b.y <= 0 || b.y + b.size >= canvas.height) b.dy *= -1;
            ctx.drawImage(b.img, b.x, b.y, b.size, b.size);
        });

        requestAnimationFrame(animate);
    }
    animate();

    function displayCart() {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let list = document.getElementById("cart-items-list");
        let footer = document.getElementById("cart-footer");
        let emptyMsg = document.getElementById("empty-cart-msg");
        let countSpan = document.getElementById("item-count");
        let total = 0;
        
        countSpan.innerText = `${cart.length} Items`;
        list.innerHTML = "";

        if (cart.length === 0) {
            footer.style.display = "none";
            emptyMsg.style.display = "block";
            return;
        }

        footer.style.display = "flex";
        emptyMsg.style.display = "none";

        cart.forEach((item, index) => {
            total += item.price;
            
            // Fix image path logic
            let imgPath = item.image;
            if (imgPath && !imgPath.startsWith('http') && !imgPath.startsWith('image/')) {
                imgPath = 'image/' + imgPath;
            }

            list.innerHTML += `
                <div class="cart-item">
                    <div class="item-info" style="display: flex; align-items: center; gap: 15px;">
                        <img src="${imgPath}" alt="${item.name}" 
                             onerror="this.src='https://cdn-icons-png.flaticon.com/512/1170/1170678.png'"
                             style="width: 70px; height: 70px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <div>
                            <h3 style="margin: 0; font-size: 1.1rem; color: #1a1a1a;">${item.name}</h3>
                            <p style="margin: 5px 0 0; color: #666; font-size: 0.9rem;">Premium Series</p>
                        </div>
                    </div>
                    <div class="item-price" style="text-align: center; font-size: 1.2rem;">₹${item.price.toLocaleString()}</div>
                    <div style="text-align: right;">
                        <button class="remove-btn" onclick="removeFromCart(${index})" 
                                style="background: #ff4d4d; color: white; border: none; padding: 10px 20px; border-radius: 20px; cursor: pointer; transition: 0.3s;">
                            Remove
                        </button>
                    </div>
                </div>
            `;
        });
        document.getElementById("cart-total-amount").innerText = total.toLocaleString();
    }

    function removeFromCart(index) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart.splice(index, 1);
        localStorage.setItem("cart", JSON.stringify(cart));
        displayCart();
    }

    function placeOrder() {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        if (cart.length === 0) { alert("Cart is empty!"); return; }

        let total = cart.reduce((sum, item) => sum + item.price, 0);
        let formData = new FormData();
        formData.append('place_order', true);
        formData.append('total', total);
        formData.append('items', JSON.stringify(cart));

        fetch('cart.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                localStorage.removeItem("cart");
                window.location.href = "index.php";
            } else {
                alert(data.message);
                if (data.message.includes("login")) window.location.href = "Auth.php";
            }
        });
    }
    displayCart();
</script>
</body>
</html>
