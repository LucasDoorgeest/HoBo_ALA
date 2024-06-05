




document.addEventListener('DOMContentLoaded', function() {
    const bg = document.querySelector("div#blurBg");

    const serieInfoImg = document.querySelector(".serieInfoImg");
    bg.style.backgroundImage = `url(${serieInfoImg.src})`;

});