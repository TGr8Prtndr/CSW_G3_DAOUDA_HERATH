<?php
/**
 * Code d'affichage du tableau des entrainements
 * @author : Ilyas DAOUDA
 */
?>

<?php

// Pour récupérer la tableau
require_once('tt_entrainement.php');
?>

    <?php if (isset($resultats) && count($resultats) > 0): ?>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th class="col-1">Sélectionner</th>
                    <th class="col-1">ID</th>
                    <th class="col-4">Titre</th>
                    <th class="col-3">Catégorie</th>
                    <th class="col-3">Date de l'entrainement</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats as $row): ?>
                    <tr>
                        <td><input type="checkbox" name="annuler[]" value="<?php echo $row['idEntrainement']; ?>"></td>
                        <td><?php echo htmlspecialchars($row['idEntrainement']); ?></td>
                        <td><?php echo htmlspecialchars($row['titre']); ?></td>
                        <td><?php echo htmlspecialchars($row['categorie']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_entrainement']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun enregistrement trouvé.</p>
    <?php endif; ?>

