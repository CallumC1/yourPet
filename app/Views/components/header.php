<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\css\output.css">

    <!-- Get page title, if not set set to "Your Pet" -->
    <?php $title = isset($pageTitle) ? $pageTitle : "Your Pet" ?>
    <title> <?= $title ?> </title>
</head>
<body>
