<?php 
    include '../connection.php';

    $selectJadwal = mysqli_query($connection, "SELECT * FROM stasiun");
    $result = mysqli_fetch_all($selectJadwal, MYSQLI_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($result);

    exit();
?>