"use strict";

const messageForm = document.getElementById("message-form");
const currentDiscussion = document.URL.split("/")[document.URL.split("/").length - 1];
let deleteMessageForms = document.querySelectorAll(".message-delete");

makeMessagesDeletable();

/**
 * Load all the messages relative to the article
 * In the ".messages" div
 */
function loadMessages()
{
    fetch(`/discussion/${currentDiscussion}/messages`, {
        method: 'GET'
    }).then(function (response) {
        return response.text();
    }).then(function (text) {
        if (text !== "")
        {
            document.querySelector(".messages").innerHTML = text;
            deleteMessageForms = document.querySelectorAll(".message-delete");
            makeMessagesDeletable();
        }
    }).catch(function (error) {
        console.log(error);
    })
}

/**
 * Submitting the message form
 * With fetch
 */
messageForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const formContent = new FormData(messageForm);
    const formAction = this.getAttribute("action");
    console.log(formAction);
    fetch(formAction, {
        method: 'post',
        body: formContent,
    }).then(function () {
        alert("Message posted");
        loadMessages();
    }).catch(function (error) {
        alert("Message post failed : " + error);
    });
    return false;
});

/**
 * Add the delete event on all delete buttons
 */
function makeMessagesDeletable()
{
    deleteMessageForms.forEach((aDeleteForm) => {
        aDeleteForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const deleteFormAction = aDeleteForm.getAttribute("action");
            const deleteFormContent = new FormData(aDeleteForm);
            fetch(deleteFormAction, {
                method: 'post',
                body: deleteFormContent,
            }).then(function (isOk) {
                console.log(isOk)
                alert("Message deleted");
                loadMessages();
            }).catch(function (error) {
                alert("Suppression failed :" + error);
            });
        });
        return false;
    });
}