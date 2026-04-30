<?php
require_once 'config.php';

// Récupérer toutes les filières pour le select
$stmtFilieres = $pdo->query("SELECT * FROM filieres");
$filieres = $stmtFilieres->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les étudiants avec leur filière (jointure)
$stmtEtudiants = $pdo->query("
    SELECT e.id, e.nom, e.prenom, f.nom as filiere_nom 
    FROM etudiants e 
    LEFT JOIN filieres f ON e.filiere_id = f.id
");
$etudiants = $stmtEtudiants->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un étudiant</h1>
        <form id="addForm" action="traitement.php" method="POST">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <select name="filiere_id">
                <option value="">-- Choisir une filière --</option>
                <?php foreach ($filieres as $filiere): ?>
                    <option value="<?= $filiere['id'] ?>"><?= htmlspecialchars($filiere['nom']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Ajouter</button>
        </form>

        <h2>Liste des étudiants</h2>
        <table>
            <thead>
                <tr><th>Nom</th><th>Prénom</th><th>Filière</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                    <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                    <td><?= htmlspecialchars($etudiant['filiere_nom'] ?: 'Aucune') ?></td>
                    <td>
                        <a href="update.php?id=<?= $etudiant['id'] ?>">Modifier</a>
                        <a href="delete.php?id=<?= $etudiant['id'] ?>" class="delete-link">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>