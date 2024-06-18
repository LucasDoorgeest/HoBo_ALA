<?php
include_once "../php/basicIncludes.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = fetchSql('SELECT * FROM klant WHERE email = ?', [$email]);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: /');
        exit;
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}

$head = new HeadComponent("Login", 
                        ["/styles/global.css"], 
                        []);
?>


<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
<?php HeaderComponent::render(); ?>
<main class="register">
    <section class="registerForm">
        <article>
            <h1>Welcome back</h1>
            <p>Enter your username and password to log into your account</p>
        </article>
        <button class="brand">
            <i class="fa-brands fa-apple"></i>
            <p>Log in with Apple</p>
        </button>
        <button class="brand">
            <i class="fa-brands fa-google"></i>
            <p>Log in with Google</p>
        </button>
        <form action="" method="post">
            <article class="emailform">
                <p>Email</p>
                <input class="ghost border-info" type="email" name="email" placeholder="example@example.com">
            </article>
            <article class="passwordform-login">
                <p>Password</p>
                <input class="ghost border-info" type="password" name="password" placeholder="Your password">
            </article>
            <input class="submitbutton" type="submit" value="Login">
            <article>
                <span class="ghost"> Don't have an account yet? </span>
                <a class="hover" href="/pages/register.php">Sign up</a>
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

