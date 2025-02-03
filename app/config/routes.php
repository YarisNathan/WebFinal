<?php

use flight\Engine;
use flight\net\Router;
use app\controllers\AnimalController;

/** 
 * @var Router $router 
 * @var Engine $app
 */
Flight::before('route', function () {
    $protectedRoutes = ['/dashboard', '/gifts', '/admin'];
    $currentRoute = Flight::request()->url;

    if (in_array($currentRoute, $protectedRoutes) && !isset($_SESSION['user_id'])) {
        Flight::redirect('/login');
        exit;
    }

    if ($currentRoute == '/admin' && (!isset($_SESSION['user_role'][0]) || $_SESSION['user_role'][0] !== 'admin')) {
        Flight::redirect('/gifts');
        exit;
    }
});

$animalController = new AnimalController();
Flight::route('GET /Animals', [$animalController, 'animals']);
Flight::route('POST /Animals/ajouter', [$animalController, 'addAnimal']);
Flight::route('GET /Animals/ajouterForm', [$animalController, 'formulaireAddAnimal']);
Flight::route('GET /Animals/delete/@id', [$animalController, 'deleteAnimal']);
Flight::route('GET /Animals/edit/@id', [$animalController, 'formulaireModifyAnimal']);
Flight::route('POST /Animals/update/@id', [$animalController, 'updateAnimal']);

Flight::route('GET /EtatElevage', [$animalController, 'GainPoidsAnimale']);
Flight::route('POST /Animals/gainPoids/@id', [$animalController, 'calculerGainPoids']);
