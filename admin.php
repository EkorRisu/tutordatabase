<?php

require 'fuction.php';
$produk = query("SELECT * FROM produk ORDER BY nama ASC");

//pengaktifan tombol cari
if (isset($_POST["cari"])) {
    $produk = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>tutor php</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="icon" href="aqua.jpg" type="image/x-con">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            background: pink;
    
        }
        table{
            font-family:  'serif';
        }
   </style>
</head>

<body>
    <div class="custom-bg">
    <div class="na">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Elito Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="tambah.php">Tambah Data</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
                </form>
            </div>
        </div>
    </nav>
    </div>
    <div class="container">
    <div class="header">
        <h1>Elito Shop</h1>
        <h5>エリトショプ</h5>
    </div>


    <div class="table">
        <table border="1" cellspacing="0" width="100%" class="table table-bordered">
            <tr>
                <th>no.</th>
                <th>Gambar</th>
                <th>Harga</th>
                <th>Nama</th>
                <th>Tersedia</th>
                <th>Edit</th>

            </tr>
            <?php $i = 1; ?>
            <?php foreach ($produk as $row): ?>
                <tr>

                    <td>
                        <?= $i ?>
                    </td>
                    <td><img class="card-img-top" height="100" src="img/<?= $row["gambar"]; ?>" alt="<?= $row["nama"]; ?>"></td>
                    <td>
                        <?= $row["harga"]; ?>
                    </td>
                    <td>
                        <?= $row["nama"]; ?>
                    </td>
                    <td>
                        <?= $row["tersedia"]; ?>
                    </td>
                    <td>
                        <!-- update dan delete button-->
                        <a href="hapus.php?id=<?=
                            $row["id"];
                        ?>" onclick="return confirm('Data akan di hapus, klik OK untuk confirm');">Hapus Produk</a>
                        <br>
                        <a href="update.php?id=<?=
                            $row["id"];
                        ?>">Update</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>