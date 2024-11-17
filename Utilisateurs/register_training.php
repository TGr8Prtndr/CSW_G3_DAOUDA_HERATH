<?php
/**
 * Code for the page to register for a training for a user
 * @author HERATH Sanduni
 */

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

$titre = "S'inscrire aux entraînements";
include 'header.php';
?>

<main class="flex-grow-1 container py-4">

    <!-- Display session message if available -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['message_type']); // Clear the message ?>
    <?php endif; ?>

    <h2 class="mb-4">S'inscrire aux entraînements</h2>
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
                <th>Action</th>
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
                         IFNULL(COUNT(inscriptions.id_inscription), 0)) AS places_disponibles 
                    FROM entrainements 
                    LEFT JOIN inscriptions 
                        ON entrainements.idEntrainment = inscriptions.idEntrainement 
                    -- Query to display only future trainings  
                    WHERE TIMESTAMP(entrainements.date_entrainement, entrainements.heure_debut) > NOW()  
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

                // Places disponibles
                $places_disponibles = $row['places_disponibles'];
                echo "<td>";
                if ($places_disponibles > 0) {
                    echo htmlspecialchars($places_disponibles, ENT_QUOTES, 'UTF-8');
                } else {
                    echo "Complet"; // Display "Complet" if no places are available
                }
                echo "</td>";

                // Action Button
                echo "<td>";
                if ($places_disponibles > 0) {
                    echo "<form method='post' action='register_action.php'>";
                    echo "<input type='hidden' name='idEntrainment' value='" . htmlspecialchars($row['idEntrainment'], ENT_QUOTES, 'UTF-8') . "'>";
                    echo "<button type='submit' class='btn btn-primary'>S'inscrire</button>";
                    echo "</form>";
                } else {
                    echo "<button class='btn btn-secondary' disabled>Complet</button>"; // Disabled button for full trainings
                }
                echo "</td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<?php include 'footer.php'; ?>
