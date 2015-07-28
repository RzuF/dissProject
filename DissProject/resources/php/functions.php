<?php
include_once('config.php');

function wrap($fontSize, $angle, $fontFace, $string, $width){

	$ret = "";

	$arr = explode(' ', $string);
	
	$lastReturn = false;

	foreach ($arr as $word)
	{

		$testString = $ret.' '.$word;
		$testBox = imagettfbbox($fontSize, $angle, $fontFace, $testString);
		if ($testBox[2] > $width)
		{
			if($lastReturn)
			{
				$multipler = 1;
				
				do
				{
					$wordArray = str_split($word, strlen($word)/(2 * $multipler) + 1);
					
					$multipler++;
					
					$testStringIn = $ret . implode("\n", $wordArray);
					
					$testBoxIn = imagettfbbox($fontSize, $angle, $fontFace, $testStringIn);
				}
				while ($testBoxIn[2] > $width);
				
				$ret .= implode("\n", $wordArray);
			}
			else $ret .= ($ret == "" ? "" : "\n").$word;
			
			$lastReturn = true;
		}
		
		else 
		{
			$ret .= ($ret == "" ? "" : ' ').$word;
			$lastReturn = false;
		}
	}

	return $ret;
}

// Need to write code for cutting word if (word_length > $width)

function createImage($description, $id){
	
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
	mkdir("../images/notes/", 0777, true);
	imagepng($image, "../images/notes/$id.png");
	imagedestroy($image);
}

function isValidEmail($email) 
{
	return filter_var($email, FILTER_VALIDATE_EMAIL)
	&& preg_match('/@.+\./', $email);
}

?>