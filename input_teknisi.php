<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Teknisi</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
// Sisipkan koneksi.php
include 'koneksi.php';

// Proses form jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $namaTeknisi = $_POST["nama_teknisi"];

    // Query untuk insert data ke tabel teknisi
    $query = "INSERT INTO teknisi (nama_teknisi) VALUES ('$namaTeknisi')";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Cek apakah data berhasil disimpan
    if ($result) {
        echo "<p style='color: green;'>Data teknisi berhasil ditambahkan.</p>";
    } else {
        echo "<p style='color: red;'>Error: " . mysqli_error($koneksi) . "</p>";
    }
}
?>




<form action="" method="post">
        <h2>Tambah Data Teknisi</h2>

        <label for="nama_teknisi">Nama Teknisi:</label>
        <input type="text" name="nama_teknisi" required>
		
		<button type="submit">Tambah Teknisi</button>
    </form>

</body>
</html>
