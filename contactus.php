<?php

  if(isset($_POST["submit"])){
    include ("config.php");
    $name = $_POST["name"];
    $email = $_POST["email"];
    $problemType = $_POST["problem"];
    $problemDetail = "";
      if(!isset($_POST["problemDetail"]) || $_POST["problemDetail"] == ""){
          $problemDetail = "-";
      }
      else{
        $problemDetail = $_POST["problemDetail"];
      }

      $sqlcmd = "SELECT * FROM complaint;";
      $dataRetrieve = mysqli_query($dbcon, $sqlcmd);
      $numOfRows = mysqli_num_rows($dataRetrieve);

      $commentID = 100001 + $numOfRows;
      $realCommentID = strval($commentID);
      $sqlcmd = "INSERT INTO complaint (complaintID , complaintName, complaintEmail, complaintType, complaintDetail) VALUES ('$realCommentID','$name','$email','$problemType','$problemDetail');";
      $dataRetrieve = mysqli_query($dbcon, $sqlcmd);
      echo "<script type ='text/javascript'>alert('Your issue(s) had been submitted. Thank you.')</script>";
      echo "<script type='text/javascript'>location.href = 'mainPage.php';</script>";
      //header("Location: mainPage.php");

    }
    else{
      echo "<script type='text/javascript'>location.href = 'mainPage.php';</script>";
    }
?>
