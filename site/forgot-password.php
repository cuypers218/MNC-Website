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
                
                $resetLink = SITE_URL . '/reset-password?token=' . $token;

                $subject = 'Reset your My Nest Chapter password';
                $body = '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;padding:0;background:#FAFAFA;font-family:Arial,sans-serif;">
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#FAFAFA;padding:40px 20px;">
  <tr><td align="center">
    <table cellpadding="0" cellspacing="0" border="0" width="560" style="max-width:560px;width:100%;background:#ffffff;border:1px solid #D3D3D3;">

      <!-- Header -->
      <tr>
        <td style="background:#252535;padding:28px 40px 24px;text-align:left;">
          <p style="margin:0 0 2px;font-family:Arial,sans-serif;font-size:9px;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:#8BA7D4;">MY NEST CHAPTER</p>
          <p style="margin:0;font-family:Arial,sans-serif;font-size:22px;font-weight:700;color:#C44570;letter-spacing:1px;">Reset your password</p>
        </td>
      </tr>

      <!-- Body -->
      <tr>
        <td style="padding:36px 40px 0;">
          <p style="margin:0 0 8px;font-family:Arial,sans-serif;font-size:18px;font-weight:700;color:#252535;">Hey ' . htmlspecialchars($user['first_name']) . ',</p>
          <p style="margin:0 0 28px;font-family:Arial,sans-serif;font-size:15px;color:#5A5A72;line-height:1.7;">We got a request to reset your password. This link expires in 1 hour. If you didn\'t ask for this, you can ignore this email.</p>

          <!-- CTA -->
          <table cellpadding="0" cellspacing="0" border="0" style="margin:8px 0 32px;">
            <tr>
              <td style="background:#C44570;padding:0;">
                <a href="' . $resetLink . '" style="display:inline-block;padding:14px 32px;font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#252535;text-decoration:none;">Set New Password</a>
              </td>
            </tr>
          </table>

          <p style="margin:0 0 36px;font-family:Arial,sans-serif;font-size:13px;color:#5A5A72;line-height:1.7;">If the button doesn\'t work, copy this link into your browser:<br><a href="' . $resetLink . '" style="color:#C44570;">' . $resetLink . '</a></p>
        </td>
      </tr>

      <!-- Footer -->
      <tr>
        <td style="padding:20px 40px 28px;border-top:1px solid #D3D3D3;">
          <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#ABABAB;">My Nest Chapter &nbsp;&middot;&nbsp; mynestchapter.com<br>You\'re receiving this because a password reset was requested for this email.</p>
        </td>
      </tr>

    </table>
  </td></tr>
</table>
</body></html>';

                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                $headers .= 'From: My Nest Chapter <hello@mynestchapter.com>' . "\r\n";
                $headers .= 'Reply-To: hello@mynestchapter.com' . "\r\n";

                if (mail($email, $subject, $body, $headers)) {
                    error_log('Password reset email sent: ' . $email);
                } else {
                    error_log('Password reset email FAILED to send: ' . $email . ' link: ' . $resetLink);
                }
            }
        }
    }
}
?>

<section class="section">
    <div class="form-page">
        <h1 class="text-center" style="margin-bottom: 0.5rem;">Reset Password</h1>
        <p class="text-center" style="color: #8BA7D4; font-size: 0.9rem; margin-bottom: 2rem;">Enter your email and I'll send you a link to reset your password.</p>
        
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
