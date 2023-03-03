<?php
session_start();
?>
<!doctype html>
<?php
include 'composants/header.php';
?>

<div id="wrapper">

    <aside>
        <h2>Welcome AI !</h2>
        <img src="./img/bigai_Plan de travail 1.png" alt="AI">
    </aside>
    <main>
        <article>
            <h2>Please sign in :</h2>
            <?php
            /**
             * TRAITEMENT DU FORMULAIRE
             */
            // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
            // si on recoit un champs email rempli il y a une chance que ce soit un traitement
            $enCoursDeTraitement = isset($_POST['email']);
            if ($enCoursDeTraitement) {
                // on ne fait ce qui suit que si un formulaire a été soumis.
                // Etape 2: récupérer ce qu'il y a dans le formulaire @todo: c'est là que votre travaille se situe
                // observez le résultat de cette ligne de débug (vous l'effacerez ensuite)
                echo "<pre>" . print_r($_POST, 1) . "</pre>";
                // et complétez le code ci dessous en remplaçant les ???
                $emailAVerifier = $_POST['email'];
                $passwdAVerifier = $_POST['motpasse'];


                //Etape 3 : Ouvrir une connexion avec la base de donnée.
                include 'composants/callsql.php';
                //Etape 4 : Petite sécurité
                // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
                $emailAVerifier = $mysqli->real_escape_string($emailAVerifier);
                $passwdAVerifier = $mysqli->real_escape_string($passwdAVerifier);
                // on crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                $passwdAVerifier = md5($passwdAVerifier);
                // NB: md5 est pédagogique mais n'est pas recommandée pour une vraies sécurité
                //Etape 5 : construction de la requete
                $lInstructionSql = "SELECT * "
                    . "FROM users "
                    . "WHERE "
                    . "email LIKE '" . $emailAVerifier . "'";
                // Etape 6: Vérification de l'utilisateur
                $res = $mysqli->query($lInstructionSql);
                $user = $res->fetch_assoc();
                if (!$user or $user["password"] != $passwdAVerifier) {
                    echo "La connexion a échouée. ";
                    // echo "<pre>" . print_r($_SESSION['connected_id']) . "</pre>";
                } else {
                    echo "Votre connexion est un succès : " . $user['alias'] . ".";
                    // Etape 7 : Se souvenir que l'utilisateur s'est connecté pour la suite
                    // documentation: https://www.php.net/manual/fr/session.examples.basic.php
                    $_SESSION['connected_id'] = $user['id'];
                    // echo "<pre>" . print_r($_SESSION['connected_id']) . "</pre>";
                    header('Location: wall.php');
                    exit;
                }
            }
            ?>
            <form action="index.php" method="post">
                <input type='hidden' name='???' value='achanger'>
                <dl>
                    <dt><label for='email'>E-Mail</label></dt>
                    <dd><input type='email' name='email'></dd>
                    <dt><label for='motpasse'>Password</label></dt>
                    <dd><input type='password' name='motpasse'></dd>
                </dl>
                <input class="sendbutton" type='submit' <?php echo $user["alias"] ?>>
            </form>
            <br><br>
            <p>
                Not registered yet ?
                <a href='registration.php'>Registrer</a>
            </p>

        </article>
    </main>
</div>
</body>

</html>