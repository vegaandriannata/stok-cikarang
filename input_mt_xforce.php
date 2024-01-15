<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username']) || (isset($_SESSION['timeout']) && time() > $_SESSION['timeout'])) {
    header("Location: login.php");
    exit();
}

$tanggal = $shift = $keterangan = $deskripsi = '';
$kdp = $kbg = $kpkr = $kpkn = $kskr = $kskn = $kmkr = $kmkn= $htdp = $htbg = '';


$pesan = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
    $shift = isset($_POST['shift']) ? $_POST['shift'] : '';
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
	$kdp = isset($_POST['kdp']) ? $_POST['kdp'] : '';
    $kbg = isset($_POST['kbg']) ? $_POST['kbg'] : '';
    $kpkr = isset($_POST['kpkr']) ? $_POST['kpkr'] : '';
    $kpkn = isset($_POST['kpkn']) ? $_POST['kpkn'] : '';
    $kskr = isset($_POST['kskr']) ? $_POST['kskr'] : '';
    $kskn = isset($_POST['kskn']) ? $_POST['kskn'] : '';
    $kmkr = isset($_POST['kmkr']) ? $_POST['kmkr'] : '';
    $kmkn = isset($_POST['kmkn']) ? $_POST['kmkn'] : ''; 
	$htdp = isset($_POST['htdp']) ? $_POST['htdp'] : '';
    $htbg = isset($_POST['htbg']) ? $_POST['htbg'] : '';
	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $sql_insert = "INSERT INTO mt_xforce (tanggal,shift, keterangan,deskripsi, kdp, kbg, kpkr, kpkn, kskr, kskn, kmkr, kmkn, htdp, htbg)
            VALUES ('$tanggal','$shift',  '$keterangan','$deskripsi', '$kdp', '$kbg', '$kpkr', '$kpkn', '$kskr', '$kskn', '$kmkr', '$kmkn', '$htdp', '$htbg')";

    if ($koneksi->query($sql_insert) === TRUE) {
        $pesan = "Data berhasil disimpan.";

        // Insert data into histori_admin table
        $admin_username = $_SESSION['username'];
        $action = "insert"; 
        $admin_data = $tanggal . '+' . $shift . '+' . $keterangan . '+' . $deskripsi. '+' . $kdp. '+' . $kbg. '+' . $kpkr. '+' . $kpkn. '+' . $kskr. '+' . $kskn. '+' . $kmkr. '+' . $kmkr. '+' . $htdp. '+' . $htbg;
        $tanggal_input = date("Y-m-d H:i:s");

        $sql_history = $koneksi->prepare("INSERT INTO histori_activity (user, action, data, tanggal, url) VALUES (?, ?, ?, ?, ?)");
        $sql_history->bind_param("sssss", $admin_username, $action, $admin_data, $tanggal_input, $url);

        if ($sql_history->execute()) {
            echo "History inserted successfully";
        } else {
            echo "Error inserting history: " . $sql_history->error;
        }

        header("Location: stok_mt_xforce.php");
        exit(); 
    } else {
        $pesan = "Error: " . $sql_insert . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Stok Bahan Mentah Xforce</title>
      <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            max-width: 100%;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
    <h1>Form Input Stok Bahan Mentah Xforce</h1>

    <?php echo $pesan;  ?>

    <form action="" method="post">
	 <!-- Section 1 -->
	 <div style="display: flex; flex-wrap: wrap;">
    <div style="flex: 0 0 32%; margin-right: 2%;">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>
</div>

    <!-- Section 2 -->
    <div style="flex: 0 0 32%;margin-right: 2%;">
		 <label for="shift">Shift:</label>
        <select id="shift" name="shift" required>
            <option value="Pagi" <?php echo ($shift == 'pagi') ? 'selected' : ''; ?>>Pagi</option>
            <option value="Malam" <?php echo ($shift == 'malam') ? 'selected' : ''; ?>>Malam</option>
        </select>
</div>

    <!-- Section 2 -->
    <div style="flex: 0 0 32%;">
        <label for="keterangan">Keterangan:</label>
        <select id="keterangan" name="keterangan" required>
            <option value="Stok Masuk" <?php echo ($keterangan == 'Stok Masuk') ? 'selected' : ''; ?>>Stok Masuk</option>
            <option value="Stok Keluar" <?php echo ($keterangan == 'Stok Keluar') ? 'selected' : ''; ?>>Stok Keluar</option>
            <option value="Stok Masuk Dari Line" <?php echo ($keterangan == 'Stok Masuk Dari Line') ? 'selected' : ''; ?>>Stok Masuk Dari Line</option>
        </select>
		</div>
        </div>
		<label for="deskripsi">Deskripsi:</label>
        <input type="text" id="deskripsi" name="deskripsi" value="<?php echo $deskripsi; ?>" >

		<p>Stok Mold</p>
		<div style="display: flex; flex-wrap: wrap;">

    <!-- Section 1 -->
    <div style="flex: 0 0 22%; margin-right: 4%;">
        <label for="kdp">Kaca Depan:</label>
        <input type="number" id="kdp" name="kdp" value="<?php echo $kdp; ?>" required>

        <label for="kbg">Kaca Bagasi:</label>
        <input type="number" id="kbg" name="kbg" value="<?php echo $kbg; ?>" required>
</div>
<!-- Section 2 -->
    <div style="flex: 0 0 22%;margin-right: 4%;">
        <label for="kpkr">Kaca Penumpang Kiri:</label>
        <input type="number" id="kpkr" name="kpkr" value="<?php echo $kpkr; ?>" required>

        <label for="kpkn">Kaca Penumpang Kanan:</label>
        <input type="number" id="kpkn" name="kpkn" value="<?php echo $kpkn; ?>" required>
</div>
<!-- Section 3 -->
    <div style="flex: 0 0 22%; margin-right: 4%;">
        <label for="kskr">Kaca Sopir Kiri:</label>
        <input type="number" id="kskr" name="kskr" value="<?php echo $kskr; ?>" required>

        <label for="kskn">Kaca Sopir Kanan:</label>
        <input type="number" id="kskn" name="kskn" value="<?php echo $kskn; ?>" required>
</div>
<!-- Section 4 -->
    <div style="flex: 0 0 22%;">
        <label for="kmkr">Kaca Mati Kiri:</label>
        <input type="number" id="kmkr" name="kmkr" value="<?php echo $kmkr; ?>" required>

        <label for="kmkn">Kaca Mati Kanan:</label>
        <input type="number" id="kmkn" name="kmkn" value="<?php echo $kmkn; ?>" required>
 </div>
</div>
        <p>Stok Heating</p>
        <label for="htdp">Kaca Depan:</label>
        <input type="number" id="htdp" name="htdp" value="<?php echo $htdp; ?>" required>

        <label for="htbg">Kaca Bagasi:</label>
        <input type="number" id="htbg" name="htbg" value="<?php echo $htbg; ?>" required>
		
        <input type="submit" value="Simpan">
    </form>
	</div>
</body>
</html>
