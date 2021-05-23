'use strict';
/**
 * Default Url without the get parameters
 * @type {string}
 */
const cleanUrl = `${location.protocol}//${location.host}${location.pathname}`;

const previousLink = document.querySelector(".previous");
const nextLink = document.querySelector(".next");
const addBtn = document.querySelector(".article-add");
const addForm = document.querySelector(".article-creation");
const deleteArticles = document.querySelectorAll(".delete-article");
const searchBtn = document.querySelector(".search-btn");
const searchInput = document.getElementById("form-search");

document.addEventListener('DOMContentLoaded',()=>{
    addForm.style.display = "none";
});

/**
 * Reload the page with the new articles to display
 * @param {boolean} isNext
 */
function goTo(isNext = true)
{
    // We get the current offset displayed in the url
    const currentOffset = Number.parseInt(document.URL.split("?offset=").pop());
    const hasOffset = !Number.isNaN(currentOffset);
    console.log('has offset : '+hasOffset);
    let newOffset;
    if(isNext)
    {
        newOffset = hasOffset ? currentOffset + 10 : 10;
    }
    else
    {
        newOffset = hasOffset && currentOffset - 10 >= 0 ? currentOffset - 10 : 0;
    }
    window.location.replace(`${cleanUrl}?offset=${newOffset}`);
}

/**
 * Adding listeners on previous and next links
 * We change the offset's value to do the request
 */
previousLink.onclick = function (){
    goTo(false);
};

nextLink.onclick = function (){
    goTo(true);
};

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
    addForm.style.display = formIsVisible ? "block" : "none";
};

/**
 * Fetch method for article suppression
 * We iter on the array of delete buttons and add event listener
 * TODO: suppression fail
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
