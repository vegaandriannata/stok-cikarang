<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Teknisi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }
		.button-container {
            margin-top: 20px;
        }

        .button-container a, .button-container button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-container a:hover, .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h2>Dashboard Teknisi</h2>	
<div class="button-container">
	
        <a href="dashboard-stok.php"style="margin-right:1%;">Dashboard Stok</a>
        <a href="input_teknisi.php"style="margin-right:1%;">Input Teknisi </a>
		<button onclick="exportToExcel()">Export to Excel</button>
		<a href="?logout" class="logout">Logout</a>
    </div>
<?php
// Sisipkan koneksi.php
include 'koneksi.php';

// Query untuk mendapatkan data teknisi
$query = "SELECT * FROM teknisi";
$result = mysqli_query($koneksi, $query);
?>



<?php
// Cek apakah ada data teknisi
if (mysqli_num_rows($result) > 0) {
    // Tampilkan data dalam tabel
    echo "<table>";
    echo "<tr><th>No</th><th>Nama Teknisi</th></tr>";

    $no = 1; // Inisialisasi nomor urut

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
       
        echo "<td>" . $row["nama_teknisi"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Tidak ada data teknisi.</p>";
}

// Tutup koneksi
mysqli_close($koneksi);
?>

</body>
</html>
