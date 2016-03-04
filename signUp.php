<html>
<head>
  <?php
    include("config.php");


    $sqlcmd = "SELECT * FROM account WHERE UPPER(accountName) = UPPER('$_POST[userNameS]');";
    $existingAccount = mysqli_query($dbcon,$sqlcmd);
    if(mysqli_num_rows($existingAccount) > 0){
      echo "<script type='text/javascript'>alert('User name had been choosen! Please choose another one!'); window.location = 'login.html'; </script>";
    }
    else{
      $sqlcmd = "SELECT * FROM account";
      $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
      $numOfRows = mysqli_num_rows($dataRetrieve);
      $accountID = 100001 + $numOfRows;
      $realAccountID = strval($accountID);
      $sqlcmd = "INSERT INTO account (accountID,accountName,accountPassword,accountEmail,accountType)
                VALUES ('$realAccountID', '$_POST[userNameS]', '$_POST[userPasswordS]' , ' $_POST[emailAddressS]','User')";
      $insertData = mysqli_query($dbcon,$sqlcmd);
      echo "<script type='text/javascript'>alert('Successful register!');</script>";
      mysqli_close($dbcon);
  }

  ?>
  <script type="text/javascript">
    window.location = "login.html";
  </script>

<meta charset= "utf-8" content="text/html">
<title>Gaming Galaxy</title>
<body>
</body>
</head>
</html>
