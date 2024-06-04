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
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="passwordRepeat" placeholder="Repeat password">
        <input type="submit" value="Register">
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

