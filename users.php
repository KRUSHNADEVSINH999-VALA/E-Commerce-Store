<?php
include('../db.php');
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Auth.php");
    exit();
}

// Handle role change or deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id='$id' AND role != 'admin'");
    header("Location: users.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="sidebar">
    <div class="sidebar-logo">VELOUR</div>
    <a href="admin.php">Dashboard</a>
    <a href="products.php">Products</a>
    <a href="orders.php">Orders</a>
    <a href="users.php" class="active">Users</a>
    <div class="sidebar-footer"><a href="../logout.php" class="logout-btn">Logout</a></div>
</div>
<div class="main">
    <div class="topbar"><h1>Users Management</h1></div>
    <div class="table-section">
        <table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM users");
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <?php if($row['role'] != 'admin'): ?>
                            <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete user?')"><button class="delete">Delete</button></a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
