<?php
require_once 'connexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $mdp = $_POST['mot_de_passe'];

    $stmt = $conn->prepare("SELECT * FROM Administrateur WHERE login = :login AND mot_de_passe = :mdp");
    $stmt->execute([':login' => $login, ':mdp' => $mdp]); // En pratique, on utiliserait password_hash
    $admin = $stmt->fetch();

    if ($admin) {
        $_SESSION['admin'] = $admin['id_admin'];
        header("Location: dashboard.php");
        exit();
        /*echo "Bienvenue, $login <br><a href='logout.php'>Se déconnecter</a>";*/
    } else {
        echo "Échec de la connexion.";
    }
}
?>
