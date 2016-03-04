<!DOCTYPE HTML>
<html>
<head>

<?php
  include("config.php");

  $numOfHottestGame = 0;
  #numOfLatestGame = 0;

  //Get the Hottest game
  $sqlGetGameName = "SELECT gameID, gameName FROM game ORDER BY gameHit DESC LIMIT 4;";
  $dataRetrieveHottest = mysqli_query($dbcon,$sqlGetGameName);
  //Get the total number of row for LOOP
  $numOfHottestGame = mysqli_num_rows($dataRetrieveHottest);

  $sqlGetGameURLHot = array();
  $sqlGetGameURLLat = array();

  //Get the imageurl
  while($rowHottest = mysqli_fetch_row($dataRetrieveHottest)){
    $sqlGetGameURL = "SELECT imageurl FROM imagegame WHERE gameID = '$rowHottest[0]' LIMIT 1;";
    $dataRetrieveURL = mysqli_query($dbcon,$sqlGetGameURL);
    //Get the total number of row for LOOP
    $rowURL = mysqli_fetch_row($dataRetrieveURL);
    $sqlGetGameURLHot[] = $rowURL[0];
  }
  $dataRetrieveHottest = mysqli_query($dbcon,$sqlGetGameName);

  //Get the latest game
  $sqlGetGameName = "SELECT gameID, gameName FROM game ORDER BY gameReleaseDate DESC LIMIT 4;";
  $dataRetrieveLatest = mysqli_query($dbcon,$sqlGetGameName);
  //Get the total number of row for LOOP
  $numOfLatestGame = mysqli_num_rows($dataRetrieveLatest);

  //Get the imageurl
  while($rowLatest = mysqli_fetch_row($dataRetrieveLatest)){
    $sqlGetGameURL = "SELECT imageurl FROM imagegame WHERE gameID = '$rowLatest[0]' LIMIT 1;";
    $dataRetrieveURL = mysqli_query($dbcon,$sqlGetGameURL);
    //Get the total number of row for LOOP
    $rowURL = mysqli_fetch_row($dataRetrieveURL);
    $sqlGetGameURLLat[] = $rowURL[0];
  }
  $dataRetrieveLatest = mysqli_query($dbcon,$sqlGetGameName);

  //Get the latest news
  $sqlGetNews = "SELECT newsID, newsTitle FROM news ORDER BY newsDate DESC LIMIT 5;";
  $dataRetrieveNews = mysqli_query($dbcon,$sqlGetNews);
  //Get the total number of row for LOOP
  $numOfLatestNews = mysqli_num_rows($dataRetrieveLatest);

  //Get the latest review
  $sqlGetReview = "SELECT reviewID, reviewTitle FROM review ORDER BY reviewDate DESC LIMIT 5;";
  $dataRetrieveReview= mysqli_query($dbcon,$sqlGetReview);
  //Get the total number of row for LOOP
  $numOfLatestReview = mysqli_num_rows($dataRetrieveReview);


?>

<meta charset= "utf-8" content="text/html">
<title>Main - Gaming Galaxy</title>
<link rel="stylesheet" href="css/style.css">
<style type="text/css">
div#container
{

   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
body
{
  background-image:url('wc.jpg');
  background-repeat:no-repeat;
  background-size:100%;
  font-family: "Beatnik SF";
  text-align: center;
  margin: 0;
  background-color: #fff;
}

a, p#search
{
   font-family: "Beatnik SF";
   font-size: 21px;
   color: #FFFFFF;
   text-decoration: none;
}
a:visited
{
   color: #FFFFFF;
}
a:active
{
   color: #FFFFFF;
}
a:hover, p#search:hover
{
   color: #FFFFFF;
   text-decoration: underline;
   cursor:pointer;
}
p#search, span, div, ol, ul, li, input, textarea, form
{
   margin: 0;
   padding: 0;
}

#nav{
   color: #4C4C4C;
   font-family: "Beatnik SF";
   font-size: 21px;
   font-weight: normal;
   font-style: normal;
   padding: 0;
}

#nav ul {
  text-align: left;
  display: inline;
  margin: 0;
  padding: 15px 4px 17px 0;
  list-style: none;
}

#nav ul li {
  font:20px "Beatnik SF";
  display: inline-block;
  margin-right: 10px;
  position: relative;
  padding: 15px 20px;
  background: #fff;
  cursor: pointer;
  transition: all 0.2s;
}

#nav ul li:hover {
  background: #666;
  color: #fff;
}

