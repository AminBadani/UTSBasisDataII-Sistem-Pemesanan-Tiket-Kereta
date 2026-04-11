<?php 
    include 'connection.php'; 

    if (!isset($_GET['id-jadwal'])) {
        header('Location: index.php');
        exit();
    } else {
        $current_id_jadwal = htmlspecialchars($_GET['id-jadwal']);
        $select_detail_jadwal = mysqli_query($connection, "SELECT * FROM detail_jadwal WHERE id_jadwal = $current_id_jadwal LIMIT 1");
        $detail_jadwal = mysqli_fetch_assoc($select_detail_jadwal);

        if (!isset($detail_jadwal)) {
            header('Location: index.php');
            exit();
        }

        $harga_rupiah = number_format($detail_jadwal['harga_dasar'], 0, ',', '.'); 
        $waktu_berangkat = date("l, M y - H:i:s", strtotime($detail_jadwal['waktu_berangkat'])); 
        $waktu_tiba = date("l, M y - H:i:s", strtotime($detail_jadwal['waktu_tiba'])); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Kereta - Detail</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <h1 class="title">Detail Jadwal: <?php echo $detail_jadwal['id_kereta'] ?></h1>
    
    <div class="container">
        <div class="information-card">
            <div class="card-header">
                <h3>
                   Informasi Kereta: <?php echo $detail_jadwal['nama_kereta'] ?>
                </h3>
                <p>Tipe kereta: <?php echo $detail_jadwal['tipe_kereta'] ?></p>
                <p>Harga tiket: Rp<?php echo $harga_rupiah ?></p>
                <p>Asal: <?php echo $detail_jadwal['kota_asal'] . ' (' . $detail_jadwal['id_stasiun_asal'] . ')' ?></p>
                <p>Tujuan: <?php echo $detail_jadwal['kota_tujuan'] . ' (' . $detail_jadwal['id_stasiun_tujuan'] . ')' ?></p>
            </div>
            <div class="card-content">
                <p>Berangkat: <?php echo $waktu_berangkat ?></p>
                <p>Tiba: <?php echo $waktu_tiba ?></p>
                <p>Kapasitas: <?php echo $detail_jadwal['kapasitas_total'] ?></p>
                <p>Terisi: 20</p>
                <p>Sisa: 30</p>
            </div>
            <div class="card-footer">
                <button>Edit jadwal</button>
                <button>Hapus jadwal</button>
            </div>
        </div>
    </div>
</body>
</html>