<?php
require_once 'dbconfig.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur PDO sur exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "<script>alert('Connexion réussie');</script>";
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>