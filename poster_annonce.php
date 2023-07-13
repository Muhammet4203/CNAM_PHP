<?php
require_once 'config.php';
require_once 'Annonce.php';
require_once 'Utilisateur.php';

session_start();

if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit;
}

// Traitement du formulaire de publication d'annonce
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    // Créer une nouvelle annonce
    $annonce = new Annonce();
    $annonce->setTitre($titre);
    $annonce->setDescription($description);
    $annonce->setPrix($prix);
    $annonce->setDatePublication(date('Y-m-d'));

    // Récupérer l'ID de l'utilisateur en cours à partir de la session
    $idUtilisateur = $_SESSION['utilisateur']->getId();
    $annonce->setIdUtilisateur($idUtilisateur);

    // Insérer l'annonce dans la base de données
    $annonce->insert();

    // Rediriger vers la page d'accueil ou afficher un message de succès
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Poster une annonce</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Poster une annonce</h1>

    <form action="poster_annonce.php" method="POST">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description" required></textarea>

        <label for="prix">Prix :</label>
        <input type="number" name="prix" id="prix" required>

        <button type="submit">Poster</button>
    </form>

    <a href="index.php">Retour à la page d'accueil</a>

    <script src="js/script.js"></script>
</body>
</html>
