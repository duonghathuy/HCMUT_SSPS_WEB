function confirmSend(isEnoughBalance) {
    let className = document.activeElement.className;

    if(!className.includes('saved')) {
        return false;
    }

    if(isEnoughBalance < 0) {
        window.alert(`Vui lòng mua thêm ít nhất ${-isEnoughBalance} trang in để tiếp tục sử dụng dịch vụ!`);
        return false;
    }

    if(className.includes('saved')) {
        return window.confirm('Bạn muốn gửi yêu cầu in này?');
    }

    return false;
}

function confirmDelete() {
    return window.confirm('Bạn muốn xóa yêu cầu in này?')
}