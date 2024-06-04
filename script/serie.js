
function sendWatching() {
    fetch('/php/iAmWatching.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ userId: userId, serieId: serieId }),
    })
}

document.addEventListener('DOMContentLoaded', function() {
    if (typeof userId !== 'undefined') {
        setInterval(
            sendWatching, 5000
        )
    }
});