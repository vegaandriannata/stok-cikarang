<?php


include 'koneksi.php';

$nama = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$jenis_kaca = $_POST['jenis_kaca'];
$no_rangka = $_POST['no_rangka'];
$no_mesin = $_POST['no_mesin'];
$ket_claim = $_POST['ket_claim'];

$sql = "INSERT INTO claim_xforce (nama, tanggal, jenis_kaca, no_rangka, no_mesin, ket_claim)
        VALUES ('$nama', '$tanggal', '$jenis_kaca', '$no_rangka', '$no_mesin', '$ket_claim')";

if ($koneksi->query($sql) === TRUE) {
    echo "Claim berhasil diajukan.";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
