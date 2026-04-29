<?php
include('../db.php');
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Auth.php");
    exit();
}

// Handle Add Product
if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $query = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";
    mysqli_query($conn, $query);
}

// Handle Update Product
if (isset($_POST['update_product'])) {
    $id = $_POST['product_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $query = "UPDATE products SET name='$name', price='$price', image='$image' WHERE id='$id'";
    mysqli_query($conn, $query);
}

// Handle Delete Product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id='$id'");
    header("Location: products.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <style>
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); }
        .modal-content { background: white; margin: 10% auto; padding: 20px; width: 400px; border-radius: 15px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; }
        .submit-btn { background: #1a1a1a; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="sidebar-logo">VELOUR</div>
    <a href="admin.php">Dashboard</a>
    <a href="products.php" class="active">Products</a>
    <a href="orders.php">Orders</a>
    <a href="users.php">Users</a>
    <div class="sidebar-footer"><a href="../logout.php" class="logout-btn">Logout</a></div>
</div>
<div class="main">
    <div class="topbar"><h1>Products Management</h1></div>
    <div class="table-section">
        <button class="add-btn" onclick="openModal('addModal')">+ Add Product</button>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM products");
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>₹<?php echo number_format($row['price']); ?></td>
                    <td><img src="../<?php echo $row['image']; ?>" width="50"></td>
                    <td>
                        <button class="edit" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($row)); ?>)">Edit</button>
                        <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete product?')"><button class="delete">Delete</button></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<div id="addModal" class="modal">
    <div class="modal-content">
        <h3>Add New Product</h3>
        <form method="POST">
            <div class="form-group"><label>Name</label><input type="text" name="name" required></div>
            <div class="form-group"><label>Price</label><input type="number" name="price" required></div>
            <div class="form-group"><label>Image Path</label><input type="text" name="image" placeholder="image/product.jpeg" required></div>
            <button type="submit" name="add_product" class="submit-btn">Add</button>
            <button type="button" onclick="closeModal('addModal')">Cancel</button>
        </form>
    </div>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <h3>Edit Product</h3>
        <form method="POST">
            <input type="hidden" name="product_id" id="edit_id">
            <div class="form-group"><label>Name</label><input type="text" name="name" id="edit_name" required></div>
            <div class="form-group"><label>Price</label><input type="number" name="price" id="edit_price" required></div>
            <div class="form-group"><label>Image Path</label><input type="text" name="image" id="edit_image" required></div>
            <button type="submit" name="update_product" class="submit-btn">Update</button>
            <button type="button" onclick="closeModal('editModal')">Cancel</button>
        </form>
    </div>
</div>

<script>
    function openModal(id) { document.getElementById(id).style.display = 'block'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }
    function openEditModal(product) {
        document.getElementById('edit_id').value = product.id;
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_price').value = product.price;
        document.getElementById('edit_image').value = product.image;
        openModal('editModal');
    }
</script>
</body>
</html>
