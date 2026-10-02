<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';
$products = require __DIR__ . '/components/products.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($action === 'add' && $id !== false && isset($products[$id])) {
    $currentQty = isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id] : 0;
    $_SESSION['cart'][$id] = $currentQty + 1;
    setFlash('Produk ditambahkan ke keranjang.');
} elseif ($action === 'remove' && $id !== false && isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
    setFlash('Produk dihapus dari keranjang.');
} elseif ($action === 'clear') {
    $_SESSION['cart'] = array();
    setFlash('Keranjang dikosongkan.');
} else {
    setFlash('Permintaan tidak valid.');
}

$target = ($action === 'add') ? 'index.php' : 'cart.php';
header('Location: ' . $target);
exit;