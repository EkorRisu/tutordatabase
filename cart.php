<?php
session_start();
require 'fuction.php';

// Memeriksa apakah user_id sudah diset dalam sesi
if (!isset($_SESSION['user_id'])) {
    // Arahkan pengguna ke halaman login jika user_id tidak diset
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Hapus item dari keranjang
if (isset($_GET['remove'])) {
    $product_id = intval($_GET['remove']); // Pastikan product_id adalah integer
    if (removeFromCart($product_id, $user_id)) {
        echo "<script>alert('Produk berhasil dihapus dari keranjang');</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk dari keranjang');</script>";
    }
    echo "<script>window.location.href = 'cart.php';</script>";
    exit;
}


// Proses checkout
if (isset($_POST['checkout'])) {
    $total = checkout($user_id);
    echo "<script>alert('Checkout berhasil. Total pembayaran: Rp$total');</script>";
    echo "<script>window.location.href = 'cart.php';</script>";
    exit;
}

// Dapatkan item dari keranjang
$cart_items = getCartItems($user_id);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Cart - Elito Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="icon" href="aqua.jpg" type="image/x-con">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: pink;
        }
        table {
            font-family: 'serif';
        }
    </style>
</head>

<body>
    <?php 
    include('tempe/_nav.php');
    ?>
    <div class="container">
        <div class="header">
            <h1>Cart Page</h1>
        </div>

        <div class="table">
            <table border="1" cellspacing="0" width="100%" class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Beli</th>
                </tr>
                <?php $i = 1; $total_bayar = 0; ?>
                <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= htmlspecialchars($item["nama"] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($item["harga"] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($item["quantity"] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars($item["harga"] * $item["quantity"] ?? 0, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <!-- Tombol untuk menghapus produk dari keranjang -->
                        <a href="cart.php?remove=<?= htmlspecialchars($item['product_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger">Hapus</a>
                        <!-- checkout peritem -->
                        <a href="cart.php?checkout=<?= htmlspecialchars($item['product_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-success">Checkout</a>

                    </td>
                </tr>
                <?php $total_bayar += $item["harga"] * $item["quantity"]; ?>
                <?php $i++; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" align="right"><strong>Total Bayar:</strong></td>
                    <td colspan="2"><strong>Rp<?= htmlspecialchars($total_bayar, ENT_QUOTES, 'UTF-8'); ?></strong></td>
                </tr>
            </table>
        </div>
        <form method="post" action="">
            <button type="submit" name="checkout" class="btn btn-success">Checkout</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
