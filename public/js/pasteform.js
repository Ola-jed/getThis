"use strict";

const textarea = document.querySelector('textarea');
const label = document.querySelector('input[name="title"]');

/**
 * Drag event
 */
textarea.addEventListener('dragover',function (dragOverEvent) {
    dragOverEvent.preventDefault();
});

/**
 * Drop event:
 * Loading the file content in the textarea and defining the title
 */
textarea.addEventListener('drop',function (dropEvent) {
    dropEvent.stopPropagation();
    dropEvent.preventDefault();
    const file = dropEvent.dataTransfer.files[0];
    let reader = new FileReader();
    reader.readAsText(file);
    reader.onload = function () {
        textarea.value = reader.result;
        label.value = file.name;
    };
});