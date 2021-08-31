"use strict";

const currentArticle = document.URL.split("/")[document.URL.split("/").length - 1];
let deleteForms = document.querySelectorAll(".delete-form");

// When the page is loaded, we fetch the comments for the article
document.addEventListener("DOMContentLoaded", loadComments);

// Load all the comments relative to the current article in their container
function loadComments()
{
    fetch(`/article/${currentArticle}/comments`, {
        method: 'GET'
    }).then(function (response) {
        return response.text();
    }).then(function (text) {
        if (text !== "")
        {
            document.querySelector(".comments").innerHTML = text;
            deleteForms = document.querySelectorAll(".delete-form");
            makeCommentsDeletable();
        }
    }).catch(function (error) {
        console.log(error);
    })
}

// Submit the comment
const commentForm = document.getElementsByTagName("form")[0];
commentForm.addEventListener('submit', function () {
    const formAction = this.getAttribute("action");
    const commentFormContent = new FormData(commentForm);
    fetch(formAction, {
        method: 'post',
        body: commentFormContent,
    }).then(function () {
        mdtoast.success('Comment posted', { duration: 3000 });
        loadComments();
    }).catch(function (error) {
        mdtoast.error('Comment post failed : ' + error, { duration: 3000 });
    });
});

// Delete a comment
function makeCommentsDeletable()
{
    deleteForms.forEach((e) => {
        e.addEventListener('submit', function () {
            const deleteFormAction = e.getAttribute("action");
            const deleteFormContent = new FormData(e);
            fetch(deleteFormAction, {
                method: 'post',
                body: deleteFormContent,
            }).then(function () {
                mdtoast.success('Comment deleted', { duration: 3000 });
                loadComments();
            }).catch(function (error) {
                mdtoast.error('Comment deletion failed : ' + error, { duration: 3000 });
            });
        })
    });
}