<?php
$dir = "../Galerie/";
$files = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

// Tri par date décroissante
usort($files, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

// Nombre limité via GET
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : count($files);
$files = array_slice($files, 0, $limit);

// Formatage JSON
$result = array_map(function ($file) {
    return [
        'path' => $file,
        'name' => pathinfo($file, PATHINFO_FILENAME)
    ];
}, $files);

header('Content-Type: application/json');
echo json_encode($result);  