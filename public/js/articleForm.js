"use strict";

const createArticleButton = document.getElementById("create-article");
const articleTextarea = document.getElementById("content");
const Editor = toastui.Editor;
const editor = new Editor({
    el: document.querySelector('#editor'),
    initialEditType: 'markdown',
    previewStyle: 'vertical',
    usageStatistics: false
});
createArticleButton.addEventListener('click',function (){
    articleTextarea.value = editor.getMarkdown();
});