<?php
/**
 * Code d'affichage d'un tableau réduit des inscrits sur la page d'accueil admin
 * @author : Ilyas DAOUDA
 */
?>

<?php

// Pour récupérer la tableau
include('tt_index_inscrits.php');
?>

    <?php if (isset($resultats) && count($resultats) > 0): ?>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th class="col-1">Titre</th>
                    <th class="col-3">Description</th>
                    <th class="col-3">Date</th>
                    <th class="col-5">Inscrits</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['titre'] ?></td>
                        <td><?= $row['description_entrainement'] ?></td>
                        <td><?= $row['date_entrainement'] ?></td>
                        <td>
                            <?php if (!empty($row['inscrits'])): ?>
                                <?= implode('<br>', array_map('htmlspecialchars', $row['inscrits'])) ?>
                            <?php else: ?>
                                Aucun inscrit
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun enregistrement trouvé.</p>
    <?php endif; ?>

