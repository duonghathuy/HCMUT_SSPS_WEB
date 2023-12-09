<?php
    @include_once("../ConnectDB.php");

    $ID = $_POST['id'];

    // Get Balance of Owner_ID
    $sql = "SELECT Balance
        FROM Users
        WHERE ID = '$ID'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $Balance = $row["Balance"];

    // Get Printing_Request DB
    $sql = "SELECT Request_ID, Registration_Date, Completion_Date, File_Name, Pages_Per_Sheet, Number_Of_Copies, Printer_ID, Request_Status
            FROM Printing_Request
            WHERE Owner_ID = '$ID'
            ORDER BY Registration_Date DESC
            ";

    $result = $conn->query($sql);

    $data = Array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Calculate Total_Of_Pages
            $total_of_pages = 0;

            // Get Requested_Page_Numbers for each Request_ID
            $get_requested_page_numbers_sql =  "SELECT Start_Page_Number, End_Page_Number
                                                FROM Requested_Page_Numbers 
                                                WHERE Request_ID = {$row['Request_ID']}
                                                ";
            
            $requested_page_numbers_result = $conn->query($get_requested_page_numbers_sql);

            $requested_page_number_list = "";
            
            $num_requested_page_numbers = $requested_page_numbers_result->num_rows;
            if($num_requested_page_numbers > 0) {
                $index = 1;
                while($requested_page_number = $requested_page_numbers_result->fetch_assoc()) {
                    $requested_page_number_list = $requested_page_number_list . "{$requested_page_number['Start_Page_Number']}" . " - " . "{$requested_page_number['End_Page_Number']}";
                    if($index < $num_requested_page_numbers) {
                        $requested_page_number_list = $requested_page_number_list . ", ";
                    }
                    $index += 1;

                    // Update $total_of_pages
                    $total_of_pages += $requested_page_number['End_Page_Number'] - $requested_page_number['Start_Page_Number'] + 1;
                }
            }

            // Calculate Total_Of_Pages
            $total_of_pages = ceil($total_of_pages / $row["Pages_Per_Sheet"]);

            if($total_of_pages % 2 != 0) {
                $total_of_pages += 1;
            }

            $total_of_pages *= $row["Number_Of_Copies"];

            // Check Completion_Date
            $completion_date = "...";
            if($row["Completion_Date"]) {
                $completion_date = $row["Completion_Date"];
            }
            
            // Request_Status
            $request_status = 'Gửi in';
            $status = 'saved';
            if($row['Request_Status'] == 'Đã gửi') {
                $status = 'sent';
                $request_status = 'Đã gửi';
            } else if ($row['Request_Status'] == 'Đã hoàn thành') {
                $status = 'completed';
                $request_status = 'Đã hoàn thành';
            }
            
            // Display Data
            array_push($data,
                array(
                    'Request_ID' => $row["Request_ID"],
                    'Registration_Date' => $row["Registration_Date"],
                    'Completion_Date' => $row["Completion_Date"],
                    'File_Name' => $row["File_Name"],
                    'Requested_Page_Numbers' => $requested_page_number_list,
                    'Pages_Per_Sheet' => $row["Pages_Per_Sheet"],
                    'Number_Of_Copies' => $row["Number_Of_Copies"],
                    'Total_Of_Pages' => $total_of_pages,
                    'Printer_ID' => $row["Printer_ID"],
                    'Request_Status' => $row['Request_Status'],
                    'Balance' => $Balance
                )
            );
        }
    }

    echo json_encode($data);
?> 