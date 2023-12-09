<?php
    @include_once("../ConnectDB.php");

    $ID = $_POST['id'];

    // Get Balance
    $sql = "SELECT Balance 
        FROM Users
        WHERE ID = '$ID'
        ";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $balance = $row['Balance'];

    // Get Paper_Price
    $sql = "SELECT Paper_Price 
            FROM Configuration
            ";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $price = $row['Paper_Price'];


    // Response
    $response = Array(
        "balance" => $balance,
        "price" => $price,
    );

    echo json_encode($response);
?>