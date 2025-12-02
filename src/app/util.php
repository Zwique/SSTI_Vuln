<?php

// The core RCE
function dangerous_exec($cmd) {
    return shell_exec($cmd);
}

// Vulnerable fake template engine
function dangerous_template_render($text) {
    // Replace {{ ... }} → execute inside PHP eval
    return preg_replace_callback('/{{(.*?)}}/s', function($m) {
        $code = trim($m[1]);
        return dangerous_exec($code); // EXECUTION!
    }, $text);
}