#nav ul li ul {
  padding: 0;
  position: absolute;
  top: 48px;
  left: 0;
  width:189px;
  box-shadow: none;
  display: none;
  opacity: 0;
  visibility: hidden;
}

#nav ul li ul li {
  font-size:14px;
  text-align:center;
  background: #555;
  display: block;
  color: #fff;
}

#nav ul li a {
padding:5px;
text-decoration:none;
color:#4c4c4c;
}

#nav ul li a:hover{ text-decoration:none;
  color:#fff;}

#nav ul li ul li:hover{ background: #999; }
#nav ul li:hover ul {
  display: block;
  opacity: 1;
  visibility: visible;
}

#nav ul li ul li a {
  color : #fff;
}

/* latest and hottest game image selection */
p#label{
  margin-top:20px;
  margin-bottom:-10px;
  margin-left:30px;
  color:#4c4c4c;
  text-align:left;
}

div#imgContainer {
  text-align:center;
  border:5px solid #ddd;
  border-radius:10px;
  height:215px;
  width:1350px;
  padding:3px;
  margin:20px;
  background-color:#ddd;
}
div.img {
  display:inline-block;
  padding: 5px;
  border: 7px solid #4c4c4c;
  border-radius:10px;
  height: 190px;
  width: 270px;
  text-align: center;

}

div.img img {
  display: inline;
  text-align:center;
  margin: 5px;
  border: 2px solid #ffffff;
  border-radius:15px;
}

div.img a:hover img {
  border-color: orange;
}

div.description {
  text-align: center;
  font-family: "Beatnik SF";
  font-size : 12px;
  font-weight: bold;
  margin: auto;
}

div.account-container {
  position: absolute;
  left:50px;
  top:40px;
}
ul#acc li{list-style:none;}
ul#acc li ul{color:#fff; display:none; padding:10px; width:189px;}
ul#acc li:hover ul {display : block;}
ul#acc li ul li{display:block; text-align: left;}

