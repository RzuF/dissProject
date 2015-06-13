<?php

include_once('gd-gradient-fill.php');
include_once('config.php');

function wrap($fontSize, $angle, $fontFace, $string, $width){

	$ret = "";

	$arr = explode(' ', $string);

	foreach ( $arr as $word ){

		$testString = $ret.' '.$word;
		$testBox = imagettfbbox($fontSize, $angle, $fontFace, $testString);
		if ( $testBox[2] > $width ){
			$ret.=($ret==""?"":"\n").$word;
		} else {
			$ret.=($ret==""?"":' ').$word;
		}
	}

	return $ret;
}

// Need to write code for cutting word if (word_length > $width)

?>