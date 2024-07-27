<?php
session_start(); // Memulai sesi di awal file

require 'fuction.php';

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // Jika belum login, arahkan ke halaman login
    header('Location: login.php');
    exit;
}

// Mendapatkan user_id dari sesi
$user_id = $_SESSION['user_id'];

// Mengambil data keranjang untuk user yang sedang login
$cart_items = getCart($user_id);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Keranjang Belanja</title>
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
            <h1>Keranjang Belanja</h1>
        </div>

        <div class="table">
            <table border="1" cellspacing="0" width="100%" class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Hapus</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><img class="card-img-top" height="100" src="img/<?= $item["gambar"]; ?>" alt="<?= $item["nama"]; ?>"></td>
                    <td><?= $item["nama"]; ?></td>
                    <td><?= $item["harga"]; ?></td>
                    <td><?= $item["quantity"]; ?></td>
                    <td><?= $item["harga"] * $item["quantity"]; ?></td>
                    <td>
                        <!-- Form untuk menghapus barang dari keranjang -->
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?= $item['id']; ?>">
                            <button type="submit" name="remove_from_cart" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </table>
        </div>

        <?php
        // Memproses penghapusan barang dari keranjang
        if (isset($_POST['remove_from_cart'])) {
            $cart_id = $_POST['cart_id'];
            removeFromCart($cart_id);
            echo "<script>alert('Barang berhasil dihapus dari keranjang');</script>";
            echo "<script>window.location.href='cart.php';</script>"; // Refresh halaman untuk memperbarui daftar keranjang
        }
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
