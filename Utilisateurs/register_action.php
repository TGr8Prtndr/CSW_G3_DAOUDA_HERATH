<?php
/**
 * Code for handling database and messages for registering for a training.
 * @author HERATH Sanduni
 */

session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEntrainment = intval($_POST['idEntrainment']);
    $userId = $_SESSION['user_id'];

    // Check if the user is already subscribed
    $sqlCheck = "SELECT COUNT(*) AS count FROM inscriptions WHERE idEntrainement = ? AND idUser = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("ii", $idEntrainment, $userId);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result()->fetch_assoc();
    $stmtCheck->close();

    if ($resultCheck['count'] > 0) {
        // User already subscribed
        $_SESSION['message'] = "Vous êtes déjà inscrit à cet entraînement.";
        $_SESSION['message_type'] = "warning"; // To style the message
    } else {
        // Proceed with subscription
        $sqlInsert = "INSERT INTO inscriptions (idEntrainement, idUser) VALUES (?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("ii", $idEntrainment, $userId);

        if ($stmtInsert->execute()) {
            $_SESSION['message'] = "Inscription réussie à l'entraînement.";
            $_SESSION['message_type'] = "success"; // To style the message
        } else {
            $_SESSION['message'] = "Erreur lors de l'inscription. Veuillez réessayer.";
            $_SESSION['message_type'] = "danger"; // To style the message
        }
        $stmtInsert->close();
    }

    // Redirect back to the registration page
    header("Location: register_training.php");
    exit;
}
?>
