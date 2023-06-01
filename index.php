<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="template/www/style/style.css">
</head>
<header>
    <h1>Menu</h1>
</header>
<body>

<?php

$pdo = new PDO('sqlite:pizzasushiwok.db');

$queryCategories = $pdo->query('SELECT * FROM categories');

$categories = $queryCategories->fetchAll(PDO::FETCH_ASSOC);

foreach ($categories as $category) {
    echo '<h2>' . $category['name'] . '</h2>';

    $querySubCategories = $pdo->query("SELECT DISTINCT subcategories FROM items where categories_id =" . $category['id']);
    $subCategories = $querySubCategories->fetchAll(PDO::FETCH_ASSOC);

    foreach ($subCategories as $item) {
        echo '<h3>' . $item['subcategories'] . '</h3>';

        $queryPositions = $pdo->query("SELECT * FROM items where subcategories ='" . $item['subcategories'] . "'");
        $positions = $queryPositions->fetchAll(PDO::FETCH_ASSOC);

        foreach ($positions as $position) {
            echo
                '<div class="item">
                    <img src="template/www/img/'. $position['imgSrc']. '"><p>'
                    . $position['name']. '<br>Стоимость - ' . $position['price'] . '
                    <br>Description
                 </p></div>';
        }
    }
}
