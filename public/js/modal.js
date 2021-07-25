"use strict";

const reportButton = document.getElementById("open-modal");
const modalBox = document.querySelector(".modal");
const closeBox = document.getElementById("close");
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

closeBox.addEventListener('click', removeIsActive);
cancelBtn.addEventListener('click', removeIsActive);