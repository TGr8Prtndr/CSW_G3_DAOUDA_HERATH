<?php
// Database connection parameters
$host = 'localhost'; 
$username = 'root'; 
$password = 'root'; 
$database = 'csw-g3'; 

// Creating connection
$conn = new mysqli($host, $username, $password, $database);

// Checking the connection
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Set the character set to UTF-8 to handle accented characters (if not the accented letters won't appear)
if (!$conn->set_charset("utf8mb4")) {
    die("Erreur de configuration UTF-8 : " . $conn->error);
}

?>
