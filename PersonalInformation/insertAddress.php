<?php
    @include_once("../ConnectDB.php");

    $id = $_POST["id"];
    $street = $_POST["street"];
    $commune = $_POST["commune"];
    $district = $_POST['district'];
    $province = $_POST["province"];

    $sql = "CALL `insertAddress`('$id', '$street', '$commune', '$district', '$province', @response);";
    $result = $conn->query($sql);

    $sql = "SELECT @response AS `response`;";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    echo json_encode($row["response"]);
?>