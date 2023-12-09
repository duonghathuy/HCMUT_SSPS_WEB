function ValidateRequest(){
    var fileInput = document.getElementById('myFile');
    let paperPrint = document.querySelector("input[name='paperPrint']:checked").value;
    let numberOfCopies= document.getElementById("numberPrint");

    if (fileInput.files.length == 0){
        window.alert("Vui lòng chọn file cần in\n");
        return false
    }
    if (paperPrint == "chooseRange"){
        let range = document.getElementById("startPage").value;
        if (IsRangeValid(range) == false){
            window.alert("Đoạn trang cần in không hợp lệ\n");
            return false;
        }
    }
    if (numberOfCopies.value == ""){
        window.alert("Vui lòng nhập số bản in\n");
        numberOfCopies.focus();
        return false;
    }
    if (numberOfCopies.value < 0 || Number.isInteger(Number(numberOfCopies.value)) == false){
        window.alert("Số bản in phải là một số nguyên dương\n");
        numberOfCopies.focus();
        return false;
    }
    return true;
}
function IsRangeValid(range){
    if (range == ""){
        return false;
    }
    if (range.indexOf("-") == -1){
        return false;
    }
    let array = range.split("-");
    if (array.length != 2){
        return false;
    }
    let startPage = Number(array[0]);
    let endPage = Number(array[1]);
    if (Number.isInteger(startPage) == false || Number.isInteger(endPage) == false){
        return false;
    }
    if (startPage >= endPage){
        return false;
    }
    return true;
}