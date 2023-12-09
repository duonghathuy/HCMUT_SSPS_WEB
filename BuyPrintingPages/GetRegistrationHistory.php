<?php
    @include_once("../ConnectDB.php");

    $ID = $_POST['id'];

    $sql = "SELECT Order_ID, Order_Creation_Date, Quantity, Total_Price, Payment_Status, Owner_ID
            FROM BPP_Order
            WHERE Owner_ID = '$ID'
            ORDER BY Order_Creation_Date DESC
            ";
    $result = $conn->query($sql);

    $response = Array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($response, array(
                "Order_ID" => $row['Order_ID'],
                "Order_Creation_Date" => $row['Order_Creation_Date'],
                "Quantity" => $row['Quantity'],
                "Total_Price" => $row['Total_Price'],
                "Payment_Status" => $row['Payment_Status'],
                "Owner_ID" => $row['Owner_ID']
            ));
        }
    }

    echo json_encode($response);
?>