<?php
    @include_once("../ConnectDB.php");

    // Get Balance
    $sql = "SELECT Balance 
        FROM Users
        WHERE ID = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $balance = $row['Balance'];
    }

    // Get Paper_Price
    $sql = "SELECT Paper_Price 
    FROM Configuration
    WHERE Role = 'Student'
    ";
    $result = $conn->query($sql);

    $price = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $price = $row['Paper_Price'];
    }

    // Save the new order to DB
    if(isset($_POST['submit-order'])) {
        // Get Quantity
        $quantity = $_POST['quantity'];

        // Get the current date and time
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date("Y/m/d H:i:s");

        // INSERT into DB
        $sql = "INSERT INTO BPP_Order (Order_ID, Order_Creation_Date, Quantity, Payment_Status, Owner_ID)
                VALUES (NULL, '$date', '$quantity', '0', '1')
            ";

        $conn->query($sql) or die("". $conn->error);
    }

    // Return
    header("Location: BuyPrintingPages.php");
?>