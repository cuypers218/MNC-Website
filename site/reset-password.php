<?php
$pageTitle = 'Set New Password';
$pageDescription = 'Set a new password for your My Nest Chapter account.';
require_once __DIR__ . '/includes/header.php';

$token = $_GET['token'] ?? '';
$error = '';
$success = '';
$validToken = false;
$userId = null;

// Validate token
if ($token) {
    $db = getDB();
    $stmt = $db->prepare('SELECT user_id, expires_at, used FROM download_tokens WHERE token = ? AND product_id = 0');
    $stmt->execute([$token]);
    $record = $stmt->fetch();
    
    if ($record && !$record['used'] && strtotime($record['expires_at']) > time()) {
        $validToken = true;
        $userId = $record['user_id'];
    } else {
        $error = 'This reset link has expired or already been used. Please request a new one.';
    }
}

// Handle new password submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $validToken) {
    if (!validateCsrf()) {
        $error = 'Something went wrong. Please try again.';
    } else {
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        if (strlen($password) < 8) {
            $error = 'Password must be at least 8 characters.';
        } elseif ($password !== $confirmPassword) {
            $error = 'Passwords don\'t match.';
        } else {
            $db = getDB();
            $hash = password_hash($password, PASSWORD_BCRYPT);
            
            // Update password
            $stmt = $db->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
            $stmt->execute([$hash, $userId]);
            
            // Mark token as used
            $stmt = $db->prepare('UPDATE download_tokens SET used = 1 WHERE token = ?');
            $stmt->execute([$token]);
            
            $success = 'Password updated. You can now log in with your new password.';
            $validToken = false; // Hide the form
        }
    }
}
?>

<section class="section">
    <div class="form-page">
        <h1 class="text-center" style="margin-bottom: 2rem;">Set New Password</h1>
        
        <?php if ($success): ?>
            <div class="form-success"><?= esc($success) ?></div>
            <p class="form-link" style="margin-top: 1rem;"><a href="/login" class="btn btn-primary btn-full">Log In</a></p>
        <?php elseif ($error): ?>
            <div class="form-error"><?= $error ?></div>
            <p class="form-link" style="margin-top: 1rem;"><a href="/forgot-password">Request a new reset link</a></p>
        <?php elseif ($validToken): ?>
            <form method="POST">
                <?= csrfField() ?>
                
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" placeholder="At least 8 characters" required minlength="8">
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Type it again" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-full">Set New Password</button>
            </form>
        <?php else: ?>
            <div class="form-error">Invalid reset link. Please request a new one.</div>
            <p class="form-link" style="margin-top: 1rem;"><a href="/forgot-password">Request a new reset link</a></p>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
