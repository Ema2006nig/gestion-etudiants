<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;

// Confirmation JS déjà faite côté client, on supprime directement
$stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
exit;
?>