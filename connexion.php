<?php
require_once 'config.php';
require_once 'Utilisateur.php';

session_start();

if (isset($_SESSION['utilisateur'])) {
    header('Location: index.php');
    exit;
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['adresse_email'];
    $motDePasse = $_POST['mot_de_passe'];

    // Vérifier les informations de connexion
    $utilisateur = Utilisateur::getUtilisateurParEmail($email);
    if ($utilisateur && password_verify($motDePasse, $utilisateur->getMotDePasse())) {
        // Authentification réussie
        $_SESSION['utilisateur'] = $utilisateur;
        header('Location: index.php');
        exit;
    } else {
        // Identifiants invalides
        $erreur = 'Identifiants invalides. Veuillez réessayer.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Connexion</h1>

    <?php if (isset($erreur)) : ?>
        <p><?php echo $erreur; ?></p>
    <?php endif; ?>

    <form action="connexion.php" method="POST">
        <label for="adresse_email">Adresse e-mail :</label>
        <input type="email" name="adresse_email" id="adresse_email" required>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required>

        <button type="submit">Se connecter</button>
    </form>

    <a href="inscription.php">Pas encore inscrit ? Inscrivez-vous ici</a>

    <script src="js/script.js"></script>
</body>
</html>
