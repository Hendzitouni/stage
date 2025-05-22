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
        $message = '❌ Tous les champs sont obligatoires';
        $messageType = 'error';
    } else {
        try {
            $checkSql = "SELECT NCE FROM Etudiant WHERE NCE = :nce";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bindParam(':nce', $nce);
            $checkStmt->execute();

            if ($checkStmt->fetch()) {
                $message = '⚠️ Un étudiant avec ce NCE existe déjà';
                $messageType = 'error';
            } else {
                $sql = "INSERT INTO Etudiant (NCE, nom, prenom, classe) VALUES (:nce, :nom, :prenom, :classe)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nce', $nce);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':classe', $classe);

                if ($stmt->execute()) {
                    $message = '✅ Étudiant ajouté avec succès !';
                    $messageType = 'success';
                    $_POST = array(); // réinitialiser le formulaire
                } else {
                    $message = '❌ Erreur lors de l\'ajout de l\'étudiant';
                    $messageType = 'error';
                }
            }
        } catch (PDOException $e) {
            $message = 'Erreur technique : ' . htmlspecialchars($e->getMessage());
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            padding: 40px;
        }

        .top-bar {
            width: 90%;
            margin: 0 auto 20px auto;
            display: flex;
            justify-content: flex-start;
        }

        .btn-retour {
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .container {
            width: 450px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            padding: 12px 15px;            
            font-size: 16px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
       

        input[type="submit"] {
            margin-top: 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a class="btn-retour" href="dashboard.php">⬅ Retour au tableau de bord</a>
</div>

<div class="container">
    <h1>Ajouter un nouvel étudiant</h1>

    <?php if (!empty($message)): ?>
        <div class="message <?= $messageType ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label for="nce">Numéro carte étudiant (NCE) :</label>
        <input type="number" id="nce" name="nce" value="<?= $_POST['nce'] ?? '' ?>" required>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= $_POST['nom'] ?? '' ?>" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= $_POST['prenom'] ?? '' ?>" required>

        <label for="classe">Classe :</label>
        <input type="text" id="classe" name="classe" value="<?= $_POST['classe'] ?? '' ?>" required>

        <input type="submit" value="Ajouter">
    </form>
</div>

</body>
</html>
