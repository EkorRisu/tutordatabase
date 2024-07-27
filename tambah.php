<?php
require 'fuction.php';
if(isset($_POST["submit"])){
    //mengecek data dari fuction
    if ( tambah ($_POST)>0){
        echo"
            <script> 
                alert('data berhasil di tambahkan');
                document.location.href='index.php';
            </script>
        ";

    } else {
        echo"
        <script> 
            alert('data gagal di tambahkan');
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
    <title>Tambah Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            label{
                display: block;
            }
        </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </div>
        </div>
    </nav>
    <h1>Tambah produk Toko</h1>
    

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama Produk: </label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="harga">Harga Produk:</label>
                <input type="text" name="harga" id="harga">
            </li>
            <li>
                <label for="tersedia">Produk yang Tersedia:</label>
                <input type="text" name="tersedia" id="tersedia">
            </li>
            <li>
                <label for="gambar">Masukan gambar</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>