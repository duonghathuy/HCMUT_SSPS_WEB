<?php
    @include_once("../ConnectDB.php");

    $id = $_POST["id"];
    $street = $_POST["street"];
    $commune = $_POST["commune"];
    $district = $_POST['district'];
    $province = $_POST["province"];

    $sql = "CALL `deleteAddress`('$id', '$street', '$commune', '$district', '$province');";
    $conn->query($sql);
?>