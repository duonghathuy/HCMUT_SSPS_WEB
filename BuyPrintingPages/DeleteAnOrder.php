<?php
    @include_once("../ConnectDB.php");

    $Order_ID = $_GET["Order_ID"];
    $sql = "DELETE FROM BPP_Order WHERE Order_ID = $Order_ID";

    $result = $conn->query($sql);

    header("Location: BuyPrintingPages.php");
?>
