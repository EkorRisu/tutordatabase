<?php
require 'fuction.php';

//mengambil id
$id=$_GET["id"];

// query data
$pro = query("SELECT * FROM produk WHERE id = $id")[0];

if(isset($_POST["submit"])){
    //mengecek data dari fuction
    if(update($_POST) > 0){
        echo "
            <script> 
                alert('data berhasil diubah');
                document.location.href='index.php';
            </script>
        ";
    } else {
        echo "
            <script> 
                alert('data gagal diubah');
                document.location.href='index.php';
            </script>
        ";    
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
    <style>
        label{
            display: block;
        }
    </style>
</head>
<body>
    <h1>Update data</h1>
    <a href="admin.php">Kembali ke Halaman Utama</a>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <input type="hidden" name="id" value="<?= $pro["id"]; ?>">
            <input type="hidden" name="gambarlama" value="<?= $pro["gambar"]; ?>">

            <li>
                <label for="nama">Nama Produk: </label>
                <!-- Perbaikan: Menggunakan sintaks PHP untuk menampilkan nilai -->
                <input type="text" name="nama" id="nama" value="<?= $pro["nama"] ?>">
            </li>
            <li>
                <label for="harga">Harga Produk:</label>
                <input type="text" name="harga" id="harga" value="<?= $pro["harga"] ?>">
            </li>
            <li>
                <label for="tersedia">Produk yang Tersedia:</label>
                <input type="text" name="tersedia" id="tersedia" value="<?= $pro["tersedia"] ?>">
            </li>
            <li>
                <label for="gambar">Masukkan gambar</label>
                <img src="img/<? $pro['gambar'];?>" alt="">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Update Data</button>
            </li>
        </ul>
    </form>
</body>
</html>
