function sendWatching() {
    fetch('/php/iAmWatching.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ klantID: klantID, aflID: aflID }),
    })
}

document.addEventListener('DOMContentLoaded', function() {
    if (typeof klantID !== 'undefined') {
        sendWatching();
        setInterval(
            sendWatching, 5000
        )
    }

    const seizoen = document.getElementById("seizoen");
        const afleveringen = document.querySelectorAll(".afleveringenWrap");

        seizoen.addEventListener("change", () => {
            afleveringen.forEach((aflevering) => {
                aflevering.classList.add("d-none");
            });

            afleveringen[seizoen.selectedIndex].classList.remove("d-none");
        });
});