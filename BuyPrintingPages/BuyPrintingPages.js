function validateInputs() {
    let quantityInput = document.getElementById('quantity');
    let quantityValue = quantityInput.value;

    if(String(quantityValue).trim().length == 0) {
        window.alert('Số lượng trang in cần mua thêm không hợp lệ!')
        return false;
    }

    window.alert('Đăng kí thành công!')
};

function confirmPay() {
    let className = document.activeElement.className;

    if(className.includes('unpaid')) {
        return window.alert('Bạn muốn thanh toán đơn đăng kí mua trang in này?')
    }

    return false;
};

function confirmDelete() {
    return window.confirm('Bạn muốn xóa đơn đăng kí mua trang in này?');
}