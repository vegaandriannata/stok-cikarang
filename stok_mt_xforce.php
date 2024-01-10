<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Stok Heating</title>
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

    <h1>Dashboard Stok Bahan Mentah Xforce</h1>
    <div class="button-container">
	<a href="javascript:void(0);" onclick="toggleFilterForm()">Filter</a>
		<a href="stok_mt_xforce.php">Reset Filter</a>
        <a href="dashboard-stok.php">Dashboard Stok</a>
        <a href="input_mt_xforce.php">Input Stok Bahan Mentah Xforce</a>
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
                <th rowspan="2">NO</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Shift</th>
                <th rowspan="2">Keterangan</th>
                <th colspan="8">Stok Mold</th>
                <th colspan="2">Stok Heating</th>
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
                <th>Depan</th>
                <th>Bagasi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            include 'koneksi.php';

            $totalStokMasukMold = [
                'kdp' => 0, 'kbg' => 0, 'kpkr' => 0, 'kpkn' => 0,
                'kskr' => 0, 'kskn' => 0, 'kmkr' => 0, 'kmkn' => 0
            ];
            $totalStokKeluarMold = [
                'kdp' => 0, 'kbg' => 0, 'kpkr' => 0, 'kpkn' => 0,
                'kskr' => 0, 'kskn' => 0, 'kmkr' => 0, 'kmkn' => 0
            ];
            $totalStokMasukHeating = ['htdp' => 0, 'htbg' => 0];
            $totalStokKeluarHeating = ['htdp' => 0, 'htbg' => 0];


			$filterTanggalStart = isset($_GET['filterTanggalStart']) ? $_GET['filterTanggalStart'] : '';
			$filterTanggalEnd = isset($_GET['filterTanggalEnd']) ? $_GET['filterTanggalEnd'] : '';
            $sql = "SELECT * FROM mt_xforce";
			
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
                    echo "<td>" . $row["kmkr"] . "</td>";
                    echo "<td>" . $row["kmkn"] . "</td>";
                    echo "<td>" . $row["htdp"] . "</td>";
                    echo "<td>" . $row["htbg"] . "</td>";

                    echo "</tr>";
                    $no++;
                }

               
                echo "<tr>";
                echo "<td colspan='4'>Total Stok Masuk</td>";
                foreach ($totalStokMasukMold as $value) {
                    echo "<td>$value</td>";
                }
                foreach ($totalStokMasukHeating as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";

                echo "<tr>";
                echo "<td colspan='4'>Total Stok Keluar</td>";
                foreach ($totalStokKeluarMold as $value) {
                    echo "<td>$value</td>";
                }
                foreach ($totalStokKeluarHeating as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            } else {
                echo "<tr><td colspan='15'>Tidak ada data</td></tr>";
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
