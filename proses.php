<?php 
require_once 'dbkoneksi.php';

// Pastikan data yang dibutuhkan tersedia sebelum mengaksesnya
if(isset($_POST['nama'], $_POST['nim'], $_POST['jurusan'], $_POST['semester'], $_POST['proses'])) {
    $_nama = $_POST['nama'];
    $_nim = $_POST['nim'];
    $_jurusan = $_POST['jurusan'];
    $_semester = $_POST['semester'];
    $_proses = $_POST['proses'];

    // array data
    $ar_data = [
        $_nama,
        $_nim,
        $_jurusan,
        $_semester
    ];

    // Lakukan pengecekan untuk menentukan apakah prosesnya adalah Simpan atau Update
    if($_proses == "Simpan") {
        $sql = "INSERT INTO mahasiswa (nama, nim, jurusan, semester) VALUES (?, ?, ?, ?)";
    } else if($_proses == "Update") {
        $idedit = isset($_POST['idedit']) ? $_POST['idedit'] : null;
        if($idedit !== null) {
            $ar_data[] = $idedit;
            $sql = "UPDATE mahasiswa SET nama=?, nim=?, jurusan=?, semester=? WHERE id=?";
        } else {
            // Jika tidak ada idedit, tidak bisa melakukan update
            // Anda dapat menambahkan penanganan error di sini
            header('location:index.php');
            exit;
        }
    }

    // Eksekusi query
    if(isset($sql)) {
        $st = $dbh->prepare($sql);
        $st->execute($ar_data);
    }
}

// Redirect ke halaman index setelah proses selesai
header('location:index.php');
?>
