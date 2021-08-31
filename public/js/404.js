"use strict";
const holes = document.querySelectorAll('.hole');
const scoreBoard = document.querySelector('.score');
const moles = document.querySelectorAll('.mole');
let lastHole;
let timeUp = false;
let score = 0;

/**
 * Make a random time for mole to pop from the hole
 * @param min
 * @param max
 * @returns {number}
 */
function randomTime(min, max)
{
    return Math.round(Math.random() * (max - min) + min);
}

/**
 * Generate a random hole
 * @param holes
 * @returns {*}
 */
function randomHole(holes)
{
    const index = Math.floor(Math.random() * holes.length);
    const hole = holes[index];
    // Prevent same hole from getting the same number
    if (hole === lastHole)
    {
        return randomHole(holes);
    }
    lastHole = hole;
    return hole;
}

/**
 * Show a new mole
 */
function peep()
{
    const time = randomTime(500, 1000);
    const hole = randomHole(holes);
    hole.classList.add('up');
    setTimeout(() => {
        hole.classList.remove('up');
        if (!timeUp)
        {
            peep();
        }
    }, time);
}

/**
 * Start the game
 * Function called on click of the start button
 * Show random moles for 15 seconds
 */
function startGame()
{
    scoreBoard.textContent = '0';
    timeUp = false;
    score = 0;
    peep();
    setTimeout(() => timeUp = true, 15000);
}

/**
 * A mole is hit
 * Make sure it is created by a user. To prevent cheaters
 * @param e
 */
function wack(e)
{
    if (!e.isTrusted)
    {
        return;
    }
    score++;
    this.parentNode.classList.remove('up');
    scoreBoard.textContent = score;
}

moles.forEach(mole => mole.addEventListener('click', wack))