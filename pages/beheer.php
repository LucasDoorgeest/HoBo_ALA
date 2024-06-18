<?php
include_once "../php/basicIncludes.php";

$head = new HeadComponent(
    "Beheer",
    ["/styles/global.css"],
    []
);

if (!isset($_SESSION["user"]) || $_SESSION["user"]["isAdmin"] != 1) {
    header("Location: /");
}

$series = fetchSqlAll("SELECT * FROM serie", []);

?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <h1>Beheer</h1>

        <section>
        <a class="button addNewSerie" href="/pages/addSerie.php">Add new serie</a>


        <table class="serieBeheer">
            <tr>
                <th>SerieID</th>
                <th>SerieTitel</th>
                <th>Bewerken</th>
            </tr>
            <?php
                foreach ($series as $serie) {
                   ?>
                    <tr>
                        <td><?php echo $serie["SerieID"] ?></td>
                        <td><?php echo $serie["SerieTitel"] ?></td>
                        <td><a class="button" href="/pages/editSerie.php?id=<?php echo $serie["SerieID"] ?>">Edit</a></td>
                    </tr>
                    <?php
                }
            ?>
        </table>    
        </section>

    </main>
    <?php FooterComponent::render(); ?>
</body>
</html>