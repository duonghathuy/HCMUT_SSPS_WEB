<?php
// Include your database connection file
@include '../ConnectDB.php';

// Get the campus number from the POST data
// $campusNumber = $_POST['campus'];
// $building = $_POST['building'];

$id = $_POST['id'];

// Prepare your SQL statement

$sql = "SELECT * FROM printer_list WHERE printer_id = ?";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind the campus number to the SQL statement

$stmt->bind_param("s", $id);

// Execute the SQL statement
$stmt->execute();

$result = $stmt->get_result();

// If the ID exists, echo 'exists'
if ($result->num_rows > 0) {
    echo 'exists';
}
// If the ID does not exist, echo 'not exists'
else {
    echo 'not exists';
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>