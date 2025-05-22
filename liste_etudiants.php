<?php
require_once 'connexion.php';
$etudiants = $conn->query("SELECT * FROM Etudiant")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
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

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: white;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .actions a {
            text-decoration: none;
            color: white;
            background-color: #28a745;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 0 5px;
        }

        .actions a.delete {
            background-color: #dc3545;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <a class="btn-retour" href="dashboard.php">⬅ Retour au tableau de bord</a>
</div>

<h2>Liste des étudiants</h2>

<table>
    <tr>
        <th>NCE</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Classe</th>
        <th>Action</th>
    </tr>
    <?php foreach ($etudiants as $e): ?>
    <tr>
        <td><?= $e['NCE'] ?></td>
        <td><?= $e['nom'] ?></td>
        <td><?= $e['prenom'] ?></td>
        <td><?= $e['classe'] ?></td>
        <td class="actions">
            <a class="delete" href="supprimer_etudiant.php?NCE=<?= $e['NCE'] ?>">Supprimer</a>
            <a href="modifier_etudiant.php?NCE=<?= $e['NCE'] ?>">Modifier</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
