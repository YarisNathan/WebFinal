<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier la quantité d'alimentation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4">
    <?php
    require_once '../config/database.php';

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      echo "<div class='alert alert-danger'>ID d'alimentation invalide.</div>";
      exit;
    }

    $id = $_GET['id'];
    try {
      $stmt = $pdo->prepare("SELECT a.*, t.nom_type 
                                 FROM alimentation a 
                                 JOIN type_animal t ON a.id_type_animal = t.id_type_animal 
                                 WHERE id_alimentation = ?");
      $stmt->execute([$id]);
      $alimentation = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$alimentation) {
        echo "<div class='alert alert-danger'>Alimentation non trouvée.</div>";
        exit;
      }
    } catch (PDOException $e) {
      echo "<div class='alert alert-danger'>Erreur: " . $e->getMessage() . "</div>";
      exit;
    }
    ?>

    <h2>Modifier la quantité d'alimentation</h2>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($alimentation['nom_alimentation']); ?></h5>
        <p class="card-text">Type d'animal: <?php echo htmlspecialchars($alimentation['nom_type']); ?></p>

        <form id="updateForm">
          <input type="hidden" name="id_alimentation" value="<?php echo htmlspecialchars($alimentation['id_alimentation']); ?>">

          <div class="mb-3">
            <label for="quantite" class="form-label">Quantité actuelle (kg)</label>
            <input type="number" class="form-control" id="quantite" name="quantite"
              value="<?php echo htmlspecialchars($alimentation['quantite_stock']); ?>"
              step="0.1" min="0" required>
          </div>

          <button type="submit" class="btn btn-primary">Mettre à jour</button>
          <a href="liste-alimentation-users.php" class="btn btn-secondary">Retour à la liste</a>
        </form>

        <div id="message" class="mt-3"></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/update-alimentation.js"></script>
</body>

</html>