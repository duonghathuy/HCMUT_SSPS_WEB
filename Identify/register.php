<?php
    include_once "../ConnectDB.php";
    if (isset($_POST["submitButton"])) {
        $error = "";
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $sex = $_POST["sex"];
        $dob = $_POST["dob"];

        $retypePassword = $_POST["retypePassword"];

        if (strlen($username) < 2 || strlen($username) > 30) {
            $error .=  "Tên đăng nhập phải từ 2 đến 30 kí tự.\n";
        }
        if (strlen($password) < 6) {
            $error .= "Mật khẩu phải chứa ít nhất 6 kí tự.\n";
        }
        if ($password !== $retypePassword) {
            $error .= "Mật khẩu nhập lại không khớp.";
        }

        if ($error == ""){
            $sql = "SELECT * FROM users WHERE Username = '$username'";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                $error .= "Tên đăng nhập đã tồn tại.";
            } 
            else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (Username, Password, Fname, Lname, Email, Sex, DateOfBirth) 
                        VALUES ('$username', '$hashedPassword', '$fname', '$lname', '$email', '$sex', '$dob')";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $error .= "Đăng ký tài khoản thành công!";
                } 
                else {
                    $error .= "Đăng ký tài khoản thất bại!";
                }
            }
            mysqli_close($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Đăng ký</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        *{
            box-sizing: border-box;
            font-family: "Inter";  
        }

        .pageHeader{
            position: relative;
            width: 100%;
            padding: 0px;
        }
        .pageHeader .nav-item { 
            padding-left: 7px;
            padding-right: 7px;
        }

        .container{
            width: 70%;
            margin-top: 70px;
            margin-bottom: 70px;
        }
        .registerForm{
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 10px;
        }
        .registerForm h2{
            text-align: center;
            margin-top: 40px;
        }
        .registerForm label{
            font-weight: 500;
        }
        .registerForm .registerButton{
            margin-top: 20px;
        
        }
        .registerForm button{
            width: 100%;
            margin-top: 20px;
            border-radius: 10px;
        }
        hr{
            border: 1px solid #000;
            margin: 0px;
        }
        input{
            border: 0px;
        }
        a{
            text-decoration: none;
            color: blue;
            font-weight: bold;
        }
        .registerForm .btn{
            height: 50px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class = "container">
        <div class = "registerForm">
            <h2>ĐĂNG KÝ</h2>
            <form action = "" method  = "POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id = "fname" name = "fname" placeholder="name@example.com">
                    <label for="floatingInput">Họ</label>
                </div>        
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id = "lname" name = "lname" placeholder="name@example.com">
                    <label for="floatingInput">Tên lót và tên</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id = "email" name = "email" placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                </div>        
                <select style = "margin-bottom: 20px;" name = "sex" class="form-select" aria-label="Giới tính">
                    <option selected>Giới tính</option>
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
                <div class="mb-3">
                    <label for="floatingdob" class="form-label">Ngày sinh</label>
                    <input type="date" class="form-control" id="floatingdob" name="dob" value = "Ngày tháng năm sinh">
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id = "floatingusername" name = "username" placeholder="name@example.com">
                    <label for="floatingInput">Tên đăng nhập</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" name = "password" placeholder="Password">
                    <label for="floatingPassword">Mật khẩu</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingretypePassword" name = "retypePassword" placeholder="Password">
                    <label for="floatingPassword">Nhập lại mật khẩu</label>
                </div>
                <div class = "registerButton">
                    <a href = "login.php">Đã có tài khoản? Đăng nhập</a>
                </div>     
                <button type="button" class="btn btn-info" onclick = "validateForm()">Đăng ký</button>
                <button style = "display: none" type="submit" class="btn btn-dark" id = "submitButton" name="submitButton">Đăng ký</button>
            </form>
        </div>

    </div>
    <?php   
        if (isset($_POST["submitButton"])) {
            if ($error != "") {
                echo "<script>alert('$error');</script>";
            }
        } 
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    function validateForm() {
        var username = document.getElementById('floatingusername').value;
        var password = document.getElementById('floatingPassword').value;
        var retypePassword = document.getElementById('floatingretypePassword').value;
        //validate email, dob
        var email = document.getElementById('email').value;
        var dob = document.getElementById('floatingdob').value;
        var errorMessage = '';

        if (username.length < 2 || username.length > 30) {
            errorMessage += 'Tên đăng nhập phải từ 2 đến 30 kí tự.\n';
        }

        if (password.length < 6) {
            errorMessage += 'Mật khẩu phải chứa ít nhất 6 kí tự.\n';
        }

        if (password != retypePassword) {
            errorMessage += 'Mật khẩu nhập lại không khớp.\n';
        }

        //validate email, dob
        if (email == '') {
            errorMessage += 'Email không được để trống.\n';
        }
        else{
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailRegex.test(email)) {
                errorMessage += 'Email không hợp lệ.\n';
            }
        }

        if (dob == '') {
            errorMessage += 'Ngày sinh không được để trống.\n';
        }
        else{
            var dobRegex = /^\d{4}-\d{2}-\d{2}$/;
            if (!dobRegex.test(dob)) {
                errorMessage += 'Ngày sinh không hợp lệ.\n';
            }
        }
        if (errorMessage != '') {
            alert(errorMessage);
        }
        else{
            document.getElementById('submitButton').click();
        }
    }
</script>
</body>
</html>