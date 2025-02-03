<?php
require_once '../models/AlimentationModel.php';
require_once '../config/database.php';

class AlimentationController
{
  private $model;

  public function __construct()
  {
    global $pdo;
    $this->model = new AlimentationModel($pdo);
  }

  public function listAlimentations()
  {
    $alimentations = $this->model->getAllAlimentations();
    require '../views/liste-alimentation-users.php';
  }

  public function showUpdateForm($id)
  {
    if (!isset($id) || !is_numeric($id)) {
      $error_message = "ID d'alimentation invalide.";
      require '../views/update-qtt-alimentation.php';
      return;
    }

    try {
      $alimentation = $this->model->getAlimentationById($id);

      if (!$alimentation) {
        $error_message = "Alimentation non trouvée.";
        require '../views/update-qtt-alimentation.php';
        return;
      }

      require '../views/update-qtt-alimentation.php';
    } catch (PDOException $e) {
      $error_message = "Erreur: " . $e->getMessage();
      require '../views/update-qtt-alimentation.php';
    }
  }

  public function updateQuantite()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id_alimentation'] ?? null;
      $quantite = $_POST['quantite'] ?? null;

      if (!$id || !is_numeric($id) || !is_numeric($quantite)) {
        echo json_encode(['success' => false, 'message' => 'Données invalides']);
        exit;
      }

      try {
        $success = $this->model->updateQuantite($id, $quantite);
        echo json_encode([
          'success' => $success,
          'message' => $success ? 'Quantité mise à jour avec succès' : 'Erreur lors de la mise à jour'
        ]);
      } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur de base de données: ' . $e->getMessage()]);
      }
      exit;
    }
  }
}
