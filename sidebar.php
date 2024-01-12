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
<div class="container">
        <div class="sidebar">
            <div class="menu">
                <a href="stok_mt_xpander.php?produk=xpander&jenis=bahan_mentah">Laporan Stok Gudang Xpander</a>
                <a href="stok_mt_xforce.php?produk=xforce&jenis=bahan_mentah">Laporan Stok Gudang Xforce</a>
                <a href="stok_claim_xpander.php">Laporan Stok Claim Xpander</a>
                <a href="stok_claim_xforce.php">Laporan Stok Claim Xforce</a>
                <a href="stok_ht_xpander.php?produk=xpander&jenis=heating">Laporan Stok Heating Xpander</a>
                <a href="stok_ht_xforce.php?produk=xforce&jenis=heating">Laporan Stok Heating Xforce</a>
                <a href="list_teknisi.php">List Teknisi</a>
                <a href="list_teknisi_heating.php">List Teknisi Heating</a>
                <a href="list_admin.php">List Admin</a>
            </div>
            <div class="logout">
                <a href="?logout">Logout</a>
            </div>
        </div>
        <div class="content">
            <!-- Your main content goes here -->
        </div>
    </div>