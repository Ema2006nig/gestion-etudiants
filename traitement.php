<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $filiere_id = !empty($_POST['filiere_id']) ? $_POST['filiere_id'] : null;

    $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $prenom, $filiere_id]);

    header('Location: index.php');
    exit;
}
?>