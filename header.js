let appHeader = `
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
        <a href="login.php" class="login">Đăng nhập</a>
    </div>
    </section>
`;

document.getElementById("app-header").innerHTML = appHeader;