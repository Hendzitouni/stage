<?php
require_once 'connexion.php';

$message = "";

// Insertion si formulaire soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numjury = $_POST['numjury'];
    $date = $_POST['date'];
    $note = $_POST['note'];
    $nce = $_POST['nce'];
    $matricule = $_POST['matricule'];

    $sql = "INSERT INTO Soutenance (Numjury, date_soutenance, note, NCE, Matricule) 
            VALUES (:numjury, :date, :note, :nce, :matricule)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':numjury' => $numjury,
        ':date' => $date,
        ':note' => $note,
        ':nce' => $nce,
        ':matricule' => $matricule
    ]);

    $message = "✅ Soutenance ajoutée avec succès.";
}

// Récupérer étudiants et enseignants
$etudiants = $conn->query("SELECT NCE, nom, prenom FROM Etudiant")->fetchAll();
$enseignants = $conn->query("SELECT Matricule, nom_Ens, prenom_Ens FROM Enseignant")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une soutenance</title>
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
            width: 500px;
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
            margin-bottom: 15px;
            color: green;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, select {
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

        label {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a class="btn-retour" href="dashboard.php">⬅ Retour au tableau de bord</a>
</div>

<div class="container">
    <h2>Ajouter une soutenance</h2>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Numéro Jury :</label>
        <input type="number" name="numjury" required>

        <label>Date :</label>
        <input type="date" name="date" required>

        <label>Note :</label>
        <input type="number" name="note" step="0.1" required>

        <label>Étudiant :</label>
        <select name="nce" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($etudiants as $e): ?>
                <option value="<?= $e['NCE'] ?>"><?= $e['nom'] . ' ' . $e['prenom'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Enseignant :</label>
        <select name="matricule" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($enseignants as $ens): ?>
                <option value="<?= $ens['Matricule'] ?>"><?= $ens['nom_Ens'] . ' ' . $ens['prenom_Ens'] ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Ajouter">
    </form>
</div>

</body>
</html>
