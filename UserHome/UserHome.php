<?php
    session_start();
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
    <link rel="stylesheet" type="text/css" href="UserHome.css" >

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
                <div>
                    <a href="#" class="login">Đăng nhập</a>
                </div>
            </div>
        </section>
    </header>

    <!-- header section ends -->


    <!-- body section starts -->

    
    <div class="main">
        <img src="../images/slbktv.jpg" alt="backkhoa"/>
        <div class="home-title">
            <p class="school-name">TRƯỜNG ĐẠI HỌC BÁCH KHOA - ĐHQG TP.HCM</p>
            <p class="service-name">STUDENT SMART PRINTING SERVICE</p>
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

<script>
    localStorage.setItem("ID", <?php echo $_SESSION['id']; ?>)
    localStorage.setItem("Username", <?php echo "\"".$_SESSION['username']."\""; ?>)
    localStorage.setItem("Role", <?php echo "\"".$_SESSION['role']."\""; ?>)
</script>