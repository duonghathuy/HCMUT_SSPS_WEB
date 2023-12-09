<?php
    @include_once("../ConnectDB.php");

    //Get Order_ID
    $Order_ID = $_GET["Order_ID"];

    // Get Owner_ID and Quantity
    $sql = "SELECT Quantity, Owner_ID
            FROM BPP_Order
            WHERE Order_ID = $Order_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $Owner_ID = $row["Owner_ID"];
    $Quantity = $row["Quantity"];

    // Get Old Balance
    $sql = "SELECT Balance FROM Users WHERE ID = $Owner_ID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $old_balance = $row["Balance"];

    // Calculate New Balance
    $new_balance = $old_balance + $Quantity;

    // Update New Balance into Student Database
    $sql = "UPDATE Users
            SET Balance = $new_balance
            WHERE ID = $Owner_ID";

    $result = $conn->query($sql);

    // Update Payment_Status into BPP_Order Database
    $sql = "UPDATE BPP_Order
            SET Payment_Status = 1
            WHERE Order_ID = $Order_ID";

    $result = $conn->query($sql);

    header("Location: BuyPrintingPages.html");
?>