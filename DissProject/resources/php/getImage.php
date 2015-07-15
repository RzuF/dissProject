<?php

header('Content-Type: image/png');
include_once('functions.php');
include_once('config.php');

session_start();

try 
{
	$sqlcon = new PDO(DSN, USER, PASS);

} 
catch (PDOException $e) 
{
	print "Connection Error!: " . $e->getMessage() . "<br/>";
	die();
}

$description = "Diss o podanym ID nie istnieje!\n\nThere is no diss with given ID!";

/*try 
{
	if($req = $sqlcon->query("SELECT text, author FROM ".PREFIX."_notes WHERE id = '".$_GET['id']."'")->fetch())
		$description = $req['text'];
}
catch (PDOException $e)
{
	print "Connection Error!: " . $e->getMessage() . "<br/>";
	die();
}*/

$font = CFG_IMG_FONT;
$fontSize = CFG_IMG_FONT_SIZE;

$wrappedText = wrap($fontSize, 0, $font, $description, CFG_IMG_WIDTH - CFG_IMG_MARGIN*2);

$testBox = imagettfbbox($fontSize, 0, $font, $wrappedText);

$height = $testBox[1] - $testBox[7] + CFG_IMG_MARGIN * 2;

$image = imagecreate(CFG_IMG_WIDTH, $height);
$bg = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, CFG_IMG_COLOR_TEXT_R, CFG_IMG_COLOR_TEXT_G, CFG_IMG_COLOR_TEXT_B);

//$image = new gd_gradient_fill(CFG_IMG_WIDTH ,$height, 'rectangle' , CFG_IMG_COLOR_START,CFG_IMG_COLOR_END);

imagettftext($image, $fontSize, 0, CFG_IMG_MARGIN, CFG_IMG_MARGIN + CFG_IMG_FONT_SIZE, $textColor, $font, $wrappedText);
imagepng($image);
imagedestroy($image);

?>