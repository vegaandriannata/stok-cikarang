
<?php
session_start();

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Laporan Stok</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        font-size: 14px;
    }

    h1 {
        text-align: center;
    }

    .menu {
        display: flex;
        flex-direction: column; 
        align-items: center; 
        margin-top: 20px;
    }

    .menu a {
        text-decoration: none;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        margin-bottom: 10px; 
        width: 200px; 
        box-sizing: border-box; 
        display: flex; 
        justify-content: center; 
    }

    .menu a:hover {
        background-color: #45a049;
    }
	.logout {
        text-align: center;
        margin-top: 20px;
    }

    .logout a {
        text-decoration: none;
        padding: 10px;
        background-color: #f44336;
        color: white;
        border-radius: 5px;
    }

    .logout a:hover {
        background-color: #d32f2f;
    }
    </style>

</head>
<body>

    <h1>Dashboard Laporan Stok</h1>

    <div class="menu">
        <a href="stok_mt_xpander.php?produk=xpander&jenis=bahan_mentah">Laporan Stok Gudang Xpander</a>
        <a href="stok_mt_xforce.php?produk=xforce&jenis=bahan_mentah">Laporan Stok Gudang Xforce</a>
        <a href="stok_claim_xpander.php">Laporan Stok Claim Xpander</a>
		<a href="stok_claim_xforce.php">Laporan Stok Claim Xforce</a>
		<a href="stok_ht_xpander.php?produk=xpander&jenis=heating">Laporan Stok Heating Xpander</a>
        <a href="stok_ht_xforce.php?produk=xforce&jenis=heating">Laporan Stok Heating Xforce</a>
        <a href="list_teknisi.php">List Teknisi</a>
        <a href="register.php">Register Admin</a>
    </div>
<div class="logout">
        <a href="?logout">Logout</a>
    </div>
</body>
</html>
