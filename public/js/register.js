"use strict";

const passwordInput = document.getElementById("p1");
const passwordConfirmInput = document.getElementById("p2");

/**
 * Are the password same ?
 */
function checkPasswords()
{
    let isGood = passwordInput.value === passwordConfirmInput.value;
    passwordInput.style.color = isGood ? "black" : "red";
    passwordConfirmInput.style.color = isGood ? "black" : "red";
}

passwordInput.addEventListener('keyup',checkPasswords);
passwordConfirmInput.addEventListener('keyup',checkPasswords);