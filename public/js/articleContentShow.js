"use strict";

const initialValue = document.querySelector('#viewer').innerHTML;
document.querySelector('#viewer').innerHTML = '';
const Viewer = toastui.Editor;
const viewer = new Viewer({
    el: document.querySelector('#viewer'),
    height: 'auto',
    initialValue: initialValue
});