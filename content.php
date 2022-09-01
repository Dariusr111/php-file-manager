<?php

if (isset($_GET['dir'])) {
    $child_dir = $_GET['dir'];
}

$dir = 'C:/xampp/htdocs/php/pask-8-nd/test';
$path = $dir.$child_dir;

echo file_get_contents($path);

// $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
// $kelias = $_GET['dir'];
// $path   = $rootDir.$kelias;
// echo '<textarea name="" id="" cols="100" rows="100">' . file_get_contents($path) . '</textarea>';

?>