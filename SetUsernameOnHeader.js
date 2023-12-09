document.addEventListener("DOMContentLoaded", function() {
    let username = localStorage.getItem("Username");
    let role = localStorage.getItem("Role");

    let href = role === "Student" ? "../StudentServices/StudentServices.html" : "../SPSOServices/SPSOServices.html";
    
    document.querySelector(".right-side .username-header").innerHTML = username;

    document.querySelector(".header .left-side .logo a").href = "../UserHome/UserHome.php";
    document.querySelector(".header .left-side .menu-bar .first-option a").href = "../UserHome/UserHome.php";
    document.querySelector(".header .left-side .menu-bar .second-option a").href = href;
    document.querySelector(".header .right-side .logout").href = "../Identify/logout.php";
    document.querySelector(".header .right-side .username-header").href = "../PersonalInformation/Profile.html";
})