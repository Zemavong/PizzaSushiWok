<?php

//Код написан в процедурном стиле, так как это быстрее. При необходимости могу написать с ООП-подходом

include_once 'head.php';

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
                    <img src="template/www/img/' . $position['imgSrc'] . '">
                     <a href="cart.php?id=' . $position['id'] . '">'. $position['name'] .'</a>
                     <p>Стоимость - ' . $position['price'] .
                '</p></div>';
        }
    }
}
