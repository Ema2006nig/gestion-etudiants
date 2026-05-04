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
    <!-- Icônes Font Awesome pour le look moderne -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <!-- En-tête décoratif -->
        <div class="header-banner">
            <h1><i class="fa-solid fa-graduation-cap"></i> Gestion des étudiants</h1>
        </div>

        <!-- Carte pour le formulaire d'ajout -->
        <div class="form-card">
            <h2><i class="fa-solid fa-user-plus"></i> Ajouter un étudiant</h2>
            <form id="addForm" action="traitement.php" method="POST">
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="text" name="prenom" placeholder="Prénom" required>
                <select name="filiere_id">
                    <option value="">-- Choisir une filière --</option>
                    <?php foreach ($filieres as $filiere): ?>
                        <option value="<?= $filiere['id'] ?>"><?= htmlspecialchars($filiere['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit"><i class="fa-solid fa-check"></i> Ajouter</button>
            </form>
        </div>

        <!-- Section liste -->
        <div class="liste-etudiants">
            <h2><i class="fa-solid fa-list"></i> Liste des étudiants</h2>
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
                            <a href="update.php?id=<?= $etudiant['id'] ?>" class="action-link edit-link">
                                <i class="fa-solid fa-pen-to-square"></i> Modifier
                            </a>
                            <a href="delete.php?id=<?= $etudiant['id'] ?>" class="delete-link action-link">
                                <i class="fa-solid fa-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>