<?php
    if (isset($_SESSION) == false){
        session_start();
    }
    include_once "DatabaseConnection.php";
    $selectPrinterQuery = "SELECT * FROM printer";
    $printerResultPointer = mysqli_query($connection,$selectPrinterQuery);
?>
    <?php if (isset($_SESSION['errorMessage'])){ ?>
        <script>
            window.alert("<?= $_SESSION['errorMessage'] ?>");
        </script>
        <?php
            unset($_SESSION['errorMessage']);
        ?>
    <?php } ?>
    <?php if (isset($_SESSION['requestSuccess'])){ ?>
        <script>
            window.alert("Successfully request printing for a document\n");
        </script>
        <?php
            unset($_SESSION['requestSuccess']);
        ?>
    <?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dịch vụ sinh viên</title>

    <!-- custom css file link -->
    <link rel="stylesheet" type="text/css" href="printtingService.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- js file link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../SetUsernameOnHeader.js"></script>
</head>
<body>
    <!-- header section starts -->
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
                <a href="#" class="logout">Đăng xuất</a>
            </div>
        </div>
    </section>

    <!-- header section ends -->




    <!-- body section starts -->

    <div class="body">
        <form method="post" action="RequestPrinting.php" onsubmit="return ValidateRequest();" enctype="multipart/form-data">
            <h1 class="title">đăng ký in tài liệu</h1>
            <p>Tệp tin cần in:</p>
            <div class = "mainFrame">
                <div id = "inputFile"> 
                    <div id = uploadFile>
                        <label id = "inputLabel" for="myFile"><i style = "margin-right: 5px;" class="fas fa-file"></i>Chọn tệp tin</label>
                        <input style = "display: none;" type="file" id="myFile" name="filename" onchange="displayFileName()">
                        <p id="selectedFileName">Không có tệp nào được chọn</p>
                    </div>
                    <div id = "choosePrintter">
                        <label for="printter"><i style = "margin-right: 5px;" class="fas fa-print"></i>Chọn máy in: </label>
                        <select name="printter" id="printter">
                            <?php while($printerData = mysqli_fetch_assoc($printerResultPointer)){ ?>
                                <option value="<?= $printerData['Printer_ID'] ?>"><?= $printerData['Printer_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div id = "configureFile">
                    <div id = "choosePaperSize">
                        <label id = "paperSize" for = "paperSize">Khổ giấy: </label>
                        <select name="paperSize" id="paperSize">
                            <option value="A4">A4</option>
                            <option value="A3">A3</option>
                        </select>
                    </div>
                    <div class = "choosePaperPrintAndSide"  id = "choosePaperPrint">
                        <label for = "paperPrint">Trang in: </label>
                        <div class="radioContainer">
                            <div class="radioOption">
                                <input type="radio" id="allPages" name="paperPrint" value="allPages" checked>
                                <label for="allPages">Tất cả trang</label>
                            </div>
                            <!--
                            <div class="radioOption">
                                <input type="radio" id="choosenPage" name="paperPrint" value="choosenPage">
                                <label for="choosenPage">Chỉ trang được chọn</label>
                            </div>
                            -->
                            <div class="radioOption">
                                <input type="radio" id="chooseRange" name="paperPrint" value="chooseRange">
                                <label for="chooseRange">In trong đoạn</label>
                            </div>
                            <div class="radioOption">
                                <input type="text" id="startPage" name="startPage" placeholder="ví dụ: 1-2, 3-5" disabled>
                            </div>
                        </div>
                    </div>
                    <div class = "choosePaperPrintAndSide" id = "choosePaperSide">
                        <label for = "paperSide">Mặt giấy: </label>
                        <div class="radioContainer">
                            <div class="radioOption">
                                <input type="radio" id="oneSide" name="paperSide" value="1" checked>
                                <label for="oneSide">Một mặt</label>
                            </div>
                            <div class="radioOption">
                                <input type="radio" id="twoSide" name="paperSide" value="2">
                                <label for="twoSide">Hai mặt</label>
                            </div>
                        </div>
                    </div>
                    <div id = "chooseNumberPrint"> <!-- số bản in-->
                        <label for = "numberPrint">Số bản in: </label>
                        <input type = "number" placeholder="Nhập số bản in" id = "numberPrint" name = "numberPrint">
                    </div>
                </div>
            </div>
            <button type="submit" id = "submitButton">Đăng ký</button>
        </form>
    </div>

    <!-- body section ends -->




    <!-- footer section starts -->
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
    <!-- footer section ends -->
    <script>
        function displayFileName() {
            var fileInput = document.getElementById('myFile');
            var fileNameDisplay = document.getElementById('selectedFileName');
            if (fileInput.files.length > 0){
                // Lấy tên của tệp tin đã chọn
                var fileName = fileInput.value.split('\\').pop();
                // Hiển thị tên tệp tin
                fileNameDisplay.innerText = fileName;
            }else{
                fileNameDisplay.innerHTML = "Không có tệp nào được chọn";
            }
        }

    </script>
    <script src="printingService.js"></script>
    <script src="Validate.js"></script>
    <?php if (isset($_SESSION['errorMessage'])){ ?>
        <script>
            window.alert(<?= $_SESSION['errorMessage'] ?>)
        </script>
        <?php
            unset($_SESSION['errorMessage']);
        ?>
    <?php } ?>
    <?php if (isset($_SESSION['requestSuccess'])){ ?>
        <script>
            window.alert("Successfully request printing for a document\n");
        </script>
        <?php
            unset($_SESSION['requestSuccess']);
        ?>
    <?php } ?>
</body>
</html>