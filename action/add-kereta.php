<?php 
    include '../connection.php';
    
    $list_kereta = mysqli_fetch_all(mysqli_query($connection, "SELECT * FROM kereta"), MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Kereta - Tambah Kereta</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <a class="back-home" href="index.php">< Kembali ke halaman utama</a>
    <h1 class="title">Sistem Pemesanan Tiket Kereta - Tambah Kereta</h1>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list_kereta as $stasiun): ?>
                    <tr>
                        <td><?php echo $stasiun['id_kereta'] ?></td>
                        <td><?php echo $stasiun['nama_kereta'] ?></td>
                        <td>
                            <button>Edit</button>
                            <button>Hapus</button>
                        </td>
                    </tr>
                    <tr>
                <?php endforeach; ?>                
            </tbody>
        </table>

        <form method="POST">
            <label for="kereta">ID kereta: </label>
            <input type="text" name="id-kereta" id="kereta" placeholder="K0-1" required> <br>
    
            <label for="nama">Nama kereta: </label>
            <input type="text" name="nama-kereta" id="nama" placeholder="Enggang Ekspress" required> <br>
    
            <button>Tambah kereta</button>
        </form>
    </div>
</body>
</html>