document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.scrollableWrap').forEach(function (scrollableWrap) {
        const leftBtn = scrollableWrap.parentElement.querySelector('.leftArrow');
        const rightBtn = scrollableWrap.parentElement.querySelector('.rightArrow');
        const scrollableImg = document.querySelector('.scrollableImg');
        const imgWidth = scrollableImg.offsetWidth * 4;

        leftBtn.addEventListener('click', function () {
            scrollableWrap.scrollLeft = parseInt(scrollableWrap.scrollLeft) - imgWidth;
        });

        rightBtn.addEventListener('click', function () {
            scrollableWrap.scrollLeft = parseInt(scrollableWrap.scrollLeft) + imgWidth;
        });
    });
});