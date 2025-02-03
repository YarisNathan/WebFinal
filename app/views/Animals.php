<?php  ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php ?>
        <?php ?>

        <div class="content-wrapper">

            <section class="content-header">
                <h1>
                    Liste des Animaux
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
                    <li>Animaux</li>
                    <li class="active">Liste des Animaux</li>
                </ol>
            </section>

            <section class="content">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Erreur!</h4>
                        " . $_SESSION['error'] . "
                    </div>
                    ";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Succès!</h4>
                        " . $_SESSION['success'] . "
                    </div>
                    ";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box" style="height: 60vh;">
                            <div class="box-header with-border">
                                <a href="<?php echo Flight::get('flight.base_url') ?>/Animals/ajouterForm" class="btn btn-primary btn-sm btn-flat">
                                    <i class="fa fa-plus"></i> Ajouter un Animal
                                </a>
                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <th>ID</th>
                                        <th>Éleveur</th>
                                        <th>Type</th>
                                        <th>Poids Actuel (kg)</th>
                                        <th>Poids Min Vente (kg)</th>
                                        <th>Poids Max (kg)</th>
                                        <th>Prix Vente / kg (€)</th>
                                        <th>Jours Sans Manger</th>
                                        <th>Perte Poids / Jour (kg)</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($Animals as $Animal): ?>
                                            <tr>
                                                <td><?= $Animal['id'] ?></td>
                                                <td><?= $Animal['eleveur_nom'] ?></td>
                                                <td><?= $Animal['type_nom'] ?></td>
                                                <td><?= $Animal['poids_actuel'] ?> kg</td>
                                                <td><?= $Animal['poids_min_vente'] ?> kg</td>
                                                <td><?= $Animal['poids_max'] ?> kg</td>
                                                <td><?= $Animal['prix_vente_kg'] ?> €</td>
                                                <td><?= $Animal['jours_sans_manger'] ?> jours</td>
                                                <td><?= $Animal['perte_poids_par_jour'] ?> kg</td>
                                                <td>
                                                    <a href="Animals/edit/<?= $Animal['id'] ?>">
                                                        <button class="btn btn-success btn-sm edit btn-flat">
                                                            <i class="fa fa-edit"></i> Modifier
                                                        </button>
                                                    </a>
                                                    <a href="Animals/delete/<?= $Animal['id'] ?>">
                                                        <button class="btn btn-danger btn-sm delete btn-flat">
                                                            <i class="fa fa-trash"></i> Supprimer
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php ?>

    </div>
    <?php ?>

</body>

</html>
