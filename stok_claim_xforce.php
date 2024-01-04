<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stok Claim</title>
    <style>
        body {
            font-family: Arial, sans-serif, 12px;
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
        text-align: center; /* Center-align table headers */
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

    <h1>Dashboard Stok Claim Xforce</h1>
	<div class="button-container">
	<a href="dashboard-stok.php">Dashboard Stok</a>
    <a href="input_claim_xforce.php">Input Stok Claim Xforce</a>
    </div>
	
	
    <table>
        <thead>
            <tr>
                <th rowspan="2">NO</th>
				<th rowspan="2">Tanggal</th>
				<th rowspan="2">Shift</th>
				<th rowspan="2">Keterangan</th>
				<th colspan="8">Claim</th>
				
				
                
                
            </tr>
			
			<tr>
				<th>Depan</th>
                <th>Bagasi</th>
                <th>Sopir Kiri</th>
				<th>Sopir Kanan</th>
				<th>Penumpang Kiri</th>
				<th>Penumpang Kanan</th>
				<th>Mati Kiri</th>
				<th>Mati Kanan</th>
				
			</tr>
			
			
        </thead>
        <tbody>
            <?php
			$no = 1;
                // Sertakan file koneksi.php
                include 'koneksi.php';

                // Ambil data dari tabel ht_xpander
                $sql = "SELECT * FROM claim_xforce";
                $result = mysqli_query($koneksi, $sql);

                // Tampilkan data dalam tabel HTML
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
						echo "<td>" . $no . "</td>";
                        echo "<td>" . $row["tanggal"] . "</td>";
						echo "<td>" . $row["shift"] . "</td>";
						echo "<td>" . $row["keterangan"] . "</td>";
                        echo "<td>" . $row["kdp"] . "</td>";
                        echo "<td>" . $row["kbg"] . "</td>";
                        echo "<td>" . $row["kpkr"] . "</td>"; 
						echo "<td>" . $row["kpkn"] . "</td>";
						echo "<td>" . $row["kskr"] . "</td>";
                        echo "<td>" . $row["kskn"] . "</td>";
                        echo "<td>" . $row["kmkr"] . "</td>"; 
						echo "<td>" . $row["kmkn"] . "</td>";
						
                        
                        echo "</tr>";
						$no++;
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
