<?php
    @include_once("../ConnectDB.php");

    $sql = "SELECT Printer_ID
            FROM Printer
            ";
    $result = $conn->query($sql);
    
    $data = array();

    while ($row = $result->fetch_assoc()) {
        array_push($data, $row);
    }

    echo json_encode($data);
?>