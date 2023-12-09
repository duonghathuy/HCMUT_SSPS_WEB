<?php
    if (isset($_SESSION) == false){
        session_start();
    }
    include_once "GetConfiguration.php";
?>  
<?php if (isset($_SESSION['update'])){ ?>
    <script>window.alert("Cập nhật thành công");</script>
    <?php
        unset($_SESSION['update']);
    ?>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cấu hình hệ thống</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="ConfigureSystem.css">
        <script src="ConfigureValidation.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
                    <a href="" class="username-header">Username</a>
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
            <h1 class="title">Cấu hình hệ thống</h1>
            <form name="configure-system" method="post" action="UpdateConfiguration.php" onsubmit="return ValidateConfiguration()">
                <div>
                    Số giấy in mặc định: <input type="number" name="numberOfPages" placeholder="<?= $configurationData['Default_Number_Of_Pages'] ?>" min="0">
                </div>
                <div>
                    Giá một trang in: <input type="number" name="paperPrices" placeholder="<?= $configurationData['Paper_Price'] ?>" min="0">
                </div>
                <div class="supply-date">
                    Thời điểm cung cấp giấy in:
                    <input type="datetime-local" name="supplyDate">
                    <div class="extension-setting-button">
                        <button type="button" onclick="AddDate()">Thêm</button>
                    </div>
                </div>
                <div class="supply-date-list">
                    
                </div>
                <div class="file-extension">
                    Định dạng tập tin cho phép:
                    <input type="text" name="extension" placeholder="Điền tên định dạng cần thêm hoặc xóa">
                    <div class="extension-setting-button">
                        <button type="button" onclick="if (AddExtension()){AddFile();}">Thêm</button>
                    </div>
                </div>
                <div class="permitted-file-type">
                    
                </div>
                <div class="submit-button">
                    <button type="submit">Lưu</button>
                </div>
            </form>
            
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
        <script src="AjaxFunction.js"></script>
    </body>
</html>