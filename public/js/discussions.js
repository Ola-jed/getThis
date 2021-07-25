'use strict';

const searchBtn = document.querySelector(".search-btn");
const searchInput = document.getElementById("form-search");

/**
 * Search bar
 * We call the controller and set the html content
 */
searchBtn.onclick = function () {
    fetch(`/discussions/subject?subject=${searchInput.value}`, {
        method: 'GET'
    }).then(function (response) {
        return response.text();
    }).then(function (text) {
        document.querySelector(".discussions").innerHTML = text === "" ? "No result" : text;
    }).catch(function (error) {
        console.log(error);
    });
};
