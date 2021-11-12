<?php
session_start();

if (empty($_SESSION['_token'])) {
    $_SESSION['_token'] = bin2hex(random_bytes(32));
}
$_token = $_SESSION['_token'];
if (!isset($_SESSION['auth'])) {
    if ($_SERVER['REQUEST_URI'] == '/') {
        header('Location: login');
    }
}
