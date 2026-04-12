<?php 
    include '../connection.php';
    
    $list_stasiun = mysqli_fetch_all(mysqli_query($connection, "SELECT * FROM stasiun"), MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Kereta - Tambah Stasiun</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <a class="back-home" href="../index.php">< Kembali ke halaman utama</a>
    <h1 class="title">Sistem Pemesanan Tiket Kereta - Tambah Stasiun</h1>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list_stasiun as $stasiun): ?>
                    <tr>
                        <td><?php echo $stasiun['id_stasiun'] ?></td>
                        <td><?php echo $stasiun['nama_stasiun'] ?></td>
                        <td><?php echo $stasiun['kota'] ?></td>
                        <td>
                            <button>Edit</button>
                            <button>Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>                
            </tbody>
        </table>

        <form method="POST">
            <label for="stasiun">ID Stasiun: </label>
            <input type="text" name="id-stasiun" id="stasiun" placeholder="PKY" required> <br>
    
            <label for="nama">Nama stasiun: </label>
            <input type="text" name="nama-stasiun" id="nama" placeholder="Bukit Tinggi" required> <br>
    
            <label for="kota">Kota: </label>
            <input type="text" name="kota" id="kota" placeholder="Palangkaraya" required> <br>
    
            <button>Tambah stasiun</button>
        </form>
    </div>
</body>
</html>