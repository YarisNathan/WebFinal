<?php

namespace app\controllers;

use app\models\vehiculeModel;
use Flight;

class vehiculeControlleur
{

    public function __construct()
    {

    }

    public function dashboard() {
        Flight::render('index');
    }

    public function Cueilleurs() {
        $Vehicules = Flight::vehiculeModel()->getAllVehicules();       
        Flight::render('Cueilleur', ['Cueilleur'=> $Vehicules]);
    }

    public function addVehicule()
    {
        $request = Flight::request();
        $chauffeur_id = $request->data->chauffeur_id;
        $marque = $request->data->marque;
        $modele = $request->data->modele;

        if (empty($chauffeur_id) || empty($marque) || empty($modele)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'chauffeur_id' => $chauffeur_id,
            'marque' => $marque,
            'modele' => $modele,
        ];

        Flight::vehiculeModel()->addVehicule($data);
        Flight::json(['status' => 'Véhicule ajouté avec succès']);
    }

    public function updateVehicule($id)
    {
        $request = Flight::request();
        $chauffeur_id = $request->data->chauffeur_id;
        $marque = $request->data->marque;
        $modele = $request->data->modele;

        if (empty($chauffeur_id) || empty($marque) || empty($modele)) {
            Flight::json(['error' => 'Tous les champs sont requis'], 400);
            return;
        }

        $data = [
            'chauffeur_id' => $chauffeur_id,
            'marque' => $marque,
            'modele' => $modele,
        ];

        Flight::vehiculeModel()->updateVehicule($id, $data);
        Flight::json(['status' => 'Véhicule mis à jour avec succès']);
    }

    public function deleteVehicule($id)
    {
        Flight::vehiculeModel()->deleteVehicule($id);
        Flight::json(['status' => 'Véhicule supprimé avec succès']);
    }

    public function formulaireAddVehicule()
    {
        Flight::render('formulaireAjout');
    }

    public function formulaireModifyVehicule($id)
    {
        $Vehicules = Flight::vehiculeModel()->getVehicule($id);

        $data = [
            'chauffeur_id' => $Vehicules["chauffeur_id"],
            'modele' => $Vehicules["modele"],
            'marque' => $Vehicules["marque"]
        ];

        Flight::render('formulaireModifier', ['id' => $id, 'data' => $data]);
    }

}
