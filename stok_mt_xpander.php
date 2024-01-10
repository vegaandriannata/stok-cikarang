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
            font-size: 12px;
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
	.filter-form select,
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
	table tfoot tr:last-child {
            background-color: #212529; /* Green color */
            color: white;
        }

		
    </style>
	
</head>
<body>

     <h1>Dashboard Stok Bahan Mentah Xpander</h1>
    <div class="button-container">
		<a href="javascript:void(0);" onclick="toggleFilterForm()">Filter</a>
		<a href="stok_mt_xpander.php" style="margin-right:1%;">Reset Filter</a>
        <a href="dashboard-stok.php"style="margin-right:1%;">Dashboard Stok</a>
        <a href="input_mt_xpander.php" style="margin-right:1%;">Input Stok</a>
		<button onclick="exportToExcel()">Export to Excel</button>
    </div>
	
	<div class="form-group">
    <form method="get" action="" class="filter-form">
    <label for="filterTanggalStart">Tanggal Mulai:</label>
    <input type="date" id="filterTanggalStart" name="filterTanggalStart">
    
    <label for="filterTanggalEnd">Tanggal Akhir:</label>
    <input type="date" id="filterTanggalEnd" name="filterTanggalEnd">
<label for="filterShift">Shift:</label>
    <select id="filterShift" name="filterShift">
        <option value="">-- All --</option>
        <option value="Pagi">Pagi</option>
        <option value="Malam">Malam</option>
    </select>
    <label for="filterKeterangan">Keterangan:</label>
    <select id="filterKeterangan" name="filterKeterangan">
        <option value="">-- All --</option>
        <option value="Stok Masuk">Stok Masuk</option>
        <option value="Stok Keluar">Stok Keluar</option>
    </select>
	
	

    <button type="submit">Filter</button>
</form>
	</div>
	<div class="button-container">
        
        <label for="showEntriesSelect">Show entries:</label>
        <select id="showEntriesSelect" onchange="showEntries()">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="250">250</option>
            <option value="500">500</option>
            <option value="-1">All</option>
        </select>

    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="2">NO</th>
				<th rowspan="2">Tanggal</th>
				<th rowspan="2">Shift</th>
				<th rowspan="2">Keterangan</th>
				<th colspan="10">Stok Mold</th>
				<th colspan="2">Stok Heating</th>
				
            </tr>
			
			
			<tr>
				<th>Depan</th>
                <th>Bagasi</th>
                <th>Sopir Kiri</th>
				<th>Sopir Kanan</th>
				<th>Penumpang Kiri</th>
				<th>Penumpang Kanan</th>
				<th>Mati Depan Kiri</th>
				<th>Mati Depan Kanan</th>
				<th>Mati Belakang Kiri</th>
				<th>Mati Belakang Kanan</th>
				<th>Depan</th>
				<th>Bagasi</th>
			</tr>
			
			
        </thead>
        <tbody>
            <?php
			$totalStokMasukMold = [
                'kdp' => 0, 'kbg' => 0, 'kpkr' => 0, 'kpkn' => 0,
                'kskr' => 0, 'kskn' => 0, 'kmdkr' => 0, 'kmdkn' => 0,
                'kmbkr' => 0, 'kmbkn' => 0
            ];
            $totalStokKeluarMold = [
                'kdp' => 0, 'kbg' => 0, 'kpkr' => 0, 'kpkn' => 0,
                'kskr' => 0, 'kskn' => 0, 'kmdkr' => 0, 'kmdkn' => 0,
                'kmbkr' => 0, 'kmbkn' => 0
            ];
            $totalStokMasukHeating = ['htdp' => 0, 'htbg' => 0];
            $totalStokKeluarHeating = ['htdp' => 0, 'htbg' => 0];
			$no = 1;
			
                
                include 'koneksi.php';

				$filterTanggalStart = isset($_GET['filterTanggalStart']) ? $_GET['filterTanggalStart'] : '';
				$filterTanggalEnd = isset($_GET['filterTanggalEnd']) ? $_GET['filterTanggalEnd'] : '';
				$filterKeterangan = isset($_GET['filterKeterangan']) ? $_GET['filterKeterangan'] : '';
				$filterShift = isset($_GET['filterShift']) ? $_GET['filterShift'] : '';
				
               $sql = "SELECT * FROM mt_xpander";

if (!empty($filterTanggalStart) && !empty($filterTanggalEnd)) {
    $sql .= " WHERE tanggal BETWEEN '$filterTanggalStart' AND '$filterTanggalEnd'";
}

if (!empty($filterKeterangan)) {
    $sql .= empty($filterTanggalStart) ? " WHERE" : " AND";
    $sql .= " keterangan = '$filterKeterangan'";
}

