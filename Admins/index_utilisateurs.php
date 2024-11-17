<?php
/**
 * Code d'affichage d'un tableau réduit des utilisateurs sur la page d'accueil admin
 * @author : Ilyas DAOUDA
 */
?>

<?php

// Pour récupérer la tableau
require_once('tt_index_utilisateurs.php');
?>

    <?php if (isset($resultats) && count($resultats) > 0): ?>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th class="col-1">ID</th>
                    <th class="col-4">Nom</th>
                    <th class="col-3">Prénom</th>
                    <th class="col-4">Adresse mail</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['idUser']); ?></td>
                        <td><?php echo htmlspecialchars($row['nom_user']); ?></td>
                        <td><?php echo htmlspecialchars($row['prenom_user']); ?></td>
                        <td><?php echo htmlspecialchars($row['emailUser']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun enregistrement trouvé.</p>
    <?php endif; ?>

