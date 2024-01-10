<?php

include 'koneksi.php';


$tanggal = $shift = $keterangan = '';
$kdp = $kbg = $kpkr = $kpkn = $kskr = $kskn = $kmdkr = $kmdkn= $kmbkr = $kmbkn=  '';


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
    $kmdkr = isset($_POST['kmdkr']) ? $_POST['kmdkr'] : '';
    $kmdkn = isset($_POST['kmdkn']) ? $_POST['kmdkn'] : ''; 
	$kmbkr = isset($_POST['kmbkr']) ? $_POST['kmbkr'] : '';
    $kmbkn = isset($_POST['kmbkn']) ? $_POST['kmbkn'] : ''; 
	

    
    $sql = "INSERT INTO claim_xpander (tanggal,shift, keterangan, kdp, kbg, kpkr, kpkn, kskr, kskn, kmdkr, kmdkn,kmbkr, kmbkn)
            VALUES ('$tanggal', '$shift', '$keterangan', '$kdp', '$kbg', '$kpkr', '$kpkn', '$kskr', '$kskn', '$kmdkr', '$kmdkn','$kmbkr', '$kmbkn')";

    if ($koneksi->query($sql) === TRUE) {
        $pesan = "Data berhasil disimpan.";
        
        header("Location: stok_claim_xpander.php");
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
    <title>Form Input Stok Claim Xpander</title>
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
    <h1>Form Input Stok Claim Xpander</h1>

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
    <div style="flex: 0 0 16%; margin-right: 5%;">
        <label for="kdp">Kaca Depan:</label>
        <input type="text" id="kdp" name="kdp" value="<?php echo $kdp; ?>" >

        <label for="kbg">Kaca Bagasi:</label>
        <input type="text" id="kbg" name="kbg" value="<?php echo $kbg; ?>" >
</div>
<!-- Section 2 -->
    <div style="flex: 0 0 16%; margin-right: 5%;">
        <label for="kpkr">Kaca Penumpang Kiri:</label>
        <input type="text" id="kpkr" name="kpkr" value="<?php echo $kpkr; ?>" >

        <label for="kpkn">Kaca Penumpang Kanan:</label>
        <input type="text" id="kpkn" name="kpkn" value="<?php echo $kpkn; ?>" >
</div>
<!-- Section 2 -->
    <div style="flex: 0 0 16%; margin-right: 5%;">
        <label for="kskr">Kaca Sopir Kiri:</label>
        <input type="text" id="kskr" name="kskr" value="<?php echo $kskr; ?>" >

        <label for="kskn">Kaca Sopir Kanan:</label>
        <input type="text" id="kskn" name="kskn" value="<?php echo $kskn; ?>" >
</div>
<!-- Section 3 -->
    <div style="flex: 0 0 16%; margin-right: 5%;">
        <label for="kmkr">Kaca Mati Depan Kiri:</label>
        <input type="text" id="kmdkr" name="kmdkr" value="<?php echo $kmdkr; ?>" >

        <label for="kmkn">Kaca Mati Depan Kanan:</label>
        <input type="text" id="kmdkn" name="kmdkn" value="<?php echo $kmdkn; ?>" > 
		</div>
		<!-- Section 4 -->
    <div style="flex: 0 0 16%; ">
		<label for="kmkr">Kaca Mati Belakang Kiri:</label>
        <input type="text" id="kmbkr" name="kmbkr" value="<?php echo $kmbkr; ?>" >

        <label for="kmkn">Kaca Mati Belakang Kanan:</label>
        <input type="text" id="kmbkn" name="kmbkn" value="<?php echo $kmbkn; ?>" >
</div>
        
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
