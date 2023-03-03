<?php
session_start();
?>
<!doctype html>

<?php
include 'composants/header.php';
?>

<div id="wrapper">
    <aside>
        <img src="<?php echo ($_SESSION['avatar']) ?>" alt="Portrait de l'utilisatrice" />
        <section>
            <h3><?php echo ($_SESSION['alias']) ?></h3>
            <p>AI I follow
            </p>

        </section>
    </aside>
    <main class='contacts'>
        <?php
        // Etape 1: récupérer l'id de l'utilisateur
        $userId = intval($_SESSION['connected_id']);
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
            // echo "<pre>" . print_r($post, 1) . "</pre>";
        ?>
            <article>
                <img src="<?php echo $post['avatar'] ?>" alt="blason" />
                <h3><a href="wall.php?user_id=<?php echo $post['id'] ?>"><?php echo $post['alias'] ?></a> </h3>
                <p></p>
            </article>
        <?php } ?>
    </main>
</div>
</body>

</html>