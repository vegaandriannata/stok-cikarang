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
        }

        h1 {
            text-align: center;
        }

        .menu {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .menu a {
            text-decoration: none;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }

        .menu a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Dashboard Laporan Stok</h1>

    <div class="menu">
        <a href="stok_mt_xpander.php?produk=xpander&jenis=bahan_mentah">Laporan Stok Bahan Mentah Xpander</a>
        <a href="stok_mt_xforce.php?produk=xforce&jenis=bahan_mentah">Laporan Stok Bahan Mentah Xforce</a>
        <a href="stok_ht_xpander.php?produk=xpander&jenis=heating">Laporan Stok Heating Xpander</a>
        <a href="stok_ht_xforce.php?produk=xforce&jenis=heating">Laporan Stok Heating Xforce</a>
    </div>

</body>
</html>
