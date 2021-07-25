"use strict";

const passwordInput = document.getElementById("password1");
const passwordConfirmInput = document.getElementById("password2");

/**
 * Are the password same ?
 */
function checkPasswords()
{
    const isGood = passwordInput.value === passwordConfirmInput.value;
    passwordInput.style.color = isGood ? "black" : "red";
    passwordConfirmInput.style.color = isGood ? "black" : "red";
}

passwordInput.addEventListener('keyup', checkPasswords);
passwordConfirmInput.addEventListener('keyup', checkPasswords);