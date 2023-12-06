<?php
    @include_once("../ConnectDB.php");

    $sql = "SELECT File_Type
            FROM Accepted_File_Types
            ";
    $result = $conn->query($sql);

    $response = Array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($response, $row["File_Type"]);
        }
    }

    echo json_encode($response);
?>