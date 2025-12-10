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
<head><title>Vuln Lab</title></head>
<body>
<h1>Welcome</h1>
<form method="POST" action="api.php?action=login">
    <input name="username" placeholder="username"><br>
    <input type="password" name="password" placeholder="password"><br>
    <button>Login</button>
</form>
</body>
</html>
