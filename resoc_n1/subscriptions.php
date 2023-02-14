<!doctype html>

<?php
include 'composants/header.php';
?>

<div id="wrapper">
    <aside>
        <img src="./img/user.jpg" alt="Portrait de l'utilisatrice" />
        <section>
            <h3>Présentation</h3>
            <p>Sur cette page vous trouverez la liste des personnes dont
                l'utilisatrice <?php echo intval($_GET['user_id']) ?> 
                suit les messages
            </p>

        </section>
    </aside>
    <main class='contacts'>
        <?php
        // Etape 1: récupérer l'id de l'utilisateur
        $userId = intval($_GET['user_id']);
        // Etape 2: se connecter à la base de donnée
        include 'composants/callsql.php';
        // Etape 3: récupérer le nom de l'utilisateur
        $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
        $lesInformations = $mysqli->query($laQuestionEnSql);
        if (!$lesInformations) {
            echo ("Échec de la requete : " . $mysqli->error);
        }
        // Etape 4: à vous de jouer
        //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 
        while ($post = $lesInformations->fetch_assoc()) {

        ?>
        <article>
            <img src="./img/user.jpg" alt="blason" />
            <h3>Alexandra</h3>
            <p>id:654</p>
        </article>
        <?php } ?>
    </main>
</div>
</body>

</html>