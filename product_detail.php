<?php
include('db.php');
session_start();

$product = null;
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
}

if(!$product) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - VELOUR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { color: black; }
        .header-name { color: black !important; }
        .nav-links a { color: black !important; }
        .product-detail { display: flex; padding: 50px; gap: 50px; max-width: 1200px; margin: 60px auto; color: black; }
        .product-detail img { width: 500px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .detail-info { flex: 1; }
        .detail-info h1 { font-size: 3rem; margin-bottom: 20px; color: black; }
        .detail-info .price { font-size: 2rem; color: black; margin-bottom: 20px; }
        .detail-info .description { margin-bottom: 30px; line-height: 1.6; opacity: 0.8; color: black; }
        .action-btns { display: flex; gap: 20px; }
        .detail-btn { padding: 15px 30px; border-radius: 30px; border: none; font-size: 1.1rem; cursor: pointer; transition: 0.3s; }
        .btn-cart { background: #d4af37; color: #000; }
        .btn-wish { background: transparent; border: 2px solid #ccc; color: #ccc; }
        .detail-btn:hover { transform: scale(1.05); }
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
            <a href="cart.php">🛒 <span class="badge" id="cart-count">0</span></a>
        </div>
    </nav>
</header>

<section class="product-detail">
    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <div class="detail-info">
        <h1><?php echo $product['name']; ?></h1>
        <p class="price">₹<?php echo number_format($product['price']); ?></p>
        <p class="description">
            Experience the next level of technology with the <?php echo $product['name']; ?>. 
            Crafted for performance and designed for elegance, it's the perfect addition to your digital collection.
        </p>
        <div class="action-btns">
            <button class="detail-btn btn-cart" onclick="addToCart()">Add to Cart</button>
            <button id="wishlist-detail-heart" class="detail-btn btn-wish" 
                    onclick="toggleWishlist()" 
                    style="background: transparent; border: none; font-size: 2rem; color: #ccc;">❤</button>
        </div>
    </div>
</section>

<script>
    function updateCartCount() {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        document.getElementById("cart-count").innerText = cart.length;
    }
    updateCartCount();

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

    function addToCart() {
        const id = '<?php echo $product['id']; ?>';
        const name = '<?php echo $product['name']; ?>';
        const price = <?php echo $product['price']; ?>;
        const image = '<?php echo $product['image']; ?>';
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart.push({ id, name, price, image });
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartCount();
        alert(name + " added to cart!");
    }

    const heart = document.getElementById('wishlist-detail-heart');
    const productId = '<?php echo $product['id']; ?>';

    // Initial check
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    if (wishlist.find(i => i.id === productId)) {
        heart.style.color = 'red';
    }

    function toggleWishlist() {
        const name = '<?php echo $product['name']; ?>';
        const price = <?php echo $product['price']; ?>;
        const image = '<?php echo $product['image']; ?>';
        
        let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
        const index = wishlist.findIndex(i => i.id === productId);
        
        if (index === -1) {
            wishlist.push({ id: productId, name, price, image });
            heart.style.color = 'red';
        } else {
            wishlist.splice(index, 1);
            heart.style.color = '#ccc';
        }
        localStorage.setItem("wishlist", JSON.stringify(wishlist));
    }
</script>
</body>
</html>
