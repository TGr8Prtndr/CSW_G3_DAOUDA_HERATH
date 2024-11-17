<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEntrainment = intval($_POST['idEntrainment']); // Ensure this matches the form input name
    $userId = $_SESSION['user_id'];

    // Prepare the delete query
    $sql = "DELETE FROM inscriptions WHERE idEntrainement = ? AND idUser = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // Handle query preparation errors
        $_SESSION['message'] = "Erreur lors de l'annulation. Veuillez réessayer.";
        $_SESSION['message_type'] = "danger"; // Error message type
        header("Location: cancel_registration.php");
        exit;
    }

    // Bind the parameters
    $stmt->bind_param("ii", $idEntrainment, $userId);

    // Execute the statement
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $_SESSION['message'] = "Votre inscription a été annulée avec succès.";
        $_SESSION['message_type'] = "success"; // Success message type
    } else {
        $_SESSION['message'] = "Aucune inscription trouvée ou déjà annulée.";
        $_SESSION['message_type'] = "warning"; // Warning message type
    }

    $stmt->close();

    // Redirect back to the cancellation page
    header("Location: cancel_registration.php");
    exit;
}
