<?php

namespace app\models;

use Flight;

class AnimalModel
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    //Type
    public function createTypeAnimal($nom)
    {
        $sql = "INSERT INTO type_animal (nom) VALUES ('$nom')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getTypeAnimal($id)
    {
        $sql = "SELECT * FROM type_animal WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllTypeAnimals()
    {
        $sql = "SELECT * FROM type_animal";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    public function updateTypeAnimal($id, $nom)
    {
        $sql = "UPDATE type_animal SET nom = '$nom' WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deleteTypeAnimal($id)
    {
        $sql = "DELETE FROM type_animal WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    //Animal
    public function createAnimal($utilisateur_id, $type_id, $poids_actuel, $poids_min_vente, $poids_max, $prix_vente_kg, $jours_sans_manger, $perte_poids_par_jour)
    {
        $sql = "INSERT INTO animal (utilisateur_id, type_id, poids_actuel, poids_min_vente, poids_max, prix_vente_kg, jours_sans_manger, perte_poids_par_jour) VALUES ($utilisateur_id, $type_id, $poids_actuel, $poids_min_vente, $poids_max, $prix_vente_kg, $jours_sans_manger, $perte_poids_par_jour)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getAnimal($id)
    {
        $sql = "SELECT * FROM animal WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllAnimals()
    {
        $sql = "SELECT 
                    animal.id, 
                    utilisateur.nom AS eleveur_nom, 
                    type_animal.nom AS type_nom, 
                    animal.poids_actuel, 
                    animal.poids_min_vente, 
                    animal.poids_max, 
                    animal.prix_vente_kg, 
                    animal.jours_sans_manger, 
                    animal.perte_poids_par_jour
                FROM animal
                JOIN utilisateur ON animal.utilisateur_id = utilisateur.id
                JOIN type_animal ON animal.type_id = type_animal.id;
            ";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function updateAnimal($id, $utilisateur_id, $type_id, $poids_actuel, $poids_min_vente, $poids_max, $prix_vente_kg, $jours_sans_manger, $perte_poids_par_jour)
    {
        $sql = "UPDATE animal SET";
        if ($utilisateur_id != null) {
            $sql += " utilisateur_id = $utilisateur_id,";
        }
        if ($type_id != null) {
            $sql += " type_id = $type_id,";
        }
        if ($poids_actuel != null) {
            $sql += " poids_actuel = $poids_actuel,";
        }
        if ($poids_min_vente != null) {
            $sql += " poids_min_vente = $poids_min_vente,";
        }
        if ($poids_max != null) {
            $sql += " poids_max = $poids_max,";
        }
        if ($prix_vente_kg != null) {
            $sql += " prix_vente_kg = $prix_vente_kg,";
        }
        if ($jours_sans_manger != null) {
            $sql += " jours_sans_manger = $jours_sans_manger,";
        }
        if ($perte_poids_par_jour != null) {
            $sql += " perte_poids_par_jour = $perte_poids_par_jour";
        }
        $sql += " WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deleteAnimal($id)
    {
        $sql = "DELETE  FROM animal WHERE id = $id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // Alimentation Animal
    public function createHistorique_animal_alimentation($animal_id, $alimentation_id, $jour)
    {
        $sql = "INSERT INTO historique_animal_alimentation (animal_id, alimentation_id, jour) VALUES ($animal_id, $alimentation_id, $jour)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getHistorique_animal_alimentation($id)
    {
        $sql = "SELECT * FROM historique_animal_alimentation WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllHistoriques_animal_alimentation()
    {
        $sql = "SELECT * FROM historique_animal_alimentation";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function deleteHistorique_animal_alimentation($id)
    {
        $sql = "DELETE FROM historique_animal_alimentation WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function getEtatElevageAtDate($date)
    {
        $sql = "
        SELECT animal.id, animal.poids_actuel, animal.perte_poids_par_jour,
               DATEDIFF(:date, animal.date_ajout) AS jours_ecoules,
               (animal.poids_actuel - (animal.perte_poids_par_jour * DATEDIFF(:date, animal.date_ajout))) AS poids_final
        FROM animal
        WHERE animal.date_ajout <= :date;
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function calculerGainPoidsAnimal($animal_id, $date)
    {
        $sql = "SELECT ha.animal_id, a.pourcentage_gain_poids, ha.quantite, an.poids_actuel as poidsanimal_actuel
                FROM historique_animal_alimentation ha
                JOIN alimentation a ON ha.alimentation_id = a.id
                JOIN animal an ON ha.animal_id = an.id
                WHERE ha.animal_id = $animal_id 
                AND ha.date_consommation <= '$date'";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $gainPoidsTotal = 0;
        while ($row = $stmt->fetch()) {
            $gainPoidsTotal += ($row['quantite'] * ($row['pourcentage_gain_poids'] / 100));
        }

        return $gainPoidsTotal;
    }
}
