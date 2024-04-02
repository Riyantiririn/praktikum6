<?php 
require_once 'dbkoneksi.php';

$nama = $nim = $jurusan = $semester = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $nama = test_input($_POST["nama"]);
    $nim = test_input($_POST["nim"]);
    $jurusan = test_input($_POST["jurusan"]);
    $semester = test_input($_POST["semester"]);

    // Cek apakah semua input sudah terisi
    if (empty($nama) || empty($nim) || empty($jurusan) || empty($semester)) {
        $error = "Semua kolom harus diisi.";
    } else {
        // Lakukan proses penyimpanan data ke dalam database
        $sql = "INSERT INTO nama_tabel (nama, nim, jurusan, semester) VALUES ('$nama', '$nim', '$jurusan', '$semester')";
        if (mysqli_query($koneksi, $sql)) {
            // Redirect ke halaman sukses jika penyimpanan berhasil
            header("Location: halaman_sukses.php");
            exit;
        } else {
            $error = "Terjadi kesalahan. Silakan coba lagi.";
        }
    }
}

// Fungsi untuk membersihkan dan memvalidasi input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Mahasiswa</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            max-width: 300px;
            margin: 0 auto;
        }
        label {
            margin-bottom: 5px;
        }
        input, button {
            margin-bottom: 10px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nama">Nama Mahasiswa:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
        
        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" value="<?php echo $nim; ?>">
        
        <label for="jurusan">Prodi:</label>
        <input type="text" id="jurusan" name="jurusan" value="<?php echo $jurusan; ?>">
        
        <label for="semester">Semester:</label>
        <input type="number" id="semester" name="semester" value="<?php echo $semester; ?>">
        
        <input type="submit" name="proses" value="Simpan">
    </form>
    <?php if (!empty($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
</body>
</html>
