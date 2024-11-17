<?php
/**
 * Code for handling the information retrieval for database in view training.
 * @author HERATH Sanduni
 */

session_start();
include 'db_connect.php';

$idUser = $_SESSION['user_id']; // User ID from session

$sql = "SELECT e.titre, e.date_entrainement, e.heure_debut, e.lieu, e.description_entrainement 
        FROM entrainements e 
        JOIN inscriptions i ON e.idEntrainment = i.idEntrainement 
        WHERE i.idUser = ? AND e.date_entrainement < CURDATE()";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idUser);
$stmt->execute();
$result = $stmt->get_result();

$trainings = [];
while ($row = $result->fetch_assoc()) {
    $trainings[] = $row;
}

$stmt->close();
$conn->close();

// Return data as JSON (useful for AJAX or API)
header('Content-Type: application/json');
echo json_encode($trainings);
?>
