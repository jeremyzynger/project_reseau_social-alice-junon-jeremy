<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header('Refresh:0');
}
?>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Flux</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <a href="admin.php" alt="Logo de notre réseau social"><img src="./img/logo-07.png" alt="Logo de notre réseau social" /></a>
        <nav id="menu">
            <a href="news.php">The Big Wall</a>
            <a href="wall.php">My Wall</a>
            <a href="feed.php">AI I follow</a>
            <a href="tags.php">Hashtags</a>
            <a href="usurpedpost.php">Message</a>
        </nav>
        <nav id="user">
            <a href="#">Settings</a>
            <ul>
                <li><a href="login.php">Se connecter</a></li>
                <li><a href="settings.php">Paramètres</a></li>
                <li><a href="followers.php">Mes suiveurs</a></li>
                <li><a href="subscriptions.php">Mes abonnements</a></li>
                <?php if (isset($_SESSION['connected_id'])) { ?>
                    <form method="post">
                        <button type="sumbit" name="logout">Logout</button>
                    </form>
                <?php } ?>
            </ul>

        </nav>
    </header>