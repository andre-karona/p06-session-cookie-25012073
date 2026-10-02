<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Keranjang Berbasis Session & Cookie</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<!-- Mengubah warna latar belakang secara dinamis berdasarkan cookie tema -->
<body class="<?php echo $theme === 'dark' ? 'bg-dark text-white' : 'bg-light text-dark'; ?>">

<nav class="navbar navbar-expand-lg <?php echo $theme === 'dark' ? 'navbar-dark bg-secondary' : 'navbar-dark bg-dark'; ?> mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">Toko Online Ganesha</a>
        
        <!-- Form Pilihan Tema (Terang / Gelap) -->
        <form action="bootstrap.php" method="POST" class="d-flex align-items-center me-3">
            <select name="theme" onchange="this.form.submit()" class="form-select form-select-sm me-2">
                <option value="light" <?php echo $theme === 'light' ? 'selected' : ''; ?>>☀️ Light Mode</option>
                <option value="dark" <?php echo $theme === 'dark' ? 'selected' : ''; ?>>🌙 Dark Mode</option>
            </select>
        </form>

        <div class="navbar-nav ms-auto">
            <a class="nav-link btn btn-outline-secondary text-white px-3" href="cart.php">
                🛒 Keranjang (<?php echo isset($_SESSION['cart']) ? cartCount($_SESSION['cart']) : 0; ?>)
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <?php 
    $flashMessage = pullFlash();
    if ($flashMessage): 
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e($flashMessage); ?>
        </div>
    <?php endif; ?>