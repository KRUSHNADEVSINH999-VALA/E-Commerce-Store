<?php
include('db.php');
session_start();

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT * FROM products";
if ($search) {
    $query .= " WHERE name LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - VELOUR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { color: black; }
        .header-name { color: black !important; }
        .nav-links a { color: black !important; }
        .products h2 { color: black !important; }
        .product-card h3 { color: black !important; }
        .product-card .price { color: black !important; }
    </style>
</head>
<body>
<header>
    <nav>
        <div class="header-name">VELOUR</div>
        <div class="search-box">
            <form method="GET">
                <input type="text" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
            </form>
        </div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="all_products.php" class="active">Items</a>
            <a href="wishlist.php">WishList</a>
            <a href="cart.php" class="cart-icon" style="color: black;">🛒 <span class="badge" id="cart-count">0</span></a>
            <div class="user-menu">
                <span class="user-emoji">👤</span>
                <div class="dropdown">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        
                        <a href="orders.php" style="color: black;">My Orders</a>
                        <a href="wishlist.php" style="color: black;">Wishlist</a>
                        <?php if($_SESSION['role'] == 'admin'): ?>
                            
                        <?php endif; ?>
                        <div class="divider"></div>
                        <a href="logout.php" class="logout-link" style="color: black;">Logout</a>
                    <?php else: ?>
                        <a href="Auth.php" style="color: black;">Login / Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<section class="products">
    <h2><?php echo $search ? "Search Results for '$search'" : "All Products"; ?></h2>
    <div class="product-grid">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="product-card" style="position: relative;">
                    <div class="wishlist-heart" 
                         data-id="<?php echo $row['id']; ?>" 
                         data-name="<?php echo $row['name']; ?>" 
                         data-price="<?php echo $row['price']; ?>"
                         data-image="<?php echo $row['image']; ?>"
                         style="position: absolute; top: 15px; left: 15px; z-index: 10; cursor: pointer; font-size: 20px; color: #ccc; transition: 0.3s;">
                        ❤
                    </div>
                    <a href="product_detail.php?id=<?php echo $row['id']; ?>">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    </a>
                    <h3><?php echo $row['name']; ?></h3>
                    <div class="product-card-bottom">
                        <p class="price">₹<?php echo number_format($row['price']); ?></p>
                        <button class="add-to-cart-btn" 
                                data-id="<?php echo $row['id']; ?>" 
                                data-name="<?php echo $row['name']; ?>" 
                                data-price="<?php echo $row['price']; ?>"
                                data-image="<?php echo $row['image']; ?>">Add to Cart</button>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found matching your search.</p>
        <?php endif; ?>
    </div>
</section>

<script>
    function updateCartCount() {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        document.getElementById("cart-count").innerText = cart.length;
    }
    updateCartCount();

    // Wishlist Functionality
    document.querySelectorAll('.wishlist-heart').forEach(heart => {
        const id = heart.getAttribute('data-id');
        let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
        if (wishlist.find(i => i.id === id)) {
            heart.style.color = 'red';
        }

        heart.addEventListener('click', (e) => {
            e.preventDefault();
            const name = heart.getAttribute('data-name');
            const price = parseInt(heart.getAttribute('data-price'));
            const image = heart.getAttribute('data-image');
            
            let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
            const index = wishlist.findIndex(i => i.id === id);
            
            if (index === -1) {
                wishlist.push({ id, name, price, image });
                heart.style.color = 'red';
            } else {
                wishlist.splice(index, 1);
                heart.style.color = '#ccc';
            }
            localStorage.setItem("wishlist", JSON.stringify(wishlist));
        });
    });

    // Add to Cart Functionality
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const price = parseInt(button.getAttribute('data-price'));
            let image = button.getAttribute('data-image');
            
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.push({ id, name, price, image });
            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartCount();
            alert(name + " added to cart!");
        });
    });
</script>

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
