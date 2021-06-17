"use strict";

const deleteArticles = document.querySelectorAll(".delete-article");
const searchBtn = document.querySelector(".search-btn");
const searchInput = document.getElementById("form-search");

/**
 * Fetch method for article suppression
 * We iter on the array of delete buttons and add event listener
 */
deleteArticles.forEach((e) => {
    e.addEventListener('submit',function (event) {
        const deleteFormAction = e.getAttribute("action");
        const deleteFormContent = new FormData(e);
        fetch(deleteFormAction,{
            method : 'post',
            body : deleteFormContent,
        }).then(function()
        {
            location.reload();
        }).catch(function(error)
        {
            console.log("Suppression failed :"+error);
        });
    });
});

/**
 * Event on search
 */
searchBtn.onclick = function () {
    console.log(searchInput.value);
    fetch(`/articles/title?title=${searchInput.value}`,{
        method : 'GET'
    }).then(function(response)
    {
        return response.text();
    }).then(function(text)
    {
        document.querySelector(".articles").innerHTML = text === "" ? "No result" : text;
    }).catch(function(error)
    {
        console.log(error);
    });
};