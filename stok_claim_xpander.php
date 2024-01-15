<?php
session_start();
include 'koneksi.php';
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
$userName = $_SESSION['username'];	

$teknisi_options = ''; // Variable to store technician options

// Fetch technician names from the database
$sql_teknisi = "SELECT nama_teknisi FROM teknisi";
$result_teknisi = $koneksi->query($sql_teknisi);

if ($result_teknisi->num_rows > 0) {
    while ($row_teknisi = $result_teknisi->fetch_assoc()) {
        $teknisi_name = $row_teknisi['nama_teknisi'];
        $teknisi_options .= "<option value='$teknisi_name'>$teknisi_name</option>";
    }
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
            padding: 7px;
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
	<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        font-size: 14px;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-color: #f4f4f4; /* Light gray background color */
    }

    h1 {
        text-align: center;
        margin: 20px 0;
    }

    .container {
        display: flex;
        flex: 1;
    }

    .sidebar {
        background-color: #344; /* Dark background color */
        padding: 20px;
        min-width: 200px;
        box-sizing: border-box;
        color: white;
    }
    .header {
        background-color: #333; /* Dark background color */
        padding: 10px;
        min-width: 200px;
        box-sizing: border-box;
        color: white;
    }

    .menu a {
        text-decoration: none;
        padding: 10px;
        color: white;
        border-radius: 5px;
        margin-bottom: 10px;
        display: block;
        transition: background-color 0.3s;
    }

    .menu a:hover {
        background-color: #555; /* Slightly darker color on hover */
    }

    .logout {
        text-align: center;
        margin-top: auto;
    }

    .logout a {
        text-decoration: none;
        padding: 10px;
        background-color: #d32f2f; /* Red color for logout button */
        color: white;
        border-radius: 5px;
        display: block;
        transition: background-color 0.3s;
    }

    .logout a:hover {
        background-color: #b71c1c; /* Slightly darker red on hover */
    }

    .content {
        padding: 20px;
        flex: 1;
        background-color: white; /* White background color for content */
    }
	.stok-masuk {
    background-color: #00FF00; /* Green color for "Stok Masuk" */
}

.stok-keluar {
    background-color: #FF0000; /* Red color for "Stok Keluar" */
}
.inner-header {
            display: flex;
            justify-content: space-between;
			align-items: center;
        }
