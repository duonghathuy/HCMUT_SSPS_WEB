<?php
    include_once __DIR__ . "/DatabaseConnection.php";
    $fileName = $_GET['File_Type'];
    $insertQuery = "INSERT INTO accepted_file_types (File_Type) VALUES ('$fileName')";
    mysqli_query($connection,$insertQuery);
?>