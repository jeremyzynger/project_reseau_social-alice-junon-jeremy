<!doctype html>

<?php
include 'composants/header.php';
?>

<?php
/**
 * Etape 1: Ouvrir une connexion avec la base de donnée.
 */
// on va en avoir besoin pour la suite
include 'composants/callsql.php';
//verification
if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
}
?>
<div id="wrapper" class='admin'>
    <aside>
        <h2>HASHTAGS</h2>
        <?php
        /*
                 * Etape 2 : trouver tous les mots clés
                 */
        $laQuestionEnSql = "SELECT * FROM `tags` LIMIT 50";
        $lesInformations = $mysqli->query($laQuestionEnSql);
        // Vérification
        if (!$lesInformations) {
            echo ("Échec de la requete : " . $mysqli->error);
            exit();
        }

        /*
                 * Etape 3 : @todo : Afficher les mots clés en s'inspirant de ce qui a été fait dans news.php
                 * Attention à en pas oublier de modifier tag_id=321 avec l'id du mot dans le lien
                 */
        while ($tag = $lesInformations->fetch_assoc()) {
            //echo "<pre>" . print_r($tag, 1) . "</pre>";
        ?>
            <article>

                <h3><a href="tags.php?tag_id=<?php echo $tag['id'] ?>"><?php echo $tag['label'] ?></a></h3>
                <!-- <p><//?php echo $tag['id'] ?></p> -->

            </article>
        <?php } ?>
    </aside>
    <main>
        <h2>AI</h2>
        <?php
        /*
                 * Etape 4 : trouver tous les mots clés
                 * PS: on note que la connexion $mysqli à la base a été faite, pas besoin de la refaire.
                 */
        $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
        $lesInformations = $mysqli->query($laQuestionEnSql);
        // Vérification
        if (!$lesInformations) {
            echo ("Échec de la requete : " . $mysqli->error);
            exit();
        }

        /*
                 * Etape 5 : @todo : Afficher les utilisatrices en s'inspirant de ce qui a été fait dans news.php
                 * Attention à en pas oublier de modifier dans le lien les "user_id=123" avec l'id de l'utilisatrice
                 */
        while ($tag = $lesInformations->fetch_assoc()) {
            //echo "<pre>" . print_r($tag, 1) . "</pre>";
        ?>
            <article>
                <h3><a href="wall.php?user_id=<?php echo $tag['id'] ?>"><?php echo $tag['alias'] ?></a></h3>
                <p><?php echo $tag['id'] ?></p>
                <nav>
                    <a href="wall.php?user_id=<?php echo $tag['id'] ?>">Wall</a>
                    | <a href="feed.php?user_id=<?php echo $tag['id'] ?>">Flow</a>
                    | <a href="settings.php?user_id=<?php echo $tag['id'] ?>">Parameters</a>
                    | <a href="followers.php?user_id=<?php echo $tag['id'] ?>">Followers</a>
                    | <a href="subscriptions.php?user_id=<?php echo $tag['id'] ?>">Followed</a>
                </nav>
            </article>
        <?php } ?>
    </main>
</div>
</body>

</html>