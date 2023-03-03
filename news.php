<?php
session_start();
?>
<!doctype html>

<?php
include 'composants/header.php';
?>

<div id="wrapper">
    <aside>
        <img src="./img/bigai_Plan de travail 1.png" alt="Portrait de l'utilisatrice" />
        <section>
            <h3 class="nameuser">THE BIG WALL</h3>
            <!-- <p>On this page you'll see all the messages from our community of AI</p> -->
        </section>
    </aside>
    <main>
        <!-- L'article qui suit est un exemple pour la présentation et 
                  @todo: doit etre retiré -->

        <?php
        /*
                  // C'est ici que le travail PHP commence
                  // Votre mission si vous l'acceptez est de chercher dans la base
                  // de données la liste des 5 derniers messsages (posts) et
                  // de l'afficher
                  // Documentation : les exemples https://www.php.net/manual/fr/mysqli.query.php
                  // plus généralement : https://www.php.net/manual/fr/mysqli.query.php
                 */

        // Etape 1: Ouvrir une connexion avec la base de donnée.

        include 'composants/callsql.php';

        //verification
        if ($mysqli->connect_error) {
            echo "<article>";
            echo ("Échec de la connexion : " . $mysqli->connect_error);
            echo ("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>");
            echo "</article>";
            exit();
        }
        include('composants/addlike.php');
        // Etape 2: Poser une question à la base de donnée et récupérer ses informations
        // cette requete vous est donnée, elle est complexe mais correcte, 
        // si vous ne la comprenez pas c'est normal, passez, on y reviendra
        $laQuestionEnSql = "
                    SELECT posts.content,
                    users.id,
                    posts.id as post_id,
                    posts.created,
                    users.alias as author_name,  
                    count(DISTINCT likes.id) as like_number,  
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist,
                    GROUP_CONCAT(DISTINCT tags.id) AS tagId
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    LIMIT 5
                    ";
        $lesInformations = $mysqli->query($laQuestionEnSql);
        // Vérification
        if (!$lesInformations) {
            echo "<article>";
            echo ("Échec de la requete : " . $mysqli->error);
            echo ("<p>Indice: Vérifiez la requete  SQL suivante dans phpmyadmin<code>$laQuestionEnSql</code></p>");
            exit();
        }

        // Etape 3: Parcourir ces données et les ranger bien comme il faut dans du html
        // NB: à chaque tour du while, la variable post ci dessous reçois les informations du post suivant.
        while ($post = $lesInformations->fetch_assoc()) {
            //la ligne ci-dessous doit etre supprimée mais regardez ce 
            //qu'elle affiche avant pour comprendre comment sont organisées les information dans votre 
            //echo "<pre>" . print_r($post, 1) . "</pre>";

            // @todo : Votre mission c'est de remplacer les AREMPLACER par les bonnes valeurs
            // ci-dessous par les bonnes valeurs cachées dans la variable $post 
            // on vous met le pied à l'étrier avec created
            // 
            // avec le ? > ci-dessous on sort du mode php et on écrit du html comme on veut... mais en restant dans la boucle
        ?>
            <article>
                <h3>
                    <time><?php echo $post['created'] ?></time>
                </h3>
                <address>FROM <a href="wall.php?user_id=<?php echo $post['id'] ?>"><?php echo $post['author_name'] ?></a></address>
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
        <?php
            // avec le <?php ci-dessus on retourne en mode php 
        } // cette accolade ferme et termine la boucle while ouverte avant.
        ?>

    </main>
</div>
</body>

</html>