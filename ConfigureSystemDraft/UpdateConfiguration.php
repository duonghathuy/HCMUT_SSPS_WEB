<?php
    @include_once("../ConnectDB.php");

    // Get Inputs
    $Default_Number_Of_Pages = $_POST['numberOfPages'];
    $Paper_Price = $_POST['paperPrice'];
    $File_Types = json_decode($_POST['newFileTypes']);
    $Refill_Dates = json_decode($_POST['newRefillDates']);
    
    // UPDATE Configuration into DB
    $sql = "UPDATE `Configuration`
            SET Default_Number_Of_Pages = '$Default_Number_Of_Pages',
            Paper_Price = '$Paper_Price'
            WHERE ID = '0';
        ";
    $conn->query($sql);

    // UPDATE Accepted_File_Types into DB
    $sql = "DELETE FROM Accepted_File_Types";
    $conn->query($sql);

    foreach($File_Types as $Type) {
        $sql = "INSERT INTO Accepted_File_Types(File_Type)
                VALUE ('$Type')
                ";
        $conn->query($sql);
    }

    // UPDATE Refill_Dates into DB
    $sql = "DELETE FROM Refill_Dates";
    $conn->query($sql);

    foreach($Refill_Dates as $Date) {
        $sql = "INSERT INTO Refill_Dates(Refill_Date)
                VALUE ('$Date')
                ";
        $conn->query($sql);
    }
?>