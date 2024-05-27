

document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".rightArrow").forEach((element) => {
        element.addEventListener("click", scrollRight);
    });
    document.querySelectorAll(".leftArrow").forEach((element) => {
        element.addEventListener("click", scrollLeft);
    });
});


// Scrolles to the next slide
function scrollRight(e) {
    let parent;
    if (e.target.tag == "button") {
        parent = e.target.parentElement.querySelector(".scrolableWrap");
    } else {
        parent = e.target.parentElement.parentElement.querySelector(".scrolableWrap");
    }
    let current = parent.dataset.current ? parseInt(parent.dataset.current) : 0;
    let children = parent.children;
    current+=2;

    while (current >= children.length) {
        current--;
    }

    children[current].scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });

    parent.dataset.current = current;
}

function scrollLeft(e) {
    let parent = e.target.parentElement.parentElement.querySelector(".scrolableWrap");
    let current = parent.dataset.current ? parseInt(parent.dataset.current) : 0;
    let children = parent.children;
    current-=2;

    while (current < 0) {
        current++;
    }

    children[current].scrollIntoView({ behavior: "smooth", block: "nearest"});

    parent.dataset.current = current;
}