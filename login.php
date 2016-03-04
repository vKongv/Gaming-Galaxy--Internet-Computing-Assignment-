<?php
  include("config.php");

      $sqlcmd = "SELECT accountID , accountName, accountPassword,accountType FROM account WHERE UPPER(accountName) = UPPER('$_POST[userName]') AND accountPassword='$_POST[userPassword]';";
      $dataRetreive = mysqli_query($dbcon,$sqlcmd);

      $row = mysqli_fetch_row($dataRetreive);
      if ($_POST['userName'] == $row[1]){
        if($_POST['userPassword'] == $row[2]){
          //name, value, expair time
          echo "<script type='text/javascript'>alert('Verified!');</script>";
          setcookie("userName",$_POST['userName'],time()+ 3600,"/");
          setcookie("userID", $row[0],time()+ 3600,"/" );
          setcookie("userType",$row[3],time()+ 3600,"/" );
          ?>
          <script type="text/javascript">
            window.location = "mainPage.php";
          </script>
          <?php
          }
        }
        else{
          echo "<script type='text/javascript'>alert('Not Verified!');</script>";
        ?>
        <script type="text/javascript">
          window.location = "login.html";
        </script>
        <?php

        }
?>
