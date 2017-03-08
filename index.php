<?php
   /* Kaptcha1 Image Generator
	* Definitely not secure captcha challenge
	* Keeping it easy for those who haven't processed images before.
	* Kris Howard - ka1m
	* kris@mail.usf.edu
	*/
	session_start();
	
	// Grab the time
	$now=gettimeofday(true);

	
	if(empty($_SESSION['time']))
	{
		$_SESSION['time']=$now;
	}

	// Get the elapsed time ($_SESSION['time'] will always have a value at this point)
	$elapsed = $now - $_SESSION['time'];
	

	// Check if within timelimit and value matches.
	if(($elapsed<1) && !empty($_SESSION['quarry']) && ($_POST['answer']==$_SESSION['quarry'])) 
	{
		// echo the md5 of 'winrar!!!'
		echo "Key: 59ce95c695abe470432bb8b4fb0db2c5";
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>Kaptcha 1</title>
</head>

<body>
<div class="container">
<h1>Kaptcha1</h1>
<p>You have one second to read this image and post it back to this page.<br />Remember the cookies,<br />the image will also provide them.</p>

<div class="captcha">
<img src="image.php" alt="What kind of image is this?!" />
<br />
<form action="index.php" method="post">
Answer:<br /><input type="text" name="answer" /><br />
<input type="submit" value="Submit" style="margin: 2px;">
</div>
</form>
<?php

// If they tried and took too long.
if($elapsed>1 && !empty($_POST['answer']))
{
	echo "Too Slow!";
	$_SESSION['time']='';
	echo "<br /> Elapsed time: ";
	echo $elapsed;
	echo " seconds.";
	echo "<br /><br />";

}
// If they submitted the wrong answer.
if (!empty($_POST['answer']) && $_POST['answer']!=$_SESSION['quarry'])
{
	echo "Wrong answer! <br />";
	echo "Expected: ";
	echo $_SESSION['quarry'];
	echo "<br />";
	echo "Received: ";
	echo $_POST['answer'];
}

?>
</div>
</body>
</html>

