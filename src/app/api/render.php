<?php
// CVE‑2025‑1337: Vulnerable Template Renderer (LFI / RCE)

// default file if no page is provided
$page = $_GET['page'] ?? "default.html";

// NO VALIDATION → vulnerable
include($page);
