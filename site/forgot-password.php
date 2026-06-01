<?php
$pageTitle = 'Reset Password';
$pageDescription = 'Reset your My Nest Chapter password.';
require_once __DIR__ . '/includes/header.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrf()) {
        $error = 'Something went wrong. Please try again.';
    } else {
        $email = trim($_POST['email'] ?? '');
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } else {
            // Always show success message (don't reveal if email exists or not)
            $message = 'If an account exists with that email, you\'ll receive a password reset link shortly.';
            
            // Check if user exists
            $db = getDB();
            $stmt = $db->prepare('SELECT id, first_name FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user) {
                // Generate reset token
                $token = bin2hex(random_bytes(32));
                $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
                
                // Store token (reuse download_tokens table with a special product_id of 0)
                $stmt = $db->prepare('INSERT INTO download_tokens (user_id, product_id, token, expires_at) VALUES (?, 0, ?, ?)');
                $stmt->execute([$user['id'], $token, $expires]);
                
                // TODO: Send email via Hostinger Reach with reset link
                // For now, log it (check Hostinger error logs)
                $resetLink = SITE_URL . '/reset-password?token=' . $token;
                error_log('PASSWORD RESET LINK for ' . $email . ': ' . $resetLink);
            }
        }
    }
}
?>

<section class="section">
    <div class="form-page">
        <h1 class="text-center" style="margin-bottom: 0.5rem;">Reset Password</h1>
        <p class="text-center" style="color: #666666; font-size: 0.9rem; margin-bottom: 2rem;">Enter your email and I'll send you a link to reset your password.</p>
        
        <?php if ($message): ?>
            <div class="form-success"><?= esc($message) ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="form-error"><?= esc($error) ?></div>
        <?php endif; ?>
        
        <?php if (!$message): ?>
        <form method="POST" action="/forgot-password">
            <?= csrfField() ?>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@email.com" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-full" style="margin-top: 0.5rem;">Send Reset Link</button>
        </form>
        <?php endif; ?>
        
        <p class="form-link"><a href="/login">Back to Log In</a></p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
