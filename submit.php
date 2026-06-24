<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$allowedCompetitions = ["men", "women", "kids"];

$name = trim($_POST["name"] ?? "");
$competition = $_POST["competition"] ?? "men";
$wattage = intval($_POST["wattage"] ?? 0);

if (!in_array($competition, $allowedCompetitions, true)) {
    die("Ongeldige competitie. Kies mannen, vrouwen of kinderen.");
}

if ($name === "" || $wattage <= 0 || $wattage > 3000) {
    die("Ongeldige invoer. Controleer naam en wattage.");
}

$stmt = $pdo->prepare("
    INSERT INTO scores (name, competition, wattage)
    VALUES (:name, :competition, :wattage)
");

$stmt->execute([
    ":name" => $name,
    ":competition" => $competition,
    ":wattage" => $wattage
]);

header("Location: index.php?success=1");
exit;
?>
