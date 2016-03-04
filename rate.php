<?php
  if(isset($_POST["submitRating"])){
    include ("config.php");
    $userRating = floatval($_POST["userRating"]);
    $gameID = $_POST['gameID'];

    $cmd = "SELECT * FROM game WHERE gameID = '$gameID' LIMIT 1;";
    $dataRetreive = mysqli_query($dbcon, $cmd);
    $gameDetails = mysqli_fetch_row($dataRetreive);
    $ratingBefore = $gameDetails[6] * $gameDetails[11];
    $ratingNow = $ratingBefore + $userRating;
    $upload_reviewData = "UPDATE game SET reviewUserCount = reviewUserCount + 1 WHERE gameID = '$gameID';";
    $dataRetreive = mysqli_query($dbcon, $upload_reviewData);
    $upload_reviewData = "UPDATE game SET gameUserRating = $ratingNow/reviewUserCount WHERE gameID = '$gameID';";
    $dataRetreive = mysqli_query($dbcon, $upload_reviewData);
    header("Location: gameDetails.php?game=$gameID");

  }
  else{
    header("Location: mainPage.php");
  }

?>
