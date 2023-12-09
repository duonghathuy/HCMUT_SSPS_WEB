<?php
@include '../ConnectDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $printerId = $_POST['printerId'];
    $printerName = $_POST['printerName'];
    $printerDesc = $_POST['printerDesc'];
    $campus = $_POST['campus'];
    $building = $_POST['building'];
    $room = $_POST['printerRoom'];

    //default setting when add is printer turn OFF
    $query = "INSERT INTO printer_list (printer_id, printer_name, printer_desc, printer_avai, printer_campusloc, printer_buildingloc, printer_room) VALUES (?, ?, ?, 'N', ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $printerId, $printerName, $printerDesc, $campus, $building, $room);

    if ($stmt->execute()) {
        echo "<script>alert('New printer added successfully'); window.location = 'addPrinter.php'</script>";
       // header('location:addPrinter.php');
    } else {
        echo "Error: " . $stmt->error;
    }

}
?>