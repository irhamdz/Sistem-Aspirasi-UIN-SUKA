<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				ini_set('memory_limit', '-1');
				$vdir_upload = "./media/slide/";
	$targ_w = $targ_h = 640;
	$jpeg_quality = 360;
	
	if(!isset($_POST['x']) || !is_numeric($_POST['x'])) {
	  die('Please select a crop area.');
	}
//print_r($_POST);
	$src = 'http://pmi.uin-suka.ac.id/media/slide/hh_030-21.jpg';
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor($targ_w, $targ_h);

	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	$targ_w,$targ_h,$_POST['w'],$_POST['h']);

	header('Content-type: image/jpeg');
	imagejpeg($dst_r,null,$jpeg_quality); // NULL will output the image directly
//echo "<img src='$src'/>";
	exit;
}

?>