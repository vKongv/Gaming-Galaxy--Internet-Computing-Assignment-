<!DOCTYPE html>
<html>
<head>
  <?php
    include ("config.php");

    //Get the review related info
    $sqlcmdReview = "SELECT reviewTitle, reviewDate, reviewText, account.accountName, review.reviewID,imagereview.imageURL, game.gameRating,game.gameUserRating FROM imagereview, review, game,account WHERE imagereview.reviewID = review.reviewID AND review.accountID = account.accountID AND review.gameID = game.gameID GROUP BY review.reviewID";
    $dataRetrieveReview = mysqli_query($dbcon,$sqlcmdReview);
  ?>

<script type = "text/javascript">
  function toReviewPage(x){
    window.location = x;
  }
</script>

<title>Review - Gaming Galaxy</title>
<style type="text/css">
body{font-family:"Beatnik SF";}
#nav{
  color: #4C4C4C;
  font-family: "Beatnik SF";
  font-size: 21px;
  padding: 0;
  position:relative;
  margin-top:20px;
  text-align:center;
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

#nav ul li a:hover { text-decoration:none;
    color:#fff;}

#nav ul li ul li:hover { background: #999; }
#nav ul li:hover ul {
      display: block;
      opacity: 1;
      visibility: visible;
}
#nav ul li ul li a{text-decoration:none; color:#fff;}

div.container {
  margin: 15px;
  padding: 5px;
  border: 7px solid #4c4c4c;
  border-radius:10px;
  height: 400px;
  width: 400px;
  float: left;
  text-align: center;
  cursor : pointer;
}
div.container:hover{border-color:orange;}
div.container a,  div.container a:active,

div.container a:visited{text-decoration:none;}

div.container img {
  display: inline;
  margin: 5px;
  border: 1px solid #ffffff;
  border-radius:10px;
}

div.desc {
  text-align: left;
  font-weight: normal;
  margin-left: 50px;
  width : 300px;
}
</style>
</head>
<body>
  <div id="nav">
    <ul>
      <li>  <a target="" href="mainPage.php">Home</a></li> | &nbsp;
      <li><a target="" href="showAllNews.php">News</a></li> | &nbsp;
      <li>
      <a target="" href="gametype.php">Game Types</a>
      <ul style='width:183px;'>
          <li><a href="genre.php?genre=Action">Actions</a></li>
          <li><a href="genre.php?genre=Racing">Racing</a></li>
          <li><a href="genre.php?genre=Shooting">Shooting</a></li>
          <li><a href="genre.php?genre=Sports">Sports</a></li>
          <li><a href="genre.php?genre=Strategey">Strategy</a></li>
          <li><a href="genre.php?genre=Survival">Survival</a></li>
        </ul>
      </li> | &nbsp;
      <li style="border:solid;border-color:#999; border-radius:5px;"><a target="" href="showAllReview.php">Reviews</a></li> | &nbsp;
      <li><a target="" href="contactus.html">Contact Us</a></li>
    </ul>
  </div>
</div>

<?php
  while($rowReview = mysqli_fetch_row($dataRetrieveReview)){
    $index = 0;
    $title = $rowReview[0];
    if (strlen($rowReview[0]) > 30){
      $title = substr($rowReview[0],0,30).'...';
    }

    $text = $rowReview[2];
    if (strlen($rowReview[2]) > 200){
      $text = substr($rowReview[2],0,197)."...";
    }
    $url = "reviewDetails.php?review=$rowReview[4]";

    $date = substr($rowReview[1],0,10);
    echo "
    <p id = 'url' style ='font-size : 0px;'>$url</p>";?>
    <div class='container' onclick = "toReviewPage('<?php echo $url;?>')">
      <h2 style='margin-bottom:-1px;'><?php echo $title;?></h2>
      <a><img src='<?php echo $rowReview[5];?>' alt='<?php echo $rowReview[0]?>' width='310' height='190'></a>
      <p style='margin-top:-3px; margin-left:50px; text-align:left;'>by <?php echo $rowReview[3];?><span style='margin-left:130px;'><?php echo $date;?></span></p>
      <p style='margin-left:50px; text-align:left; line-height:1.0;'>Our rating: <?php echo $rowReview[6];?>/5 &nbsp;&nbsp;&nbsp; User rating: <?php echo $rowReview[7];?>/5</p>
      <div class='desc'><p><?php echo $text;?></p></div>
      <?php
      echo "
    </div>
    ";
  $index ++;
}
?>
<p></p>
</body>
</html>
