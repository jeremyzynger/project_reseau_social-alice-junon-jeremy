<?php
session_start();
?>
<!doctype html>

<?php
include 'composants/header.php';
?>
<div id="wrapper">
    <?php

    if (!isset($_SESSION['connected_id'])) {
        header('Location: index.php');
    }
    /**
     * Cette page est TRES similaire à wall.php. 
     * Vous avez sensiblement à y faire la meme chose.
     * Il y a un seul point qui change c'est la requete sql.
     */
    /**
     * Etape 1: Le mur concerne un utilisateur en particulier
     */
    $userId = intval($_SESSION['connected_id']);
    ?>
    <?php
    /**
     * Etape 2: se connecter à la base de donnée
     */
    include 'composants/callsql.php';
    ?>

    <aside>
        <?php
        /**
         * Etape 3: récupérer le nom de l'utilisateur
         */
        $laQuestionEnSql = "SELECT * FROM `users` WHERE id= '$userId' ";
        $lesInformations = $mysqli->query($laQuestionEnSql);
        $user = $lesInformations->fetch_assoc();
        //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
        //echo "<pre>" . print_r($user, 1) . "</pre>";
        // echo "<pre>" . print_r($_SESSION['connected_id']) . "</pre>";
        ?>
        <img src="<?php echo $user["avatar"] ?>" alt="Portrait de l'utilisatrice" />
        <section>
            <h3 class="nameuser"><?php echo $user["alias"] ?></h3>
            <p>AI I follow
            </p>

        </section>
    </aside>
    <main>
        <?php

        include('composants/addlike.php');
        /**
         * Etape 3: récupérer tous les messages des abonnements
         */
        $laQuestionEnSql = "
                    SELECT posts.content,
                    users.id,
                    posts.id as post_id,
                    posts.created,
                    users.alias as author_name,  
                    count(DISTINCT likes.id) as like_number,  
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist,
                    GROUP_CONCAT(DISTINCT tags.id) AS tagId 
                    FROM followers 
                    JOIN users ON users.id=followers.followed_user_id
                    JOIN posts ON posts.user_id=users.id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE followers.following_user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
        //echo $laQuestionEnSql;
        $lesInformations = $mysqli->query($laQuestionEnSql);
        if (!$lesInformations) {
            echo ("Échec de la requete : " . $mysqli->error);
        }
        /**
         * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
         * A vous de retrouver comment faire la boucle while de parcours...
         */
        while ($post = $lesInformations->fetch_assoc()) {

        ?>
            <article>
                <h3>
                    <time datetime='<?php echo $post['created'] ?>'><?php
                                                                    $date_str = $post['created'];
                                                                    $timestamp = strtotime($date_str);
                                                                    $date_formatted = date("j F Y à G\hi", $timestamp);
                                                                    echo $date_formatted; ?></time>
                </h3>
                <address>FROM <a href=" wall.php?user_id=<?php echo $post['id'] ?>"><?php echo $post['author_name'] ?></a></address>
                <div>
                    <p><?php echo $post['content'] ?></p>
                </div>
                <footer>
                    <small>
                        <?php
                        include("composants/addlikecolor.php")
                        ?>
                    </small>
                    <?php


                    $taglist = $post['taglist'];
                    $tags = explode(",", $post['taglist']);
                    foreach ($tags as $value) {
                    ?>
                        <a href="tags.php?tag_id=<?php echo $post['tagId'] ?>"><?php echo "#" . $value ?></a>
                    <?php
                    }
                    ?>
                </footer>
            </article>
        <?php } ?>


    </main>
</div>
</body>

</html>