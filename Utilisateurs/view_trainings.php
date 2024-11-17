<?php
session_start();

if (isset($_SESSION['timezone'])) {
    date_default_timezone_set($_SESSION['timezone']);
} else {
    date_default_timezone_set('UTC'); // Default fallback
}


// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$titre = "Voir les entraînements";
include 'header.php';
?>

<main class="flex-grow-1 container py-4">
    <h2 class="mb-4">Entraînements à venir</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Lieu</th>
                <th>Places disponibles</th>
                <th>Image du parcours</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_connect.php';

            // Query to calculate available places
            $sql = "SELECT 
                        entrainements.idEntrainment, 
                        entrainements.titre, 
                        entrainements.description_entrainement, 
                        entrainements.categorie, 
                        entrainements.date_entrainement, 
                        entrainements.heure_debut, 
                        entrainements.lieu, 
                        entrainements.nombre_max_participants, 
                        (entrainements.nombre_max_participants - 
                         IFNULL(COUNT(inscriptions.id_inscription), 0)) AS places_disponibles, 
                        photos.url_image 
                    FROM entrainements 
                    LEFT JOIN inscriptions 
                        ON entrainements.idEntrainment = inscriptions.idEntrainement 
                    LEFT JOIN photos 
                        ON entrainements.id_photo = photos.id_photo 
                    WHERE entrainements.date_entrainement >= CURDATE() 
                    GROUP BY entrainements.idEntrainment";

            $result = $conn->query($sql);

            if (!$result) {
                die("Erreur de requête : " . $conn->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['titre'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['description_entrainement'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['categorie'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['date_entrainement'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['heure_debut'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['lieu'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>";
                echo htmlspecialchars($row['places_disponibles'], ENT_QUOTES, 'UTF-8');
                echo "</td>";
                echo "<td>";
                if (!empty($row['url_image'])) {
                    echo "<img src='" . htmlspecialchars($row['url_image'], ENT_QUOTES, 'UTF-8') . "' alt='Image du parcours' style='width:100px;'>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<?php include 'footer.php'; ?>
