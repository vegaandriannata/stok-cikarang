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
    </div>

</body>
</html>
