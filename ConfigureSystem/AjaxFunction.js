
function DisplaySupplyDateList(){
    var supplyDateList = document.querySelector(".supply-date-list");
    $.ajax({
        url: "GetRefillDate.php",
        success: function(result){
            supplyDateList.innerHTML = result;
        }
    })
}
function DisplayAcceptedFileTypesList(){
    var permittedFileTypeList = document.querySelector(".permitted-file-type");
    $.ajax({
        url: "GetAcceptedFileTypes.php",
        success: function(result){
            permittedFileTypeList.innerHTML = result;
        }
    })
}
window.onload = function(){
    DisplaySupplyDateList();
    DisplayAcceptedFileTypesList();
}
function DeleteDate(dateId){
    $.ajax({
        url: "DeleteDate.php?date_id=" + dateId,
        success: function(result){
            DisplaySupplyDateList();
        }
    })
}
function DeleteFile(fileType){
    $.ajax({
        url: "DeleteFile.php?File_Type=" + fileType,
        success:function(result){
            DisplayAcceptedFileTypesList();
        }
    })
    
}
function AddDate(){
    let supplyDate = document.querySelector("input[name='supplyDate']");
    $.ajax({
        url: "InsertDate.php?date=" + supplyDate.value,
        success:function(result){
            DisplaySupplyDateList();
        }
    })
}
function AddFile(){
    let extension = document.querySelector("input[name='extension']");
    $.ajax({
        url: "InsertFile.php?File_Type=" + extension.value,
        success:function(result){
            extension.value = "";
            DisplayAcceptedFileTypesList();
        }
    })
}