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
<html lang="nl"></html>
<?php $head->render(); ?>
<?php headerBlock(); ?>
<main>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
    </form>
</main>
<?php footer(); ?>
</body>
</html>

