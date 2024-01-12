<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username']) || (isset($_SESSION['timeout']) && time() > $_SESSION['timeout'])) {
    header("Location: login.php");
    exit();
}

$tanggal = $shift = $line = $keterangan = $status = $no_rangka = '';
$kdp = $kbg = $kpkr = $kpkn = $kskr = $kskn =  $kmkr = $kmkn=  '';
$alasan_kdp = $alasan_kbg = $alasan_kpkr = $alasan_kpkn = $alasan_kskr = $alasan_kskn =  $alasan_kmkr = $alasan_kmkn=  '';


$pesan = '';

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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
	$status = isset($_POST['status']) ? $_POST['status'] : '';
	$no_rangka = isset($_POST['no_rangka']) ? $_POST['no_rangka'] : '';
    $shift = isset($_POST['shift']) ? $_POST['shift'] : '';
	$line = isset($_POST['line']) ? $_POST['line'] : '';
	$kdp = isset($_POST['kdp']) ? $_POST['kdp'] : '';
    $kbg = isset($_POST['kbg']) ? $_POST['kbg'] : '';
    $kpkr = isset($_POST['kpkr']) ? $_POST['kpkr'] : '';
    $kpkn = isset($_POST['kpkn']) ? $_POST['kpkn'] : '';
    $kskr = isset($_POST['kskr']) ? $_POST['kskr'] : '';
    $kskn = isset($_POST['kskn']) ? $_POST['kskn'] : '';
    
	$kmkr = isset($_POST['kmkr']) ? $_POST['kmkr'] : '';
    $kmkn = isset($_POST['kmkn']) ? $_POST['kmkn'] : ''; 
	
	$alasan_kdp = isset($_POST['alasan_kdp']) ? $_POST['alasan_kdp'] : '';
	$alasan_kbg = isset($_POST['alasan_kbg']) ? $_POST['alasan_kbg'] : '';
	$alasan_kpkr = isset($_POST['alasan_kpkr']) ? $_POST['alasan_kpkr'] : '';
	$alasan_kpkn = isset($_POST['alasan_kpkn']) ? $_POST['alasan_kpkn'] : '';
	$alasan_kskr = isset($_POST['alasan_kskr']) ? $_POST['alasan_kskr'] : '';
	$alasan_kskn = isset($_POST['alasan_kskn']) ? $_POST['alasan_kskn'] : '';
	
	$alasan_kmkr = isset($_POST['alasan_kmkr']) ? $_POST['alasan_kmkr'] : '';
	$alasan_kmkn = isset($_POST['alasan_kmkn']) ? $_POST['alasan_kmkn'] : '';


    $nama_teknisi = isset($_POST['nama_teknisi']) ? $_POST['nama_teknisi'] : '';

    $sql = "INSERT INTO claim_xforce
        (tanggal, shift, line, keterangan, nama_teknisi, status, no_rangka, 
         kdp, kbg, kpkr, kpkn, kskr, kskn,  kmkr, kmkn,
         alasan_kdp, alasan_kbg, alasan_kpkr, alasan_kpkn, alasan_kskr, 
         alasan_kskn,  alasan_kmkr, alasan_kmkn)
        VALUES 
        ('$tanggal', '$shift', '$line', '$keterangan', '$nama_teknisi', '$status', '$no_rangka', 
         '$kdp', '$kbg', '$kpkr', '$kpkn', '$kskr', '$kskn',  '$kmkr', '$kmkn',
         '$alasan_kdp', '$alasan_kbg', '$alasan_kpkr', '$alasan_kpkn', '$alasan_kskr', 
         '$alasan_kskn',  '$alasan_kmkr', '$alasan_kmkn')";

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
    <title>Form Input Stok Claim Xforce</title>
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
		
		<label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Claim" <?php echo ($status == 'Claim') ? 'selected' : ''; ?>>Claim</option>
            <option value="Reject" <?php echo ($status == 'Reject') ? 'selected' : ''; ?>>Reject</option>
        </select>

		<label for="nama_teknisi">Nama Teknisi:</label>
		<select id="nama_teknisi" name="nama_teknisi" required>
			<?php echo $teknisi_options; ?>
		</select>
		
		<label for="no_rangka">Nomor Rangka:</label>
		<input type="text" id="no_rangka" name="no_rangka" value="<?php echo $no_rangka; ?>" required>
		
		
		<label for="line">Line:</label>
        <select id="line" name="line" required>
            <option value="1" <?php echo ($line == '1') ? 'selected' : ''; ?>>1</option>
            <option value="2" <?php echo ($line == '2') ? 'selected' : ''; ?>>2</option>
			<option value="3" <?php echo ($line == '3') ? 'selected' : ''; ?>>3</option>
            <option value="4" <?php echo ($line == '4') ? 'selected' : ''; ?>>4</option>
			<option value="5" <?php echo ($line == '5') ? 'selected' : ''; ?>>5</option>
            <option value="6" <?php echo ($line == '6') ? 'selected' : ''; ?>>6</option>
			
        </select>

		<p>Stok Mold</p>
		<div style="display: flex; flex-wrap: wrap;">

    <!-- Section 1 -->
 <!-- Section 1 -->
