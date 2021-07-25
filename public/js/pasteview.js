"use strict";

document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('pre code').forEach((el, n) => {
        hljs.lineNumbersBlock(el, n);
        hljs.highlightElement(el);
    });
});