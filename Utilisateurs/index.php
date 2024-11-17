<?php

/**
 * Code for the welcome page for the users in the Running association
 * @author HERATH Sanduni
 */

session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Set the page title
$titre = "Accueil";
include 'header.php'; // Includes the navigation bar
?>

<!-- Main Content -->
<main class="flex-grow-1 container py-4">
    <div class="row">
        <!-- Welcome Section -->
        <section class="col-12 text-center">
            <h1 class="mb-4">Bienvenue à l'Association Running</h1>
            <p class="lead">
                Explorez nos entraînements, inscrivez-vous, et restez en forme avec notre communauté.
            </p>
        </section>

        <!-- Quick Links Section -->
        <section class="col-12 mt-4">
            <h2 class="mb-4 text-center">Options Rapides</h2>
            <div class="row">
                <div class="col-md-3 text-center">
                    <a href="view_trainings.php" class="btn btn-primary btn-lg w-100 mb-3">Voir les entraînements</a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="register_training.php" class="btn btn-success btn-lg w-100 mb-3">S'inscrire</a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="cancel_registration.php" class="btn btn-danger btn-lg w-100 mb-3">Annuler l'inscription</a>
                </div>
                <div class="col-md-3 text-center">
                    <a href="training_history.php" class="btn btn-info btn-lg w-100 mb-3">Historique</a>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; // Includes the footer ?>
