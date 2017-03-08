<?php
/* Kaptcha1 Image Generator
 * Definitely not secure captcha challenge
 * Keeping it easy for those who haven't processed images before.
 * Kris Howard - ka1m
 * kris@mail.usf.edu
 */
	
	// Start session
	session_start();	
	
	// Generate the random number
	$_SESSION['quarry']=rand(1000000000,9999999999);

	// First generate image so it does not affect competitors time as much
	// This saves 0.001 - 0.01 seconds through cursory local testing

	// Create image object
	$i = @imagecreate(150, 50)
    or die("Cannot Initialize new GD image stream");

	// Set bg color to white
	imagecolorallocate($i, 255, 255, 255);

	// Grab the quarry
	$quarry = empty($_SESSION['quarry']) ? 'error' : $_SESSION['quarry'];

	// Set text color
	$tColor=imagecolorallocate($i,0,0,0);

	// Add text to $i
	$text=imagettftext($i,16,0,20,30,$tColor,"fonts/times.ttf",$quarry);



	// Grab the time
	$now=gettimeofday(true);
	// For those accessing image.php directly, reset time if it's outside
	// allowed time.
	if((empty($_SESSION['time'])) || (($now - $_SESSION['time']) > 1))
	{
		$_SESSION['time']=$now;
	}

	// Send header
	header("Content-Type: image/png");
	header("Content-Disposition:inline ; filename=supersecure.jpg");	

	// Send content
	imagepng($i);
	imagedestroy($i);
?>