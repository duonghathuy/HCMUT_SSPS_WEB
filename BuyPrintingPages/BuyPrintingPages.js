function validateInputs() {
    let quantityInput = document.getElementById('quantity');
    let quantityValue = quantityInput.value;

    if(String(quantityValue).trim().length == 0) {
        window.alert('Số lượng trang in cần mua thêm không hợp lệ!')
        return false;
    }

    window.alert('Đăng kí thành công!')
}

function confirmDelete() {
    return window.confirm('Bạn muốn xóa đơn đăng kí mua trang in này?')
}