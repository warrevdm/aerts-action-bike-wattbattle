<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$allowedCompetitions = ["men", "women", "kids"];

$name = trim($_POST["name"] ?? "");
$email = strtolower(trim($_POST["email"] ?? ""));
$competition = $_POST["competition"] ?? "men";
$wattage = intval($_POST["wattage"] ?? 0);
$newsletterOptin = isset($_POST["newsletter_optin"]) ? 1 : 0;

if (!in_array($competition, $allowedCompetitions, true)) {
    die("Ongeldige competitie. Kies mannen, vrouwen of kinderen.");
}

if ($name === "" || $wattage <= 0 || $wattage > 3000) {
    die("Ongeldige invoer. Controleer naam en wattage.");
}

if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Ongeldig e-mailadres. Vul een geldig e-mailadres in.");
}

$stmt = $pdo->prepare("
    INSERT INTO scores (name, email, newsletter_optin, competition, wattage)
    VALUES (:name, :email, :newsletter_optin, :competition, :wattage)
");

$stmt->execute([
    ":name" => $name,
    ":email" => $email,
    ":newsletter_optin" => $newsletterOptin,
    ":competition" => $competition,
    ":wattage" => $wattage
]);

header("Location: index.php?success=1");
exit;
?>
