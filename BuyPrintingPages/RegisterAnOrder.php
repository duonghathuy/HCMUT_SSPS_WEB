<?php
    @include_once("../ConnectDB.php");

    $ID = $_POST['id'];
    $Quantity = $_POST['quantity'];

    // Get Balance
    $sql = "SELECT Balance 
        FROM Users
        WHERE ID = '$ID'";
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

    // Calculate Total_Price
    $Total_Price = $price * $Quantity;

    // Get the current date and time
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date("Y/m/d H:i:s");

    // INSERT into DB
    $sql = "INSERT INTO BPP_Order (Order_ID, Order_Creation_Date, Quantity, Total_Price, Payment_Status, Owner_ID)
            VALUES (NULL, '$date', '$Quantity', '$Total_Price', '0', '$ID')
            ";

    $conn->query($sql);
?>