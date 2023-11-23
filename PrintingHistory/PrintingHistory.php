<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhật kí sử dụng dịch vụ in</title>

    
    <!-- custom css file link -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="PrintingHistory.css" >

    <!-- js file link -->
    <script src="PrintingHistory.js"></script>

</head>
<body>
    <!-- header section starts -->
    <header id="app-header">
        <section class="header">
            <div class="left-side">
                <div class="logo">
                    <a href="#">
                        <img src="../images/logo.png" alt="logo" />
                        <p>ĐẠI HỌC QUỐC GIA TP.HCM<br>TRƯỜNG ĐẠI HỌC BÁCH KHOA</p>
                    </a>
                </div>
                
                <div class="menu-bar">
                    <div class="first-option"><a href="">trang chủ</a></div>
                    <div class="second-option"><a href="" >dịch vụ của tôi</a></div>
                </div>
            </div>
        
            <div class="right-side">
                <div class="username">Username</div>
                <div class="seperator">|</div>
                <div>
                    <a href="#" class="login">Đăng xuất</a>
                </div>
            </div>
        </section>
    </header>
    <!-- header section ends -->


    <!-- body section starts -->

    <div class="body">
        <h1 class="title">Nhật kí sử dụng dịch vụ in</h1>

        <div class="registration-history">
            <table>
                <thead>
                    <tr>
                        <th>Mã phiếu</th>
                        <th>Ngày đăng ký</th>
                        <th>Ngày hoàn thành</th>
                        <th>Tập tin</th>
                        <th>Các trang cần in</th>
                        <th>Số trang trên 1 mặt</th>
                        <th>Số bản in</th>
                        <th>Tổng số trang</th>
                        <th>Mã máy in</th>
                        <th class="request-status-th">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        @include_once("../ConnectDB.php");
                        // Get Balance of Owner_ID
                        $sql = "SELECT Balance
                            FROM Student
                            WHERE Student_ID = 1";

                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        $Balance = $row["Balance"];

                        // Get Printing_Request DB
                        $sql = "SELECT Request_ID, Registration_Date, Completion_Date, File_Name, Pages_Per_Sheet, Number_Of_Copies, Printer_ID, Request_Status
                                FROM Printing_Request
                                WHERE Owner_ID = 1
                                ORDER BY Registration_Date DESC
                                ";

                        $result = $conn->query($sql);
    
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
                                echo "
                                    <tr>
                                        <td>".$row["Request_ID"]."</td>
                                        <td>".$row["Registration_Date"]."</td>
                                        <td>".$completion_date."</td>
                                        <td>".$row["File_Name"]."</td>
                                        <td>".$requested_page_number_list."</td>
                                        <td>".$row["Pages_Per_Sheet"]."</td>
                                        <td>".$row["Number_Of_Copies"]."</td>
                                        <td>".$total_of_pages."</td>
                                        <td>".$row["Printer_ID"]."</td>
                                        <td class='request-status $status'>
                                            <a href='SendRequest.php?Request_ID=".$row['Request_ID']."&Total_Of_Pages=".$total_of_pages."' class='status-btn $status' onclick= 'return confirmSend($Balance - $total_of_pages)'>".$request_status."</a>
                                            <span>/ </span>
                                            <a href='DeleteAnRequest.php?Request_ID=".$row['Request_ID']."' class='delete-btn' onclick='return confirmDelete()'>Xóa</a>
                                        </td>
                                    </tr>
                                ";
                            }
                        } else {
                            echo "<tr>
                                <td>...</td>
                                <td>...</td>
                                <td>...</td>
                                <td>...</td>
                                <td>...</td>
                                <td>...</td>
                                <td>...</td>
                                <td>...</td>
                                <td>...</td>
                                <td>...</td>
                            </tr>";
                        }
                    ?> 
                </tbody>
            </table>
        </div>
        
    </div>


    <!-- body section ends -->


    <!-- footer section starts -->
    <footer id="app-footer">
        <div class="footer-container">
            <section class="footer">
                <div class="box-container">
                    <div class="box">
                        <h3>student smart printing service</h3>
                        <img src="../images/logo.png" alt="logo" />
                    </div>
    
                    <div class="box">
                        <h3>website</h3>
                        <a href="https://hcmut.edu.vn/" class="hcmut">HCMUT</a>
                        <a href="https://mybk.hcmut.edu.vn/my/index.action" class="mybk">MyBK</a>
                        <a href="https://mybk.hcmut.edu.vn/bksi/public/vi/" class="bksi">BKSI</a>
                    </div>
    
                    <div class="box">
                        <h3>liên hệ</h3>
                        <a href="#"> <div class="location-icon"></div>268 Ly Thuong Kiet Street Ward 14, District 10, Ho Chi Minh City, Vietnam </a>
                        <a href="#"> <div class="phone-icon"></div>(028) 38 651 670 - (028) 38 647 256 (Ext: 5258, 5234) </a>
                        <a href="mailto:elearning@hcmut.edu.vn" class="email"> <div class="email-icon"></div>elearning@hcmut.edu.vn </a>
                    </div>
                </div>
            </section>
            <div class="copyright">
                <p>Copyright 2007-2022 BKEL - Phát triển dựa trên Moodle</p>
            </div>
        </div>
    </footer>
    <!-- footer section ends -->
</body>
</html>
