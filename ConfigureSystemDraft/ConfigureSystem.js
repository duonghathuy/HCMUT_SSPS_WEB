var newFileTypes = new Set();
var newRefillDates = new Set();

$(document).ready(function() {
    getConfiguration();
    getRefillDates();
    getAcceptedFileTypes();
    autoUpdateBalance();
    
    // Accepted File Types
    loadNewFileTypes();

    $("button.add-file-type").click(function (e) { 
        e.preventDefault();
        
        let value = validateFileType();

        if(value == false) return false;

        newFileTypes.add(value);

        console.log(newFileTypes);
        
        loadNewFileTypes();
    });

    // Refill Dates
    loadNewRefillDates();

    $("button.delete-refill-date").click(function (e) {
        e.preventDefault();
        
        let value = confirmDelete('ngày cung cấp trang in');
        console.log(value)

        if(value == false) return false;

        newRefillDates.delete(value);

        console.log(newRefillDates);

        loadNewRefillDates();
    });

    $("button.add-refill-date").click(function (e) { 
        e.preventDefault();
        
        let value = document.querySelector("input[name='refill-date'").value;

        if(value == "") {
            window.alert('Vui lòng nhập ngày cung cấp trang in mà bạn muốn thêm!');
            return false;
        }

        newRefillDates.add(value.replace("T", " "));

        console.log();

        loadNewRefillDates();
    });

    $("form.configure-system-form").submit(function (e) {
        e.preventDefault();

        let value = validateInputs();

        if(value == false) return false;
        
        let newFileTypesArr = Array.from(newFileTypes);
        let newRefillDatesArr = Array.from(newRefillDates);

        $.ajax({
            type: "POST",
            url: "UpdateConfiguration.php",
            data: {
                numberOfPages: value.numberOfPages,
                paperPrice: value.paperPrice,
                newFileTypes: JSON.stringify(newFileTypesArr),
                newRefillDates: JSON.stringify(newRefillDatesArr),
            },
            success: function (response) {
                window.alert('Cập nhật cấu hình hệ thống thành công!');
                window.location.reload();
            },
            fail: function() {
                window.alert('Cập nhật cấu hình hệ thống thất bại. Vui lòng thử lại!');
            }
        });
    });
});

function validateInputs(){
    let numberOfPagesInput = document.getElementById('number-of-pages');
    let paperPriceInput = document.getElementById('paper-price');

    let numberOfPages = String(numberOfPagesInput.value);
    let paperPrice = String(paperPriceInput.value);

    if (numberOfPages.length == 0){
        window.alert("Vui lòng nhập số trang in mặc định!");
        return false;
    }

    if (paperPrice.length == 0){
        window.alert("Vui lòng nhập giá trang in!");
        return false;
    }

    return {
        numberOfPages: numberOfPages,
        paperPrice: paperPrice,
    };
}

function confirmDelete(element) {
    let res = window.confirm(`Bạn muốn xóa ${element} này?`);

    if(res == false) return false;
    
    return document.activeElement.value;
}

function validateFileType() {
    let fileType = document.getElementById('file-type').value.trim();

    if(fileType == "") {
        window.alert('Vui lòng nhập định dạng tập tin mà bạn muốn thêm!');
        return false;
    }

    if(fileType.indexOf(".") != 0) {
        window.alert('Định dạng tập tin không hợp lệ!');
        return false;
    }
    
    return fileType;
}

function getConfiguration() {
    $.ajax({
        type: "POST",
        url: "GetConfiguration.php",
        async: false,
        success: function (response) {
            let data = JSON.parse(response);

            document.querySelector("input[name='number-of-pages'").value = data['Default_Number_Of_Pages'];
            document.querySelector("input[name='paper-price'").value = data['Paper_Price'];
        }
    });
}

function getAcceptedFileTypes() {
    $.ajax({
        type: "POST",
        url: "GetAcceptedFileTypes.php",
        async: false,
        success: function (response) {
            let data = JSON.parse(response);

            data.forEach(type => {
                newFileTypes.add(type);
            });
        },
        fail: function() {
            console.log('fail');
        }
    });
};

function getRefillDates() {
    $.ajax({
        type: "POST",
        url: "GetRefillDates.php",
        async: false,
        success: function (response) {
            let data = JSON.parse(response);

            data.forEach(date => {
                newRefillDates.add(date);
            });
        },
        fail: function() {
            console.log('fail');
        }
    });
};

function loadNewFileTypes() {
    let fileTypesHTML = "";

    newFileTypes.forEach(type => {
        fileTypesHTML += `
        <div class='file-type-item'>
            <button type='button' class='delete-btn delete-file-type' value='`+type+`'>&times;</button>
            <p>`+type+`</p>
        </div>
        `;
    });

    document.querySelector(".accepted-file-type-list").innerHTML = fileTypesHTML;

    $("button.delete-file-type").click(function (e) {
        e.preventDefault();

        let value = confirmDelete('định dạng tập tin');

        if(value == false) return false;

        newFileTypes.delete(value);

        console.log(newFileTypes);

        loadNewFileTypes();
    });
}

function loadNewRefillDates() {
    let refillDatesHTML = "";

    newRefillDates.forEach(date => {
        refillDatesHTML += `
        <div class='refill-date-item'>
            <button type='button' class='delete-btn delete-refill-date' value='`+date+`'>&times;</button>
            <p>`+date+`</p>
        </div>
        `;
    });

    document.querySelector(".refill-date-list").innerHTML = refillDatesHTML;

    $("button.delete-refill-date").click(function (e) {
        e.preventDefault();
        
        let value = confirmDelete('ngày cung cấp trang in');

        if(value == false) return false;

        newRefillDates.delete(value);

        console.log(newRefillDates);

        loadNewRefillDates();
    });
}

function updateBalance() {
    $.ajax({
        type: "POST",
        url: "AutoUpdateBalance.php",
        success: function (response) {
            console.log("Đã tự động cập nhật thêm số lượng trang in cho sinh viên!")
        },
        fail: function() {
            console.log("Tự động cập nhật thêm số lượng trang in cho sinh viên thất bại!")
        }
    });
}

function autoUpdateBalance() {
    $.ajax({
        type: "POST",
        url: "GetRefillDates.php",
        success: function (response) {
            let dates = JSON.parse(response);
            
            const now = new Date();

            dates.forEach(function(date) {
                const targetDate = new Date(date);
                const timeRemaining = targetDate - now;

                if(timeRemaining >= 0) {
                    setTimeout(updateBalance, timeRemaining);
                }
            })
        }
    });
}
