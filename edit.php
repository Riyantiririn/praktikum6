<?php
require_once 'dbkoneksi.php';

$_idedit = isset($_GET['idedit']) ? $_GET['idedit'] : null;

if ($_idedit !== null) {
    $sql = "SELECT * FROM mahasiswa WHERE id=?";
    $st = $dbh->prepare($sql);
    $st->execute([$_idedit]);
    $row = $st->fetch();
} else {
    $row = [
        'nama' => '',
        'nim' => '',
        'jurusan' => '',
        'semester' => ''
    ];
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
    </style>
</head>
<body>
    <form method="post" action="proses.php">
        <label for="nama">Nama Mahasiswa:</label>
        <input id="nama" name="nama" type="text" value="<?= htmlspecialchars($row['nama']) ?>">

        <label for="nim">Nim:</label>
        <input id="nim" name="nim" type="text" value="<?= htmlspecialchars($row['nim']) ?>">

        <label for="jurusan">Prodi:</label>
        <input id="jurusan" name="jurusan" type="text" value="<?= htmlspecialchars($row['jurusan']) ?>">

        <label for="semester">Semester:</label>
        <input id="semester" name="semester" type="number" value="<?= htmlspecialchars($row['semester']) ?>">

        <?php 
        $button = ($_idedit !== null) ? "Update" : "Simpan";
        $buttonValue = ($_idedit !== null) ? "update" : "simpan";
        ?>
        <input type="submit" name="proses" value="<?= $button ?>" />
        <input type="hidden" name="idedit" value="<?= $_idedit ?>" />
    </form>
</body>
</html>
