const profileUpdateForm = document.getElementById("profile-update");
const updateBtn = document.querySelector(".update");

// Is the update form visible or not ?
let isVisible = false;

updateBtn.onclick = function () {
    isVisible = !isVisible;
    profileUpdateForm.style.display = isVisible ? 'block' : 'none';
    updateBtn.textContent = isVisible ? 'Hide form' : 'Update account';
}
