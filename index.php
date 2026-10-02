<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';
$products = require __DIR__ . '/components/products.php';

// Memanggil desain bagian atas
require_once __DIR__ . '/components/header.php';
?>

<div class="row">
    <div class="col-md-12">
        <h2 class="mb-4">Daftar Produk</h2>
    </div>
    
    <?php foreach ($products as $id => $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><?= e($product['nama']); ?></h5>
                        <p class="card-text text-success fw-bold">Rp <?= number_format($product['harga'], 0, ',', '.'); ?></p>
                    </div>
                    <!-- Form POST untuk menambahkan produk ke keranjang belanja -->
                    <form action="actions.php" method="POST" class="mt-3">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <button type="submit" class="btn btn-primary w-100">➕ Tambah ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
// Memanggil desain bagian bawah
require_once __DIR__ . '/components/footer.php';
?>