<?php
@include '../ConnectDB.php';

// Create connection


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $printerID = $_POST['printerID'];
    $selection = $_POST['selection'];

    // Update query
    if ($selection == 'Bật') {
        $selection = 'Y';
    } else if ($selection == 'Tắt') {
        $selection = 'N';
    }
    $selection = 'Y';

    // Update query
    $sql = "UPDATE Printer SET Printer_avai = '$selection' WHERE Printer_ID = '$printerID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>