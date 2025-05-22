<?php
require_once 'connexion.php';

$message = "";

if (isset($_GET['NCE'])) {
    $nce = $_GET['NCE'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $classe = $_POST['classe'];

        $stmt = $conn->prepare("UPDATE Etudiant SET nom = :nom, prenom = :prenom, classe = :classe WHERE NCE = :nce");
        $stmt->execute([':nom' => $nom, ':prenom' => $prenom, ':classe' => $classe, ':nce' => $nce]);

        $message = "✅ Étudiant modifié avec succès.";
    }

    $stmt = $conn->prepare("SELECT * FROM Etudiant WHERE NCE = :nce");
    $stmt->execute([':nce' => $nce]);
    $e = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un étudiant</title>
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
            width: 400px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"], input[type="submit"] {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
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
            text-align: center;
            margin-bottom: 20px;
            color: green;
        }

        .back-link {
            text-align: center;
            margin-top: 10px;
        }

        .back-link a {
            color: #007BFF;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a class="btn-retour" href="dashboard.php">⬅ Retour au tableau de bord</a>
</div>

<div class="container">
    <h2>Modifier l'étudiant</h2>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= $e['nom'] ?>" required>

        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= $e['prenom'] ?>" required>

        <label>Classe :</label>
        <input type="text" name="classe" value="<?= $e['classe'] ?>" required>

        <input type="submit" value="Modifier">
    </form>

    <div class="back-link">
        <a href="liste_etudiants.php">↩ Retour à la liste des étudiants</a>
    </div>
</div>

</body>
</html>
