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
    $query = "INSERT INTO Printer (Printer_ID, Printer_name, Printer_desc, Printer_avai, Printer_campusloc, Printer_buildingloc, Printer_room) VALUES (?, ?, ?, 'N', ?, ?, ?)";
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