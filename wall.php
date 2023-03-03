<?php
session_start();
?>

<!doctype html>

<?php
include 'composants/header.php';
?>

<div id="wrapper">
    <?php
    $tagId = intval($_GET['tag_id']);
    /**
     * Etape 1: Le mur concerne un utilisateur en particulier
     * La première étape est donc de trouver quel est l'id de l'utilisateur
     * Celui ci est indiqué en parametre GET de la page sous la forme user_id=...
     * Documentation : https://www.php.net/manual/fr/reserved.variables.get.php
     * ... mais en résumé c'est une manière de passer des informations à la page en ajoutant des choses dans l'url
     */
    if (!isset($_SESSION['connected_id'])) {
        header('Location: index.php');
    } else if (isset($_SESSION['connected_id']) && isset($_GET['user_id'])) {
        $userId = intval($_GET['user_id']);
    } else if (isset($_SESSION['connected_id']) && !isset($_GET['user_id'])) {
        $userId = intval($_SESSION['connected_id']);
    }
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
        $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
        $lesInformations = $mysqli->query($laQuestionEnSql);
        $user = $lesInformations->fetch_assoc();
        //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
        //echo "<pre>" . print_r($user, 1) . "</pre>";
        // echo "<pre>" . print_r($_SESSION['connected_id']) . "</pre>";
        // echo "<pre>" . print_r($user["id"]) . "</pre>";

        $enCoursDeTraitement = isset($_POST['follow']);
        if ($enCoursDeTraitement) {
            $follower = $_SESSION['connected_id'];
            $followed = $user["id"];
            $instructionSql = "SELECT * FROM followers WHERE followed_user_id = $followed AND following_user_id = $follower";
            $result = $mysqli->query($instructionSql);
            if ($result->num_rows > 0) {
                // Si l'utilisateur est déjà abonné, supprimez l'abonnement
                $instructionSql = "DELETE FROM followers WHERE followed_user_id = $followed AND following_user_id = $follower";
                $ok = $mysqli->query($instructionSql);
                if (!$ok) {
                    //echo "Impossible de se désabonner.";
                } else {
                    //echo "Vous vous êtes désabonné.";
                }
            } else {
                // Si l'utilisateur n'est pas abonné, ajoutez l'abonnement
                $instructionSql = "INSERT INTO followers (id, followed_user_id, following_user_id) VALUES (NULL, $followed, $follower)";
                $ok = $mysqli->query($instructionSql);
                if (!$ok) {
                    //echo "Impossible de s'abonner.";
                } else {
                    //echo "Vous êtes abonné.";
                }
            }
        }

        ?>
        <img src="<?php echo $user["avatar"] ?>" alt="Portrait de l'utilisatrice" />
        <section>
            <h3 class="nameuser"><?php echo $user["alias"] ?></h3>
            <!-- <p>My name is :
            </p> -->
        </section><?php
                    $follower = $_SESSION['connected_id'];
                    $followed = $user["id"];
                    $sql = "SELECT * FROM followers WHERE followed_user_id = '$followed' AND following_user_id = '$follower'";
                    $result = $mysqli->query($sql);
                    //var_dump($result->num_rows);

                    if ($follower == $followed) {
                        // echo "Vous ne pouvez pas vous suivre vous meme!";
                    } else if ($result->num_rows < 1) {

                    ?>
            <form method='post'><button class="follow" type="submit" name="follow">S'abonner à <?php echo $user["id"] ?></button></form>
        <?php } else {
        ?>
            <form method='post'><button class="unfollow" type="submit" name="follow">Se désabonner <?php echo $user["id"] ?></button></form>
        <?php

                    }

        ?>
    </aside>
    <main>
        <?php

        include('composants/addlike.php');
        /**
         * Etape 3: récupérer tous les messages de l'utilisatrice
         */
        $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name,
                    users.id,
                    posts.id as post_id,
                    COUNT(DISTINCT likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist, 
                    GROUP_CONCAT(DISTINCT tags.id) AS tagId
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
        $lesInformations = $mysqli->query($laQuestionEnSql);
        if (!$lesInformations) {
            echo ("Échec de la requete : " . $mysqli->error);
        }

        /**
         * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
         */
        while ($post = $lesInformations->fetch_assoc()) {

            //echo "<pre>" . print_r($post, 1) . "</pre>";
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