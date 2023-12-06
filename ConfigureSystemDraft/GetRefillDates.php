<?php
    @include_once("../ConnectDB.php");

    $sql = "SELECT Refill_Date
            FROM Refill_Dates
            ";
    $result = $conn->query($sql);

    $response = Array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($response, $row["Refill_Date"]);
        }
    }

    echo json_encode($response);
?>