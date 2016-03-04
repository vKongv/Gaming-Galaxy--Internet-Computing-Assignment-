<html>
<head>

<link rel="stylesheet" href="css/gamedetailstyle.css">
<?php
  include ("config.php");
  if(isset($_GET['game'])){
    //Increase the gameHit by 1
    $sqlcmd = "UPDATE game SET gameHit = gameHit + 1 WHERE gameID = '$_GET[game]';";
    $dataRetrieve = mysqli_query($dbcon,$sqlcmd);

    //Get the game info
    $sqlcmd = "SELECT gameName, gameGenre, gameRating, gameUserRating, gameReleaseDate, gamePublisher, gameDescription, gameVideoURL FROM game WHERE gameID = '$_GET[game]';";
    $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
    $row = mysqli_fetch_row($dataRetrieve);

    //Get the image info
    $sqlcmd = "SELECT imageURL FROM game,imagegame WHERE imagegame.gameID = game.gameID AND game.gameID = '$_GET[game]' LIMIT 6;";
    $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
    $numOfImage = mysqli_num_rows($dataRetrieve);
    $image = mysqli_fetch_row($dataRetrieve);
    $imageURLMain = "sysimage/noimg.jpg";
  }
  else{
    header('Location: mainPage.php');
  }
?>

<title><?php echo $row[0]; ?></title>
</head>
<body>
  <div id="nav">

    <ul>
      <li><a target="" href="mainPage.php">Home</a></li> | &nbsp;
      <li><a target="" href="showAllNews.php">News</a></li> | &nbsp;
      <li>
        <a target="" href="gametype.php">Game Types</a>
        <ul style="width:183px;">
          <li><a href="genre.php?genre=Action">Actions</a></li>
          <li><a href="genre.php?genre=Racing">Racing</a></li>
          <li><a href="genre.php?genre=Shooting">Shooting</a></li>
          <li><a href="genre.php?genre=Sports">Sports</a></li>
          <li><a href="genre.php?genre=Strategey">Strategy</a></li>
          <li><a href="genre.php?genre=Survival">Survival</a></li>
        </ul>
      </li> | &nbsp;
      <li><a target="" href="showAllReview.php">Reviews</a></li> | &nbsp;
      <li><a target="" href="contactus.html">Contact Us</a></li>
    </ul>
  </div>
<br><br>
  <div id="gamedetail">
    <!-- Check whether got image or not -->
    <?php
        if($numOfImage > 0){
          $imageURLMain = $image[0];
        }
    ?>
    <table>
    <tr>
      <td valign='bottom' rowspan = '9' style='padding-right:20px;'><?php echo "<img width=580px height=300px src = '$imageURLMain'>";?></td>
      <td></td>
    </tr>

    <tr>
      <td></td>
      <td valign='top'><a class = "game-title" target ="_blank" href='mainPage.php' ><?php echo "$row[0]";?> </a></td>
    </tr>

    <tr>
      <td valign='top'><strong>Genre:</strong> </td>
      <td valign='top'><?php echo "$row[1]";?></td>
    </tr>
    <tr>
      <td valign='top'><strong>Admin rating:<strong></td>
      <td valing='top'><?php echo "$row[2]";?> / 5.0</td>
    </tr>
    <tr>
      <td valign='top'><strong>User rating:<strong></td>
      <td valign='top'><?php echo "$row[3]";?> / 5.0</td>
    </tr>
    <tr>
      <td valign='top'><strong>Released Date:</strong> </td>
      <td valign='top'><?php echo "$row[4]";?></td>
    </tr>
    <tr>
      <td valign='top'><strong>Publisher:</strong> </td>
      <?php
          echo "
            <td valign='top'><a target = '_blank' href='https://www.google.com.my/#q=$row[5]'>$row[5]</a></td>
          ";
      ?>
    </tr>
  </table>
  </div>

  <div id="gamephoto">
    <?php
    $numOfImageShow = 0;
    while($image = mysqli_fetch_row($dataRetrieve)){
      echo "
        <span>
          <a>
            <img src='$image[0]' alt='' >
          </a>
        </span>
      ";
      $numOfImageShow ++;
    }
      for($i = 5 ; $i > $numOfImageShow; $i--){
        echo "
          <span>
            <a>
              <img src='image/noimg.jpg' alt='' >
            </a>
          </span>
        ";
      }
    ?>
  </div>

  <?php
    if (strcmp($row[7], "-") != 0){
      echo "
        <p  style='margin-left:350px;'><embed width='720' height='348' src='http://www.youtube.com/v/$row[7]' frameborder='0' allowfullscreen></p>
          <div id='sharebuttons'>
            <!-- Facebook -->
            <a href='http://www.facebook.com/sharer.php?u=http://youtu.be/$row[7]' target='_blank'>
              <img style='margin-left:600px;'src='icon/facebook.png' alt='Facebook' width='3%' height='6%'/></a>

            <!-- Twitter -->
            <a href='http://twitter.com/share?url=http://youtu.be/$row[7]' target='_blank'>
              <img src='icon/twitter.png' alt='Twitter' width='3%' height='6%'/></a>

            <!-- Google+ -->
            <a href='https://plus.google.com/share?url=http://youtu.be/$row[7]' target='_blank'>
              <img src='icon/googleplus.png' alt='Google' width='3%' height='6%'/></a>

            <!-- LinkedIn -->
            <a href='http://www.linkedin.com/shareArticle?mini=true&url=http://youtu.be/$row[7]' target='_blank'>
              <img src='icon/linkedin.png' alt='LinkedIn' width='3%' height='6%'/></a>
          </div>
      ";
    }
    else {
      echo "
        <h2 style = 'text-align : center;'>---------------- No Trailer available ---------------- </h2>
      ";
    }
  ?>
  <div id="gamedescription">
    <h2>About this game: </h2>
    <?php echo "$row[6]";?>
  </div>

  <?php if(isset($_COOKIE['userName'])){ ?>
  <form action="rate.php" method="post">
    <div style="margin-left:950px;">Do you want to rate this game?&nbsp;
    <select name = "userRating">
      <option selected value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <input type="submit" id = "submitRating" name="submitRating" value="Rate Now!" />
<?php echo "
    <!--<input type='hidden' value='gameDetails.php?game=$_GET[game]' name ='gameURL'/>-->
    <input type='hidden' value='$_GET[game]' name ='gameID'/>
    ";
  } else {
?>
  <h3 style='text-align:center;'> Please <a href='login.html'>Login </a> to review </h2>
  <?php
    }
  ?>

    </div>

  </form>
  <p></p>
  <p style="background-color:#4c4c4c; color:#fff;padding:10px;">&copy; 2015 Gaming Galaxy. All right reserved. Privacy notice.</p>
</body>
</html>
