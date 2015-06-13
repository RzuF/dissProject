<?php

header('Content-Type: image/png');
include_once('functions.php');

/*
 * Code for getting text from given ID in GET request to $description variable
 */

$description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non nunc lectus. Curabitur hendrerit bibendum enim dignissim tempus. Suspendisse non ipsum auctor metus consectetur eleifend. Fusce cursus ullamcorper sem nec ultricies. Aliquam erat volutpat. Vivamus massa justo, pharetra et sodales quis, rhoncus in ligula. Integer dolor velit, ultrices in iaculis nec, viverra ut nunc.\n\n";

$font = CFG_IMG_FONT;
$fontSize = CFG_IMG_FONT_SIZE;

$wrappedText = wrap($fontSize, 0, $font, $description, CFG_IMG_WIDTH - CFG_IMG_MARGIN*2);
//echo $wrappedText;

$testBox = imagettfbbox($fontSize, 0, $font, $wrappedText);

$height = $testBox[1] - $testBox[7] + CFG_IMG_MARGIN * 2;
//$wrappedText .= ($testBox[1] - $testBox[7]);

$image = imagecreate(CFG_IMG_WIDTH ,$height);
$bg = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, CFG_IMG_COLOR_TEXT_R, CFG_IMG_COLOR_TEXT_G, CFG_IMG_COLOR_TEXT_B);

//$image = new gd_gradient_fill(CFG_IMG_WIDTH ,$height, 'rectangle' , CFG_IMG_COLOR_START,CFG_IMG_COLOR_END);

imagettftext($image, $fontSize, 0, CFG_IMG_MARGIN, CFG_IMG_MARGIN + CFG_IMG_FONT_SIZE, $textColor, $font, $wrappedText);
imagepng($image);
imagedestroy($image);

?>