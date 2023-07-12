<?php
class Annonce {
    private $id;
    private $titre;
    private $description;
    private $idUtilisateur;
    private $categorie;
    private $prix;
    private $datePublication;

    // Méthode statique pour récupérer toutes les annonces depuis la base de données
    public static function getAllAnnonces() {
        $pdo = new PDO("mysql:host=localhost:3307;dbname=lemauvaiscoin;charset=utf8", "root", "");
        $stmt = $pdo->query("SELECT * FROM Annonces");
        $annonces = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $annonce = new Annonce();
            $annonce->id = $row['ID_annonce'];
            $annonce->titre = $row['Titre'];
            $annonce->description = $row['Description'];
            $annonce->idUtilisateur = $row['ID_utilisateur'];
            $annonce->categorie = $row['Categorie'];
            $annonce->prix = $row['Prix'];
            $annonce->datePublication = $row['Date_publication'];
            $annonces[] = $annonce;
        }

        return $annonces;
    }

    // Méthodes pour obtenir les attributs de l'annonce
    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getDatePublication() {
        return $this->datePublication;
    }
}
?>
