<?php
    @include_once("../ConnectDB.php");

    $sql = "SELECT Student_ID, Fname, Lname
            FROM Student
            ";
    $result = $conn->query($sql);
    
    $data = array();

    while ($row = $result->fetch_assoc()) {
        array_push($data, "{$row["Lname"]} {$row["Fname"]} - {$row["Student_ID"]}");
    }

    echo json_encode($data);
?>