<div style="flex: 0 0 16%; margin-right: 5%;">
    <label for="kdp">Kaca Depan:</label>
    <input type="text" id="kdp" name="kdp" value="<?php echo $kdp; ?>" >
    <select id="alasan_kdp" name="alasan_kdp">
        <option value=""></option>
		<option value="baret">Baret</option>
        <option value="bintik">Bintik</option>
        <option value="lecek">Lecek</option>
    </select>

    <label for="kbg">Kaca Bagasi:</label>
    <input type="text" id="kbg" name="kbg" value="<?php echo $kbg; ?>" >
    <select id="alasan_kbg" name="alasan_kbg">
	 <option value=""></option>
        <option value="baret">Baret</option>
        <option value="bintik">Bintik</option>
        <option value="lecek">Lecek</option>
    </select>
</div>
<!-- Section 2 -->
<div style="flex: 0 0 16%; margin-right: 5%;">
    <label for="kpkr">Kaca Penumpang Kiri:</label>
    <input type="text" id="kpkr" name="kpkr" value="<?php echo $kpkr; ?>" >
    <select id="alasan_kpkr" name="alasan_kpkr">
	 <option value=""></option>
        <option value="baret">Baret</option>
        <option value="bintik">Bintik</option>
        <option value="lecek">Lecek</option>
    </select>

    <label for="kpkn">Kaca Penumpang Kanan:</label>
    <input type="text" id="kpkn" name="kpkn" value="<?php echo $kpkn; ?>" >
    <select id="alasan_kpkn" name="alasan_kpkn">
	 <option value=""></option>
        <option value="baret">Baret</option>
        <option value="bintik">Bintik</option>
        <option value="lecek">Lecek</option>
    </select>
</div>
<!-- Section 3 -->
<div style="flex: 0 0 16%; margin-right: 5%;">
    <label for="kskr">Kaca Sopir Kiri:</label>
    <input type="text" id="kskr" name="kskr" value="<?php echo $kskr; ?>" >
    <select id="alasan_kskr" name="alasan_kskr">
	 <option value=""></option>
        <option value="baret">Baret</option>
        <option value="bintik">Bintik</option>
        <option value="lecek">Lecek</option>
    </select>

    <label for="kskn">Kaca Sopir Kanan:</label>
    <input type="text" id="kskn" name="kskn" value="<?php echo $kskn; ?>" >
    <select id="alasan_kskn" name="alasan_kskn">
	 <option value=""></option>
        <option value="baret">Baret</option>
        <option value="bintik">Bintik</option>
        <option value="lecek">Lecek</option>
    </select>
</div>

<!-- Section 5 -->
<div style="flex: 0 0 16%; ">
    <label for="kmkr">Kaca Mati Belakang Kiri:</label>
    <input type="text" id="kmkr" name="kmkr" value="<?php echo $kmkr; ?>" >
    <select id="alasan_kmkr" name="alasan_kmkr">
	 <option value=""></option>
        <option value="baret">Baret</option>
        <option value="bintik">Bintik</option>
        <option value="lecek">Lecek</option>
    </select>

    <label for="kmkn">Kaca Mati Belakang Kanan:</label>
    <input type="text" id="kmkn" name="kmkn" value="<?php echo $kmkn; ?>" >
    <select id="alasan_kmkn" name="alasan_kmkn">
	 <option value=""></option>
        <option value="baret">Baret</option>
        <option value="bintik">Bintik</option>
        <option value="lecek">Lecek</option>
    </select>
</div>

        
        <input type="submit" value="Simpan">
    </form>
</body>
</html>