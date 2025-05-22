<?php
require_once 'connexion.php';

if (isset($_GET['NCE'])) {
    $nce = $_GET['NCE'];
    $stmt = $conn->prepare("DELETE FROM Etudiant WHERE NCE = :nce");
    $stmt->execute([':nce' => $nce]);
    echo "Étudiant supprimé.";
}
 header("Location: liste_etudiants.php");
        exit();
/**<a href="liste_etudiants.php">Retour à la liste</a> */
?>
