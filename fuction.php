<?php
    //koneksi php
    $conn = mysqli_connect("localhost", "root", "", "toko1");

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    //konkesi dengan tambah.php
    function tambah($post){
        global $conn; 
        //menginput data ke db
        $nama=htmlspecialchars($post["nama"]);
        $harga=htmlspecialchars($post["harga"]);
        $tersedia=htmlspecialchars($post["tersedia"]);
        //upload gambar
        $gambar=upload();
        if (!$gambar){
            return false;
        }
    
        //query
        $query = "INSERT INTO produk (gambar, harga, nama, tersedia)
          VALUES ('$gambar', '$harga', '$nama', '$tersedia')";

        mysqli_query($conn, $query);   

        return mysqli_affected_rows($conn);
    
    }
    
    //fuction hapus
    function hapus($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
        return mysqli_affected_rows($conn);
    }

    //fuction update
    function update($data){
        global $conn; 
            
        $id = $data['id'];
        //menginput update ke db
        $nama = htmlspecialchars($data["nama"]);
        $harga = htmlspecialchars($data["harga"]);
        $tersedia = htmlspecialchars($data["tersedia"]);

        //ubah gambar
        $gambarLama= htmlspecialchars($data["gambarlama"]);
    
          // cek apakah user pilih gambar baru atau tidak
             if( $_FILES['gambar']['error'] === 4){
                $gambar = $gambarLama;
                 } else {
                     $gambar = upload();
                 }

        
        //query
        $query = "UPDATE produk SET
                    nama='$nama',
                    harga='$harga',
                    tersedia='$tersedia'
                  WHERE id=$id"; 
    
        mysqli_query($conn, $query);   
    
        return mysqli_affected_rows($conn);
    }
    //fuction upload
    function upload(){
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];
    
    
        // cek apakah tidak ada gambar yg di upload
        if( $error === 4) {
            echo "<script>
            alert('masukan gambar terlebih dahulu');
            </script>
            ";
            return false;
        }
    
        // cek upload gambar gambar
        $ekstensiGambarValid = ['JPG','PNG','JPEG'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtoupper(end($ekstensiGambar));
        if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script>
            alert('Type File tidak mendukung');
            </script>
            ";
            return false;
        }
    
        // cek jika ukurannya terlalu besar
        if( $ukuranFile > 5000000) {
            echo "<script>
            alert('ukuran gambar terlalu besar, maks:5MB');
            </script>
            ";
            return false;
        }
    
        // lolos pengecekan, gambar siap di upload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
    
    
        move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
        return $namaFileBaru;
    
    
    }

    function cari($keyword){
        $query="SELECT * FROM produk 
                WHERE 
                nama LIKE'%$keyword%' OR
                harga LIKE '%$keyword%' OR
                tersedia LIKE '%$keyword%'   
                
                ";
        return query($query);
    }

    
    function registrasi($data){
        global $conn;
        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $pass2 = mysqli_real_escape_string($conn, $data["pass2"]);
    
        // Konfirmasi password
        if ($password !== $pass2){
            echo "<script> alert('Password tidak sama'); </script>";
            return false;
        }
    
        // Cek username
        $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
        if (mysqli_fetch_assoc($result)){
            echo "<script> alert('Username sudah dipakai'); </script>";
            return false;
        }
    
        // Enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
    
        // Menambah user baru
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        mysqli_query($conn, $query);
    
        return mysqli_affected_rows($conn);
    }

    //login page
    function login($data)
{
    global $conn;

    // Sanitize input
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);

    // Check if username exists
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    
    // If the query failed
    if (!$result) {
        echo "
        <script>
            alert('Terjadi kesalahan pada query');
        </script>
        ";
        return false;
    }

    // Check if username exists in the database
    if (mysqli_num_rows($result) === 0) {
        echo "
        <script>
            alert('Username tidak terdaftar');
        </script>
        ";
        return false;
    }

    // Check password
    $row = mysqli_fetch_assoc($result);
    if (!password_verify($password, $row["password"])) {
        echo "
        <script>
            alert('Password salah');
        </script>
        ";
        return false;
    }

    // Set session
    $_SESSION["login"] = true;
    $_SESSION["user_id"] = $row["id"];

    return true;
}



function logout()
{
    $_SESSION = [];
    session_unset();
    session_destroy();

    return true;
}

    //add product
    function getProducts()
{
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM produk");
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Fungsi untuk mendapatkan produk berdasarkan id
function getProduct($id) {
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM produk WHERE id = $id");
    return mysqli_fetch_assoc($result);

    
}

// Fungsi untuk menambahkan produk ke keranjang
function addToCart($data) {
    global $conn;
    $product_id = $data['product_id'];
    $user_id = $data['user_id'];
    $quantity = $data['quantity'];

    // Inisialisasi keranjang dalam sesi jika belum ada
    if (!isset($_SESSION['cart'][$user_id])) {
        $_SESSION['cart'][$user_id] = [];
    }

    // Periksa apakah produk sudah ada di keranjang
    if (isset($_SESSION['cart'][$user_id][$product_id])) {
        echo "<script>alert('Produk sudah ada di keranjang');</script>";
        return false;
    }

    // Tambahkan produk ke keranjang
    $_SESSION['cart'][$user_id][$product_id] = [
        'quantity' => $quantity,
    ];

    return true;
}

// Fungsi untuk menghapus produk dari keranjang
function removeFromCart($data) {
    $product_id = $data['product_id'];
    $user_id = $data['user_id'];

    // Periksa apakah produk ada di keranjang
    if (!isset($_SESSION['cart'][$user_id][$product_id])) {
        echo "<script>alert('Produk tidak ada di keranjang');</script>";
        return false;
    }

    // Hapus produk dari keranjang
    unset($_SESSION['cart'][$user_id][$product_id]);

    return true;
}

// Fungsi untuk mendapatkan keranjang berdasarkan user_id
function getCart($user_id) {
    if (!isset($_SESSION['cart'][$user_id])) {
        return [];
    }

    return $_SESSION['cart'][$user_id];
}

// Fungsi untuk menghitung total harga di keranjang
function getCartTotal($user_id) {
    $cart = getCart($user_id);
    $total = 0;

    foreach ($cart as $product_id => $product) {
        $quantity = $product['quantity'];
        $product_info = getProduct($product_id);
        $total += $product_info['harga'] * $quantity;
    }

    return $total;
}
?>

