<?php
require 'fuction.php';
if( isset($_POST["register"])){
    if(registrasi($_POST)>0){
        echo "<script> alert('User Berhasil di tambahkan'); </script>";

    } else {
        global $conn;
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        label {
            display: block;
        }
        .table {
            margin-left: auto;
            margin-right: auto; /* Mengganti margin-bottom dengan margin-right untuk efek centering horizontal */
            list-style-type: none;
        }
        .head {
            font-family: sans-serif;
            text-align: center; 
        }
    </style>
    <link rel="icon" href="aqua.jpg">
</head>
<body>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </div>
        </div>
    </nav>
    <form action="" method="post">
        <div class="head">
            <h1>Halaman Register</h1>
        </div>
        <div class="table">
            <ul>
                <li>
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username">
                </li>
                
                <li>
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password">
                </li>
                
                <li>
                    <label for="pass2">Confirm Password: </label>
                    <input type="password" name="pass2" id="pass2">
                </li>   
                <li>
                    <button type="submit" name="register">Register</button>
                </li>
                
                <li>
                    <p>You have accout?. Lets go Login</p> <a href="login.php">login</a>
                </li>
            </ul>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>