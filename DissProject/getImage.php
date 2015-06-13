<?php

header('Content-Type: image/png');
include_once('functions.php');

/*
 * Code for getting text from given ID in GET request to $description variable
 */

$description = "Sth just for testing";

$font = CFG_IMG_FONT;
$fontSize = CFG_IMG_FONT_SIZE;

$wrappedText = wrap($fontSize, 0, $font, $description, CFG_IMG_WIDTH - CFG_IMG_MARGIN);

$testBox = imagettfbbox($fontSize, 0, $font, $wrappedText);

$height = $testBox[1] - $testBox[7] + CFG_IMG_MARGIN * 2;

$image = imagecreate(CFG_IMG_WIDTH ,$height);
$bg = imagecolorallocate($image, 255, 0, 0);
$textColor = imagecolorallocate($image, CFG_IMG_COLOR_TEXT_R, CFG_IMG_COLOR_TEXT_G, CFG_IMG_COLOR_TEXT_B);

$image = new gd_gradient_fill(CFG_IMG_WIDTH ,$height, 'rectangle' , CFG_IMG_COLOR_START,CFG_IMG_COLOR_END);

imagettftext($image, $fontSize, 0, CFG_IMG_MARGIN, CFG_IMG_MARGIN, $textColor, $font, $wrappedText);
imagepng($image);
imagedestroy($image);

?>