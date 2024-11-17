<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre; ?></title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Include custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Association Running</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($titre == 'Voir les entraînements') ? 'active' : ''; ?>" href="view_trainings.php">Voir les entraînements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($titre == "S'inscrire aux entraînements") ? 'active' : ''; ?>" href="register_training.php">S'inscrire aux entraînements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($titre == "Annuler l'inscription") ? 'active' : ''; ?>" href="cancel_registration.php">Annuler l'inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($titre == 'Historique des entraînements') ? 'active' : ''; ?>" href="training_history.php">Historique des entraînements</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="logout.php">Se déconnecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Spacer for the fixed navbar -->
    <div class="mt-5"></div>
