<?php
    if (isset($_SESSION) == false){
        session_start();
    }
    include_once __DIR__ . "/DatabaseConnection.php";
    $defaultNumberOfPages = $_POST['numberOfPages'];
    $paperPrice = $_POST['paperPrices'];
    $updateQuery = "UPDATE configuration
    SET Default_Number_Of_Pages = $defaultNumberOfPages, Paper_Price = $paperPrice
    WHERE ID = 0";
    if (mysqli_query($connection,$updateQuery)){
        $_SESSION['update'] = "success";
        header("location: ConfigureSystem.php");
    }else{
        $_SESSION['errorNumber'] = mysqli_errno($connection);
        $_SESSION['errorMessage'] = mysqli_error($connection);
    }
?>