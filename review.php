<?php
  include("config.php");
  if(isset($_POST["submitComment"])){
    if(isset($_POST["comments"]) && $_POST["comments"] != ""){
      $sqlcmd = "SELECT * FROM comment";
      $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
      $row = mysqli_fetch_row($dataRetrieve);
      $numOfRow = mysqli_num_rows($dataRetrieve);
      $commentID = 100001 + $numOfRow;
      $realCommentID = "C" . strval($commentID);

      echo "$_POST[accountID]";
      $sqlcmd = "INSERT INTO comment (commentID, commentText, commentDate,reviewID,accountID) VALUES ('$realCommentID','$_POST[comments]',CURRENT_TIMESTAMP,'$_POST[reviewID]','$_POST[accountID]');";
      $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
      echo "<script type='text/javascript'> alert('Successful add comment!'); window.location = 'reviewDetails.php?review=$_POST[reviewID]'; </script>";
    }
    else{
      echo "<script type='text/javascript'>alert('Must enter comment!'); window.location = 'reviewDetails.php?review=$_POST[reviewID]';</script>";
      header("Location : " . "mainPage.php");
    }
  }
    else{
      echo "Header";
      echo "<script type='text/javascript'>window.location = 'mainPage.php'; </script>";
  }

?>
