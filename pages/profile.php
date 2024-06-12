<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

$head = new HeadComponent("Profiel", ["/styles/global.css"], []);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "UPDATE klant SET Voornaam = ?, Tussenvoegsel = ?, Achternaam = ?, Genre = ? WHERE KlantNr = ?";
    $params = [$_POST["Voornaam"], $_POST["Tussenvoegsel"], $_POST["Achternaam"], 
                $_POST["Genre"], $_SESSION["user"]["KlantNr"]];
    runSql($query, $params);


    $query = "SELECT * FROM klant WHERE KlantNr = ?";
    $params = [$_SESSION["user"]["KlantNr"]];
    $user = fetchSql($query, $params);
    $_SESSION["user"] = $user;
    header("Location: /pages/profile.php");
}
?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>

<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <h1 class="center">Profiel</h1>
        <section class="profilePage">

        <form action="profile.php" method="post">


            <table>
                <tr>
                    <td><label for="Voornaam">Voornaam</label></td>
                    <td><input type="text" name="Voornaam" placeholder="Voornaam" value="<?php echo $_SESSION["user"]["Voornaam"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="Tussenvoegsel">Tussenvoegsel</label></td>
                    <td><input type="text" name="Tussenvoegsel" placeholder="Tussenvoegsel" value="<?php echo $_SESSION["user"]["Tussenvoegsel"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="Achternaam">Achternaam</label></td>
                    <td><input type="text" name="Achternaam" placeholder="Achternaam" value="<?php echo $_SESSION["user"]["Achternaam"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="Email">Email</label></td>
                    <td><input type="email" name="Email" placeholder="Email" value="<?php echo $_SESSION["user"]["Email"] ?>" disabled></td>
                </tr>
                <tr>
                    <td><label for="Genre">Favorite genre</label></td>
                    <td>
                        <select name="Genre" id="Genre">
                            <?php
                            $genres = fetchSqlAll("SELECT * FROM genre");
                            foreach ($genres as $genre) {
                                $genreId = $genre["GenreID"];
                                $isGekozen = $genre["GenreID"] == $_SESSION["user"]["Genre"];
                                ?>
                                <option value="<?php echo $genreId ?>" <?php echo $isGekozen ? "selected" : "" ?>>
                                    <?php echo $genre["GenreNaam"] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <input class="button" type="submit" value="Wijzigingen opslaan">
        </form>
        </section>
        <a id="kijkgeschiedenis" href="/pages/history.php">
            <img src="/img/history.png" alt="history icon">
            <p>Bekijk kijkgeschiedenis</p>
        </a>
    </main>
    <?php FooterComponent::render(); ?>
</body>
</html>