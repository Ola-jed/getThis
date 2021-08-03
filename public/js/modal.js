"use strict";

const reportButton = document.getElementById("open-modal");
const modalBox = document.querySelector(".modal");
const closeBoxes = document.querySelectorAll(".close");
const cancelBtn = document.getElementById("cancel");

/**
 * Hide the modal box
 */
function removeIsActive()
{
    modalBox.classList.remove('is-active');
}

reportButton.addEventListener('click', function () {
    modalBox.classList.add('is-active');
})

closeBoxes.forEach((closeBox) => {
    closeBox.addEventListener('click', removeIsActive);
});
cancelBtn.addEventListener('click', removeIsActive);