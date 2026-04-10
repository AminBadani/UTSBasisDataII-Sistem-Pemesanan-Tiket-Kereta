<?php 
    include '../connection.php';

    $selectJadwal = mysqli_query(
        $connection, 
        "SELECT 
            j.id_jadwal, j.waktu_berangkat, j.waktu_tiba, j.harga_dasar,
            j.id_kereta, k.nama_kereta, k.tipe_kereta, k.kapasitas_total,
            j.id_stasiun_asal AS id_stasiun_asal, s_asal.nama_stasiun AS nama_stasiun_asal, s_asal.kota AS kota_asal,
            j.id_stasiun_tujuan AS id_stasiun_tujuan, s_tujuan.nama_stasiun AS nama_stasiun_tujuan, s_tujuan.kota AS kota_tujuan
            FROM jadwal j 
        INNER JOIN 
            kereta k 
            ON j.id_kereta = k.id_kereta
        INNER JOIN 
            stasiun s_asal 
            ON j.id_stasiun_asal = s_asal.id_stasiun
        INNER JOIN 
            stasiun s_tujuan 
            ON j.id_stasiun_tujuan = s_tujuan.id_stasiun
        ORDER BY j.waktu_berangkat ASC"
    );
    $result = mysqli_fetch_all($selectJadwal, MYSQLI_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($result);

    exit();
?>