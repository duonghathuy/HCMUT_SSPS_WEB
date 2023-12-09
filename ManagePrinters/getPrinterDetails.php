<?php
@include '../ConnectDB.php';

if (isset($_POST['printerId'])) {
    $printerId = $_POST['printerId'];

    $query = "SELECT * FROM printer_list WHERE printer_id = '$printerId'";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "Error executing the query: " . $conn->error;
    }
}
?>