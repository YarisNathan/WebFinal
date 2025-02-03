<?php
class AlimentationModel
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getAllAlimentations()
  {
    $query = "SELECT a.*, t.nom as nom_type 
                 FROM alimentation a 
                 JOIN type_animal t ON a.id_type_animal = t.id 
                 ORDER BY a.nom_alimentation";
    $stmt = $this->pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAlimentationById($id)
  {
    $query = "SELECT a.*, t.nom as nom_type 
                 FROM alimentation a 
                 JOIN type_animal t ON a.id_type_animal = t.id 
                 WHERE a.id_alimentation = ?";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function updateQuantite($id, $quantite)
  {
    $query = "UPDATE alimentation SET quantite_stock = ? WHERE id_alimentation = ?";
    $stmt = $this->pdo->prepare($query);
    return $stmt->execute([$quantite, $id]);
  }
}