.inner-header {
        background-color: #fff; /* Dark background color */
       
        box-sizing: border-box;
        color: #000;
    }
	
	
        .inner-header h2,
        .inner-header h3,
		.inner-header h3 img {
            margin-right: 10px;
        }
		.inner-header h3 {
            display: flex;
            align-items: center;
        }

        .inner-header h3 img {
            margin-right: 10px; /* Adjust the margin as needed */
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Dashboard Laporan Stok</h1>
</div>
<div class="container">

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="menu">
                <a href="stok_mt_xpander.php?produk=xpander&jenis=bahan_mentah">Stok Gudang Xpander</a>
                <a href="stok_mt_xforce.php?produk=xforce&jenis=bahan_mentah">Stok Gudang Xforce</a>
                <a href="stok_claim_xpander.php">Stok Claim Xpander</a>
                <a href="stok_claim_xforce.php">Stok Claim Xforce</a>
                <a href="stok_ht_xpander.php?produk=xpander&jenis=heating">Stok Heating Xpander</a>
                <a href="stok_ht_xforce.php?produk=xforce&jenis=heating">Stok Heating Xforce</a>
                <a href="list_teknisi.php">List Teknisi</a>
                <a href="list_admin.php">List Admin</a>
            </div>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </div>
		<div class="content">
   <div class="inner-header">
<div>
     <h2>Dashboard Stok Claim Xpander </h2>
	 </div>
	 
	 <div class="inner-header">
		
        <h3><img style="max-width:30px; "src="asset/image/profile1.png"><?php echo $userName; ?></h3>
    </div>
	  </div>
    <div class="button-container">
	<a href="javascript:void(0);" onclick="toggleFilterForm()">Filter</a>
		<a href="stok_claim_xpander.php"style="margin-right:1%;">Reset Filter</a>
        <a href="input_claim_xpander.php"style="margin-right:1%;">Input Stok </a>
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
	<label for="filterNama">Nama Teknisi:</label>
<select id="filterNama" name="filterNama">
    <option value="">-- All --</option>
    <?php echo $teknisi_options; ?>
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
	<label for="filterTipeMobil">Tipe Mobil:</label>
    <select id="filterTipeMobil" name="filterTipeMobil">
        <option value="">-- All --</option>
		<option value="Xpander">Xpander</option>
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
				<th rowspan="2">Nama <br> Teknisi</th>
				<th rowspan="2">Tipe <br> Mobil</th>
				<th rowspan="2">No <br> Rangka</th>
                <th colspan="10">Claim</th>
            </tr>

            <tr>
                <th>Depan</th>
                <th>Bagasi</th>
                <th>Sopir Kiri</th>
                <th>Sopir Kanan</th>
                <th>Penumpang <br> Kiri</th>
                <th>Penumpang <br> Kanan</th>
                <th>Mati <br> Depan <br> Kiri</th>
                <th>Mati<br> Depan <br> Kanan</th>
                <th>Mati<br> Belakang <br> Kiri</th>
                <th>Mati <br>Belakang <br> Kanan</th>
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
			$filterLine = isset($_GET['filterLine']) ? $_GET['filterLine'] : ''; 
			$filterTipeMobil = isset($_GET['filterTipeMobil']) ? $_GET['filterTipeMobil'] : ''; 
			$filterNama = isset($_GET['filterNama']) ? $_GET['filterNama'] : '';

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
			if (!empty($filterTipeMobil)) {
				$sql .= (empty($filterTanggalStart) && empty($filterKeterangan) && empty($filterShift) && empty($filterStatus)&& empty($filterLine)) ? " WHERE" : " AND";
				$sql .= " tipe_mobil = '$filterTipeMobil'";
			}
			if (!empty($filterNama)) {
    $sql .= (empty($filterTanggalStart) && empty($filterKeterangan) && empty($filterShift) && empty($filterStatus) && empty($filterLine) && empty($filterTipeMobil)) ? " WHERE" : " AND";
    $sql .= " nama_teknisi = '$filterNama'";
}


			$result = mysqli_query($koneksi, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    if ($row["keterangan"] == "Stok Masuk") {
						echo "<td class='stok-masuk'>" . $no . "</td>";
					} elseif ($row["keterangan"] == "Stok Keluar") {
						echo "<td class='stok-keluar'>" . $no . "</td>";
					}elseif ($row["keterangan"] == "Stok Masuk Dari Line") {
						echo "<td class='stok-masuk-dari-line'>" . $no . "</td>";
					}
                    echo "<td>" . $row["tanggal"] . "</td>";
                    echo "<td>" . $row["shift"] . "</td>";
                    echo "<td>" . $row["keterangan"] . "</td>";
					echo "<td>" . $row["status"] . "</td>";
					echo "<td>" . $row["line"] . "</td>";
					echo "<td>" . $row["nama_teknisi"] . "</td>";
					echo "<td>" . $row["tipe_mobil"] . "</td>";
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
                <td colspan='9'>Total Stok Masuk</td>
                <?php
                foreach ($totalStokMasukClaim as $value) {
                    echo "<td>$value</td>";
                }
               
                ?>
            </tr>
            <tr>
                <td colspan='9'>Total Stok Keluar</td>
                <?php
                foreach ($totalStokKeluarClaim as $value) {
                    echo "<td>$value</td>";
                }
                
                ?>
            </tr>
            <tr>
                <td colspan='9'>Total Stok Tersedia</td>
                <?php
                foreach ($totalStokMasukClaim as $key => $value) {
                    $totalStokTersediaClaim[$key] = $totalStokMasukClaim[$key] - $totalStokKeluarClaim[$key];
                    echo "<td>$totalStokTersediaClaim[$key]</td>";
                }
                ?>
            </tr>
        </tfoot>
    </table>
	<div class="button-container">
    <!-- Add pagination buttons -->
    <button onclick="prevPage()">Previous</button>
    <button onclick="nextPage()">Next</button>

    
</div>
	</div>
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
	var currentPage = 1;
    var rowsPerPage = 10;
    var totalRows = 0;

    function showPage(page) {
        var table = document.querySelector('table');
        var rows = table.querySelectorAll('tbody tr');

        totalRows = rows.length;

        var startIndex = (page - 1) * rowsPerPage;
        var endIndex = startIndex + rowsPerPage;

        for (var i = 0; i < totalRows; i++) {
            if (i >= startIndex && i < endIndex) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }

        // Update pagination buttons
        updatePaginationButtons(page);
    }

    function updatePaginationButtons(currentPage) {
        var prevButton = document.querySelector('.button-container button:first-child');
        var nextButton = document.querySelector('.button-container button:last-child');

        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === Math.ceil(totalRows / rowsPerPage);
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    }

    function nextPage() {
        if (currentPage < Math.ceil(totalRows / rowsPerPage)) {
            currentPage++;
            showPage(currentPage);
        }
    }

    function showEntries() {
        var select = document.getElementById('showEntriesSelect');
        var selectedValue = parseInt(select.value);

        rowsPerPage = selectedValue;

        // Reset to the first page
        currentPage = 1;
        showPage(currentPage);
    }

    document.addEventListener("DOMContentLoaded", function () {
        // Initialize pagination
        showPage(currentPage);
    });
    </script>

</body>
</html>
