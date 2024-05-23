<?php
// Get page title, if not set set to "Your Pet"
$title = isset($pageTitle) ? $pageTitle : "YourPet";
$background = isset($pageBackground) ? $pageBackground : "bg-slate-100";
$bodyClasses = isset($bodyClasses) ? $bodyClasses : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/output.css">
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title> <?= $title; ?> </title>
</head>
<body class="<?= $background . ' ' . $bodyClasses?> font-Monsterrat">
