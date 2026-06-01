<?php
$pageTitle = 'Create Account';
$pageDescription = 'Create your My Nest Chapter account to access your tools and purchases.';
require_once __DIR__ . '/includes/header.php';

// If already logged in, go to dashboard
if (isLoggedIn()) {
    header('Location: /dashboard');
    exit;
}

$error = '';
$success = '';

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrf()) {
        $error = 'Something went wrong. Please try again.';
    } else {
        $firstName = trim($_POST['first_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        // Validation
        if (empty($firstName) || empty($email) || empty($password)) {
            $error = 'Please fill in all fields.';
        } elseif (strlen($firstName) > 100) {
            $error = 'First name is too long.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
        } elseif (strlen($password) < 8) {
            $error = 'Password must be at least 8 characters.';
        } elseif ($password !== $confirmPassword) {
            $error = 'Passwords don\'t match.';
        } else {
            $db = getDB();
            
            // Check if email already exists
            $stmt = $db->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $error = 'An account with that email already exists. <a href="/login">Log in instead?</a>';
            } else {
                // Create account
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $db->prepare('INSERT INTO users (first_name, email, password_hash) VALUES (?, ?, ?)');
                $stmt->execute([$firstName, $email, $hash]);
                
                $userId = $db->lastInsertId();
                
                // Auto-login
                loginUser($userId, $firstName);
                
                // Redirect to dashboard
                header('Location: /dashboard?welcome=1');
                exit;
            }
        }
    }
}
?>

<section class="section">
    <div class="form-page">
        <h1 class="text-center" style="margin-bottom: 0.5rem;">Create Your Account</h1>
        <p class="text-center" style="color: #666666; font-size: 0.9rem; margin-bottom: 2rem;">Your tools and purchases will live here.</p>
        
        <?php if ($error): ?>
            <div class="form-error"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="POST" action="/register">
            <?= csrfField() ?>
            
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="Your first name" required value="<?= esc($_POST['first_name'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@email.com" required value="<?= esc($_POST['email'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="At least 8 characters" required minlength="8">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Type it again" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-full" style="margin-top: 0.5rem;">Create Account</button>
        </form>
        
        <p class="form-link">Already have an account? <a href="/login">Log in</a></p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
