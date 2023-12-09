<?php
@include '../ConnectDB.php';

if(isset($_POST['campus'])) {
    $selectedCampus = $_POST['campus'];
    $query = "SELECT * FROM campus_building WHERE printer_campusloc = '$selectedCampus'";
    $result = $conn->query($query);

    if ($result) {
        $buildings = array();
        while ($row = $result->fetch_assoc()) {
            $buildings[] = $row['printer_buildingloc'];
        }
        echo json_encode($buildings);
    } else {
        echo "Error executing the query: " . $conn->error;
    }
}
?>