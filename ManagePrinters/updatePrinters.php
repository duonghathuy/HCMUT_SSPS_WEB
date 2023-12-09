<?php
@include '../ConnectDB.php';

if(isset($_POST['building'])) {
    $selectedBuilding = $_POST['building'];
    $query = "SELECT * FROM printer_list WHERE printer_buildingloc = '$selectedBuilding'";
    $result = $conn->query($query);

    if ($result) {
        $printers = array();
        while ($row = $result->fetch_assoc()) {
            $printers[] = $row['printer_id'];
        }
        echo json_encode($printers);
    } else {
        echo "Error executing the query: " . $conn->error;
    }
}
?>