<?php
include_once '../blocks/head.php';
include_once '../blocks/header.php';
include_once '../blocks/footer.php';

include_once '../php/sqlConnect.php';
include_once '../php/sqlUtils.php';


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





$head = [
    'title' => 'Register',
    'styles' => ['/styles/global.css'],
    'scripts' => [],
];
?>

<!DOCTYPE html>
<html lang="nl"></html>
<?php head($head); ?>
<?php headerBlock(); ?>
<main>
    <article>
        <i class="fa-brands fa-apple"></i>Sign up with Apple
    </article>
    <article>
        <i class="fa-brands fa-google"></i>Sign up with Google
    </article>
    <form action="" method="post">
        <article>
            <p>Email</p>
            <input type="email" name="email" placeholder="example@example.com">
        </article>
        <article>
            <p>Password</p>
            <input type="password" name="password" placeholder="Your password">
        </article>
        <article>
            <p>Repeat password</p>
            <input type="password" name="passwordRepeat" placeholder="Repeat password">
        </article>
        <input name="cb" type="checkbox">
        <label>I have read and accept</label>
        <a href="#">terms &amp; conditions</a>
        <article>
            <input type="submit" value="Register">
        </article>
        <article>
           <span class="ghost"> Already have an account? </span>
           <a href="/pages/login.php">Sign in</a>
        </article>
    </form>
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

