<?php
    @include_once("../ConnectDB.php");

    $sql = "SELECT Default_Number_Of_Pages, Paper_Price
            FROM Configuration
            WHERE ID = 0
            ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $response = Array(
        "Default_Number_Of_Pages" => $row["Default_Number_Of_Pages"],
        "Paper_Price" => $row["Paper_Price"]
    );

    echo json_encode($response);
?>