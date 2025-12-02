<?php
require_once "config.php";
require_once "util.php";
session_start();

$action = $_GET['action'] ?? '';

switch ($action) {

    case "login":
        $u = $_POST['username'];
        $p = $_POST['password'];

        $stmt = $db->prepare("SELECT username FROM users WHERE username=? AND password=?");
        $stmt->bind_param("ss", $u, $p);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $_SESSION['user'] = $u;
            header("Location: dashboard.php");
        } else {
            echo "Invalid.";
        }
        break;

    case "logout":
        session_destroy();
        header("Location: index.php");
        break;

    case "upload":
        $name = $_FILES['upload']['name'];
        $tmp  = $_FILES['upload']['tmp_name'];

        move_uploaded_file($tmp, "uploads/" . $name);
        echo "Uploaded.";
        break;

    case "status":
        echo json_encode(["status"=>"ok","version"=>"1.0"]);
        break;

    case "ping":
        echo "pong";
        break;

    case "render_template":
        $tpl = $_POST['template'] ?? '';
        echo dangerous_template_render($tpl); // calls RCE!
        break;

    default:
        echo "unknown action";
}
