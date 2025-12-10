<?php
require_once "config.php";
require_once "util.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>

<h2>Hello <?php echo $_SESSION['user']; ?></h2>
<a href="api.php?action=logout">Logout</a>

<h3>Save Template</h3>
<form method="POST" action="api.php?action=render_template">
<textarea name="template" rows="6" cols="60">
Hello {{ id }}
</textarea><br>
<button>Save</button>
</form>

<h3>Preview</h3>
<a href="api.php?action=preview">Render Template</a>

</body>
</html>
