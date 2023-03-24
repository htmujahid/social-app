// dropdown menu for desktop
const dropdown = document.querySelector("#dropdown-trigger");

if (dropdown) {
    dropdown.addEventListener("click", function () {
        const dropdownContent = document.querySelector("#dropdown-content");
        dropdownContent.classList.toggle("hidden");
    });
}
// dropdown menu for mobile
const hamburger = document.querySelector("#hamburger");

if (hamburger) {
    hamburger.addEventListener("click", function () {
        const nav = document.querySelector("#responsive-nav");
        nav.classList.toggle("hidden");
    });
}

// user delete confirmation modal
const deleteUserButton = document.querySelector("#delete-user-button");

if (deleteUserButton) {
    deleteUserButton.addEventListener("click", function () {
        const modal = document.querySelector("#confirm-user-deletion-modal");
        modal.classList.remove("hidden");
        // stop scrolling
        document.body.style.overflow = "hidden";
    });
}

// close modal
const cancelUserDeletionButton = document.querySelector(
    "#cancel-user-deletion-button"
);

if (cancelUserDeletionButton) {
    cancelUserDeletionButton.addEventListener("click", function () {
        const modal = document.querySelector("#confirm-user-deletion-modal");
        modal.classList.add("hidden");
        // resume scrolling
        document.body.style.overflow = "auto";
    });
}
