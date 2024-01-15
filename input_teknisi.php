<?php
session_start();
// Sisipkan koneksi.php
include 'koneksi.php';


$posisi = '';
// Proses form jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $namaTeknisi = $_POST["nama_teknisi"];
    $posisi = $_POST["posisi"];

	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // Query untuk insert data ke tabel teknisi
    $query = "INSERT INTO teknisi (nama_teknisi, posisi) VALUES ('$namaTeknisi', '$posisi')";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Cek apakah data berhasil disimpan
    if ($result) {
    // Insert data into histori_admin table
    $admin_username = $_SESSION['username'];
    $action = "insert"; 
    $admin_data = $namaTeknisi . '+' . $posisi;
    $tanggal_input = date("Y-m-d H:i:s");

    $sql_history = $koneksi->prepare("INSERT INTO histori_activity (user, action, data, tanggal, url) VALUES (?, ?, ?, ?, ?)");
    $sql_history->bind_param("sssss", $admin_username, $action, $admin_data, $tanggal_input, $url);

    if ($sql_history->execute()) {
        $pesan = "Data teknisi berhasil ditambahkan.";
        
        // Redirect to the list_teknisi.php page
        header("Location: list_teknisi.php");
        exit();
    } else {
        $pesan = "Error inserting history: " . $sql_history->error;
    }
} else {
    $pesan = "Error: " . mysqli_error($koneksi);
}


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Teknisi</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            height: 100vh;
        }

        h2 {
            color: #333;
        }

        
		form {
			background-color: #ffffff;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			max-width: 600px;
			margin: 0 auto;
		}	

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
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





<form action="" method="post">
        <h2>Tambah Data Teknisi</h2>

        <label for="nama_teknisi">Nama Teknisi:</label>
        <input type="text" name="nama_teknisi" required> 
		
		<label for="posisi">Posisi:</label>
       <select id="posisi" name="posisi" required>
            <option value="Instalasi" <?php echo ($posisi == 'Instalasi') ? 'selected' : ''; ?>>Instalasi</option>
            <option value="Heating" <?php echo ($posisi == 'Heating') ? 'selected' : ''; ?>>Heating</option>
            <option value="Balding" <?php echo ($posisi == 'Balding') ? 'selected' : ''; ?>>Balding</option>
            <option value="HO" <?php echo ($posisi == 'HO') ? 'selected' : ''; ?>>HO</option>
            
		</select>
		<button type="submit">Tambah Teknisi</button>
		<a href="list_teknisi.php">Kembali</a>
    </form>
</div>
</body>
</html>
