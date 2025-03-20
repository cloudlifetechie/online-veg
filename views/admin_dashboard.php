<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user']; ?></h1>
    <a href="<?php echo BASE_URL; ?>?action=logout">Logout</a>
</body>
</html>