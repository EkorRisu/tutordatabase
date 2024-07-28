<?php
session_start();
require 'fuction.php';

// Memeriksa apakah user_id sudah diset dalam sesi
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null; // Atau Anda bisa melakukan tindakan lain jika user_id tidak terdefinisi
}

$produk = query("SELECT * FROM produk ORDER BY nama ASC");

// pengaktifan tombol cari
if (isset($_POST["cari"])) {
    $produk = cari($_POST["keyword"]);
}

// Tambahkan produk ke keranjang
if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $product_id = $_GET['id'];
    if (addToCart($product_id, $_SESSION['user_id'])) {
        echo "<script>alert('Produk telah dimasukan di dalam keranjang');</script>";
    } else {
       echo "<script>alert('Produk sudah dimasukan ada di keranjang');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Elito Shop</title>
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
            <h1>Elito Shop</h1>
            <h5>エリトショプ</h5>
        </div>

        <div class="table">
            <table border="1" cellspacing="0" width="100%" class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>Harga</th>
                    <th>Nama</th>
                    <th>Tersedia</th>
                    <th>Beli</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach ($produk as $row): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><img class="card-img-top" height="100" src="img/<?= $row["gambar"]; ?>" alt="<?= $row["nama"]; ?>"></td>
                    <td><?= $row["harga"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["tersedia"]; ?></td>
                    <td>
                        <!-- Link untuk menambahkan barang ke keranjang -->
                        <a href="index.php?id=<?= $row['id'];?>" class="btn btn-primary">Add to Cart</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
