<?php
$user = 'ambroise';
$password = 'youhou';
$dsn = 'mysql:dbname=meetic;host=localhost';
try {
    $db = new PDO($dsn, $user, $password);
} catch (Exception $e) {
    echo $e->getMessage();
    die;
}
