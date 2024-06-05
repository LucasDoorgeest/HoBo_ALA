
let bg = null;
let cooldown = false;
let lastImg = null;

function resetCooldown() {
    cooldown = false;

    if (lastImg && bg.style.backgroundImage !== `url(${lastImg.src})`) {
        bg.style.backgroundImage = `url(${lastImg.src})`;

        cooldown = true;

        setTimeout(function() {
            resetCooldown();
        }, 700);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    bg = document.querySelector("div#blurBg");

    const serieInfoImg = document.querySelector(".serieInfoImg");
    if (serieInfoImg) bg.style.backgroundImage = `url(${serieInfoImg.src})`;



    document.querySelectorAll("img.bgsupport").forEach(function(img) {
        img.addEventListener("mouseover", function() {
            const src = `url(${img.src})`;

            if (bg.style.backgroundImage !== src && !cooldown) {
                bg.style.backgroundImage = src;

                cooldown = true;
                setTimeout(function() {
                    resetCooldown();
                }, 700);
            }
            lastImg = img;


        });
    });

});