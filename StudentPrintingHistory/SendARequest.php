<?php
    @include_once("../ConnectDB.php");

    // Get Request_ID
    $Request_ID = $_GET["Request_ID"];

    // Get Request_ID
    $Total_Of_Pages = $_GET["Total_Of_Pages"];
    
    // Get Owner_ID
    $sql = "SELECT Owner_ID
            FROM Printing_Request
            WHERE Request_ID = $Request_ID";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $Owner_ID = $row["Owner_ID"];

    // Get Balance of Owner_ID
    $sql = "SELECT Balance
            FROM Users
            WHERE ID = $Owner_ID";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $Balance = $row["Balance"];

    // Update Request_Status into Printing_Request Database
    $sql = "UPDATE Printing_Request
        SET Request_Status = 'Đã gửi'
        WHERE Request_ID = $Request_ID";

    $result = $conn->query($sql);

    $New_Balance = $Balance - $Total_Of_Pages;
    
    // Update Balance into Student
    $sql = "UPDATE Users
        SET Balance = $New_Balance
        WHERE ID = $Owner_ID";

    $result = $conn->query($sql);
    
    header("Location: PrintingHistory.php");
?>