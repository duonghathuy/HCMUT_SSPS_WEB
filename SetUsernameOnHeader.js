document.addEventListener("DOMContentLoaded", function() {
    let username = localStorage.getItem("Username");
    
    document.querySelector(".right-side .username-header").innerHTML = username;
})