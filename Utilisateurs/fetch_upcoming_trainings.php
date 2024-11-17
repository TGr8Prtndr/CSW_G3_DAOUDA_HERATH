<?php
include 'db_connect.php';

$sql = "SELECT idEntrainment, titre, date_entrainement, heure_debut, 
               nombre_max_participants - nombre_participants_actuel AS places_disponibles 
        FROM entrainements 
        WHERE date_entrainement >= CURDATE()";
$result = $conn->query($sql);

$trainings = [];
while ($row = $result->fetch_assoc()) {
    $trainings[] = $row;
}

$conn->close();

// Return data as JSON (useful for AJAX or API)
header('Content-Type: application/json');
echo json_encode($trainings);
?>
