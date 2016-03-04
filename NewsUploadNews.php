<?php
	echo "<!DOCTYPE html>
	<html>
	<head>
	<title> News Posted </title>
	<link rel = 'stylesheet' href = 'styling.css' type = 'text/css'>
	</head>

	<body>";
	include ("config.php");

	//retrieve news' ID count and +1 for new news
	$newsID = 'SELECT COUNT(*) FROM news';
	$dataRetreive = mysqli_query($dbcon, $newsID);
	$row = mysqli_fetch_row($dataRetreive);
	$newsID = $row[0] + 1000001;

	//retrieve image's count and +1 for new image
	$target_images = 'SELECT COUNT(*) FROM imagenews';
	$dataRetreive = mysqli_query($dbcon, $target_images);
	$row = mysqli_fetch_row($dataRetreive);
	$target_images = $row[0] + 1000001;

	/*Insert data into news*/
	$newsTitle = test_input($_POST["newsTitle"]);
	$newsGameName = test_input($_POST["newsGameName"]);
	$newsText = test_input($_POST["newsText"]);
	$newsID = test_input(addslashes($newsID));
	$newsTitle = test_input(addslashes($newsTitle));
	$newsText = test_input(addslashes($newsText));
	$accountID = test_input($_POST["accountID"]);

	$newsGameName = strtoupper($newsGameName);
	$target_Game = "SELECT * FROM game WHERE gameName = '$newsGameName';";
	$dataRetreive = mysqli_query($dbcon, $target_Game);
	$target_GameID = mysqli_fetch_row($dataRetreive);

	//upload news data
	$upload_NewsData = "INSERT INTO news (newsID, newsTitle, newsDate, newsText, accountID, gameID, newsHit) VALUES
	('$newsID', '$newsTitle', CURRENT_TIMESTAMP, '$newsText', '$accountID', '$target_GameID[0]', 0);";

	$dataRetreive = mysqli_query($dbcon, $upload_NewsData);

	/*--------------------------------------------------------------------------------------------*/
	/*Insert title image into imagenews and upload it into file*/
	//specific images file location
	$target_dir = "newsimage/";

	/*--------------------------------------------------------------------------------------------*/
	/*Insert multiple images into imagenews and upload them into file*/
	if(isset($_FILES["newsImages"])){
	foreach ($_FILES["newsImages"]["tmp_name"] as $key => $images_Number) {
		$target_images = $target_images + 1;

		$target_file = $target_dir . basename($_FILES["newsImages"]["name"][$key]);

	    if(move_uploaded_file($_FILES["newsImages"]["tmp_name"][$key], $target_file)){
			$target_file = addslashes($target_file);
			$upload_images = "INSERT INTO imagenews (imageID, imageURL, newsID) VALUES ('$target_images', '$target_file', '$newsID');";

			$dataRetreive = mysqli_query($dbcon, $upload_images);
		}
		else{
			$upload_images = "INSERT INTO imagenews (imageID, imageURL, newsID) VALUES ('$target_images', 'sysimage/noimg.jpg', '$newsID');";
			$dataRetreive = mysqli_query($dbcon, $upload_images);
		}
	}
}
else{
	$upload_images = "INSERT INTO imagenews (imageID, imageURL, newsID) VALUES ('$target_images', 'sysimage/noimg.jpg', '$newsID');";
	$dataRetreive = mysqli_query($dbcon, $upload_images);
}

	/*--------------------------------------------------------------------------------------------*/
	/*Show Result*/
	echo "News ID: $newsID<br/>
	Related Game: $target_GameID[1]<br/>
	News Title: $newsTitle<br/><br/>

	Has been uploaded.";

	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<a href = 'mainPage.php'>Back to Main Menu<a>
</body>
</html>
