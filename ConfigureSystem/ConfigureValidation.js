function ValidateConfiguration(){
    let numberOfPagesInput = document.querySelector("input[name='numberOfPages']");
    let numberOfPages = Number(numberOfPagesInput.value);
    if ((Number.isInteger(numberOfPages) == false) || (numberOfPages < 0)){
        numberOfPagesInput.focus();
        window.alert("Số trang phải là số nguyên dương\n");
        return false;
    }
    window.alert("Cập nhật thành công\n");
}
function AddExtension(){
    var extension = document.querySelector("input[name='extension']");
    if (IsExtensionValid(extension) == false){
        return;
    }
    extension.value = "";
    window.alert("Thêm định dạng thành công\n");
}
function RemoveExtension(){
    var extension = document.querySelector("input[name='extension']");
    if (IsExtensionValid(extension) == false){
        return;
    }
    extension.value = "";
    window.alert("Xóa định dạng thành công\n");
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