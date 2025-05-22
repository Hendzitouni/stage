<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Administrateur</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            text-align: center;
            margin-top: 50px;
        }
        h1 {
            color: #444;
        }
        .menu {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }
        .menu a {
            display: block;
            width: 200px;
            padding: 15px;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            border-radius: 10px;
            transition: 0.3s;
        }
        .menu a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Bienvenue dans l'espace admin</h1>
    <p>Choisissez une action :</p>

    <div class="menu">
        <a href="liste_etudiants.php">📋 Liste des étudiants</a>
        <a href="ajouter_etudiant.php">➕ Ajouter un étudiant</a>
        <a href="ajouter_enseignant.php">➕ Ajouter un enseignant</a>
        <a href="ajouter_soutenance.php">➕ Ajouter une soutenance</a>
        <a href="rechercher.php">🔍 Rechercher une soutenance</a>
        <a href="logout.php">🚪 Déconnexion</a>
    </div>

</body>
</html>
