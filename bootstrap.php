<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!isset($_SESSION['flash'])) {
    $_SESSION['flash'] = null;
}

// === KODE BARU PRAKTIK C (COOKIE TEMA) ===
$allowedThemes = array('light', 'dark');
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

if (!in_array($theme, $allowedThemes, true)) {
    $theme = 'light';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
    $candidate = $_POST['theme'];
    if (in_array($candidate, $allowedThemes, true)) {
        setcookie('theme', $candidate, array(
            'expires' => time() + 60 * 60 * 24 * 30, // Berlaku 30 hari
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax'
        ));
    }
    header('Location: index.php');
    exit;
}