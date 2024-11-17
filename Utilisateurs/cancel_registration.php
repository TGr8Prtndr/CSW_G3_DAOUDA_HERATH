<?php
/**
 * Code for cancelling a training page
 * @author HERATH Sanduni
 */

session_start(); // Start the session

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

$titre = "Annuler l'inscription";
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

    <h2 class="mb-4">Annuler l'inscription</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Titre</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_connect.php';
            $idUser = $_SESSION['user_id']; // Assume user_id is stored in the session after login

            // Query to get upcoming trainings the user is registered for
            $sql = "SELECT e.idEntrainment, e.titre, e.date_entrainement, e.heure_debut 
                    FROM entrainements e 
                    JOIN inscriptions i ON e.idEntrainment = i.idEntrainement 
                    WHERE i.idUser = ? AND TIMESTAMP(e.date_entrainement, e.heure_fin) > NOW()"; //Query to make a training disappear after the finishing time of a training 
            $stmt = $conn->prepare($sql);
            
            if (!$stmt) {
                die("Erreur de préparation de la requête : " . $conn->error);
            }

            $stmt->bind_param("i", $idUser);
            $stmt->execute();
            $result = $stmt->get_result();

            // Display each training with a cancel button
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['titre'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['date_entrainement'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($row['heure_debut'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>";
                echo "<form method='post' action='cancel_action.php'>";
                echo "<input type='hidden' name='idEntrainment' value='" . htmlspecialchars($row['idEntrainment'], ENT_QUOTES, 'UTF-8') . "'>";
                
                // Avoiding the user to delete a training before 60 minutes from the starting time.
                $currentTime = new DateTime(); // Current time
                $trainingTime = new DateTime($row['date_entrainement'] . ' ' . $row['heure_debut']); // Training start time

                $timeDifferenceInSeconds = $trainingTime->getTimestamp() - $currentTime->getTimestamp(); 

                if ($currentTime < $trainingTime && $timeDifferenceInSeconds > 3600) {
                    // More than 1 hour (3600 seconds) before the training start
                    echo "<button type='submit' class='btn btn-danger'>Annuler</button>";
                } else {
                    // Within 1 hour or after the training start
                    echo "<button class='btn btn-secondary' disabled>Non annulable</button>";
                }

                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

            $stmt->close();
            ?>
        </tbody>
    </table>
</main>

<?php include 'footer.php'; ?>
