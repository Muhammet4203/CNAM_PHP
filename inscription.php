<?php
require_once 'config.php';
require_once 'Utilisateur.php';

if (isset($_SESSION['utilisateur'])) {
    header('Location: index.php');
    exit;
}

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['adresse_email'];
    $motDePasse = $_POST['mot_de_passe'];

    // Hasher le mot de passe
    $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

    // Créer un nouvel utilisateur
    $utilisateur = new Utilisateur();
    $utilisateur->setNom($nom);
    $utilisateur->setPrenom($prenom);
    $utilisateur->setAdresseEmail($email);
    $utilisateur->setMotDePasse($motDePasseHash);

    // Insérer l'utilisateur dans la base de données
    $utilisateur->insert();

    // Rediriger vers la page de connexion ou afficher un message de succès
    header('Location: connexion.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Inscription</h1>

    <form action="inscription.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>

        <label for="adresse_email">Adresse e-mail :</label>
        <input type="email" name="adresse_email" id="adresse_email" required>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required>

        <button type="submit">S'inscrire</button>
    </form>

    <a href="connexion.php">Déjà inscrit ? Connectez-vous ici</a>

    <script src="js/script.js"></script>
</body>
</html>
