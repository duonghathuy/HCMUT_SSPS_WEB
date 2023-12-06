<?php
        @include_once("../ConnectDB.php");
        $sql = "SELECT Default_Number_Of_Pages
                FROM Configuration
                WHERE ID = 0
                ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $Default_Number_Of_Pages = $row['Default_Number_Of_Pages'];
        echo $Default_Number_Of_Pages;
        // Update New Balance into Student Database
        $sql = "UPDATE Users
                SET Balance = Balance + ". $Default_Number_Of_Pages;
        $conn->query($sql);
?>