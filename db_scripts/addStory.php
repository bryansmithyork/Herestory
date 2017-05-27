<?php

	include "credentials.php";

	$loc = $_POST["location"];
	$story = $_POST["story"];
	$tag = $_POST["tag"];

	$coord = explode(",", $loc);
	$lat = $coord[0];
	$lng = $coord[1];

	date_default_timezone_set("America/Toronto");
	$date = date("D M j H:i:s Y");
	
	//echo $date . " -- " . $lat . " -- " . $lng . " -- " . $story . " -- " . $tag . " -- " . $pieceName;
	
	$conn = new mysqli($host, $user, $pass, $db);
	
	// https://secure.php.net/manual/en/imagick.getimageorientation.php
	function autoRotateImage($image) {
		$orientation = $image->getImageOrientation();

		switch($orientation) {
			case imagick::ORIENTATION_BOTTOMRIGHT:
				$image->rotateimage("#000", 180); // rotate 180 degrees
			break;

			case imagick::ORIENTATION_RIGHTTOP:
				$image->rotateimage("#000", 90); // rotate 90 degrees CW
			break;

			case imagick::ORIENTATION_LEFTBOTTOM:
				$image->rotateimage("#000", -90); // rotate 90 degrees CCW
			break;
		}

		// Now that it's auto-rotated, make sure the EXIF data is correct in case the EXIF gets saved with the image!
		$image->setImageOrientation(imagick::ORIENTATION_TOPLEFT);
	} 
	
	// https://stackoverflow.com/questions/2958167/how-to-test-if-a-user-has-selected-a-file-to-upload
	if (empty($_FILES['uploadFile']['name'])) {
		$pieceName = "";
	} else {
		$pieceNamePrefix = (string) mt_rand() . "-" . (string) mt_rand(); 
		$pieceName = $pieceNamePrefix . $_FILES['uploadFile']['name'];
		move_uploaded_file($_FILES['uploadFile']['tmp_name'], "../images/" . $pieceName);
		// http://blog.jmoz.co.uk/imagick-strip-exif-data/
		$image = new Imagick("../images/" . $pieceName);
		autoRotateImage($image);
		$image->writeImage("../images/" . $pieceName);
	}
	
	/*$story = str_replace("'", "''", $story);
	$tag = str_replace("'", "''", $tag);
	
	$story = str_replace("\"", '\"', $story);
	$tag = str_replace("\"", '\"', $tag);*/
	
	//$story = str_replace("\n", "<br \>", $story);

	$story = mysqli_real_escape_string($conn, $story);
	$tag = mysqli_real_escape_string($conn, $tag);
	//echo "INSERT INTO herestory (date, lat, lng, story, tag, picture) VALUES ('" . $date . "', " . $lat . ", " . $lng . ", '" . $story . "', '" . $tag . "', '" . $pieceName . "')";
	
	$query = "INSERT INTO herestory (date, lat, lng, story, tag, picture, hide) VALUES ('" . $date . "', " . $lat . ", " . $lng . ", '" . $story . "', '" . $tag . "', '" . $pieceName . "', 'n')";
	//echo $query;
	$results = $conn->query($query) or die(mysqli_error($conn)); //die('<div class="ui segments"><div class="ui blue inverted segment"><p>Error with inserting reference. Please make sure it is formatted correctly.</p></div><div class="ui secondary segment"><p>If you are trying to view, make sure to provide an ID.</p></div></div>'); 
	
	// http://php.about.com/od/learnphp/ht/phpredirection.htm
	//header("Location: https://www.bryanabsmith.com/herestory2/") ;
?>