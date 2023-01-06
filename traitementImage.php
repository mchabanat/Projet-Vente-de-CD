<?php

$url = $_GET['url'];

$width = $_GET['width'];
$height = $_GET['height'];

// Affichage de la vignette
$original_image = imagecreatefromstring(file_get_contents($url));

// Créationd d'une image vide
$image = imagecreatetruecolor($width,$height);

// Redimenssionner l'image originale pour la nouvelle image
imagecopyresampled($image,$original_image,0,0,0,0,$width,$height,imagesx($original_image),imagesy($original_image));

header('Content-Type: image/jpeg');

// Affichage de l'image
imagejpeg($image);

// On libère la mémoire en supprimant l'image créée
imagedestroy($original_image);
imagedestroy($image);

?>