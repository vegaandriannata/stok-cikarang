<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username']) || (isset($_SESSION['timeout']) && time() > $_SESSION['timeout'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stok Claim Xpander</title>
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
		font-size: 12px;
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
		.button-container a.logout {
    background-color: #f44336;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
}

.button-container a.logout:hover {
    background-color: #d32f2f;
}
    </style>
</head>
<body>

    <h1>Dashboard Stok Claim Xpander</h1>
    <div class="button-container">
	<a href="javascript:void(0);" onclick="toggleFilterForm()">Filter</a>
		<a href="stok_claim_xpander.php"style="margin-right:1%;">Reset Filter</a>
        <a href="dashboard-stok.php"style="margin-right:1%;">Dashboard Stok</a>
        <a href="input_claim_xpander.php"style="margin-right:1%;">Input Stok </a>
		<button onclick="exportToExcel()">Export to Excel</button>
		<a href="?logout" class="logout">Logout</a>
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
	<label for="filterStatus">Status:</label>
    <select id="filterStatus" name="filterStatus">
        <option value="">-- All --</option>
        <option value="Claim">Claim</option>
        <option value="Reject">Reject</option>
    </select>
	<label for="filterLine">Line:</label>
    <select id="filterLine" name="filterLine">
        <option value="">-- All --</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6	</option>
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
				<th rowspan="2">Status</th>
				<th rowspan="2">Line</th>
				<th rowspan="2">Nama Teknisi</th>
				<th rowspan="2">No Ranka</th>
                <th colspan="10">Claim</th>
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
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            include 'koneksi.php';

            
            $totalStokMasukClaim = [
                'kdp' => 0, 'kbg' => 0, 'kpkr' => 0, 'kpkn' => 0,
                'kskr' => 0, 'kskn' => 0, 'kmdkr' => 0, 'kmdkn' => 0,
                'kmbkr' => 0, 'kmbkn' => 0
            ];

            $totalStokKeluarClaim = [
                'kdp' => 0, 'kbg' => 0, 'kpkr' => 0, 'kpkn' => 0,
                'kskr' => 0, 'kskn' => 0, 'kmdkr' => 0, 'kmdkn' => 0,
                'kmbkr' => 0, 'kmbkn' => 0
            ];
			$filterTanggalStart = isset($_GET['filterTanggalStart']) ? $_GET['filterTanggalStart'] : '';
			$filterTanggalEnd = isset($_GET['filterTanggalEnd']) ? $_GET['filterTanggalEnd'] : '';
			$filterKeterangan = isset($_GET['filterKeterangan']) ? $_GET['filterKeterangan'] : '';
			$filterShift = isset($_GET['filterShift']) ? $_GET['filterShift'] : '';
			$filterStatus = isset($_GET['filterStatus']) ? $_GET['filterStatus'] : '';
			$filterLine = isset($_GET['filterLine']) ? $_GET['filterLine'] : ''; // Perbaikan pada filterLine
			$sql = "SELECT * FROM claim_xpander";

			if (!empty($filterTanggalStart) && !empty($filterTanggalEnd)) {
				$sql .= " WHERE tanggal BETWEEN '$filterTanggalStart' AND '$filterTanggalEnd'";
			}

			if (!empty($filterKeterangan)) {
				$sql .= empty($filterTanggalStart) ? " WHERE" : " AND";
				$sql .= " keterangan = '$filterKeterangan'";
			}

			if (!empty($filterShift)) {
				$sql .= (empty($filterTanggalStart) && empty($filterKeterangan)) ? " WHERE" : " AND";
				$sql .= " shift = '$filterShift'";
			}

			if (!empty($filterStatus)) {
				$sql .= (empty($filterTanggalStart) && empty($filterKeterangan) && empty($filterShift)) ? " WHERE" : " AND";
				$sql .= " status = '$filterStatus'";
			}

			if (!empty($filterLine)) {
				$sql .= (empty($filterTanggalStart) && empty($filterKeterangan) && empty($filterShift) && empty($filterStatus)) ? " WHERE" : " AND";
				$sql .= " line = '$filterLine'";
			}

			$result = mysqli_query($koneksi, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row["tanggal"] . "</td>";
                    echo "<td>" . $row["shift"] . "</td>";
                    echo "<td>" . $row["keterangan"] . "</td>";
					echo "<td>" . $row["status"] . "</td>";
					echo "<td>" . $row["line"] . "</td>";
					echo "<td>" . $row["nama_teknisi"] . "</td>";
					echo "<td>" . $row["no_rangka"] . "</td>";

                    if ($row["keterangan"] == "Stok Masuk") {
                        foreach ($totalStokMasukClaim as $key => $value) {
                            $totalStokMasukClaim[$key] += $row[$key];
                        }
                    } elseif ($row["keterangan"] == "Stok Keluar") {
                        foreach ($totalStokKeluarClaim as $key => $value) {
                            $totalStokKeluarClaim[$key] += $row[$key];
                        }
                    }

                    echo "<td>" . $row["kdp"] 	. " " .$row["alasan_kdp"] . "</td>";
                    echo "<td>" . $row["kbg"] 	. " ".$row["alasan_kbg"] . "</td>";
                    echo "<td>" . $row["kpkr"] 	. " ".$row["alasan_kpkr"] . "</td>";
                    echo "<td>" . $row["kpkn"]	. " ".$row["alasan_kpkn"] . "</td>";
                    echo "<td>" . $row["kskr"] 	. " ".$row["alasan_kskr"] . "</td>";
                    echo "<td>" . $row["kskn"] 	. " ".$row["alasan_kskn"] . "</td>";
                    echo "<td>" . $row["kmdkr"] . " ".$row["alasan_kmdkr"] . "</td>";
                    echo "<td>" . $row["kmdkn"] . " ".$row["alasan_kmdkn"] . "</td>";
                    echo "<td>" . $row["kmbkr"] . " ".$row["alasan_kmbkr"] . "</td>";
                    echo "<td>" . $row["kmbkn"] . " ".$row["alasan_kmbkn"] . "</td>";

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
                <td colspan='8'>Total Stok Masuk</td>
                <?php
                foreach ($totalStokMasukClaim as $value) {
                    echo "<td>$value</td>";
                }
               
                ?>
            </tr>
            <tr>
                <td colspan='8'>Total Stok Keluar</td>
                <?php
                foreach ($totalStokKeluarClaim as $value) {
                    echo "<td>$value</td>";
                }
                
                ?>
            </tr>
            <tr>
                <td colspan='8'>Total Stok Tersedia</td>
                <?php
                foreach ($totalStokMasukClaim as $key => $value) {
                    $totalStokTersediaClaim[$key] = $totalStokMasukClaim[$key] - $totalStokKeluarClaim[$key];
                    echo "<td>$totalStokTersediaClaim[$key]</td>";
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
        XLSX.writeFile(wb, 'stok_claim_xpander.xlsx');
    }
	function showEntries() {
            var table = document.querySelector('table');
            var select = document.getElementById('showEntriesSelect');
            var selectedValue = parseInt(select.value);

            
            var rows = table.querySelectorAll('tbody tr');
            rows.forEach(function (row) {
                row.style.display = '';
            });

            
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
