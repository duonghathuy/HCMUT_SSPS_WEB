document.addEventListener("DOMContentLoaded", function() {
    let id = localStorage.getItem("ID");
    
    getAddressesList(id);

    document.querySelectorAll(".insert-btn").forEach(function(btn) {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            insertAddress(id);
        })
    })

    document.querySelectorAll(".delete-btn").forEach(function(btn) {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            deleteAddress(id, btn.getAttribute("value"));
        })
    })

    document.querySelectorAll(".edit-btn").forEach(function(btn) {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            updateAddress(id, btn.getAttribute("value"));
        })
    })
})


function getAddressesList(id) {
    $.ajax({
        type: "POST",
        url: "getProfile.php",
        async: false,
        data: {
            id: id
        },
        success: function (response) {
            let data = JSON.parse(response);

            let addressesHTML = "";

            let count = 0;

            data['addresses'].forEach(address => {
                count += 1;

                addressesHTML += `
                    <tr value="`+count+`">
                        <td class="index">`+count+`</td>
                        <td class="street">`+address['street']+`</td>
                        <td class="commune">`+address['commune']+`</td>
                        <td class="district">`+address['district']+`</td>
                        <td class="province">`+address['province']+`</td>
                        <td class="choose">
                            <a class="edit-btn btn" value="`+count+`">Sửa</a>
                            <span>/</span>
                            <a class="delete-btn btn" value="`+count+`">Xóa</a>
                        </td>
                    </tr>
                `;
            });

            document.querySelector(".addresses-list").innerHTML = addressesHTML;
        },
        fail: function() {
            console.log("failed");
        }
    });
}

function insertAddress(id) {
    let streetInput = document.querySelector("input[name='street']");
    let communeInput = document.querySelector("input[name='commune']");
    let districtInput = document.querySelector("input[name='district']");
    let provinceInput = document.querySelector("input[name='province']");

    let nStreetValue = streetInput.value.trim();
    let nCommuneValue = communeInput.value.trim();
    let nDistrictValue = districtInput.value.trim();
    let nProvinceValue = provinceInput.value.trim();

    if(validateAddressInputs(nStreetValue, nCommuneValue, nDistrictValue, nProvinceValue) == false) {
        window.location.reload();
        return false;
    }
    
    $.ajax({
        type: "POST",
        url: "insertAddress.php",
        data: {
            id: id,
            street: nStreetValue,
            commune: nCommuneValue,
            district: nDistrictValue,
            province: nProvinceValue
        },
        success: function (response) {
            let data = JSON.parse(response);

            window.location.reload();
            window.alert(data);
        }
    });
}

function deleteAddress(id, index) {
    let chosen = window.confirm('Bạn muốn xóa địa chỉ này?');

    if(chosen == false) return;

    let addressElement = Array.from(document.querySelectorAll("tr")).filter(tr => 
        tr.getAttribute("value") === index
    )[0];

    let streetValue = addressElement.querySelector(".street").innerHTML;
    let communeValue = addressElement.querySelector(".commune").innerHTML;
    let districtValue = addressElement.querySelector(".district").innerHTML;
    let provinceValue = addressElement.querySelector(".province").innerHTML;

    $.ajax({
        type: "POST",
        url: "deleteAddress.php",
        data: {
            id: id,
            street: streetValue,
            commune: communeValue,
            district: districtValue,
            province: provinceValue
        },
        success: function (response) {
            window.location.reload();
            window.alert('Xóa địa chỉ thành công!');
        }
    });
}

function updateAddress(id, index) {
    let addressElement = Array.from(document.querySelectorAll("tr")).filter(tr => 
        tr.getAttribute("value") === index
    )[0];

    let streetValue = addressElement.querySelector(".street").innerHTML;
    let communeValue = addressElement.querySelector(".commune").innerHTML;
    let districtValue = addressElement.querySelector(".district").innerHTML;
    let provinceValue = addressElement.querySelector(".province").innerHTML;

    console.log(streetValue);

    let streetInput = document.querySelector("input[name='street']");
    let communeInput = document.querySelector("input[name='commune']");
    let districtInput = document.querySelector("input[name='district']");
    let provinceInput = document.querySelector("input[name='province']");

    streetInput.value = streetValue;
    communeInput.value = communeValue;
    districtInput.value = districtValue;
    provinceInput.value = provinceValue;

    let insertButton = document.querySelector(".insert-btn");
    let updateButton = document.querySelector(".update-btn");
    let cancelButton = document.querySelector(".cancel-btn");
    let title = document.querySelector("p.title");

    updateButton.classList.remove("display-none");
    insertButton.classList.add("display-none");

    cancelButton.classList.remove("display-none");

    title.innerHTML = "Cập nhật địa chỉ hiện có:";

    cancelButton.addEventListener('click', function() {
        streetInput.value = "";
        communeInput.value = "";
        districtInput.value = "";
        provinceInput.value = "";
        insertButton.classList.remove("display-none");
        updateButton.classList.add("display-none");
        cancelButton.classList.add("display-none");
    })

    updateButton.addEventListener('click', function() {
        let nStreetValue = streetInput.value.trim();
        let nCommuneValue = communeInput.value.trim();
        let nDistrictValue = districtInput.value.trim();
        let nProvinceValue = provinceInput.value.trim();

        if(validateAddressInputs(nStreetValue, nCommuneValue, nDistrictValue, nProvinceValue) == false) {
            window.location.reload();
            return false;
        }

        $.ajax({
            type: "POST",
            url: "updateAddress.php",
            data: {
                id: id,
                street: streetValue,
                commune: communeValue,
                district: districtValue,
                province: provinceValue,
                nStreet: nStreetValue,
                nCommune: nCommuneValue,
                nDistrict: nDistrictValue,
                nProvince: nProvinceValue
            },
            success: function (response) {
                let data = JSON.parse(response);
                if(data == 'Cập nhật địa chỉ thành công!') {
                    window.location.reload();
                }
                window.alert(data);
            }
        });
    })
}

function validateAddressInputs(street, commune, district, province) {
    if(street == '' || commune == '' || district == '' || province == '') {
        window.alert("Vui lòng nhập thông tin địa chỉ đầy đủ!");
        return false;
    }
    return true;
}