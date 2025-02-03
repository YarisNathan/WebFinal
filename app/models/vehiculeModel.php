<?php

namespace app\models;

use Flight;

class vehiculeModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getVehicule($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM vehicule WHERE Id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAllVehicules()
    {
        $stmt = $this->db->query("SELECT * FROM vehicule");
        return $stmt->fetchAll();
    }

    public function addVehicule($data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO vehicule (chauffeur_id, marque, modele) VALUES (?, ?, ?)");
            $stmt->execute([
                $data["chauffeur_id"],
                $data["marque"],
                $data["modele"]
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout du véhicule : " . $e->getMessage());
        }
    }

    public function updateVehicule($id, $data)
    {
        try {
            $stmt = $this->db->prepare("UPDATE vehicule SET chauffeur_id = ?, marque = ?, modele = ? WHERE Id = ?");
            $stmt->execute([
                $data["chauffeur_id"],
                $data["marque"],
                $data["modele"],
                $id
            ]);
        } catch (\Throwable $th) {
            throw new \Exception("Erreur lors de la modification du véhicule : " . $th->getMessage());
        }
    }

    public function deleteVehicule($id)
    {
        $stmt = $this->db->prepare("DELETE FROM vehicule WHERE Id = ?");
        $stmt->execute([$id]);
    }
}
