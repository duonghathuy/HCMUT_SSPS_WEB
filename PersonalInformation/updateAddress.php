<?php
    @include_once("../ConnectDB.php");

    $id = $_POST["id"];
    $street = $_POST["street"];
    $commune = $_POST["commune"];
    $district = $_POST['district'];
    $province = $_POST["province"];
    $nStreet = $_POST["nStreet"];
    $nCommune = $_POST["nCommune"];
    $nDistrict = $_POST['nDistrict'];
    $nProvince = $_POST["nProvince"];

    $sql = "CALL `updateAddress`('$id', '$street', '$commune', '$district', '$province', '$nStreet', '$nCommune', '$nDistrict', '$nProvince', @response);";
    $result = $conn->query($sql);

    $sql = "SELECT @response AS `response`;";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    echo json_encode($row["response"]);
?>