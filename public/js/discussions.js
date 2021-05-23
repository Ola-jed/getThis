'use strict';
const addBtn = document.querySelector(".discussion-add");
const discCreationForm = document.querySelector(".discussion-creation");

/**
 * Variable to get visible status of the form to add a new article
 * @type {boolean}
 */
let formIsVisible = false;

/**
 * Listener on the add button to show the form
 */
addBtn.onclick = function (){
    formIsVisible = !formIsVisible;
    discCreationForm.style.display = formIsVisible ? "block" : "none";
};
