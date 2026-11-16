<?php
require_once __DIR__ . '/bootstrap.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if (strlen($username) < 3 || strlen($password) < 12) {
        $message = 'Username must be at least 3 characters and password at least 12 characters.';
    } else {
        try {
            $count = (int)db()->query('SELECT COUNT(*) FROM admins')->fetchColumn();
            if ($count > 0) $message = 'An admin already exists. Delete setup.php from your server.';
            else {
                $q = db()->prepare('INSERT INTO admins(username,password_hash) VALUES(?,?)');
                $q->execute([$username,password_hash($password,PASSWORD_DEFAULT)]);
                $message = 'Admin created. Delete setup.php now, then sign in.';
            }
        } catch (Throwable $e) { $message = 'Database error: ' . $e->getMessage(); }
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>RADIUS setup</title><link rel="stylesheet" href="assets/css/style.css"></head><body class="setup-body"><form class="login-card setup-card" method="post"><h2>RADIUS DB · First-time setup</h2><p>Create the first administrator account.</p><?php if($message): ?><div class="notice"><?=htmlspecialchars($message)?></div><?php endif; ?><label>Admin username</label><input name="username" required minlength="3"><label>Password (minimum 12 characters)</label><input name="password" type="password" required minlength="12"><button class="login-btn">Create administrator</button><p class="small">After success, remove setup.php from your hosting folder.</p></form></body></html>
