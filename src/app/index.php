<?php
require_once "config.php";
session_start();

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vuln Lab</title>
</head>
<body>
    <h1>Welcome to Vuln Lab by Zwique</h1>

    <form method="POST" action="api.php?action=login">
        <input type="text" name="username" placeholder="username"><br>
        <input type="password" name="password" placeholder="password"><br>
        <button type="submit">Log in</button>
    </form>
</body>
</html>
