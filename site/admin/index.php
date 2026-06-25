<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/db.php';

if (isset($_SESSION[ADMIN_SESSION_KEY]) && $_SESSION[ADMIN_SESSION_KEY] === ADMIN_SESSION_VALUE) {
    header('Location: /admin/dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (ADMIN_PASSWORD_HASH === 'REPLACE_WITH_HASH_AT_BUILD_TIME') {
        $error = 'Admin password has not been set up yet. See config.php.';
    } elseif (password_verify($password, ADMIN_PASSWORD_HASH)) {
        session_regenerate_id(true);
        $_SESSION[ADMIN_SESSION_KEY] = ADMIN_SESSION_VALUE;
        header('Location: /admin/dashboard.php');
        exit;
    } else {
        $error = 'Incorrect password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin — My Nest Chapter</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
    font-family: Arial, sans-serif;
    background: #252535;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.login-card {
    background: #FFF8EE;
    width: 100%;
    max-width: 380px;
    padding: 48px 40px;
}
.brand-label {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 10px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #E87AAA;
    margin-bottom: 8px;
}
.login-title {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 26px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #252535;
    margin-bottom: 32px;
}
.form-label {
    display: block;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #252535;
    margin-bottom: 6px;
}
.form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid #e0ddd8;
    background: #ffffff;
    font-family: Arial, sans-serif;
    font-size: 15px;
    color: #252535;
    margin-bottom: 20px;
}
.form-control:focus { outline: none; border-color: #8BA7D4; }
.btn-login {
    width: 100%;
    padding: 14px;
    background: #E87AAA;
    color: #ffffff;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 2px;
    border: none;
    cursor: pointer;
}
.btn-login:hover { background: #d96899; }
.error-msg {
    background: #fde8e8;
    border-left: 4px solid #c0392b;
    color: #c0392b;
    padding: 10px 14px;
    font-size: 13px;
    margin-bottom: 16px;
}
</style>
</head>
<body>
<div class="login-card">
    <p class="brand-label">My Nest Chapter</p>
    <h1 class="login-title">Admin Panel</h1>
    <?php if ($error): ?>
        <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="/admin/">
        <label class="form-label" for="password">Password</label>
        <input
            class="form-control"
            type="password"
            id="password"
            name="password"
            autofocus
            autocomplete="current-password"
        >
        <button type="submit" class="btn-login">Sign In</button>
    </form>
</div>
</body>
</html>
