<?php
require_once "config.php";

header("Content-Type: application/json; charset=utf-8");

$stmt = $pdo->query("
    SELECT id, name, wattage, created_at
    FROM scores
    ORDER BY wattage DESC, created_at ASC
    LIMIT 5
");

$scores = $stmt->fetchAll();

echo json_encode($scores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>