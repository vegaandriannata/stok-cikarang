<?php

include 'koneksi.php';


$tanggal = $shift = $keterangan = '';
$kdp = $kbg = $kpkr = $kpkn = $kskr = $kskn = $kmkr = $kmkn=  '';


$pesan = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
    $shift = isset($_POST['shift']) ? $_POST['shift'] : '';
	$kdp = isset($_POST['kdp']) ? $_POST['kdp'] : '';
    $kbg = isset($_POST['kbg']) ? $_POST['kbg'] : '';
    $kpkr = isset($_POST['kpkr']) ? $_POST['kpkr'] : '';
    $kpkn = isset($_POST['kpkn']) ? $_POST['kpkn'] : '';
    $kskr = isset($_POST['kskr']) ? $_POST['kskr'] : '';
    $kskn = isset($_POST['kskn']) ? $_POST['kskn'] : '';
    $kmkr = isset($_POST['kmkr']) ? $_POST['kmkr'] : '';
    $kmkn = isset($_POST['kmkn']) ? $_POST['kmkn'] : ''; 
	

    
    $sql = "INSERT INTO claim_xforce (tanggal,shift, keterangan, kdp, kbg, kpkr, kpkn, kskr, kskn, kmkr, kmkn)
            VALUES ('$tanggal','$shift',  '$keterangan', '$kdp', '$kbg', '$kpkr', '$kpkn', '$kskr', '$kskn', '$kmkr', '$kmkn')";

    if ($koneksi->query($sql) === TRUE) {
        $pesan = "Data berhasil disimpan.";
        
        header("Location: stok_claim_xforce.php");
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
</head>
<body>
    <h1>Form Input Stok Claim Xforce</h1>

    <?php echo $pesan;  ?>

    <form action="" method="post">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>

		<label for="shift">Shift:</label>
        <select id="shift" name="shift" required>
            <option value="Pagi" <?php echo ($shift == 'Pagi') ? 'selected' : ''; ?>>Pagi</option>
            <option value="Malam" <?php echo ($shift == 'Malam') ? 'selected' : ''; ?>>Malam</option>
        </select>

        <label for="keterangan">Keterangan:</label>
        <select id="keterangan" name="keterangan" required>
            <option value="Stok Masuk" <?php echo ($keterangan == 'Stok Masuk') ? 'selected' : ''; ?>>Stok Masuk</option>
            <option value="Stok Keluar" <?php echo ($keterangan == 'Stok Keluar') ? 'selected' : ''; ?>>Stok Keluar</option>
        </select>

		<p>Stok Mold</p>
		<div style="display: flex; flex-wrap: wrap;">

    <!-- Section 1 -->
    <div style="flex: 0 0 22%; margin-right: 4%;">
        <label for="kdp">Kaca Depan:</label>
        <input type="text" id="kdp" name="kdp" value="<?php echo $kdp; ?>" required>

        <label for="kbg">Kaca Bagasi:</label>
        <input type="text" id="kbg" name="kbg" value="<?php echo $kbg; ?>" required>
</div>
<!-- Section 2 -->
    <div style="flex: 0 0 22%; margin-right: 4%;">
        <label for="kpkr">Kaca Penumpang Kiri:</label>
        <input type="text" id="kpkr" name="kpkr" value="<?php echo $kpkr; ?>" required>

        <label for="kpkn">Kaca Penumpang Kanan:</label>
        <input type="text" id="kpkn" name="kpkn" value="<?php echo $kpkn; ?>" required>
</div>
<!-- Section 3 -->
    <div style="flex: 0 0 22%; margin-right: 4%;">
        <label for="kskr">Kaca Sopir Kiri:</label>
        <input type="text" id="kskr" name="kskr" value="<?php echo $kskr; ?>" required>

        <label for="kskn">Kaca Sopir Kanan:</label>
        <input type="text" id="kskn" name="kskn" value="<?php echo $kskn; ?>" required>
</div>
<!-- Section 4 -->
    <div style="flex: 0 0 22%; ">
        <label for="kmkr">Kaca Mati Kiri:</label>
        <input type="text" id="kmkr" name="kmkr" value="<?php echo $kmkr; ?>" required>

        <label for="kmkn">Kaca Mati Kanan:</label>
        <input type="text" id="kmkn" name="kmkn" value="<?php echo $kmkn; ?>" required>
</div>
        
		
        <input type="submit" value="Simpan">
    </form>
</body>
</html>