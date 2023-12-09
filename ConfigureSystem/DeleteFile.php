<?php
    include_once __DIR__ . "/DatabaseConnection.php";
    $fileName = $_GET['File_Type'];
    $deleteQuery = "DELETE FROM accepted_file_types WHERE File_Type = '$fileName'";
    mysqli_query($connection,$deleteQuery);
?>