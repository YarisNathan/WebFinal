<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Alimentations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4">
    <h2>Liste des Alimentations</h2>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom de l'alimentation</th>
            <th>Type d'animal</th>
            <th>Quantité disponible (kg)</th>
            <th>% de gain de poids</th>
            <th>Prix par kg</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($alimentations as $row): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['id_alimentation']); ?></td>
              <td><?php echo htmlspecialchars($row['nom_alimentation']); ?></td>
              <td><?php echo htmlspecialchars($row['nom_type']); ?></td>
              <td><?php echo htmlspecialchars($row['quantite_stock']); ?></td>
              <td><?php echo htmlspecialchars($row['pourcentage_gain']); ?>%</td>
              <td><?php echo htmlspecialchars($row['prix_kg']); ?> €</td>
              <td>
                <a href="update-qtt-alimentation.php?id=<?php echo $row['id_alimentation']; ?>"
                  class="btn btn-primary btn-sm">Modifier quantité</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>