<?php 
    include '../connection.php';
    
    $list_kereta = mysqli_fetch_all(mysqli_query($connection, "SELECT * FROM kereta"), MYSQLI_ASSOC);
    $list_stasiun = mysqli_fetch_all(mysqli_query($connection, "SELECT * FROM stasiun"), MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Kereta - Tambah Jadwal</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <a class="back-home" href="../index.php">< Kembali ke halaman utama</a>
    <h1 class="title">Sistem Pemesanan Tiket Kereta - Tambah Jadwal</h1>

    <form method="POST">
        <label for="kereta">Kereta: </label>
        <select name="id-kereta" id="kereta">
            <?php foreach ($list_kereta as $kereta): ?>
                <option value="<?php echo $kereta['id_kereta'] ?>"><?php echo $kereta['nama_kereta'] ?> - (Kapasitas <?php echo $kereta['kapasitas_total'] ?>)</option>
            <?php endforeach; ?>
        </select> <br>

        <label for="harga">Harga dasar: <i>Rupiah tanpa titik</i></label>
        <input type="number" name="harga-dasar" id="harga" placeholder="250000" required> <br>

        <label for="asal">Stasiun asal: </label>
        <select name="stasiun-asal" id="asal">
            <?php foreach ($list_stasiun as $stasiun): ?>
                <option value="<?php echo $stasiun['id_stasiun'] ?>"><?php echo $stasiun['nama_stasiun'] ?></option>
            <?php endforeach; ?>
        </select> <br>

        <label for="tujuan">Stasiun tujuan: </label>
        <select name="stasiun-tujuan" id="tujuan">
            <?php foreach ($list_stasiun as $stasiun): ?>
                <option value="<?php echo $stasiun['id_stasiun'] ?>"><?php echo $stasiun['nama_stasiun'] ?></option>
            <?php endforeach; ?>
        </select> <br>

        <label for="berangkat">Waktu berangkat: </label>
        <input type="datetime-local" name="waktu-berangkat" id="berangkat" required> <br>

        <label for="tiba">Waktu tiba: </label>
        <input type="datetime-local" name="waktu-tiba" id="tiba" required> <br>

        <button>Tambah kereta</button>
    </form>
</body>
</html>