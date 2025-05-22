<?php
require_once 'connexion.php';

$enseignants = $conn->query("SELECT * FROM Enseignant")->fetchAll();
$soutenances = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricule = $_POST['matricule'];
    $sql = "SELECT * FROM Soutenance WHERE date_soutenance = '2024-12-15' AND Matricule = :matricule";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':matricule' => $matricule]);
    $soutenances = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rechercher les soutenances</title>
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

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        select, input[type="submit"] {
            padding: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        ul {
            margin-top: 20px;
            list-style: none;
            padding-left: 0;
        }

        li {
            background-color: #e9ecef;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .no-results {
            color: #dc3545;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a class="btn-retour" href="dashboard.php">⬅ Retour au tableau de bord</a>
</div>

<div class="container">
    <h2>Rechercher les soutenances du 15/12/2024</h2>
    <form method="post">
        <label>Choisir un enseignant :</label>
        <select name="matricule" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($enseignants as $ens): ?>
                <option value="<?= $ens['Matricule'] ?>"><?= $ens['nom_Ens'] . ' ' . $ens['prenom_Ens'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Rechercher">
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <?php if (!empty($soutenances)): ?>
            <h3>Résultats :</h3>
            <ul>
                <?php foreach ($soutenances as $s): ?>
                    <li>Jury <?= $s['Numjury'] ?> — Note : <?= $s['note'] ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="no-results">❌ Aucune soutenance trouvée pour cet enseignant le 15/12/2024.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
