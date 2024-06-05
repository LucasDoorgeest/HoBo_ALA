

document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.scrollableWrap').forEach(function (scrollableWrap) {
        const leftBtn = scrollableWrap.parentElement.querySelector('.leftArrow');
        const rightBtn = scrollableWrap.parentElement.querySelector('.rightArrow');

        const img = scrollableWrap.querySelector('.scrollableImg');

        leftBtn.addEventListener('click', function () {
            scrollableWrap.scrollLeft = parseInt(scrollableWrap.scrollLeft) - 450;
        });

        rightBtn.addEventListener('click', function () {
            scrollableWrap.scrollLeft = parseInt(scrollableWrap.scrollLeft) + 450;
        });

    });
});