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
<head>
    <title>Dashboard</title>
</head>
<body>
<h2>Hello, <?php echo $_SESSION['user']; ?></h2>

<a href="api.php?action=logout">Log out</a>

<h3>Upload File</h3>
<form action="api.php?action=upload" method="POST" enctype="multipart/form-data">
    <input type="file" name="upload">
    <button>Upload</button>
</form>

<h3>Template Preview</h3>
<form method="POST" action="api.php?action=render_template">
<textarea name="template" rows="6" cols="60">
Hello {{system('id')}}
</textarea>
<br>
<button>Render</button>
</form>

</body>
</html>
