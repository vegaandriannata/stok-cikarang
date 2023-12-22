<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stok Heating</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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

    <h1>Dashboard Stok Heating Xforce</h1>
	<div class="button-container">
	<a href="dashboard-stok.php">Dashboard Stok</a>
        <a href="input_ht_xforce.php">Input Stok HT Xforce</a>
		
    </div>
	
	
    <table>
        <thead>
            <tr>
                <th>NO</th>
				<th>Tanggal</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Sisa</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
			$no = 1;
                // Sertakan file koneksi.php
                include 'koneksi.php';

                // Ambil data dari tabel ht_xpander
                $sql = "SELECT tanggal, stok_masuk, stok_keluar, sisa, keterangan FROM ht_xforce";
                $result = mysqli_query($koneksi, $sql);

                // Tampilkan data dalam tabel HTML
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
						echo "<td>" . $no . "</td>";
                        echo "<td>" . $row["tanggal"] . "</td>";
                        echo "<td>" . $row["stok_masuk"] . "</td>";
                        echo "<td>" . $row["stok_keluar"] . "</td>";
                        echo "<td>" . $row["sisa"] . "</td>";
                        echo "<td>" . $row["keterangan"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }

                // Tutup koneksi
                mysqli_close($koneksi);
            ?>
        </tbody>
    </table>

</body>
</html>
