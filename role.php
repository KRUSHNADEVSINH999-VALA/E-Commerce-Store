<?php
include('db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="bg-float">
    <div class="bubble b1">
        <svg viewBox="0 0 24 24">
            <path d="M12 3l7 4v5c0 5-3.5 9-7 10-3.5-1-7-5-7-10V7z"/>
            <path d="M9.5 12.5l2 2 4-4"/>
        </svg>
    </div>
    <div class="bubble b2">
        <svg viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4"/>
            <path d="M4 20c0-4 4-6 8-6s8 2 8 6"/>
        </svg>
    </div>
    <div class="bubble b3">
        <svg viewBox="0 0 24 24">
            <circle cx="12" cy="7" r="3"/>
            <path d="M5 20c0-3.5 3-5 7-5s7 1.5 7 5"/>
            <path d="M16 3l2 2-2 2-2-2z"/>
        </svg>
    </div>
</div>

<section class="choice-container">
    <h1>Select Your Access</h1>
    <div class="choice-grid">
        <!-- ADMIN -->
        <a href="admin/admin-login.php" class="card">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 3l7 4v5c0 5-3.5 9-7 10-3.5-1-7-5-7-10V7z"/>
                </svg>
            </div>
            <h2>Admin</h2>
            <p>Manage products, users and analytics</p>
        </a>

        <!-- USER -->
        <a href="Auth.php" class="card">
            <div class="icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6"/>
                </svg>
            </div>
            <h2>User</h2>
            <p>Browse and explore the store experience</p>
        </a>
    </div>
</section>

</body>
</html>
