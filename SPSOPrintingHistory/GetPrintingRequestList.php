<?php
    @include_once("../ConnectDB.php");

    // Get Printing_Request DB
    $sql = "SELECT *
            FROM Printing_Request
            ORDER BY Registration_Date DESC
            ";

    $result = $conn->query($sql);

    $data = array();

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

            // Get Info of Owner
            $info_sql = "SELECT Fname, Lname
                    FROM Users
                    WHERE ID = {$row["Owner_ID"]}";
            $info_result = $conn->query($info_sql);
            $info_row = $info_result->fetch_assoc();
            $name = "{$info_row['Lname']} {$info_row['Fname']}";
            // Display Data
            array_push($data,
                array(
                    'Request_ID' => $row["Request_ID"],
                    'Owner_ID' => $row['Owner_ID'],
                    'Name' => $name,
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