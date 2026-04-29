<?php
include('../db.php');
session_start();

$error = "";

if (isset($_POST['admin_login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND role = 'admin'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Direct check for admin123 or hashed check for others
        if ($email === 'admin@gmail.com' && $password === 'admin123' || password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];
            header("Location: admin.php");
            exit();
        } else {
            $error = "Invalid admin password!";
        }
    } else {
        $error = "Admin account not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Premium Admin Login</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
body { height: 100vh; background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); display: flex; justify-content: center; align-items: center; position: relative; overflow: hidden; }
body::before { content: ""; position: absolute; width: 450px; height: 450px; background: radial-gradient(circle, #ff7a18, transparent); top: -120px; left: -120px; filter: blur(120px); }
body::after { content: ""; position: absolute; width: 450px; height: 450px; background: radial-gradient(circle, #00c6ff, transparent); bottom: -120px; right: -120px; filter: blur(120px); }
.container { position: relative; z-index: 10; width: 340px; padding: 30px; border-radius: 20px; background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(22px); border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 10px 40px rgba(0,0,0,0.5); text-align: center; color: white; }
h2 { margin-bottom: 20px; }
input { width: 100%; padding: 12px; margin: 10px 0; border-radius: 10px; border: none; outline: none; background: rgba(255,255,255,0.15); color: white; }
button { width: 100%; padding: 12px; margin-top: 10px; border: none; border-radius: 10px; background: linear-gradient(45deg, #ff7a18, #ff3d00); color: white; font-size: 16px; cursor: pointer; transition: 0.3s; }
button:hover { transform: scale(1.05); box-shadow: 0 0 15px #ff7a18; }
.alert { padding: 10px; margin-bottom: 10px; border-radius: 10px; background: #ffcccc; color: #cc0000; font-size: 0.9rem; }
.float { position: absolute; width: 65px; opacity: 0.75; animation: floatAnim 6s ease-in-out infinite; pointer-events: none; }
.f1 { top: 6%; left: 6%; animation-duration: 6s; }
.f2 { top: 10%; right: 8%; animation-duration: 7s; }
.f3 { bottom: 18%; left: 6%; animation-duration: 5s; }
.f4 { bottom: 10%; right: 6%; animation-duration: 8s; }
.f5 { top: 45%; left: 85%; animation-duration: 9s; }
.f6 { bottom: 35%; left: 45%; animation-duration: 6.5s; }
@keyframes floatAnim { 0% { transform: translateY(0); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0); } }
</style>
</head>
<body>
<img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png" class="float f1">
<img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" class="float f2">
<img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" class="float f3">
<img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" class="float f4">
<img src="https://cdn-icons-png.flaticon.com/512/3144/3144456.png" class="float f5">
<img src="https://cdn-icons-png.flaticon.com/512/2331/2331966.png" class="float f6">

<div class="container">
  <form method="POST">
    <h2>Admin Login</h2>
    <?php if ($error): ?>
        <div class="alert"><?php echo $error; ?></div>
    <?php endif; ?>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="admin_login">Login</button>
  </form>
  <p style="margin-top:15px;"><a href="../role.php" style="color:#ff7a18; text-decoration:none;">Back to Selection</a></p>
</div>
</body>
</html>
