document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        const password = form.querySelector('input[name="password"]').value;
        const email = form.querySelector('input[name="email"]').value;
        const passwordRepeat = form.querySelector('input[name="passwordRepeat"]').value;
        const privacy = form.querySelector('input[name="privacy"]').checked;

        if (password.length < 8) {
            e.preventDefault();
            alert('Password must be at least 8 characters long');
            return false;
        }

        if (password !== passwordRepeat) {
            e.preventDefault();
            alert('Passwords do not match');
            return false;
        }

        if (!privacy) {
            e.preventDefault();
            alert('You must accept the privacy policy');
            return false;
        }


        return true;
    });
});