<?php

include_once 'head.php';

$pdo = new PDO('sqlite:pizzasushiwok.db');

$itemId = $_GET['id'];

$queryItem = $pdo->query('SELECT * FROM items WHERE id=' . $itemId);

$item = $queryItem->fetch(PDO::FETCH_ASSOC);

echo '<div class="item">
    <img src="template/www/img/' . $item['imgSrc'] . '">
    <div><b>' . $item['name'] . '</b></a>
    Стоимость - ' . $item['price'] . '</div>
    <div><a href="index.php">Назад</a></div>
    </div> <div><h1>Описание</h1></div>
    <hr><hr><hr>
    ';