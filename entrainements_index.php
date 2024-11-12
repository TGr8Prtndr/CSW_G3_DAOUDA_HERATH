<?php
header('Content-Type: text/html; charset=utf-8');

// Pour récupérer la tableau
require_once('tt_entrainements_index.php');
?>

<div class="row mt-5 bg-light" id="Section2">
    <div class="col-md-12 text-center">
      <h1 class="montserrat">Entraînements à venir</h1>
    </div>

    <?php if (isset($resultats) && count($resultats) > 0): ?>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultats as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['titre']); ?></td>
                        <td><?php echo htmlspecialchars($row['description_entrainement']); ?></td>
                        <td><?php echo htmlspecialchars($row['categorie']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun enregistrement trouvé.</p>
    <?php endif; ?>
</div>
