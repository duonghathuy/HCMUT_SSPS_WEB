<?php
    @include_once("../ConnectDB.php");

    $sql = "SELECT ID, Fname, Lname
            FROM Users
            ";
    $result = $conn->query($sql);
    
    $data = array();

    while ($row = $result->fetch_assoc()) {
        array_push($data, "{$row["Lname"]} {$row["Fname"]} - {$row["ID"]}");
    }

    echo json_encode($data);
?>