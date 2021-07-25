'use strict';
const addBtn = document.querySelector(".add");
const addForm = document.querySelector(".creation");

document.addEventListener('DOMContentLoaded', () => {
    addForm.style.display = "none";
});

/**
 * Variable to get visible status of the form to add a new article
 * @type {boolean}
 */
let formIsVisible = false;

/**
 * Listener on the add button to show the form
 */
addBtn.onclick = function () {
    formIsVisible = !formIsVisible;
    addBtn.innerHTML = formIsVisible
        ? "<img src=\"images/minus.svg\" alt=\"Hide form\">"
        : "<img src=\"images/plus.svg\" alt=\"Add\">";
    addForm.style.display = formIsVisible ? "block" : "none";
};