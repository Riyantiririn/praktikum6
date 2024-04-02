<?php 
require_once 'dbkoneksi.php';

// Ambil data mahasiswa dari database
$sql = "SELECT * FROM mahasiswa";
$rs = $dbh->query($sql);

// Periksa jika ada error ketika menjalankan query
if (!$rs) {
    die("Error dalam menjalankan query.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pengolahan</title>
    <style>
       .button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    outline: none;
    border: none;
    border-radius: 5px;
    background-color: #007bff; /* Warna asal: biru */
    color: #fff;
    transition: background-color 0.3s;
}
.button:hover {
    background-color: #0056b3; /* Warna asal: biru tua */
}
.container {
    text-align: center;
}
table {
    width: 50%;
    border-collapse: collapse;
    margin: 20px auto;
}
th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
th {
    background-color: #00ff00; /* Perubahan warna: hijau */
}


    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Jurusan</th>
                <th>Semester</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nomor = 1;
            foreach($rs as $row) {
            ?>
                <tr>
                    <td><?= $nomor ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['nim']) ?></td>
                    <td><?= htmlspecialchars($row['jurusan']) ?></td>
                    <td><?= htmlspecialchars($row['semester']) ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit.php?idedit=<?= $row['id'] ?>">Edit</a>
                        <a class="btn btn-primary" href="delete.php?iddel=<?= $row['id'] ?>"
                            onclick="return confirm('Anda Yakin Ingin Menghapus Data Mahasiswa <?= htmlspecialchars($row['nama']) ?>?')">Delete</a>
                    </td>
                </tr>
            <?php 
            $nomor++;   
            } 
            ?>
        </tbody>
    </table>
    <div class="container">
        <a class="button" href="form_nilai.php">Create New Data</a>
    </div>
</body>
</html>
