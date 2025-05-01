<?php
require_once 'connexion.php';
$message = '';
$messageType = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nce = $_POST['nce'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $classe = $_POST['classe'];
    if (empty($nce) || empty($nom) || empty($prenom) || empty($classe)) {
        $message = 'Tous les champs sont obligatoires';
        $messageType = 'error';
    } else {
        try {
            $checkSql = "SELECT NCE FROM Etudiant WHERE NCE = :nce";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bindParam(':nce', $nce);
            $checkStmt->execute();
            
            if ($checkStmt->fetch()) {
                $message = 'Un étudiant avec ce NCE existe déjà';
                $messageType = 'error';
            } else {

                $sql = "INSERT INTO Etudiant (NCE, nom, prenom, classe) VALUES (:nce, :nom, :prenom, :classe)";
                $stmt = $conn->prepare($sql);
        
                $stmt->bindParam(':nce', $nce);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':classe', $classe);
        
                if ($stmt->execute()) {
                    $message = 'Étudiant ajouté avec succès!';
                    $messageType = 'success';
            
                    // Réinitialisation des valeurs pour un nouvel ajout
                    $_POST = array();
                } else {
                    $message = 'Erreur lors de l\'ajout de l\'étudiant';
                    $messageType = 'error';
                }
            }
        
            //   echo "<script>alert('Étudiant ajouté avec succès!');</script>";
        } catch(PDOException $e) {
            //echo "<script>alert('Erreur : " . addslashes($e->getMessage()) . "');</script>";    }
            $message = 'Erreur technique: ' . htmlspecialchars($e->getMessage());
            $messageType = 'error';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un étudiant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ajouter un nouvel étudiant</h1>

    <form method="POST">
    <table border="0">
        <tr>
            <td><label for="nce">Numéro carte d'étudiant(NCE):</label> </td>
            <td>        <input type="number" id="nce" name="nce" required><br><br>            </td>
        </tr>
        <tr>
            <td><label for="nom">Nom:</label></td>
            <td><input type="text" id="nom" name="nom" required><br><br></td>
        </tr>
        <tr>  
            <td><label for="prenom">Prénom:</label></td>
            <td><input type="text" id="prenom" name="prenom" required><br><br></td>
        </tr>
        <tr>  
            <td><label for="classe">Classe:</label></td>
            <td><input type="text" id="classe" name="classe" required><br><br>
            </td>
        </tr>
        <tr>  
            <td><input type="submit" value="Ajouter"></td>
        </tr>
    </table>
    </form>       
        
    <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
    <?php endif; ?>
        
        
        
        
        
        
        
   
</body>
</html>