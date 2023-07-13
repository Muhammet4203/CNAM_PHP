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

    // Méthodes getters et setters pour les attributs de l'annonce
    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function getDatePublication() {
        return $this->datePublication;
    }

    public function setDatePublication($datePublication) {
        $this->datePublication = $datePublication;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    // Méthode pour insérer l'annonce dans la base de données
    public function insert() {
        $pdo = new PDO("mysql:host=localhost:3307;dbname=lemauvaiscoin;charset=utf8", "root", "");

        $query = "INSERT INTO Annonces (Titre, Description, ID_utilisateur, Categorie, Prix, Date_publication) VALUES (:titre, :description, :idUtilisateur, :categorie, :prix, :datePublication)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':idUtilisateur', $this->idUtilisateur);
        $stmt->bindParam(':categorie', $this->categorie);
        $stmt->bindParam(':prix', $this->prix);
        $stmt->bindParam(':datePublication', $this->datePublication);
        $stmt->execute();

        $this->id = $pdo->lastInsertId();
    }
}


?>