if (!empty($filterShift)) {
    $sql .= empty($filterTanggalStart) && empty($filterKeterangan) ? " WHERE" : " AND";
    $sql .= " shift = '$filterShift'";
}

$result = mysqli_query($koneksi, $sql);

                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
						echo "<td>" . $no . "</td>";
                        echo "<td>" . $row["tanggal"] . "</td>";
						echo "<td>" . $row["shift"] . "</td>";
						echo "<td>" . $row["keterangan"] . "</td>";
						
						if ($row["keterangan"] == "Stok Masuk") {
                        foreach ($totalStokMasukMold as $key => $value) {
                            $totalStokMasukMold[$key] += $row[$key];
                        }

                        foreach ($totalStokMasukHeating as $key => $value) {
                            $totalStokMasukHeating[$key] += $row[$key];
                        }
                    } elseif ($row["keterangan"] == "Stok Keluar") {
                        foreach ($totalStokKeluarMold as $key => $value) {
                            $totalStokKeluarMold[$key] += $row[$key];
                        }

                        foreach ($totalStokKeluarHeating as $key => $value) {
                            $totalStokKeluarHeating[$key] += $row[$key];
                        }
                    }
						
                        echo "<td>" . $row["kdp"] . "</td>";
                        echo "<td>" . $row["kbg"] . "</td>";
                        echo "<td>" . $row["kpkr"] . "</td>"; 
						echo "<td>" . $row["kpkn"] . "</td>";
						echo "<td>" . $row["kskr"] . "</td>";
                        echo "<td>" . $row["kskn"] . "</td>";
                        echo "<td>" . $row["kmdkr"] . "</td>"; 
						echo "<td>" . $row["kmdkn"] . "</td>";
						echo "<td>" . $row["kmbkr"] . "</td>"; 
						echo "<td>" . $row["kmbkn"] . "</td>";
						echo "<td>" . $row["htdp"] . "</td>"; 
						echo "<td>" . $row["htbg"] . "</td>";
                        
                        

        echo "</tr>";
        $no++;
    }
   
    

            } else {
                echo "<tr><td colspan='15'>Tidak ada data</td></tr>";
            }
                
                mysqli_close($koneksi);
            ?>
        </tbody>
		 <tfoot>
            <tr>
                <td colspan='4'>Total Stok Masuk</td>
                <?php
                foreach ($totalStokMasukMold as $value) {
                    echo "<td>$value</td>";
                }
                foreach ($totalStokMasukHeating as $value) {
                    echo "<td>$value</td>";
                }
                ?>
            </tr>
            <tr>
                <td colspan='4'>Total Stok Keluar</td>
                <?php
                foreach ($totalStokKeluarMold as $value) {
                    echo "<td>$value</td>";
                }
                foreach ($totalStokKeluarHeating as $value) {
                    echo "<td>$value</td>";
                }
                ?>
            </tr>
            <tr>
                <td colspan='4'>Total Stok Tersedia</td>
                <?php
                foreach ($totalStokMasukMold as $key => $value) {
                    $totalStokTersediaMold[$key] = $totalStokMasukMold[$key] - $totalStokKeluarMold[$key];
                    echo "<td>$totalStokTersediaMold[$key]</td>";
                }

                foreach ($totalStokMasukHeating as $key => $value) {
                    $totalStokTersediaHeating[$key] = $totalStokMasukHeating[$key] - $totalStokKeluarHeating[$key];
                    echo "<td>$totalStokTersediaHeating[$key]</td>";
                }
                ?>
            </tr>
        </tfoot>
    </table>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
<script>
        function toggleFilterForm() {
            var filterForm = document.querySelector('.filter-form');
            filterForm.style.display = (filterForm.style.display === 'none' || filterForm.style.display === '') ? 'block' : 'none';
        }
		function exportToExcel() {
        var table = document.querySelector('table');
        var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet JS" });
        XLSX.writeFile(wb, 'stok_mt_xpander.xlsx');
    }
	function showEntries() {
            var table = document.querySelector('table');
            var select = document.getElementById('showEntriesSelect');
            var selectedValue = parseInt(select.value);

            // Show all rows
            var rows = table.querySelectorAll('tbody tr');
            rows.forEach(function (row) {
                row.style.display = '';
            });

            // Hide rows based on selected value
            if (selectedValue !== -1) {
                for (var i = selectedValue; i < rows.length; i++) {
                    rows[i].style.display = 'none';
                }
            }
        }
		 document.addEventListener("DOMContentLoaded", function() {
        showEntries(10);
    });
    </script>
</body>
</html>