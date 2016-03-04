<?php
  unset($_COOKIE['userName']);
  unset($_COOKIE['userID']);
  unset($_COOKIE['userType']);
  setcookie('userName', null, -1, '/');
  setcookie('userID', null, -1, '/');
  setcookie('userType', null, -1, '/');
  header("Location: mainPage.php");
?>
