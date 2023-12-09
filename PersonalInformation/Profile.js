document.addEventListener("DOMContentLoaded",function () {
    let id = localStorage.getItem("ID");

    getProfile(id);
  
    let updateButton = document.querySelector(".edit-btn");

    updateButton.addEventListener("click", function(){
        window.location.href = 'UpdateProfile.html';
    })
});

function getProfile(id) {
    $.ajax({
        type: "POST",
        url: "getProfile.php",
        
        data: {
            id: id
        },
        success: function (response) {
            let data = JSON.parse(response);
            
            document.querySelector(".id").innerHTML = data['id'];
            document.querySelector(".name").innerHTML = data['lname'] +' '+ data['fname'];
            document.querySelector(".birthday").innerHTML = data['birthday'];
            document.querySelector(".sex").innerHTML = data['sex'] ? 'Nữ' : 'Nam';
            document.querySelector(".role").innerHTML = (data['role'] == 'Student') ? 'Sinh viên' : 'Quản lý';
            document.querySelector(".username").innerHTML = data['username'];
            document.querySelector(".mail").innerHTML = data['email'];

            let addressesHTML = "";
            data['addresses'].forEach(address => {
                addressesHTML += '<li>'+address['street']+', '+address['commune']+', '+address['district']+', '+address['province']+'.</li>';
            });

            document.querySelector(".addresses").innerHTML = addressesHTML;
        },
        fail: function() {
            console.log("fail");
        }
    });
}