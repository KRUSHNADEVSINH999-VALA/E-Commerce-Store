<?php
include('db.php');
session_start();

$error = "";
$success = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}

if (isset($_POST['signup'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $error = "Email already exists!";
    } else {
        $query = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            $success = "Account created! Please login.";
        } else {
            $error = "Error creating account!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login / Register</title>
<style>
body {
    margin: 0;
    height: 100vh;
    font-family: "Poppins", sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #cfd9df, #e2ebf0);
}
.container {
    width: 420px;
    padding: 40px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.35);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
}
h2 {
    text-align: center;
    letter-spacing: 3px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 25px;
}
label {
    font-size: 14px;
    color: #555;
}
.input-box {
    margin: 15px 0;
}
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border: none;
    border-radius: 25px;
    background: rgba(255,255,255,0.8);
    outline: none;
}
.row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 10px 0 15px;
    font-size: 14px;
    color: #555;
}
button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 25px;
    background: #1a1a1a;
    color: white;
    font-weight: 500;
    letter-spacing: 2px;
    cursor: pointer;
    transition: 0.3s;
}
button:hover {
    background: #d4af37;
}
.switch {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}
.switch label {
    color: #1a1a1a;
    cursor: pointer;
    font-weight: 600;
}
#toggle {
    display: none;
}
#signup {
    display: <?php echo (isset($_POST['signup']) && !empty($error)) ? 'block' : 'none'; ?>;
}
#login {
    display: <?php echo (isset($_POST['signup']) && !empty($error)) ? 'none' : 'block'; ?>;
}
#toggle:checked ~ #login {
    display: none;
}
#toggle:checked ~ #signup {
    display: block;
}
.alert {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 10px;
    text-align: center;
}
.error { background: #ffcccc; color: #cc0000; }
.success { background: #ccffcc; color: #006600; }
.slider {
    width: 100%;
    overflow: hidden;
    color: rgb(8, 7, 7);
    padding: 10px 0;
}
.slider p {
    display: inline-block;
    white-space: nowrap;
    padding-left: 100%;
    animation: slide 12s linear infinite;
}
@keyframes slide {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}
</style>
</head>
<body>
<div class="container">
    <div class="slider">
        <p>🔥 Unlock Amazing Deals 🎯 | Fast & Secure Access 🔐 | Join Now & Experience Smart Shopping 🛒 | Your Tech World Starts Here ⚡</p>
    </div>

    <?php if ($error): ?>
        <div class="alert error"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert success"><?php echo $success; ?></div>
    <?php endif; ?>

    <input type="checkbox" id="toggle" <?php echo (isset($_POST['signup']) && !empty($error)) ? 'checked' : ''; ?>>

    <!-- LOGIN -->
    <div id="login">
        <h2>LOGIN</h2>
        <form method="POST">
            <div class="input-box">
                <label>Email address</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-box">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="row">
                <div>
                    <input type="checkbox"> Remember me
                </div>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" name="login">SIGN IN</button>
        </form>
        <div class="switch">
            Don’t have an account?
            <label for="toggle">Sign Up</label>
        </div>
    </div>

    <!-- SIGNUP -->
    <div id="signup">
        <h2>SIGN UP</h2>
        <form method="POST">
            <div class="input-box">
                <label>Full Name</label>
                <input type="text" name="fullname" required>
            </div>
            <div class="input-box">
                <label>Email address</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-box">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="signup">CREATE ACCOUNT</button>
        </form>
        <div class="switch">
            Already have an account?
            <label for="toggle">Login</label>
        </div>
    </div>
</div>
</body>
</html>
