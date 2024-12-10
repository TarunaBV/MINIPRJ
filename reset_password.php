<?php
$token = $_GET['token'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="update_password.php" method="post">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <div class="inputBox">
                <input type="password" name="new_password" required>
                <label for="new_password">New Password</label>
            </div>
            <div class="inputBox">
                <input type="password" name="confirm_password" required>
                <label for="confirm_password">Confirm Password</label>
            </div>
            <input type="submit" class="btn" value="Reset Password">
        </form>
    </div>
</body>
</html>
