<?php
    include_once "../ConnectDB.php";
    if (isset($_POST["submitButton"])) {
        $error = "";
        $username = $_POST["username"];
        $password = $_POST["password"];
        $checkRemember = isset($_POST["remember"]) ? $_POST["remember"] : 0;

        if (strlen($username) < 2 || strlen($username) > 30) {
            $error .= "Tên đăng nhập phải từ 2 đến 30 kí tự.\n";
        }

        if (strlen($password) < 6) {
            $error .= "Mật khẩu phải chứa ít nhất 6 kí tự.\n";
        }

        if (empty($error)) {
            $sql = "SELECT * FROM users WHERE Username = '$username'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row["Password"])) {
                    session_start();
                    $_SESSION["username"] = $row['Lname'] . " " . $row['Fname'];
                    $_SESSION["id"] = $row["ID"];
                    $_SESSION["role"] = $row["Role"];
                    header("Location: ../UserHome/UserHome.php");
                    $error .= "Đăng nhập thành công.";
                } 
                else {
                    $error .= "Tên đăng nhập hoặc mật khẩu không đúng.";
                }
            } 
            else {
                $error .= "Tên đăng nhập hoặc mật khẩu không đúng.";
            }
            mysqli_close($conn);
        }
        if (!empty($error)) {
            echo "<script>alert('$error');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="/applogo.png"/>
    <style>
        *{
            box-sizing: border-box;
            font-family: "Inter";  
        }
        .container{
            margin-top: 120px;
            margin-bottom: 120px;
            width: 60%;
        }
        .loginForm{
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 10px;
        }
        .loginForm h2{
            text-align: center;
            margin-bottom: 20px;
            margin-top: 40px;
        }
        .loginForm label{
            font-weight: 500;
        }
        .loginForm .formFlex{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .loginForm button{
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
        .loginForm .btn{
            height: 50px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <!-- Header -->

    <div class = "container">
        <div class = "loginForm">
            <h2>ĐĂNG NHẬP</h2>
            <form action = "" method  = "POST">
                <div class="form-floating mb-3">
                    <input name = "username" type="text" class="form-control" id="floatingUsername" placeholder="name@example.com">
                    <label for="floatingUsername">Tên đăng nhập</label>
                </div>
                <div class="form-floating">
                    <input name = "password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Mật khẩu</label>
                </div>
                <div class = formFlex>
                    <div class = "rememberCheckbox">
                        <input type="checkbox" id="remember" name="remember" value="1">
                        <label for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                    <div class = "registerButton">
                        <a href = "register.php">Chưa có tài khoản? Đăng ký</a>
                    </div>
                </div>
                <button type="button" class="btn btn-info" onclick = "validateChecker()">Đăng nhập</button>
                <button style = "display:none;" type="submit" class="btn btn-dark" id = "submitButton" name = "submitButton">Đăng nhập</button>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        function validateChecker(){
            var username = document.getElementById('floatingUsername').value;
            var password = document.getElementById('floatingPassword').value;

            var errorMessage = '';

            if (username.length < 2 || username.length > 30) {
                errorMessage += 'Tên đăng nhập phải từ 2 đến 30 kí tự.\n';
            }

            if (password.length < 6) {
                errorMessage += 'Mật khẩu phải chứa ít nhất 6 kí tự.\n';
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
