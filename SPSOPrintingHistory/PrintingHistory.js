document.addEventListener("DOMContentLoaded", function() {
    getRequestList();
    getStudentList ()
    getPrinterList();
})

$(document).ready(function() {
    document.querySelector(".end-time").addEventListener("click", function() {
        setMinEndTime();
    });

    document.querySelector(".start-time").addEventListener("click", function() {
        setMaxStartTime();
    });

    document.querySelector(".btn-submit").addEventListener("click", function() {
        applyFilter();
    })
});

function getStudentList () {
    return $.ajax({
        url: "GetStudentList.php",
        async: false,
        success: function (response) {
            let data = JSON.parse(response);
            
            let optionsHTML = "";

            data.forEach(item => {
                optionsHTML += '<div class="option" data-value="'+item+'">'+item+'</div>';
            });

            document.querySelector(".student-list").innerHTML = optionsHTML;
        }
    });
};

function getPrinterList () {
    return $.ajax({
        url: "GetPrinterList.php",
        async: false,
        success: function (response) {
            let data = JSON.parse(response);
            
            let optionsHTML = "";

            data.forEach(item => {
                optionsHTML += '<div class="option" data-value="'+item['Printer_ID']+'">'+item['Printer_ID']+'</div>';
            });

            document.querySelector(".printer-list").innerHTML = optionsHTML;
        }
    });
};

function getRequestList() {
    return $.ajax({
        url: "GetPrintingRequestList.php",
        async: false,
        success: function (response) {
            let data = JSON.parse(response);
            
            let requestsHTML = `
                <tr class="no-request no-match">
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
            `;

            data.forEach(item => {
                if(item["Completion_Date"] == null) {
                    item["Completion_Date"] = '...';
                }
                
                requestsHTML += `
                <tr>
                    <td>`+item["Request_ID"]+`</td>
                    <td>`+item["Name"]+`</td>
                    <td>`+item["Owner_ID"]+`</td>
                    <td>`+item["Registration_Date"]+`</td>
                    <td>`+item["Completion_Date"]+`</td>
                    <td>`+item["File_Name"]+`</td>
                    <td>`+item["Requested_Page_Numbers"]+`</td>
                    <td>`+item["Pages_Per_Sheet"]+`</td>
                    <td>`+item["Number_Of_Copies"]+`</td>
                    <td>`+item["Total_Of_Pages"]+`</td>
                    <td>`+item["Printer_ID"]+`</td>
                    <td class="status">`+item["Request_Status"]+`</td>
                </tr>
                `;
            });

            document.querySelector(".request-list").innerHTML = requestsHTML;

            if(data.length == 0) {
                document.querySelector(".no-request").classList.remove("no-match");
            }
        }
    });
};

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

function setMinEndTime() {
    let startTimeInput = document.querySelector(".start-time");
    let minTime = startTimeInput.value;
    
    document.querySelector(".end-time").min = minTime;
    startTimeInput.max = "";
}

function setMaxStartTime() {
    let endTimeInput = document.querySelector(".end-time");
    let maxTime = endTimeInput.value;
    
    document.querySelector(".start-time").max =  maxTime;
    endTimeInput.min = "";
}

function applyFilter() {
    // Get Student Values
    let filterStudent = document.querySelector(".student-select")
    const selectedStudents = filterStudent.querySelectorAll(".option.active");
    let students = filterStudent.querySelector(".tags-input").value.split(", ");

    // Get Time Period Values
    let startTime = document.querySelector(".start-time").value;
    let endTime = document.querySelector(".end-time").value;

    // Get Printer Values
    let filterPrinter = document.querySelector(".printer-select")
    const selectedPrinters = filterPrinter.querySelectorAll(".option.active");
    let printers = filterPrinter.querySelector(".tags-input").value.split(", ");

    // 
    let allRows = document.querySelector(".registration-history")
    let trTags = Array.from(allRows.querySelectorAll("tr"));

    // Reset default filters
    trTags.forEach(function(tr) {
        tr.classList.remove("no-match");
    });

    allRows.querySelector(".no-request").classList.add("no-match");
    
    // Apply filters
    trTags.filter(function(tr) {
        let tdTags = Array.from(tr.querySelectorAll("td"));

        if(tdTags.length === 0) return false;
        
        return !(
            ((printers == "") ? true : printers.includes(tdTags[10].innerText))
            && (startTime ? (startTime <= tdTags[3].innerText) : true) && (endTime ? (tdTags[3].innerText <= endTime) : true)
            && ((students == "") ? true : students.includes(tdTags[1].innerText + ' - ' + tdTags[2].innerText))
        ); 
    }).forEach(function(tr) {
        tr.classList.add("no-match");
    });

    if(Array.from(document.querySelectorAll("tr")).length - Array.from(document.querySelectorAll(".no-match")).length == 1) {
        document.querySelector(".no-request").classList.remove("no-match");
    }

    //resetCustomSelects();
    return true;
}