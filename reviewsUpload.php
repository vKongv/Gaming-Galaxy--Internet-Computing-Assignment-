<?php
  echo "<!DOCTYPE html>
  <html>
  <head>
  <title> review Posted </title>
  <link rel = 'stylesheet' href = 'styling.css' type = 'text/css'>
  </head>

  <body>";
  include ("config.php");

  //retrieve review' ID count and +1 for new review
  $reviewID = 'SELECT COUNT(*) FROM review';
  $dataRetreive = mysqli_query($dbcon, $reviewID);
  $row = mysqli_fetch_row($dataRetreive);
  $reviewID = $row[0] + 1000001;

  //retrieve image's count and +1 for new image
  $target_images = 'SELECT COUNT(*) FROM imagereview';
  $dataRetreive = mysqli_query($dbcon, $target_images);
  $row = mysqli_fetch_row($dataRetreive);
  $target_images = $row[0] + 1000001;

  /*Insert data into review*/
  $reviewTitle = test_input($_POST["reviewTitle"]);
  $reviewGameName = test_input($_POST["reviewGameName"]);
  $reviewText = test_input($_POST["reviewText"]);
  $reviewID = test_input(addslashes($reviewID));
  $reviewTitle = test_input(addslashes($reviewTitle));
  $reviewText = test_input(addslashes($reviewText));
  $accountID = test_input($_POST["accountID"]);

  $reviewGameName = strtoupper($reviewGameName);
  $target_Game = "SELECT * FROM game WHERE gameName = '$reviewGameName' LIMIT 1;";
  $dataRetreive = mysqli_query($dbcon, $target_Game);
  $target_GameID = mysqli_fetch_row($dataRetreive);

  //upload review data
  $upload_reviewData = "INSERT INTO review (reviewID, reviewTitle, reviewDate, reviewText, accountID, gameID, reviewHit) VALUES
  ('$reviewID', '$reviewTitle', CURRENT_TIMESTAMP, '$reviewText', '$accountID', '$target_GameID[0]', 0);";

  $dataRetreive = mysqli_query($dbcon, $upload_reviewData);

  $ratingBefore = $target_GameID[3] * $target_GameID[10];

  $rating = floatval($_POST["rating"]);
  $ratingNow = $ratingBefore + $rating;
  $upload_reviewData = "UPDATE game SET reviewCount = reviewCount + 1 WHERE gameID = '$target_GameID[0]';";
  $dataRetreive = mysqli_query($dbcon, $upload_reviewData);
  $upload_reviewData = "UPDATE game SET gameRating = $ratingNow/reviewCount WHERE gameID = '$target_GameID[0]' ;";
  $dataRetreive = mysqli_query($dbcon, $upload_reviewData);
  /*--------------------------------------------------------------------------------------------*/
  /*Insert title image into imagereview and upload it into file*/
  //specific images file location
  $target_dir = "reviewimage/";

  /*--------------------------------------------------------------------------------------------*/
  /*Insert multiple images into imagereview and upload them into file*/
  if(isset($_FILES["reviewImages"])){
  foreach ($_FILES["reviewImages"]["tmp_name"] as $key => $images_Number) {
    $target_images = $target_images + 1;

    $target_file = $target_dir . basename($_FILES["reviewImages"]["name"][$key]);

      if(move_uploaded_file($_FILES["reviewImages"]["tmp_name"][$key], $target_file)){
        $target_file = addslashes($target_file);
        $upload_images = "INSERT INTO imagereview (imageID, imageURL, reviewID) VALUES ('$target_images', '$target_file', '$reviewID');";

        $dataRetreive = mysqli_query($dbcon, $upload_images);
      }
      else{
        $upload_images = "INSERT INTO imagereview (imageID, imageURL, reviewID) VALUES ('$target_images', 'sysimage/noimg.jpg', '$reviewID');";
        $dataRetreive = mysqli_query($dbcon, $upload_images);
      }
  }
}
else{
  $upload_images = "INSERT INTO imagereview (imageID, imageURL, reviewID) VALUES ('$target_images', 'sysimage/noimg.jpg', '$reviewID');";
  $dataRetreive = mysqli_query($dbcon, $upload_images);
}

  /*--------------------------------------------------------------------------------------------*/
  /*Show Result*/
  echo "review ID: $reviewID<br/>
  Related Game: $target_GameID[1]<br/>
  review Title: $reviewTitle<br/><br/>

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
