<?php
session_start();
if (!isset($_SESSION['username']) || (isset($_SESSION['timeout']) && time() > $_SESSION['timeout'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
$userName = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
   <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center; /* Center-align table headers */
        }
		.button-container {
            margin-top: 20px;
        }

        .button-container a, .button-container button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-container a:hover, .button-container button:hover {
            background-color: #45a049;
        }
		.button-container a.logout {
    background-color: #f44336;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
}

.button-container a.logout:hover {
    background-color: #d32f2f;
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
	.inner-header {
            display: flex;
            justify-content: space-between;
			align-items: center;
        }
.inner-header {
        background-color: #fff; /* Dark background color */
       
        box-sizing: border-box;
        color: #000;
    }
	
	
        .inner-header h2,
        .inner-header h3,
		.inner-header h3 img {
            margin-right: 10px;
        }
		.inner-header h3 {
            display: flex;
            align-items: center;
        }

        .inner-header h3 img {
            margin-right: 10px; /* Adjust the margin as needed */
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
<div class="inner-header">
<div>
     <h2>Dashboard Stok Bahan Mentah Xforce </h2>
	 </div>
	 
	 <div class="inner-header">
		
        <h3><img style="max-width:30px; "src="asset/image/profile1.png"><?php echo $userName; ?></h3>
    </div>
	  </div>	
<div class="button-container">
	
        
        <a href="register.php"style="margin-right:1%;">Register Admin </a>
		<button onclick="exportToExcel()">Export to Excel</button>
		
    </div>
<?php
// Sisipkan koneksi.php
include 'koneksi.php';

// Query untuk mendapatkan data teknisi
$query = "SELECT * FROM users";
$result = mysqli_query($koneksi, $query);
?>



<?php
// Cek apakah ada data teknisi
if (mysqli_num_rows($result) > 0) {
    // Tampilkan data dalam tabel
    echo "<table>";
    echo "<tr>
	<th>No</th>
	<th>Nama Admin</th>
	<th>Username</th>
	</tr>";

    $no = 1; // Inisialisasi nomor urut

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
       
        echo "<td>" . $row["nama"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Tidak ada data admin.</p>";
}

// Tutup koneksi
mysqli_close($koneksi);
?>
</div>
</body>
</html>
