<?php
/**
 * THEMENGIFT Smart Tag System - Login & Registration
 */
if (!isset($pdo)) die('Direct access not permitted');

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Check credentials against the database (mocked logic for template)
    $stmt = $pdo->prepare("SELECT * FROM " . TAG_DB_PREFIX . "users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    // Secure password verification
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        
        // Redirect logic based on setup status
        if (empty($user['tag_setup_completed'])) {
            header('Location: /my-tag/setup');
        } else {
            header('Location: /my-tag/dashboard');
        }
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - THEMENGIFT Smart Tags</title>
    <style>
        :root { --primary: #1A365D; --secondary: #D4AF37; --bg: #F8FAFC; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; }
        h1 { color: var(--primary); margin-bottom: 30px; font-size: 1.5rem; }
        .input-group { margin-bottom: 20px; text-align: left; }
        label { display: block; margin-bottom: 8px; color: #4A5568; font-size: 0.9rem; }
        input[type="text"], input[type="password"] { width: 100%; padding: 12px; border: 1px solid #E2E8F0; border-radius: 8px; box-sizing: border-box; }
        .btn { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; transition: background 0.3s; margin-bottom: 15px; }
        .btn:hover { background: var(--secondary); color: var(--primary); font-weight: bold; }
        .btn-google { background: white; color: #4A5568; border: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-google:hover { background: #F7FAFC; }
        .error { color: #E53E3E; margin-bottom: 20px; font-size: 0.9rem; }
        .divider { margin: 20px 0; color: #A0AEC0; font-size: 0.9rem; position: relative; }
        .divider::before, .divider::after { content: ""; position: absolute; top: 50%; width: 40%; height: 1px; background: #E2E8F0; }
        .divider::before { left: 0; }
        .divider::after { right: 0; }
    </style>
</head>
<body>

    <div class="login-card">
        <h1>Login to Your Smart Tag</h1>
        
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-group">
                <label for="username">Tag Username (e.g. TMG-00234)</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Login & Setup</button>
        </form>
        
        <p style="font-size: 0.8rem; color: #718096; margin-top: 20px;">Lost your password? Contact us on WhatsApp.</p>
    </div>

</body>
</html>
