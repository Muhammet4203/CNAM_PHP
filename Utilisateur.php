<?php

class Utilisateur {
    private $id;
    private $nom;
    private $prenom;
    private $adresseEmail;
    private $motDePasse;

    // Méthodes getters et setters pour les attributs
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getAdresseEmail() {
        return $this->adresseEmail;
    }

    public function setAdresseEmail($adresseEmail) {
        $this->adresseEmail = $adresseEmail;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }

    // Méthode statique pour récupérer un utilisateur par son email depuis la base de données
    public static function getUtilisateurParEmail($email) {
        global $pdo;

        $query = "SELECT * FROM utilisateurs WHERE adresse_email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur) {
            $user = new Utilisateur();
            $user->setId($utilisateur['ID_utilisateur']);
            $user->setNom($utilisateur['Nom']);
            $user->setPrenom($utilisateur['Prenom']);
            $user->setAdresseEmail($utilisateur['Adresse_email']);
            $user->setMotDePasse($utilisateur['Mot_de_passe']);

            return $user;
        } else {
            return null;
        }
    }

    // Méthode pour insérer l'utilisateur dans la base de données
    public function insert() {
        global $pdo;

        $query = "INSERT INTO utilisateurs (nom, prenom, adresse_email, mot_de_passe) VALUES (:nom, :prenom, :email, :motDePasse)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':email', $this->adresseEmail);
        $stmt->bindParam(':motDePasse', $this->motDePasse);
        $stmt->execute();

        $this->id = $pdo->lastInsertId();
    }

    // Autres méthodes de la classe Utilisateur
}

?>
