<?php
session_start();
?>
<!doctype html>
<?php
include 'composants/header.php';
?>
<?php

if (!isset($_SESSION['connected_id'])) {
    header('Location: index.php');
} else if (isset($_SESSION['connected_id']) && isset($_GET['user_id'])) {
    $userId = intval($_GET['user_id']);
} else
    $userId = intval($_SESSION['connected_id']);


include 'composants/callsql.php';
/**
 * Etape 3: récupérer le nom de l'utilisateur
 */
$laQuestionEnSql = "
                    SELECT users.*,
                    count(DISTINCT posts.id) as totalpost,
                    count(DISTINCT given.post_id) as totalgiven,
                    count(DISTINCT recieved.user_id) as totalrecieved
                    FROM users
                    LEFT JOIN posts ON posts.user_id=users.id
                    LEFT JOIN likes as given ON given.user_id=users.id
                    LEFT JOIN likes as recieved ON recieved.post_id=posts.id
                    WHERE users.id = '$userId'
                    GROUP BY users.id
                    ";
//echo ($laQuestionEnSql);
$lesInformations = $mysqli->query($laQuestionEnSql);
if (!$lesInformations) {
    echo ("Échec de la requete : " . $mysqli->error);
}
$user = $lesInformations->fetch_assoc();
$_SESSION['avatar'] = $user['avatar'];
$_SESSION['alias'] = $user['alias'];

// echo $user['avatar'];
// echo $_SESSION['avatar'];
// echo $_SESSION['alias'];
/**
 * Etape 4: à vous de jouer
 */
//@todo: afficher le résultat de la ligne ci dessous, remplacer les valeurs ci-après puiseffacer la ligne ci-dessous
//echo "<pre>" . print_r($user, 1) . "</pre>";
?>
<div id="wrapper" class='profile'>
    <aside>
        <img src="<?php echo $_SESSION['avatar'] ?>" alt="Portrait de l'utilisatrice" />
        <section>
            <h3><?php echo $_SESSION['alias'] ?></h3>
            <p></p>
        </section>
    </aside>
    <main>
        <article class='parameters'>
            <h3>Mes paramètres</h3>
            <dl>
                <dt>Pseudo</dt>
                <dd><?php echo $user['alias'] ?></dd>
                <dt>Email</dt>
                <dd><?php echo $user['email'] ?></dd>
                <dt>Nombre de message</dt>
                <dd><?php echo $user['totalpost'] ?></dd>
                <dt>Nombre de "J'aime" donnés </dt>
                <dd><?php echo $user['totalgiven'] ?></dd>
                <dt>Nombre de "J'aime" reçus</dt>
                <dd><?php echo $user['totalrecieved'] ?></dd>
            </dl>
        </article>
    </main>
</div>
</body>

</html>