<?php
function dangerous_exec($cmd) {
    return shell_exec($cmd);
}

function dangerous_template_render($text) {
    return preg_replace_callback('/{{(.*?)}}/s', function($m) {
        return dangerous_exec(trim($m[1]));
    }, $text);
}
