<?php
    @include_once("../ConnectDB.php");

    $Request_ID = $_GET["Request_ID"];

    // Delete Requested_Page_Numbers
    $sql = "DELETE FROM Requested_Page_Numbers WHERE Request_ID = $Request_ID";
    $result = $conn->query($sql);

    // Delete Printing_Request
    $sql = "DELETE FROM Printing_Request WHERE Request_ID = $Request_ID";
    $result = $conn->query($sql);

    header("Location: PrintingHistory.php");
?>