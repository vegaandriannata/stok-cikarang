<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username']) || (isset($_SESSION['timeout']) && time() > $_SESSION['timeout'])) {
    header("Location: login.php");
    exit();
}

$tanggal = $shift  = $tdp = $tbg = $hdp = $hbg = $cdp = $cbg = '';


$pesan = '';
$teknisi_options = ''; // Variable to store technician options

// Fetch technician names from the database
$sql_teknisi = "SELECT nama_teknisi FROM teknisi WHERE heating = 'YES'";
$result_teknisi = $koneksi->query($sql_teknisi);

if ($result_teknisi->num_rows > 0) {
    while ($row_teknisi = $result_teknisi->fetch_assoc()) {
        $teknisi_name = $row_teknisi['nama_teknisi'];
        $teknisi_options .= "<option value='$teknisi_name'>$teknisi_name</option>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
	$shift = isset($_POST['shift']) ? $_POST['shift'] : '';
    $nama_teknisi = isset($_POST['nama_teknisi']) ? $_POST['nama_teknisi'] : '';
    $tdp = isset($_POST['tdp']) ? $_POST['tdp'] : '';
    $tbg = isset($_POST['tbg']) ? $_POST['tbg'] : '';
	$hdp = isset($_POST['hdp']) ? $_POST['hdp'] : '';
    $hbg = isset($_POST['hbg']) ? $_POST['hbg'] : '';
	$cdp = isset($_POST['cdp']) ? $_POST['cdp'] : '';
    $cbg = isset($_POST['cbg']) ? $_POST['cbg'] : '';
    

    
    $sql = "INSERT INTO ht_xforce (tanggal, shift, nama_teknisi, tdp, tbg, hdp, hbg, cdp, cbg)
            VALUES ('$tanggal', '$shift', '$nama_teknisi', '$tdp', '$tbg', '$hdp', '$hbg', '$cdp', '$cbg')";

    if ($koneksi->query($sql) === TRUE) {
        $pesan = "Data berhasil disimpan.";
        
        header("Location: stok_ht_xforce.php");
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
    <title>Form Input Stok HT Xforce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
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
                <a href="list_teknisi_heating.php">List Teknisi Heating</a>
                <a href="list_admin.php">List Admin</a>
            </div>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </div>
<div class="content">
    <h1>Form Input Stok HT Xforce</h1>

    <?php echo $pesan;  ?>

    <form action="" method="post">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>

        <label for="shift">Shift:</label>
    <select id="shift" name="shift" required>
        <option value="Pagi" <?php if ($shift == "Pagi") echo "selected"; ?>>Pagi</option>
        <option value="Malam" <?php if ($shift == "Malam") echo "selected"; ?>>Malam</option>
    </select>

        <label for="nama_teknisi">Nama Teknisi:</label>
		<select id="nama_teknisi" name="nama_teknisi" required>
			<?php echo $teknisi_options; ?>
		</select>

        <label for="tdp">Terima Depan:</label>
        <input type="number" id="tdp" name="tdp" value="<?php echo $tdp; ?>" required>
		
        <label for="tbg">Terima Bagasi:</label>
        <input type="number" id="tbg" name="tbg" value="<?php echo $tbg; ?>" required>

        <label for="hdp">Hasil Depan:</label>
        <input type="number" id="hdp" name="hdp" value="<?php echo $hdp; ?>" required>
		
        <label for="hbg">Hasil Bagasi:</label>
        <input type="number" id="hbg" name="hbg" value="<?php echo $hbg; ?>" required>

        <label for="cdp">Claim Depan:</label>
        <input type="number" id="cdp" name="cdp" value="<?php echo $cdp; ?>" required>
		
        <label for="cbg">Claim Bagasi:</label>
        <input type="number" id="cbg" name="cbg" value="<?php echo $cbg; ?>" required>

        

        <input type="submit" value="Simpan">
    </form>
</div>
</body>
</html>
