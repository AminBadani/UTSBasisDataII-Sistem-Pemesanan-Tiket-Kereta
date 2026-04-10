<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Kerete Api - Home</title>
    <link rel="stylesheet" href="public/style.css">
    <script src="public/script.js" defer></script>
</head>
<body>
    <h1 class="title">Sistem Pemesanan Tiket Kereta Api - Home</h1>
    
    <div class="container">
        <div id="list-ticket"></div>

        <div class="sidebar">
            <div class="sticky-sidebar">
                <div class="button-group">
                    <button>Tambah tiket</button>
                    <button>Tambah kereta</button>
                    <button>Tambah stasiun</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>