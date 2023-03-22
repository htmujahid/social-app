// dropdown menu for desktop
const dropdown = document.querySelector("#dropdown-trigger");

dropdown.addEventListener("click", function () {
    const dropdownContent = document.querySelector("#dropdown-content");
    dropdownContent.classList.toggle("hidden");
    console.log("clicked");
});

// dropdown menu for mobile
const hamburger = document.querySelector("#hamburger");

hamburger.addEventListener("click", function () {
    const nav = document.querySelector("#responsive-nav");
    nav.classList.toggle("hidden");
});
