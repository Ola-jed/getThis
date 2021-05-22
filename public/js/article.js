const cleanUrl = `${location.protocol}//${location.host}${location.pathname}`;
const previousLink = document.querySelector(".previous");
const nextLink = document.querySelector(".next");
const addBtn = document.querySelector(".article-add");
const addForm = document.querySelector(".article-creation");
const deleteArticles = document.querySelectorAll(".delete-article");

// Reload the page with the articles
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

previousLink.onclick = function (){
    goTo(false);
};

nextLink.onclick = function (){
    goTo(true);
};

let formIsVisible = false;
addBtn.onclick = function (){
    formIsVisible = !formIsVisible;
    addForm.style.display = formIsVisible ? "block" : "none";
};

// Fetch method for article suppression
// We iter on the array of delete buttons and add event listener
deleteArticles.forEach((e) => {
    e.addEventListener('submit',function (event) {
        const deleteFormAction = e.getAttribute("action");
        const deleteFormContent = new FormData(e);
        fetch(deleteFormAction,{
            method : 'post',
            body : deleteFormContent,
        }).then(function()
        {
        }).catch(function(error)
        {
            alert("Suppression failed :"+error);
            console.log("Suppression failed :"+error);
        });
        location.reload();
    });
});
