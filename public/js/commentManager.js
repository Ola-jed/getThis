const currentArticle = document.URL.split("/")[document.URL.split("/").length - 1];
let deleteForms = document.querySelectorAll(".delete-form");

// Load all the comments relative to the current article in their container
function loadComments()
{
    fetch(`/article/${currentArticle}/comments`,{
        method : 'GET'
    }).then(function(response)
    {
        return response.text();
    }).then(function(text)
    {
        if (text !== "")
        {
            document.querySelector(".comments").innerHTML = text;
            deleteForms = document.querySelectorAll(".delete-form");
            makeCommentsDeletable();
        }
    }).catch(function(error)
    {
        console.log(error);
    })
}

// When the page is loaded, we fetch the comments for the article
document.addEventListener("DOMContentLoaded", loadComments);

// Submit the comment
const commentForm = document.getElementsByTagName("form")[0];
const commentFormContent = new FormData(commentForm);
commentForm.addEventListener('submit',function (e) {
    const formAction = this.getAttribute("action");
    fetch(formAction,{
        method : 'post',
        body : commentFormContent,
    }).then(function()
    {
        alert("Comment posted");
    }).catch(function(error)
    {
        alert("Comment post failed : "+error);
    });
    loadComments();
});

// Delete a comment
function makeCommentsDeletable()
{
    deleteForms.forEach((e)=>{
        e.addEventListener('submit',function (event) {
            console.log(e);
            const deleteFormAction = e.getAttribute("action");
            const deleteFormContent = new FormData(e);
            fetch(deleteFormAction,{
                method : 'post',
                body : deleteFormContent,
            }).then(function()
            {
                alert("Comment deleted");
            }).catch(function(error)
            {
                alert("Suppression failed :"+error);
            });
            loadComments();
        })
    });
}
