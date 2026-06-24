<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$name = trim($_POST["name"] ?? "");
$wattage = intval($_POST["wattage"] ?? 0);

if ($name === "" || $wattage <= 0 || $wattage > 3000) {
    die("Ongeldige invoer. Controleer naam en wattage.");
}

$stmt = $pdo->prepare("INSERT INTO scores (name, wattage) VALUES (:name, :wattage)");
$stmt->execute([
    ":name" => $name,
    ":wattage" => $wattage
]);

header("Location: index.php?success=1");
exit;
?>