<?php
require_once "config.php";
require_once "util.php";
session_start();

$action = $_GET['action'] ?? '';

switch ($action) {

    /* ================= LOGIN (SQLi) ================= */

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
            exit;
        }

    /* ================= LOGOUT ================= */

    case "logout":
        session_destroy();
        header("Location: index.php");
        exit;

    /* ================= SQLi → FILE WRITE ================= */

    case "load_note_to_template":
        if (!isset($_SESSION['user'])) die("auth required");

        $title = $_GET['title'] ?? '';

        // ❌ INTENTIONAL SQL INJECTION
        $sql = "SELECT content FROM notes WHERE title = '$title'";
        $res = $db->query($sql);

        if ($res && $row = $res->fetch_assoc()) {
            file_put_contents(
                "/tmp/template_" . session_id(),
                $row['content']
            );
            echo "template loaded";
        } else {
            echo "no note";
        }
        exit;

    /* ================= MANUAL TEMPLATE SAVE ================= */

    case "render_template":
        if (!isset($_SESSION['user'])) die("auth required");

        $tpl = $_POST['template'] ?? '';
        file_put_contents(
            "/tmp/template_" . session_id(),
            $tpl
        );
        echo "template saved";
        exit;

    /* ================= SSTI → RCE ================= */

    case "preview":
        if (!isset($_SESSION['user'])) die("auth required");

        $path = "/tmp/template_" . session_id();
        if (!file_exists($path)) die("no template");

        echo dangerous_template_render(
            file_get_contents($path)
        );
        exit;

    /* ================= MISC ================= */

    case "ping":
        echo "pong";
        exit;

    default:
        echo "unknown action";
        exit;
}
