<?php
require_once 'config.php';
require_once 'Annonce.php';

$annonces = Annonce::getAllAnnonces();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Le Mauvais Coin</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Le Mauvais Coin</h1>

    <h2>Annonces récentes</h2>

    <?php foreach ($annonces as $annonce) : ?>
        <div class="annonce">
            <h3><?php echo $annonce->getTitre(); ?></h3>
            <p><?php echo $annonce->getDescription(); ?></p>
            <p>Prix: <?php echo $annonce->getPrix(); ?></p>
            <p>Publié le: <?php echo $annonce->getDatePublication(); ?></p>
        </div>
    <?php endforeach; ?>

    <?php if (isset($_SESSION['utilisateur'])) : ?>
        <a href="poster_annonce.php">Poster une annonce</a>
        <a href="deconnexion.php">Déconnexion</a>
    <?php else: ?>
        <a href="inscription.php">Inscription</a>
        <a href="connexion.php">Connexion</a>
    <?php endif; ?>

    <script src="js/script.js"></script>
</body>
</html>
