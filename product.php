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
    <title><?php echo $product['name']; ?> - Detail</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .product-detail { display: flex; padding: 50px; gap: 50px; max-width: 1200px; margin: auto; }
        .product-detail img { width: 500px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .detail-info { flex: 1; }
        .detail-info h1 { font-size: 3rem; margin-bottom: 20px; }
        .detail-info .price { font-size: 2rem; color: #d4af37; margin-bottom: 20px; }
        .detail-info .description { margin-bottom: 30px; line-height: 1.6; }
        .buy-now-btn { background: #1a1a1a; color: white; padding: 15px 30px; border: none; border-radius: 30px; font-size: 1.2rem; cursor: pointer; transition: 0.3s; }
        .buy-now-btn:hover { background: #d4af37; }
    </style>
</head>
<body>
<header>
    <nav>
        <div class="header-name">VELOUR</div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="product.php" class="active">Items</a>
            <a href="cart.php" class="cart-icon">🛒 <span class="badge" id="cart-count">0</span></a>
        </div>
    </nav>
</header>

<section class="product-detail">
    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <div class="detail-info">
        <h1><?php echo $product['name']; ?></h1>
        <p class="price">₹<?php echo number_format($product['price']); ?></p>
        <p class="description">High-quality <?php echo $product['name']; ?> designed for premium performance and durability. Perfect for modern lifestyle.</p>
        <button class="buy-now-btn" 
                onclick="addToCart('<?php echo $product['id']; ?>', '<?php echo $product['name']; ?>', <?php echo $product['price']; ?>)">
            Add to Cart
        </button>
    </div>
</section>

<script>
function addToCart(id, name, price) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    cart.push({ id, name, price });
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartCount();
    alert(name + " added to cart!");
}
function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    document.getElementById("cart-count").innerText = cart.length;
}
updateCartCount();
</script>
</body>
</html>
