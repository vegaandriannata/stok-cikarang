<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username']) || (isset($_SESSION['timeout']) && time() > $_SESSION['timeout'])) {
    header("Location: login.php");
    exit();
}

$tanggal = $shift = $keterangan = $deskripsi = '';
$kdp = $kbg = $kpkr = $kpkn = $kskr = $kskn = $kmdkr = $kmdkn= $kmbkr = $kmbkn= $htdp = $htbg = '';


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
    $kmdkr = isset($_POST['kmdkr']) ? $_POST['kmdkr'] : '';
    $kmdkn = isset($_POST['kmdkn']) ? $_POST['kmdkn'] : ''; 
	$kmbkr = isset($_POST['kmbkr']) ? $_POST['kmbkr'] : '';
    $kmbkn = isset($_POST['kmbkn']) ? $_POST['kmbkn'] : ''; 
	$htdp = isset($_POST['htdp']) ? $_POST['htdp'] : '';
    $htbg = isset($_POST['htbg']) ? $_POST['htbg'] : '';

    
    $sql = "INSERT INTO mt_xpander (tanggal,shift, keterangan,deskripsi, kdp, kbg, kpkr, kpkn, kskr, kskn, kmdkr, kmdkn,kmbkr, kmbkn, htdp, htbg)
            VALUES ('$tanggal','$shift',  '$keterangan','$deskripsi', '$kdp', '$kbg', '$kpkr', '$kpkn', '$kskr', '$kskn', '$kmdkr', '$kmdkn','$kmbkr', '$kmbkn', '$htdp', '$htbg')";

    if ($koneksi->query($sql) === TRUE) {
        $pesan = "Data berhasil disimpan.";
        
        header("Location: stok_mt_xpander.php");
        exit(); 
    } else {
        $pesan = "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Stok Bahan Mentah Xpander</title>
     <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            
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
</head>
<body>
    <h1>Form Input Stok Bahan Mentah Xpander</h1>

    <?php echo $pesan;  ?>

    <form action="" method="post">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>

		<label for="shift">Shift:</label>
        <select id="shift" name="shift" required>
            <option value="Pagi" <?php echo ($shift == 'pagi') ? 'selected' : ''; ?>>Pagi</option>
            <option value="Malam" <?php echo ($shift == 'malam') ? 'selected' : ''; ?>>Malam</option>
        </select>

        <label for="keterangan">Keterangan:</label>
        <select id="keterangan" name="keterangan" required>
            <option value="Stok Masuk" <?php echo ($keterangan == 'stok_masuk') ? 'selected' : ''; ?>>Stok Masuk</option>
            <option value="Stok Keluar" <?php echo ($keterangan == 'stok_keluar') ? 'selected' : ''; ?>>Stok Keluar</option>
            <option value="Stok Masuk Dari Line" <?php echo ($keterangan == 'stok_masuk_dari_line') ? 'selected' : ''; ?>>Stok Masuk Dari Line</option>
        </select>
		
        <label for="deskripsi">Tanggal:</label>
        <input type="text" id="deskripsi" name="deskripsi" value="<?php echo $deskripsi; ?>" required>

		<p style="font-weight:bold;">Stok Mold</p>
<div style="display: flex; flex-wrap: wrap;">

    <!-- Section 1 -->
    <div style="flex: 0 0 16%; margin-right: 5%;">
        <label for="kdp">Kaca Depan:</label>
        <input type="number" id="kdp" name="kdp" value="<?php echo $kdp; ?>" required>

        <label for="kbg">Kaca Bagasi:</label>
        <input type="number" id="kbg" name="kbg" value="<?php echo $kbg; ?>" required>
    </div>

    <!-- Section 2 -->
    <div style="flex: 0 0 16%;margin-right: 5%;">
        <label for="kpkr">Kaca Penumpang Kiri:</label>
        <input type="number" id="kpkr" name="kpkr" value="<?php echo $kpkr; ?>" required>

        <label for="kpkn">Kaca Penumpang Kanan:</label>
        <input type="number" id="kpkn" name="kpkn" value="<?php echo $kpkn; ?>" required>
    </div>

    <!-- Section 3 -->
    <div style="flex: 0 0 16%; margin-right: 5%;">
        <label for="kskr">Kaca Sopir Kiri:</label>
        <input type="number" id="kskr" name="kskr" value="<?php echo $kskr; ?>" required>

        <label for="kskn">Kaca Sopir Kanan:</label>
        <input type="number" id="kskn" name="kskn" value="<?php echo $kskn; ?>" required>
    </div>

    <!-- Section 4 -->
    <div style="flex: 0 0 16%;margin-right: 5%;">
        <label for="kmdkr">Kaca Mati Depan Kiri:</label>
        <input type="number" id="kmdkr" name="kmdkr" value="<?php echo $kmdkr; ?>" required>

        <label for="kmdkn">Kaca Mati Depan Kanan:</label>
        <input type="number" id="kmdkn" name="kmdkn" value="<?php echo $kmdkn; ?>" required>
    </div>

    <!-- Section 5 -->
    <div style="flex: 0 0 16%;">
        <label for="kmbkr">Kaca Mati Belakang Kiri:</label>
        <input type="number" id="kmbkr" name="kmbkr" value="<?php echo $kmbkr; ?>" required>

        <label for="kmbkn">Kaca Mati Belakang Kanan:</label>
        <input type="number" id="kmbkn" name="kmbkn" value="<?php echo $kmbkn; ?>" required>
    </div>
</div>
        <p style="font-weight:bold;">Stok Heating</p>
        <label for="htdp">Kaca Depan:</label>
        <input type="number" id="htdp" name="htdp" value="<?php echo $htdp; ?>" required>

        <label for="htbg">Kaca Bagasi:</label>
        <input type="number" id="htbg" name="htbg" value="<?php echo $htbg; ?>" required>
		
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
