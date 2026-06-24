<?php
require_once "config.php";

$pdo->query("TRUNCATE TABLE scores");

header("Location: dashboard.php");
exit;
?>