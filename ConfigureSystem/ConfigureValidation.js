function ValidateConfiguration(){
    let numberOfPagesInput = document.querySelector("input[name='numberOfPages']");
    let numberOfPages = Number(numberOfPagesInput.value);
    let paperPriceInput = document.querySelector("input[name='paperPrices']")
    let paperPrice = Number(paperPriceInput.value);
    if ((Number.isInteger(numberOfPages) == false) || (numberOfPages < 0)){
        numberOfPagesInput.focus();
        window.alert("Số trang phải là số nguyên dương\n");
        return false;
    }
    if ((Number.isInteger(paperPrice) == false) || (paperPrice < 0)){
        paperPriceInput.focus();
        window.alert("Giá tiền phải là số nguyên dương\n");
        return false;
    }
    return true;
}
function AddExtension(){
    var extension = document.querySelector("input[name='extension']");
    if (IsExtensionValid(extension) == false){
        return false;
    }
    return true;
}
function IsExtensionValid(extension){
    if (extension.value == ""){
        extension.focus();
        window.alert("Vui lập nhập tên extension\n");
        return false;
    }
    if (extension.value.indexOf(".") != 0){
        extension.focus();
        window.alert("Tên extension không hợp lệ\n");
        return false;
    }
    return true;
}