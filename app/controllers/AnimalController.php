<?php
namespace app\controllers;

use Flight;

class AnimalController
{
    public function __construct() {}

    public function animals()
    {
        $animals = Flight::AnimalModel()->getAllAnimals();
        Flight::render('Animals', ['Animals' => $animals]);
    }

    public function formulaireAddAnimal()
    {
        Flight::render('AnimalForm');
    }

    public function GainPoidsAnimale() {
        $animals = Flight::AnimalModel()->getAllAnimals();
        Flight::render('GainPoidsAnimale', ['Animals' => $animals]);
    }

    public function formulaireModifyAnimal($id)
    {
        $animal = Flight::AnimalModel()->getAnimal($id);
        Flight::render('AnimalForm', ['animal' => $animal]);
    }

    public function addAnimal()
    {
        $request = Flight::request();
        $data = [
            'utilisateur_id' => $request->data->utilisateur_id,
            'type_id' => $request->data->type_id,
            'poids_actuel' => $request->data->poids_actuel,
            'poids_min_vente' => $request->data->poids_min_vente,
            'poids_max' => $request->data->poids_max,
            'prix_vente_kg' => $request->data->prix_vente_kg,
            'jours_sans_manger' => $request->data->jours_sans_manger,
            'perte_poids_par_jour' => $request->data->perte_poids_par_jour
        ];

        if (empty($data['utilisateur_id']) || empty($data['type_id']) || empty($data['poids_actuel'])) {
            Flight::json(['error' => 'Champs obligatoires manquants'], 400);
            return;
        }

        Flight::AnimalModel()->createAnimal(
            $data['utilisateur_id'],
            $data['type_id'],
            $data['poids_actuel'],
            $data['poids_min_vente'],
            $data['poids_max'],
            $data['prix_vente_kg'],
            $data['jours_sans_manger'],
            $data['perte_poids_par_jour']
        );

        Flight::redirect("/animals");
    }

    public function updateAnimal($id)
    {
        $request = Flight::request();
        $data = [
            'utilisateur_id' => $request->data->utilisateur_id,
            'type_id' => $request->data->type_id,
            'poids_actuel' => $request->data->poids_actuel,
            'poids_min_vente' => $request->data->poids_min_vente,
            'poids_max' => $request->data->poids_max,
            'prix_vente_kg' => $request->data->prix_vente_kg,
            'jours_sans_manger' => $request->data->jours_sans_manger,
            'perte_poids_par_jour' => $request->data->perte_poids_par_jour
        ];

        if (empty($data['utilisateur_id']) || empty($data['type_id']) || empty($data['poids_actuel'])) {
            Flight::json(['error' => 'Champs obligatoires manquants'], 400);
            return;
        }

        Flight::AnimalModel()->updateAnimal(
            $id,
            $data['utilisateur_id'],
            $data['type_id'],
            $data['poids_actuel'],
            $data['poids_min_vente'],
            $data['poids_max'],
            $data['prix_vente_kg'],
            $data['jours_sans_manger'],
            $data['perte_poids_par_jour']
        );

        Flight::redirect("/animals");
    }

    public function deleteAnimal($id)
    {
        Flight::AnimalModel()->deleteAnimal($id);
        Flight::json(['status' => 'Animal supprimé avec succès']);
        Flight::redirect("/animals");
    }

    public function calculerGainPoids($id)
    {
        $date = Flight::request()->data->date; // Date donnée en POST
        if (!$date) {
            Flight::json(['error' => 'Date manquante'], 400);
            return;
        }

        $gainPoids = Flight::AnimalModel()->calculerGainPoidsAnimal($id, $date);
        Flight::json(['gain_poids' => $gainPoids]);
    }
}
