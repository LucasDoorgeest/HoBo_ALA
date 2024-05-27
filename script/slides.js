

document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('.scrolableWrap').forEach(function (scrolableWrap) {
        const leftBtn = scrolableWrap.parentElement.querySelector('.leftArrow');
        const rightBtn = scrolableWrap.parentElement.querySelector('.rightArrow');

        const img = scrolableWrap.querySelector('.scrolableImg');

        leftBtn.addEventListener('click', function () {
            scrolableWrap.scrollLeft = parseInt(scrolableWrap.scrollLeft) - 450;
        });

        rightBtn.addEventListener('click', function () {
            scrolableWrap.scrollLeft = parseInt(scrolableWrap.scrollLeft) + 450;
        });

    });
});