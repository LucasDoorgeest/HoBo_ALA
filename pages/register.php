<?php
include_once "../php/basicIncludes.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];

    if (strlen($password) < 8) {
        echo "<script>alert('Wachtwoord moet minimaal 8 tekens bevatten');</script>";
    } else if ($password !== $passwordRepeat) {
        echo "<script>alert('Wachtwoorden komen niet overeen');</script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $user = fetchSql('SELECT * FROM klant WHERE email = ?', [$email]);
        if ($user) {
            echo "<script>alert('Klant nu al geregistreerd');</script>";
        } else {
            execSql('INSERT INTO klant (email, password, AboID, Genre) VALUES (?, ?, 1, 1)', [$email, $hashedPassword]);
            $user = fetchSql('SELECT * FROM klant WHERE email = ?', [$email]);
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        }     
    }
}

$head = new HeadComponent("Register", 
                        ["/styles/global.css"], 
                        ["/script/register.js"]);
?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
<?php HeaderComponent::render(); ?>
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
                <a class="hover" href="privacy.php">terms &amp; conditions</a>
            </article>
            <input class="submitbutton" type="submit" value="Register">
            <article>
                <span class="ghost"> Already have an account? </span>
                <a class="hover" href="/pages/login.php">Log in</a>
            </article>
        </form>
    </section>
    <article class="infologin">
        <h2>Start your journey through our expansive library</h2>
        <p>You are one step away from discovering greatness</p>
        <p class="ghost">Art by Tirachard Kumtanom</p>
    </article>
</main>
<?php FooterComponent::render(); ?>
</body>
</html>