div#recent div#top5 {margin-left:60px; border:solid 5px #4c4c4c; border-radius:15px;padding:20px; font-size:20px;}
div#recent div#top5 ul {line-height:2.0;}
div#recent div#top5 ul li{margin-left:20px;list-style-type: inherit; text-align:left; line-height:1.5;}
div#recent div#top5 ul li a{color:#4c4c4c;}
div#recent div#top5{height: auto; width: 40%; float: left; color:#4c4c4c;}
</style>
</head>
<body>
  <div id="container">

    <?php
      //check if cookie exist, and change the login bar
      if(isset($_COOKIE['userName'])){
    ?>
    <div class = "account-container">
      <ul id="acc">
        <li><a href="#"> <?php print("Hi, " . $_COOKIE['userName']); ?> </a>
          <ul>
            <?php
              //check if cookie exist, and change the login bar
              if($_COOKIE['userType'] == "Admin"){
            ?>
            <li ><a href="ReviewsForm.php" title="Add new review">Post review</a></li>
            <li><a href="NewsForm.php" title="Add new news">Post news</a> </li>
            <?php
              }
            ?>
            <li><a href="logout.php" title="Logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <?php
      }
        else{
    ?>
    <a href="login.html" title="Login" style="position:absolute; left:50px; top:40px">&nbsp;Login / Sign Up&nbsp;</a>
    <?php
      }
    ?>

    <p id="search" title="Search" style="position:absolute; right:70px; top:40px">
      <a href="search.php" target = "_blank">
        <img src="s.png" alt="search" width=40 height=40>
        Search
      </a>
    </p>

    <div id="nav" style="position:absolute; left:300px; top:500px; width:1844px; height:136px; z-index:5">

      <ul>
        <li style="border:solid;border-color:#999; border-radius:5px;">
          <a target="" href="mainPage.php">Home</a></li> | &nbsp;
        <li><a target="" href="showAllNews.php">News</a></li> | &nbsp;
        <li><a target="" href="gametype.php">Game Types</a>
          <ul>
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
  </div>
  <br><br>

  <div class='slider autoplay' style="background-color:#4c4c4c;">
    <input name="cs_anchor1" id='cs_slide1_0' type="radio" class='cs_anchor slide'  autocomplete="off">
    <input name="cs_anchor1" id='cs_slide1_1' type="radio" class='cs_anchor slide'  autocomplete="off">
    <input name="cs_anchor1" id='cs_slide1_2' type="radio" class='cs_anchor slide'  autocomplete="off">
    <input name="cs_anchor1" id='cs_slide1_3' type="radio" class='cs_anchor slide'  autocomplete="off">
    <input name="cs_anchor1" id='cs_play1' type="radio" class='cs_anchor' checked autocomplete="off">
    <input name="cs_anchor1" id='cs_pause1_0' type="radio" class='cs_anchor pause' autocomplete="off">
    <input name="cs_anchor1" id='cs_pause1_1' type="radio" class='cs_anchor pause' autocomplete="off">
    <input name="cs_anchor1" id='cs_pause1_2' type="radio" class='cs_anchor pause' autocomplete="off">
    <input name="cs_anchor1" id='cs_pause1_3' type="radio" class='cs_anchor pause' autocomplete="off">

    <ul>
      <div>
        <img src="assasin.jpg" style="width: 100%;">
      </div>
      <li class='num0 img'>
        <img src='assasin.jpg' alt='assasin' title='assasin' />
      </li>
      <li class='num1 img'>
        <img src='farcry4.jpg' alt='FARCRY4' title='FARCRY4' />
      </li>
      <li class='num2 img'>
        <img src='gta5.jpg' alt='gta5' title='gta5' />
      </li>
      <li class='num3 img'>
        <img src='mgsv2.jpg' alt='MGSV2' title='MGSV2' />
      </li>

    </ul>


    <div class='cs_arrowprev'>
      <label class='num0' for='cs_slide1_0'><span><i></i></span></label>
      <label class='num1' for='cs_slide1_1'><span><i></i></span></label>
      <label class='num2' for='cs_slide1_2'><span><i></i></span></label>
      <label class='num3' for='cs_slide1_3'><span><i></i></span></label>
    </div>
    <div class='cs_arrownext'>
      <label class='num0' for='cs_slide1_0'><span><i></i></span></label>
      <label class='num1' for='cs_slide1_1'><span><i></i></span></label>
      <label class='num2' for='cs_slide1_2'><span><i></i></span></label>
      <label class='num3' for='cs_slide1_3'><span><i></i></span></label>
    </div>

    <div class='cs_bullets'>
      <label class='num0' for='cs_slide1_0'>
        <span class='cs_point'></span>
      </label>

      <label class='num1' for='cs_slide1_1'>
        <span class='cs_point'></span>
      </label>

      <label class='num2' for='cs_slide1_2'>
        <span class='cs_point'></span>
      </label>

      <label class='num3' for='cs_slide1_3'>
        <span class='cs_point'></span>
      </label>
    </div>
  </div>



  <br>
  <p id="label">LATEST GAMES:</p>
  <div id="imgContainer">
    <?php
    $i = 0;
      while($rowLatest = mysqli_fetch_row($dataRetrieveLatest)){
      echo "
    <div class='img'>
      <a target='' href='gameDetails.php?game=$rowLatest[0]'><img src='$sqlGetGameURLLat[$i]' alt='$rowLatest[1]' width='250' height='150'></a>
      <div class='description'>$rowLatest[1]</div>
    </div>
    ";
    $i++;
    }
    $i = 0;
    ?>
  </div>
  <p id="label">HOTTEST GAMES:</p>
  <div id="imgContainer">
    <?php
      $i = 0;
      while($rowHottest = mysqli_fetch_row($dataRetrieveHottest)){
      echo "
    <div class='img'>
      <a target='' href='gameDetails.php?game=$rowHottest[0]'><img src='$sqlGetGameURLHot[$i]' alt='$rowHottest[1]' width='250' height='150'></a>
      <div class='description'>$rowHottest[1]</div>
    </div>
    ";
    $i++;
    }
    $i=0;
    ?>
  </div>

  <div id="recent">
    <div id="top5">
      <ul>Recent News:
        <?php
            if($numOfLatestNews)
            while($rowNews = mysqli_fetch_row($dataRetrieveNews)){
                echo "
                  <li>
                    <a target='' href='NewsRetrieve.php?ID=$rowNews[0]'>$rowNews[1] </a></li>
                  ";
                }
        ?>
      </ul>
    </div>
    <div id="top5">
      <ul>Recent Reviews:
        <?php
            if($numOfLatestReview)
            while($rowReview = mysqli_fetch_row($dataRetrieveReview)){
                echo "
                  <li><a target='' href='reviewDetails.php?review=$rowReview[0]'>$rowReview[1]</a></li>
                  ";
                }
        ?>
      </ul>
    </div>
  </div>

    <p></p>
    <p style="position:relative;text-align:left;background-color:#4c4c4c; color:#fff;padding:10px;margin-top : 30%;">&copy; 2015 Gaming Galaxy. All right reserved. Privacy notice.</p>

</body>
</html>
