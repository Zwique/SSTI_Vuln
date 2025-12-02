<?php
$host = getenv("MYSQL_HOST");
$user = getenv("MYSQL_USER");
$pass = getenv("MYSQL_PASSWORD");
$dbn  = getenv("MYSQL_DATABASE");

$db = new mysqli($host, $user, $pass, $dbn);
