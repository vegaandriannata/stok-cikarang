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
			text-align: center;	
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

    <h1>Dashboard Stok Heating Xpander</h1>
	<div class="button-container">
	<a href="dashboard-stok.php">Dashboard Stok</a>
        <a href="input_ht_xpander.php">Input Stok HT Xpander</a>
		
    </div>
	
	
    <table>
        <thead>
            <tr>
                <th rowspan="6">NO</th>
				<th rowspan="6">Tanggal</th>
                <th rowspan="6">Shift</th>
                <th rowspan="6">Nama</th>
               
            </tr>
			
			<tr>
				<th colspan="6">Xpander</th>
                
			</tr>
			
			<tr>
				<th colspan="2" >Terima</th>
				<th colspan="2">Hasil</th>
                <th colspan="2">Claim</th>
			</tr>
			
			<tr>
				<th colspan="1">Depan</th>
				<th colspan="1">Bagasi</th>
				<th colspan="1">Depan</th>
				<th colspan="1">Bagasi</th>
				<th colspan="1">Depan</th>
				<th colspan="1">Bagasi</th>
			</tr>
			
			
			
        </thead>
        <tbody>
            <?php
			$no = 1;
                
                include 'koneksi.php';

                
                $sql = "SELECT * FROM ht_xpander";
                $result = mysqli_query($koneksi, $sql);

                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                         echo "<tr>";
						echo "<td>" . $no . "</td>";
                        echo "<td>" . $row["tanggal"] . "</td>";
						echo "<td>" . $row["shift"] . "</td>";
						echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["tdp"] . "</td>";
                        echo "<td>" . $row["tbg"] . "</td>";
                        echo "<td>" . $row["hdp"] . "</td>"; 
						echo "<td>" . $row["hbg"] . "</td>";
						echo "<td>" . $row["cdp"] . "</td>";
                        echo "<td>" . $row["cbg"] . "</td>";
                      
						
                        
                        echo "</tr>";
						$no++;
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }

                
                mysqli_close($koneksi);
            ?>
        </tbody>
    </table>

</body>
</html>
