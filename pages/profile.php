<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

$head = new HeadComponent("Profiel", ["/styles/global.css"], []);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["Voornaam"];
    $tussenvoegsel = $_POST["Tussenvoegsel"];
    $surname = $_POST["Achternaam"];
    $favoriteGenre = $_POST["Genre"];



    $query = "UPDATE klant SET Voornaam = ?, Tussenvoegsel = ?, Achternaam = ?, Genre = ? WHERE KlantNr = ?";
    $params = [$name, $tussenvoegsel, $surname, $favoriteGenre, $_SESSION["user"]["KlantNr"]];
    runSql($query, $params);


    $query = "SELECT * FROM klant WHERE KlantNr = ?";
    $params = [$_SESSION["user"]["KlantNr"]];
    $user = fetchSql($query, $params);
    $_SESSION["user"] = $user;
    header("Location: /pages/profile.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
    <?php headerBlock(); ?>
    <main>

    <form action="profile.php" method="post">
        <input type="text" name="Voornaam" placeholder="Voornaam" value="<?php echo $_SESSION["user"]["Voornaam"] ?>">
        <input type="text" name="Tussenvoegsel" placeholder="Tussenvoegsel" value="<?php echo $_SESSION["user"]["Tussenvoegsel"] ?>">
        <input type="text" name="Achternaam" placeholder="Achternaam" value="<?php echo $_SESSION["user"]["Achternaam"] ?>">
        <input type="email" name="Email" placeholder="Email" value="<?php echo $_SESSION["user"]["Email"] ?>" disabled>

        <select name="Genre" id="Genre">
            <?php
            $genres = fetchSqlAll("SELECT * FROM genre");
            foreach ($genres as $genre) {
                ?>
                <option value="<?php echo $genre["GenreID"] ?>" <?php if ($genre["GenreID"] == $_SESSION["user"]["Genre"]) { echo "selected"; } ?>><?php echo $genre["GenreNaam"] ?></option>
                <?php
            }
            ?>
        </select>


        <input type="submit" value="Wijzigingen opslaan">
    </form>

    </main>
    <?php footer(); ?>
</body>