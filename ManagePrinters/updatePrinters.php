<?php
@include '../ConnectDB.php';

if (isset($_POST['building'])) {
    $selectedBuilding = $_POST['building'];
    $query = "SELECT * FROM Printer WHERE Printer_buildingloc = '$selectedBuilding'";
    $result = $conn->query($query);

    if ($result) {
        $printers = array();
        while ($row = $result->fetch_assoc()) {
            $printers[] = $row['Printer_ID'];
        }
        echo json_encode($printers);
    } else {
        echo "Error executing the query: " . $conn->error;
    }
}
?>