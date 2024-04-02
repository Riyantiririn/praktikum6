<?php
require_once 'dbkoneksi.php';

// Pastikan parameter iddel adalah sebuah angka
$id = isset($_GET['iddel']) ? intval($_GET['iddel']) : 0;

// Persiapkan sebuah prepared statement untuk menghindari serangan SQL injection
$stmt = $dbh->prepare("DELETE FROM mahasiswa WHERE id=:id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Eksekusi statement
$stmt->execute();

// Redirect ke halaman index setelah penghapusan berhasil
header('location:index.php');
?>
