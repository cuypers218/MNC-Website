<?php
$pageTitle = 'Log In';
$pageDescription = 'Log in to your My Nest Chapter account.';
require_once __DIR__ . '/includes/header.php';

// If already logged in, go to dashboard
if (isLoggedIn()) {
    header('Location: /dashboard');
    exit;
}

$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrf()) {
        $error = 'Something went wrong. Please try again.';
    } else {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $error = 'Please fill in both fields.';
        } else {
            $db = getDB();
            $stmt = $db->prepare('SELECT id, first_name, password_hash FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password_hash'])) {
                loginUser($user['id'], $user['first_name']);
                
                // Redirect to saved page or dashboard
                $redirect = $_SESSION['redirect_after_login'] ?? '/dashboard';
                unset($_SESSION['redirect_after_login']);
                header('Location: ' . $redirect);
                exit;
            } else {
                $error = 'Email or password is incorrect.';
            }
        }
    }
}
?>

<section class="section">
    <div class="form-page">
        <h1 class="text-center" style="margin-bottom: 2rem;">Log In</h1>
        
        <?php if ($error): ?>
            <div class="form-error"><?= esc($error) ?></div>
        <?php endif; ?>
        
        <form method="POST" action="/login">
            <?= csrfField() ?>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@email.com" required value="<?= esc($_POST['email'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-full" style="margin-top: 0.5rem;">Log In</button>
        </form>
        
        <p class="form-link">Don't have an account? <a href="/register">Create one</a></p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
