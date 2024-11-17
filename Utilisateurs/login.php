<?php
/**
 * Code for login page for the users
 * @author HERATH Sanduni
 */

session_start();
include 'db_connect.php'; // Ensure the database connection is included

// Process the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Query the database for the user
    $sql = "SELECT idUser, userPassword FROM utilisateurs WHERE emailUser = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($idUser, $hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Validate the password
    if ($idUser && password_verify($password, $hashedPassword)) {
        $_SESSION['user_id'] = $idUser; // Store user ID in session
        $_SESSION['login_time'] = time(); // Optional: Track login time
        header("Location: index.php"); // Redirect to homepage
        exit;
    } else {
        $error = "Adresse e-mail ou mot de passe incorrect.";
    }
}
?>

<?php include 'header_2.php'; // Include the header ?>

<div class="container mt-5">
    <h2 class="text-center">Connexion</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" action="login.php">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
</div>

<?php include 'footer_2.php'; // Include the footer ?>
