<?php
if (isset($_SESSION) == false){
    session_start();
}
    include_once __DIR__ . "/DatabaseConnection.php";

    $selectFileTypeQuerry = "SELECT * FROM accepted_file_types";
    $fileTypeResult = mysqli_query($connection,$selectFileTypeQuerry);

    $targetDirectory = "RequestedFiles/";
    $targetFile = $targetDirectory . basename($_FILES['filename']["name"]);
    $fileExtension = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    $printterId = $_POST['printter'];
    $paperSize = $_POST['paperSize'];
    $paperPrint = $_POST['paperPrint'];
    $paperSide = $_POST['paperSide'];
    $numberOfCopies = $_POST['numberPrint'];
    $userId = $_SESSION['id'];

    $_SESSION["errorMessage"] = "";

    if ($paperPrint == "chooseRange"){
        $range = $_POST['startPage'];
    }

    if (!is_uploaded_file($_FILES['fileName']['tmp_name'])){
        $_SESSION["errorMessage"] .= "File is not uploaded\n";
    }
    
    $isFileExtensionValid = false;
    while ($permittedFileType = mysqli_fetch_row($fileTypeResult)){
        if ($fileExtension == str_replace(".","",$permittedFileType[0])){
            $isFileExtensionValid = true;
            break;
        }
    }
    if ($isFileExtensionValid == false){
        $_SESSION["errorMessage"] .= "File extension is not allowed\n";
    }

    if (!move_uploaded_file($_FILES['fileName']["tmp_name"],$targetFile)){
        $_SESSION['errorMessage'] .= "There was an error uploading your file\n";
    }
    $fileName = $_FILES['filename']['name'];
    $addRequestQuerry = "INSERT INTO printing_request(Registration_Date, File_Name, Pages_Per_Sheet, Number_Of_Copies,Printer_ID,Request_Status,Owner_ID) 
    VALUES (NOW(),'$fileName',$paperSide,$numberOfCopies,'$printterId','Đã gửi',$userId);";
    if (mysqli_query($connection,$addRequestQuerry) == false){
        $_SESSION['errorMessage'] .= "Insert into printing_request failed\n";
    }
    if ($paperPrint == "chooseRange"){
        $pair = explode("-",$range);
        $startPage = $pair[0];
        $endPage = $pair[1];
        $requestId = mysqli_insert_id($connection);

        $query = "INSERT INTO requested_page_numbers VALUES ($requestId,$startPage,$endPage)";
        if (mysqli_query($connection,$query) == false){
            $_SESSION['errorMessage'] = "Insert into requested_page_numbers failed\n";
        }
    }

    if ($_SESSION['errorMessage'] == ""){
        unset($_SESSION["errorMessage"]);
        $_SESSION['requestSuccess'] = "success";
    }
    header("location: printtingService.php");
?>