<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stok Mingguan Heating</title>
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
		.filter-form {
        display: flex; /* Use flexbox to create a horizontal layout */
		display: none;
        align-items: center; /* Align items vertically in the center */
        margin-top: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .filter-form label {
        flex: 1; /* Distribute available space equally among labels */
        text-align: right;
        margin-right: 10px; /* Add some right margin for separation */
    }

    .filter-form input,
    .filter-form button {
        flex: 2; /* Distribute available space equally among inputs and button */
        padding: 8px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    .filter-form button {
        margin-left: 10px; /* Add some left margin for separation from the input */
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .filter-form button:hover {
        background-color: #45a049;
    }
    </style>
</head>
<body>

    <h1>Dashboard Stok Heating Mingguan Xforce</h1>
	<div class="button-container">
	<a href="javascript:void(0);" onclick="toggleFilterForm()">Filter</a>
		<a href="stok_ht_xforce.php">Reset Filter</a>
	<a href="dashboard-stok.php">Dashboard Stok</a>
	
        <a href="input_ht_xforce.php">Input Stok HT Xforce</a>
		
    </div>
	<div class="form-group">
    <form method="get" action="" class="filter-form">
        <label for="filterTanggalStart">Filter Tanggal Mulai:</label>
        <input type="date" id="filterTanggalStart" name="filterTanggalStart">
        
        <label for="filterTanggalEnd">Filter Tanggal Akhir:</label>
        <input type="date" id="filterTanggalEnd" name="filterTanggalEnd">

        <button type="submit">Filter</button>
    </form>
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
				<th colspan="6">Xforce</th>
                
			</tr>
			
			<tr>
				<th colspan="2">Terima</th>
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


				// Inisialisasi array total stok
				$totalTerimaDepan = 0;
				$totalTerimaBagasi = 0;
				$totalHasilDepan = 0;
				$totalHasilBagasi = 0;
				$totalClaimDepan = 0;
				$totalClaimBagasi = 0;
			
			$filterTanggalStart = isset($_GET['filterTanggalStart']) ? $_GET['filterTanggalStart'] : '';
			$filterTanggalEnd = isset($_GET['filterTanggalEnd']) ? $_GET['filterTanggalEnd'] : '';
                $sql = "SELECT * FROM ht_xforce";
				if (!empty($filterTanggalStart) && !empty($filterTanggalEnd)) {
        $sql .= " WHERE tanggal BETWEEN '$filterTanggalStart' AND '$filterTanggalEnd'";
    }
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
                      
					// Update nilai total stock  
					$totalTerimaDepan += $row["tdp"];
                    $totalTerimaBagasi += $row["tbg"];
                    $totalHasilDepan += $row["hdp"];
                    $totalHasilBagasi += $row["hbg"];
                    $totalClaimDepan += $row["cdp"];
                    $totalClaimBagasi += $row["cbg"];
                        
                        echo "</tr>";
						$no++;
                    }
				// Menampilkan total stock rows
				echo "<tr>";
                echo "<td colspan='4'>Total Stok Akhir</td>";
                echo "<td>$totalTerimaDepan</td>";
                echo "<td>$totalTerimaBagasi</td>";
                
                echo "<td>$totalHasilDepan</td>";
                echo "<td>$totalHasilBagasi</td>";
               
                echo "<td>$totalClaimDepan</td>";
                echo "<td>$totalClaimBagasi</td>";
                echo "</tr>";
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }

                
                mysqli_close($koneksi);
            ?>
        </tbody>
    </table>
<script>
        function toggleFilterForm() {
            var filterForm = document.querySelector('.filter-form');
            filterForm.style.display = (filterForm.style.display === 'none' || filterForm.style.display === '') ? 'block' : 'none';
        }
    </script>
</body>
</html>
