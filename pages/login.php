<?php
include_once '../blocks/head.php';
include_once '../blocks/header.php';
include_once '../blocks/footer.php';

include_once '../php/sqlConnect.php';
include_once '../php/sqlUtils.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = fetchSql('SELECT * FROM users WHERE username = ?', [$username]);

    if ($user && password_verify($password, $user['password'])) {
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
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login">
    </form>
</main>
<?php footer(); ?>
</body>
</html>

