document.addEventListener("DOMContentLoaded", function(e) {
    let id = localStorage.getItem("ID");
    
    getData(id);
    getRegistrationHistory(id);

    document.querySelector("form").addEventListener("submit", function(e) {
        e.preventDefault();

        let value = validateInputs();

        if(value == false) return false;

        let quantity = document.getElementById("quantity").value;

        $.ajax({
            type: "POST",
            url: "RegisterAnOrder.php",
            data: {
                id: id,
                quantity: quantity
            },
            success: function (response) {
                window.alert("Đăng kí thành công!");
                getRegistrationHistory(id);
            }
        });
    });
});

function getData(id) {
    $.ajax({
        type: "POST",
        url: "GetData.php",
        data: {
            id: id
        },
        success: function (response) {
            console.log("Get Data Successfully!");
            let data = JSON.parse(response);

            document.querySelector("p.balance").innerHTML = `${data['balance']} trang (Khổ A4)`;
            document.querySelector("p.info-about-price").innerHTML = `(Lệ phí: ${data['price']} VNĐ/trang in khổ  A4)`;
        },
        fail: function() {
            console.log("Get Data Fail!");
        }
    });
}

function getRegistrationHistory(id) {
    $.ajax({
        type: "POST",
        url: "GetRegistrationHistory.php",
        data: {
            id: id,
        },
        success: function (response) {
            let data = JSON.parse(response);

            let registrations = "";

            data.forEach(registration => {
                let status = 'paied';
                let paymetStatus = 'Đã thanh toán';

                if(registration["Payment_Status"] == 0) {
                    status = 'unpaid';
                    paymetStatus = 'Thanh toán ngay';
                }

                registrations +=
                `<tr>
                    <td>`+registration["Order_ID"]+`</td>
                    <td>`+registration["Order_Creation_Date"]+`</td>
                    <td>`+registration["Quantity"]+`</td>
                    <td class='total-price'>`+registration["Total_Price"]+`</td>
                    <td class='payment-status `+status+`'>
                        <a href='UpdateBalance.php?Order_ID=`+registration["Order_ID"]+`' class='pay-btn  payment-btn `+status+`' onclick='return confirmPay()'>`+paymetStatus+`</a>
                        <span>/ </span>
                        <a href='DeleteAnOrder.php?Order_ID=`+registration["Order_ID"]+`' class='delete-btn payment-btn' onclick='return confirmDelete()'>Xóa</a>
                    </td>
                </tr>`;
            });

            if(registrations.length === 0) {
                registrations =
                `<tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td class='total-price'>...</td>
                    <td class='payment-status'>...</td>
                </tr>`;
            }

            document.querySelector(".registration-history tbody").innerHTML = registrations;
        }
    });
}

function validateInputs() {
    let quantityInput = document.getElementById('quantity');
    let quantityValue = quantityInput.value;

    if(String(quantityValue).trim().length == 0) {
        window.alert('Vui lòng nhập số lượng trang in cần mua thêm!')
        return false;
    }

    return quantityValue;
};

function confirmPay() {
    let className = document.activeElement.className;

    if(className.includes('unpaid')) {
        return window.confirm('Bạn muốn thanh toán đơn đăng kí mua trang in này?')
    }

    return false;
};

function confirmDelete() {
    return window.confirm('Bạn muốn xóa đơn đăng kí mua trang in này?');
}