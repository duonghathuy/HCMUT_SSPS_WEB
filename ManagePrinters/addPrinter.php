<?php

@include '../ConnectDB.php';
session_start();
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $userId = $_SESSION['id'];
} else {
    $userId = 123;
}

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $Username = $_SESSION['username'];
} else {
    $Username = 'Test';
}
// prevent campus not chosen brick the html
if (isset($_POST['campus'])) {
    $selectedCampus = $_POST['campus'];
} else {
    $selectedCampus = null;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./globalManagePrinter.css" />
    <link rel="stylesheet" href="./addPrinter.css" />
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" />

    <!-- swiper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../SetUsernameOnHeader.js"></script>
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
                    <a href="#" class="logout">Đăng xuất</a>
                </div>
            </div>
        </section>
    </header>

    <!-- header section ends -->

    <section class="main">
        <div class="container">
            <div class="main-text">
                <p>QUẢN LÝ MÁY IN</p>
            </div>
            <form id="addPrinterForm" method="POST" action="addPrinterToDB.php">
                <!-- Hidden fields for campus and building -->
                <input type="hidden" id="campusField" name="campus" value="">
                <input type="hidden" id="buildingField" name="building" value="">

                <div class="campus">
                    <label class="choose-campus" name="campus">Chọn cơ sở</label>
                    <button class="campus-button" id="campus1"
                        style="display:flex; align-items:center; background-color: white" onclick="updateBuilding(1)">
                        <div class="campus-button-text">Cơ sở 1</div>
                    </button>
                    <button class=" campus-button campus-container"
                        style="display:flex; align-items:center; background-color: white" id="campus2"
                        onclick="updateBuilding(2)">
                        <div class="campus-button-text">Cơ sở 2</div>
                    </button>
                </div>
                <div class=" flex">
                    <div class="building">
                        <label class="choose-building">Chọn toà:</label>
                        <div>
                            <select class="dropdown-menu" name="building" onchange="setBuilding(this.value)">
                                <option class="embed" value="toa1">choose-building</option>
                                <?php
                                $selectedCampus = $_POST['campus'];

                                if ($selectedCampus != null) {
                                    $query = "SELECT * FROM Printer WHERE Printer_campusloc = '$selectedCampus'";
                                    $result = $conn->query($query);
                                }
                                if ($result) {
                                    // Process the query result
                                    while ($row = $result->fetch_assoc()) {
                                        // Access the data from the row
                                        $columnValue = $row['printer_buildingloc'];
                                        // Generate the HTML code for each building option
                                        echo '<option class="embed" value="' . $columnValue . '">' . $columnValue . '</option>';
                                    }
                                } else {
                                    // Handle the case when the query fails
                                    echo "Error executing the query: " . $conn->error;
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="add-printer">
                    <div class="menu">
                        <b class="input-text">ID</b>
                        <div class="input">
                            <input type="text" name="printerId" class="ID-text input-text1" required>
                        </div>
                        <button class="check-button" onclick="clearTextID()">Check</button>
                        <span id="idExistsText" class="id-check-text"></span>
                    </div>
                    <div class="menu">
                        <b class="input-text">Tên</b>
                        <div class="input">
                            <input type="text" name="printerName" required>
                        </div>
                    </div>
                    <div class="menu">
                        <b class="input-text">Description</b>
                        <div class="input">
                            <input type="text" name="printerDesc" required>
                        </div>
                    </div>
                    <div class="menu">
                        <b class="input-text">Phòng</b>
                        <div class="input">
                            <input type="text" name="printerRoom" required>
                        </div>
                    </div>
                    <button type="submit" class="confirm-button">
                        <p>Xác nhận thêm máy in</p>
                    </button>
                </div>
            </form>
            <!-- <div class="campus">
                <label class="choose-campus" name="campus">Chọn cơ sở</label>
                <button class="campus-button campus-container" id="campus1" onclick="updateBuilding(1)">Cơ sở 1</button>
                <button class=" campus-button campus-container" id="campus2" onclick="updateBuilding(2)">Cơ sở
                    2</button>
            </div>
            <div class=" flex">
                <div class="building">
                    <label class="choose-building">Chọn toà:</label>
                    <div>
                        <select class="dropdown-menu" name="building" onchange="setBuilding(this.value)">
                            <option class="embed" value="toa1">choose-building</option>
                            <?php
                            $selectedCampus = $_POST['campus'];

                            if ($selectedCampus != null) {
                                $query = "SELECT * FROM Printer WHERE Printer_campusloc = '$selectedCampus'";
                                $result = $conn->query($query);
                            }
                            if ($result) {
                                // Process the query result
                                while ($row = $result->fetch_assoc()) {
                                    // Access the data from the row
                                    $columnValue = $row['Printer_buildingloc'];
                                    // Generate the HTML code for each building option
                                    echo '<option class="embed" value="' . $columnValue . '">' . $columnValue . '</option>';
                                }
                            } else {
                                // Handle the case when the query fails
                                echo "Error executing the query: " . $conn->error;
                            }
                            ?>

            </div> -->

    </section>

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
                    <a href="#">
                        <div class="location-icon"></div>268 Ly Thuong Kiet Street Ward 14, District 10, Ho Chi Minh
                        City, Vietnam
                    </a>
                    <a href="#">
                        <div class="phone-icon"></div>(028) 38 651 670 - (028) 38 647 256 (Ext: 5258, 5234)
                    </a>
                    <a href="mailto:elearning@hcmut.edu.vn" class="email">
                        <div class="email-icon"></div>elearning@hcmut.edu.vn
                    </a>
                </div>
            </div>
        </section>
        <div class="copyright">
            <p>Copyright 2007-2022 BKEL - Phát triển dựa trên Moodle</p>
        </div>
    </div>

    <script>
        // For saving campus
        $(document).ready(function () {
            $('.campus-button').click(function () {
                var selectedCampus = $(this).attr('id');

                localStorage.setItem('selectedCampus', selectedCampus);
                $.post('updateCampus.php', { campus: selectedCampus }, function (response) {
                });
            });

            //for filtering building in campus, idk but do not touch 
            $(document).ready(function () {
                $('.campus-button').click(function () {
                    var selectedCampus = $(this).attr('id').replace('campus', '');

                    // Send an AJAX request to getBuildings.php
                    $.post('updateBuilding.php', { campus: selectedCampus }, function (response) {
                        // Parse the JSON response from the server
                        var buildings = JSON.parse(response);

                        // Clear the building dropdown list
                        $('select[name="building"]').empty();

                        // Add each building to the dropdown list
                        $.each(buildings, function (index, building) {
                            $('select[name="building"]').append('<option class="embed" value="' + building + '">' + building + '</option>');
                        });
                    });
                });
            });
        });
        $(document).ready(function () {
            $('select[name="building"]').change(function () {
                var selectedBuilding = $(this).val();

                document.getElementById('buildingField').value = selectedBuilding;

                $('select[name="printer"]').empty();

                $.post('updatePrinters.php', { building: selectedBuilding }, function (response) {
                    var printers = JSON.parse(response);

                    $.each(printers, function (index, printer) {
                        $('select[name="printer"]').append('<option class="embed" value="' + printer + '">' + printer + '</option>');
                    });
                });
            });
        });
        $(document).ready(function () {
            $('select[name="printer"]').change(function () {
                var selectedPrinter = $(this).val();
                $.post('getPrinterDetails.php', { printerId: selectedPrinter }, function (response) {
                    var printer = JSON.parse(response);
                    $('.printer-info-text').eq(0).text(printer.PRINTERS_ID);
                    $('.printer-info-text').eq(1).text(printer.PRINTERS_NAME);
                    $('.printer-info-text').eq(2).text(printer.PRINTERS_AVAI == 'Y' ? 'Đang hoạt động' : 'Không hoạt động');
                });
            });
        });

        function openUpdatePrinterState() {
            window.open("updatePrinterState.php", "_blank", "width=500,height=500");
        }

        function clearText(element) {
            element.style.color = "black";
        }

        function updateBuilding(campusNumber) {
            document.getElementById('campusField').value = campusNumber;
            $.ajax({
                type: "POST",
                url: "updateBuilding.php",
                data: { campus: campusNumber },
                success: function (response) {
                    // Parse the JSON response from the server
                    var buildings = JSON.parse(response);

                    // Clear the building dropdown list
                    $('select[name="building"]').empty();

                    // Add each building to the dropdown list
                    $.each(buildings, function (index, building) {
                        $('select[name="building"]').append('<option class="embed" value="' + building + '">' + building + '</option>');
                    });
                }
            });
        }
        function clearTextID() {

            var inputElement = $('.input-text1');
            var inputValue = inputElement.val();

            if (inputValue.trim() === '') {
                $('#idExistsText').text("ID is NULL").css('display', 'inline');
                return;
            }

            inputElement.css('color', 'black');
            $.ajax({
                type: "POST",
                url: "checkID.php",
                data: { id: inputValue },
                success: function (response) {
                    // If the ID exists, change the color to red
                    if (response == 'exists') {
                        inputElement.css('color', 'red');
                        inputElement.css('font-weight', 'bold');
                        $('#idExistsText').text("ID already exists").css('display', 'inline');
                    }
                    // If the ID does not exist, change the color to green
                    else {
                        inputElement.css('color', 'green');
                        inputElement.css('font-weight', 'bold');
                        $('#idExistsText').text("This ID is valid").css('display', 'inline');
                    }
                }
            });
        }
        var buttons = document.querySelectorAll('.campus-button');

        // Add click event listener to each button
        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Remove 'active' class from all buttons
                buttons.forEach(function (btn) {
                    btn.classList.remove('active');
                });

                // Add 'active' class to the clicked button
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>