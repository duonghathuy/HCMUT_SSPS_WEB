<?php
    @include_once("../ConnectDB.php");

    // Get Balance
    $sql = "SELECT Balance 
        FROM Student
        WHERE Student_ID = 1
        ";
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dịch vụ sinh viên</title>

     
    <!-- custom css file link -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="BuyPrintingPages.css" >

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
        <h1 class="title">MUA THÊM TRANG IN</h1>

        <div class="balance-container">
            <p>Số trang in hiện tại:</p>
            <?php
                echo "<p class='balance'>$balance trang (Khổ A4)</p>";
            ?>
        </div>

        <form method="POST" action="" class="registration">
            <label for="quantity">Số lượng trang in mua thêm:</label>
            <input type="number" id="quantity" name="quantity" placeholder="Số lượng trang (Khổ A4)" min="1">
            <button type="submit" id="submit-order" name='submit-order' class="submit-order">Đăng ký</button>
        </form>
        
        <!-- Popup to confirm order -->
        <div class="popup" id="popup">
            <div class="overlay"></div>
            <div class="popup-content">
                <h2>Đăng ký mua trang in</h2>
                <?php
                    echo "<p>Số lượng: $quantity trang (Khổ A4)</p>";
                ?>
                <?php
                    echo "<p>Tổng số tiền: $total_price VNĐ</p>";
                ?>

                <form   class="controls">
                    <button type="button" class="close-btn" onclick="closePopup('#popup')">Hủy</button>
                    <button type="submit" name='' class="submit-btn">Xác nhận</button>
                </form>
            </div>
        </div>

        <?php
            echo "<p class='info-about-price'>(Lệ phí: $price VNĐ/trang in khổ  A4)</p>";
        ?>

        <div class="registration-history">
            <p>Lịch sử đăng ký:</p>
            <table>
                <thead>
                    <tr>
                        <th>Mã phiếu</th>
                        <th>Ngày đăng ký</th>
                        <th>Số lượng</th>
                        <th>Lệ phí</th>
                        <th class="payment-status-th">Thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    @include_once("../ConnectDB.php");

                    $sql = "SELECT Order_ID, Order_Creation_Date, Quantity, Payment_Status, Owner_ID
                            FROM BPP_Order
                            WHERE Owner_ID = 1
                            ORDER BY Order_Creation_Date DESC
                            ";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $payment_status = 'Đã thanh toán';
                            $status = 'paied';
                            if($row["Payment_Status"] == 0) {
                                $payment_status = 'Thanh toán ngay';
                                $status = 'unpaid';
                            }
                        
                            // Calculate Total_Price = Quantity * Paper_Price
                            $total_price = number_format($price * $row['Quantity']);

                            echo "<tr>
                                <td>".$row["Order_ID"]."</td>
                                <td>".$row["Order_Creation_Date"]."</td>
                                <td>".$row["Quantity"]."</td>
                                <td class='total-price'>".$total_price."</td>
                                <td class='payment-status $status'>
                                    <a href='UpdateBalance.php?Owner_ID=".$row['Order_ID']."' class='pay-btn  payment-btn'>".$payment_status."</a>
                                    <span>/ </span>
                                    <a href='DeleteAnOrder.php?Order_ID=".$row['Order_ID']."' class='delete-btn payment-btn'>Xóa</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td class='total-price'>...</td>
                            <td class='payment-status'>...</td>
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