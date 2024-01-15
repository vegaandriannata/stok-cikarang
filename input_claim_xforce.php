<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username']) || (isset($_SESSION['timeout']) && time() > $_SESSION['timeout'])) {
    header("Location: login.php");
    exit();
}

$tanggal = $shift = $line = $keterangan = $status = $no_rangka = $tipe_mobil = '';
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
	$tipe_mobil = isset($_POST['tipe_mobil']) ? $_POST['tipe_mobil'] : '';
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
	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $sql = "INSERT INTO claim_xforce
        (tanggal, shift, line, keterangan, tipe_mobil, nama_teknisi, status, no_rangka, 
         kdp, kbg, kpkr, kpkn, kskr, kskn,  kmkr, kmkn,
         alasan_kdp, alasan_kbg, alasan_kpkr, alasan_kpkn, alasan_kskr, 
         alasan_kskn,  alasan_kmkr, alasan_kmkn)
        VALUES 
        ('$tanggal', '$shift', '$line', '$keterangan', '$tipe_mobil', '$nama_teknisi', '$status', '$no_rangka', 
         '$kdp', '$kbg', '$kpkr', '$kpkn', '$kskr', '$kskn',  '$kmkr', '$kmkn',
         '$alasan_kdp', '$alasan_kbg', '$alasan_kpkr', '$alasan_kpkn', '$alasan_kskr', 
         '$alasan_kskn',  '$alasan_kmkr', '$alasan_kmkn')";

    if ($koneksi->query($sql) === TRUE) {
        $pesan = "Data berhasil disimpan.";

        // Insert data into histori_admin table
        $admin_username = $_SESSION['username'];
        $action = "insert"; 
        $admin_data = $tanggal . '+' . $shift. '+' . $nama_teknisi . '+' . $keterangan . '+' . $status. '+' . $line. '+' . $tipe_mobil. '+' . $no_rangka. '+' . $kdp. '+' . $alasan_kdp. '+' . $kbg. '+' . $alasan_kbg. '+' . $kpkr. '+' . $alasan_kpkr. '+' . $kpkn. '+' . $alasan_kpkn. '+' . $kskr. '+' . $alasan_kskr. '+' . $kskn. '+' . $alasan_kskn. '+' . $kmkr. '+' . $alasan_kmkr. '+' . $kmkn. '+' . $alasan_kmkn;
        $tanggal_input = date("Y-m-d H:i:s");

        $sql_history = $koneksi->prepare("INSERT INTO histori_activity (user, action, data, tanggal, url) VALUES (?, ?, ?, ?, ?)");
        $sql_history->bind_param("sssss", $admin_username, $action, $admin_data, $tanggal_input, $url);

        if ($sql_history->execute()) {
            echo "History inserted successfully";
        } else {
            echo "Error inserting history: " . $sql_history->error;
        }

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
    <h1>Form Input Stok Claim Xforce</h1>

    <?php echo $pesan;  ?>

    <form action="" method="post">
	<div style="display: flex; flex-wrap: wrap;">

    <!-- Section 1 -->
 <!-- Section 1 -->
<div style="flex: 0 0 49%; margin-right: 2%;">
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
		
        <label for="tipe_mobil">Tipe Mobil:</label>
        <select id="tipe_mobil" name="tipe_mobil" required>
            <option value="Xforce Exceed" <?php echo ($tipe_mobil == 'Xforce Exceed') ? 'selected' : ''; ?>>Xforce Exceed</option>
            <option value="Xforce Ultimate" <?php echo ($tipe_mobil == 'Xforce Ultimate') ? 'selected' : ''; ?>>Xforce Ultimate</option>
           
        </select>
		</div>
<!-- Section 2 -->
<div style="flex: 0 0 49%; ">
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
</div></div>
		<p>Bagian Kaca</p>
		<div style="display: flex; flex-wrap: wrap;">

    <!-- Section 1 -->
 <!-- Section 1 -->
<div style="flex: 0 0 22%; margin-right: 4%;">
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
<div style="flex: 0 0 22%; margin-right: 4%;">
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
<div style="flex: 0 0 22%; margin-right: 4%;">
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
<div style="flex: 0 0 22%; ">
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
	</div>
</body>
</html>