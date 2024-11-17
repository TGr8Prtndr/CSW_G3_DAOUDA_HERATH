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

$titre = "Historique des entraînements";
include 'header.php';
?>

<main class="flex-grow-1 container py-4">
    <h2 class="mb-4">Historique des entraînements</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Date</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Lieu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_connect.php';

            $userId = $_SESSION['user_id']; // Assume user_id is stored in the session after login

            // Query to fetch past trainings
            $sql = "SELECT e.titre, e.description_entrainement, e.categorie, e.date_entrainement, 
                           e.heure_debut, e.heure_fin, e.lieu
                    FROM entrainements e
                    JOIN inscriptions i ON e.idEntrainment = i.idEntrainement
                    WHERE i.idUser = ? AND CONCAT(e.date_entrainement, ' ', e.heure_fin) < NOW()
                    ORDER BY e.date_entrainement DESC";
            $stmt = $conn->prepare($sql);
            
            if (!$stmt) {
                die("Erreur de préparation de la requête : " . $conn->error);
            }

            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            // Display each past training
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['titre'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['description_entrainement'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['categorie'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['date_entrainement'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['heure_debut'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['heure_fin'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['lieu'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "</tr>";
            }

            $stmt->close();
            ?>
        </tbody>
    </table>
</main>

<?php include 'footer.php'; ?>
