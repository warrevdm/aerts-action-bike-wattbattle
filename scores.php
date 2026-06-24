<?php
require_once "config.php";

header("Content-Type: application/json; charset=utf-8");

$competitions = [
    "men" => [
        "label" => "Mannen competitie",
        "shortLabel" => "Mannen",
        "subtitle" => "Wie trapt de hoogste piekwattage?"
    ],
    "women" => [
        "label" => "Vrouwen competitie",
        "shortLabel" => "Vrouwen",
        "subtitle" => "De sterkste sprint van de dag."
    ],
    "kids" => [
        "label" => "Kinderen competitie",
        "shortLabel" => "Kinderen",
        "subtitle" => "Jonge benen, grote watts."
    ]
];

$result = [];

$stmt = $pdo->prepare("
    SELECT id, name, competition, wattage, created_at
    FROM scores
    WHERE competition = :competition
    ORDER BY wattage DESC, created_at ASC
    LIMIT 5
");

foreach ($competitions as $key => $meta) {
    $stmt->execute([":competition" => $key]);

    $result[$key] = [
        "label" => $meta["label"],
        "shortLabel" => $meta["shortLabel"],
        "subtitle" => $meta["subtitle"],
        "scores" => $stmt->fetchAll()
    ];
}

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
