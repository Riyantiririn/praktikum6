<?php 
function connect_to_database() {
    $host = 'localhost';
    $db = 'crud_db';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $dbh = new PDO($dsn, $user, $pass, $opt);
        return $dbh;
    } catch (PDOException $e) {
        // Jika terjadi kesalahan dalam koneksi, bisa dilakukan penanganan kesalahan di sini
        // Misalnya:
        // echo "Koneksi gagal: " . $e->getMessage();
        // exit;
        return null; // Mengembalikan null agar menandakan koneksi gagal
    }
}

// Menggunakan fungsi connect_to_database() untuk membuat koneksi ke database
$dbh = connect_to_database();

// Jika koneksi berhasil, variabel $dbh akan berisi objek PDO yang digunakan untuk menjalankan query
// Jika koneksi gagal, variabel $dbh akan bernilai null
?>
