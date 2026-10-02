<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';
$products = require __DIR__ . '/components/products.php';

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

require_once __DIR__ . '/components/header.php';
?>

<div class="row">
    <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
        <h2>Isi Keranjang Belanja</h2>
        <?php if (!empty($cartItems)): ?>
            <form action="actions.php" method="POST">
                <input type="hidden" name="action" value="clear">
                <button type="submit" class="btn btn-danger btn-sm">🗑️ Kosongkan Keranjang</button>
            </form>
        <?php endif; ?>
    </div>

    <div class="col-md-12">
        <?php if (empty($cartItems)): ?>
            <div class="alert alert-info text-center py-4">
                Keranjang belanja Anda masih kosong. <a href="index.php" class="alert-link">Kembali belanja</a>.
            </div>
        <?php else: ?>
            <div class="table-responsive bg-white rounded shadow-sm p-3">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th class="text-center">Kuantitas</th>
                            <th>Subtotal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalKeseluruhan = 0;
                        foreach ($cartItems as $id => $quantity): 
                            if (!isset($products[$id])) continue;
                            $product = $products[$id];
                            $subtotal = $product['harga'] * $quantity;
                            $totalKeseluruhan += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo e($product['nama']); ?></td>
                                <td>Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></td>
                                <td class="text-center fw-bold"><?php echo $quantity; ?></td>
                                <td class="text-success fw-bold">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <form action="actions.php" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?');">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-light fs-5">
                            <td colspan="3" class="fw-bold text-end">Total Keseluruhan:</td>
                            <td colspan="2" class="text-primary fw-bold">Rp <?php echo number_format($totalKeseluruhan, 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3 text-end">
                    <a href="index.php" class="btn btn-secondary">← Lanjut Belanja</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
require_once __DIR__ . '/components/footer.php';
?>