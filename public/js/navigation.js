'use strict';

/**
 * Default Url without the get parameters
 * @type {string}
 */
const cleanUrl = `${location.protocol}//${location.host}${location.pathname}`;
const previousLink = document.querySelector(".previous");
const nextLink = document.querySelector(".next");

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
