<?php
include_once '../blocks/head.php';
include_once '../blocks/header.php';
include_once '../blocks/footer.php';

include_once '../php/sqlConnect.php';
include_once '../php/sqlUtils.php';


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




$head = [
    'title' => 'Login',
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
        <input type="submit" value="Login">
    </form>
</main>
<?php footer(); ?>
</body>
</html>

