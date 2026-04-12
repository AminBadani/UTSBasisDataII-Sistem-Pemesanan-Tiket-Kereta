<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Kereta - Home</title>
    <link rel="stylesheet" href="public/style.css">
    <script src="public/script.js" defer></script>
</head>
<body>
    <h1 class="title">Sistem Pemesanan Tiket Kereta - Home</h1>
    
    <nav>
        <button id="button-jadwal">[ Jadwal ]</button>
        <button id="button-kereta">[ Kereta ]</button>
        <button id="button-stasiun">[ Stasiun ]</button>
    </nav>

    <div class="container">
        <div id="list-card"></div>

        <div class="sidebar">
            <div class="sticky-sidebar">
                <div class="filter-group">
                    <div class="search">
                        <label for="search-input">Cari: </label><input type="text" id="search-input" placeholder="Kereta, kota, dan stasiun">
                    </div>
                </div>
                <div class="button-group">
                    <button onclick="location.href = 'action/add-jadwal.php'">Tambah jadwal</button>
                    <button onclick="location.href = 'action/add-kereta.php'">Tambah kereta</button>
                    <button onclick="location.href = 'action/add-stasiun.php'">Tambah stasiun</button>
                    <button onclick="">Tambah penumpang</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>