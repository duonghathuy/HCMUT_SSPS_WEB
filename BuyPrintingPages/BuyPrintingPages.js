function openPopup(id) {
    let popupNode = document.querySelector(id);

    popupNode.classList.add("active");
}

function closePopup(id) {
    let popupNode = document.querySelector(id);

    popupNode.classList.remove("active");
}