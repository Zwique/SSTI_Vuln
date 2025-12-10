<?php
require_once "config.php";
require_once "util.php";
session_start();

$action = $_GET['action'] ?? '';

switch ($action) {

case "login":
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';

    // ❌ INTENTIONAL SQL INJECTION
    $sql = "SELECT username FROM users WHERE username='$u' AND password='$p'";
    $res = $db->query($sql);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION['user'] = $row['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid.";
    }
    break;

case "load_note_to_template":
    if (!isset($_SESSION['user'])) die("auth required");

    $title = $_GET['title'] ?? '';
    $res = $db->query("SELECT content FROM notes WHERE title = '$title'");

    if ($res && $row = $res->fetch_assoc()) {
        file_put_contents("/tmp/template_" . session_id(), $row['content']);
        echo "template loaded";
    } else {
        echo "no note";
    }
    break;

case "preview":
    if (!isset($_SESSION['user'])) die("auth required");

    echo dangerous_template_render(
        file_get_contents("/tmp/template_" . session_id())
    );
    break;

default:
    echo "unknown action";
}
