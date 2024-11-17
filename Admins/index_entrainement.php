<?php
/**
 * Code d'affichage d'un tableau réduit des entrainements sur la page d'accueil admin
 * @author : Ilyas DAOUDA
 */
?>

<?php

// Pour récupérer la tableau
include('tt_index_entrainement.php');
?>

    <?php if (isset($resultats) && count($resultats) > 0): ?>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th class="col-3">Titre</th>
                    <th class="col-8">Description</th>
                    <th class="col-1">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['titre']); ?></td>
                        <td><?php echo htmlspecialchars($row['description_entrainement']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_entrainement']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun enregistrement trouvé.</p>
    <?php endif; ?>

