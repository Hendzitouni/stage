<?php
require_once 'connexion.php';

$message = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Préparation et exécution de la requête
    $sql = "INSERT INTO Enseignant (Matricule, nom_Ens, prenom_Ens) VALUES (:matricule, :nom, :prenom)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':matricule' => $matricule,
        ':nom' => $nom,
        ':prenom' => $prenom
    ]);

    $message = "✅ Enseignant ajouté avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un enseignant</title>
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

        .message {
            text-align: center;
            margin-bottom: 20px;
            color: green;
            font-weight: bold;
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
            padding: 10px;
            margin-top: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a class="btn-retour" href="dashboard.php">⬅ Retour au tableau de bord</a>
</div>

<div class="container">
    <h2>Ajouter un enseignant</h2>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Matricule :</label>
        <input type="number" name="matricule" required>

        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Prénom :</label>
        <input type="text" name="prenom" required>

        <input type="submit" value="Ajouter">
    </form>
</div>

</body>
</html>
