<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];

    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long');</script>";
    } else if ($password !== $passwordRepeat) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = fetchSql('SELECT * FROM klant WHERE email = ?', [$email]);
        if ($user) {
            echo "<script>alert('Klant already exists');</script>";
        } else {
            execSql('INSERT INTO klant (email, password, AboID, Genre) VALUES (?, ?, 1, 1)', [$email, $hashedPassword]);
            header('Location: /pages/login.php');
            exit;
        }     
    }
}



//Clean post data



$head = new HeadComponent("Register", 
                        ["/styles/global.css"], 
                        []);
?>

<!DOCTYPE html>
<html lang="nl"></html>
<?php $head->render(); ?>
<?php headerBlock(); ?>
<main class="register">
    <section class="registerForm">
        <article>
            <h1>Sign up</h1>
            <p>Register to log in to your account</p>
        </article>
        <button class="brand">
            <i class="fa-brands fa-apple"></i>
            <p>Sign up with Apple</p>
        </button>
        <button class="brand">
            <i class="fa-brands fa-google"></i>
            <p>Sign up with Google</p>
        </button>
        <form action="" method="post">
            <article>
                <p>Email</p>
                <input class="ghost border-info emailform" type="email" name="email" placeholder="example@example.com">
            </article>
            <article class="passwordform">
                <article>
                    <p>Password</p>
                    <input class="ghost border-info" type="password" name="password" placeholder="Your password">
                </article>
                <article>
                    <p>Repeat</p>
                    <input class="ghost border-info" type="password" name="passwordRepeat" placeholder="Repeat password">
                </article>
            </article>
            <article>
                <input class="checkbox-terms" name="cb" type="checkbox">
                <label>I have read and accept</label>
                <a class="hover" href="#">terms &amp; conditions</a>
            </article>
            <input class="submitbutton" type="submit" value="Register">
            <article>
                <span class="ghost"> Already have an account? </span>
                <a class="hover" href="/pages/login.php">Log in</a>
            </article>
        </form>
    </section>
    <article class="infologin">
        <h1>Hobo</h1>
        <article>
            <h1>Start your journey through our expansive library</h1>
            <p>You are one step away from discovering greatness</p>
        </article>
        <p class="ghost">Art by Tirachard Kumtanom</p>
    </article>
</main>
<?php footer(); ?>
</body>
<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        const password = form.querySelector('input[name="password"]').value;
        const email = form.querySelector('input[name="email"]').value;
        const passwordRepeat = form.querySelector('input[name="passwordRepeat"]').value;


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

        return true;
    });
</script>
</html>

