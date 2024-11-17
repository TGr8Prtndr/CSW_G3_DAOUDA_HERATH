<?php
/**
 * Code d'affichage du tableau des utilisateurs
 * @author : Ilyas DAOUDA
 */
?>

<?php

// Pour récupérer la tableau
require_once('tt_utilisateurs.php');
?>

    <?php if (isset($resultats) && count($resultats) > 0): ?>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th class="col-1">Sélectionner</th>
                    <th class="col-1">ID</th>
                    <th class="col-2">Nom</th>
                    <th class="col-2">Prénom</th>
                    <th class="col-3">Adresse mail</th>
                    <th class="col-3">Veut devenir membre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats as $row): ?>
                    <tr>
                        <td><input type="checkbox" name="promouvoir[]" value="<?php echo $row['idUser']; ?>"></td>
                        <td><?php echo htmlspecialchars($row['idUser']); ?></td>
                        <td><?php echo htmlspecialchars($row['nom_user']); ?></td>
                        <td><?php echo htmlspecialchars($row['prenom_user']); ?></td>
                        <td><?php echo htmlspecialchars($row['emailUser']); ?></td>
                        <td><?php echo htmlspecialchars($row['veut_devenir_membre']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun enregistrement trouvé.</p>
    <?php endif; ?>

