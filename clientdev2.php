<?php
class Clients {
    private $id_client;
    private $nom;
    private $prenom;
    private $ville;

    public function __construct($id_client, $nom, $prenom, $ville) {
        $this->id_client = $id_client;
        $this->nom       = $nom;
        $this->prenom    = $prenom;
        $this->ville     = $ville;
    }

    public function getId()     { return $this->id_client; }
    public function getNom()    { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getVille()  { return $this->ville; }

    public function ajouter() {
        $cnx = connectionBD::getConnection();
        $req = $cnx->prepare("INSERT INTO clients (nom, prenom, ville) VALUES (:nom, :prenom, :ville)");
        $req->bindParam(':nom',    $this->nom);
        $req->bindParam(':prenom', $this->prenom);
        $req->bindParam(':ville',  $this->ville);
        $req->execute();
    }

    public static function getAll() {
        $cnx = connectionBD::getConnection();
        $req = $cnx->query("SELECT * FROM clients");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modifier() {
        $cnx = connectionBD::getConnection();
        $req = $cnx->prepare("UPDATE clients SET nom=:nom, prenom=:prenom, ville=:ville WHERE id_clients=:id");
        $req->bindParam(':nom',    $this->nom);
        $req->bindParam(':prenom', $this->prenom);
        $req->bindParam(':ville',  $this->ville);
        $req->bindParam(':id',     $this->id_client);
        $req->execute();
    }

    public function supprimer() {
        $cnx = connectionBD::getConnection();
        $req = $cnx->prepare("DELETE FROM clients WHERE id_clients=:id");
        $req->bindParam(':id', $this->id_client);
        $req->execute();
    }
}
?>