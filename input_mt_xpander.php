<?php
// Koneksi ke database (gantilah dengan informasi koneksi yang sesuai)
include 'koneksi.php';

// Inisialisasi variabel dengan nilai default
$tanggal = $stokMasuk = $stokKeluar = $sisa = $keterangan = '';

// Inisialisasi pesan untuk informasi hasil penyimpanan
$pesan = '';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir jika tersedia
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
    $stokMasuk = isset($_POST['stok_masuk']) ? $_POST['stok_masuk'] : '';
    $stokKeluar = isset($_POST['stok_keluar']) ? $_POST['stok_keluar'] : '';
    $sisa = isset($_POST['sisa']) ? $_POST['sisa'] : '';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

    // Query untuk menyimpan data ke dalam tabel ht_xpander
    $sql = "INSERT INTO mt_xpander (tanggal, stok_masuk, stok_keluar, sisa, keterangan)
            VALUES ('$tanggal', '$stokMasuk', '$stokKeluar', '$sisa', '$keterangan')";

    if ($koneksi->query($sql) === TRUE) {
        $pesan = "Data berhasil disimpan.";
        // Arahkan ke halaman stok_ht_xpander.php setelah berhasil disimpan
        header("Location: stok_mt_xpander.php");
        exit(); // Penting untuk menghentikan eksekusi script setelah header diarahkan
    } else {
        $pesan = "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Stok HT Xpander</title>
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

        input {
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

    <h1>Form Input Stok Bahan Mentah Xpander</h1>

    <?php echo $pesan; // Tampilkan pesan informasi ?>

    <form action="" method="post">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>

        <label for="stok_masuk">Stok Masuk:</label>
        <input type="number" id="stok_masuk" name="stok_masuk" value="<?php echo $stokMasuk; ?>" required>

        <label for="stok_keluar">Stok Keluar:</label>
        <input type="number" id="stok_keluar" name="stok_keluar" value="<?php echo $stokKeluar; ?>" required>

        <label for="sisa">Sisa:</label>
        <input type="number" id="sisa" name="sisa" value="<?php echo $sisa; ?>" required>

        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="keterangan" rows="4" required><?php echo $keterangan; ?></textarea>

        <input type="submit" value="Simpan">
    </form>

</body>
</html>
