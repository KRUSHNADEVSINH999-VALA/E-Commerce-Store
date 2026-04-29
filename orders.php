<?php
include('../db.php');
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Auth.php");
    exit();
}

// Update status
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id='$order_id'");
}

$query = "SELECT o.*, u.fullname FROM orders o JOIN users u ON o.user_id = u.id ORDER BY order_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="sidebar">
    <div class="sidebar-logo">VELOUR</div>
    <a href="admin.php">Dashboard</a>
    <a href="products.php">Products</a>
    <a href="orders.php" class="active">Orders</a>
    <a href="users.php">Users</a>
    <div class="sidebar-footer"><a href="../logout.php" class="logout-btn">Logout</a></div>
</div>
<div class="main">
    <div class="topbar"><h1>Orders Management</h1></div>
    <div class="table-section">
        <table>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td>₹<?php echo number_format($row['total_amount']); ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                            <select name="status" onchange="this.form.submit()">
                                <option value="pending" <?php echo $row['status']=='pending'?'selected':''; ?>>Pending</option>
                                <option value="completed" <?php echo $row['status']=='completed'?'selected':''; ?>>Completed</option>
                                <option value="cancelled" <?php echo $row['status']=='cancelled'?'selected':''; ?>>Cancelled</option>
                            </select>
                            <input type="hidden" name="update_status" value="1">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</body>
</html>
