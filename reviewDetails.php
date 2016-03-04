<html>
<head>
  <?php
    include ("config.php");
    if(isset($_GET['review'])){
      //Increase the reviewHit by 1
      $sqlcmd = "UPDATE review SET reviewHit = reviewHit + 1 WHERE reviewID = '$_GET[review]';";
      $dataRetrieve = mysqli_query($dbcon,$sqlcmd);

      //Get the review related info
      $sqlcmdReview = "SELECT reviewTitle, reviewDate, reviewText, account.accountName, review.gameID, review.reviewID,account.accountID FROM review, game,account WHERE review.accountID = account.accountID AND review.gameID = game.gameID AND reviewID = '$_GET[review]';";
      $dataRetrieveReview = mysqli_query($dbcon,$sqlcmdReview);
      $rowReview = mysqli_fetch_row($dataRetrieveReview);

      //Get the image info
      $sqlcmdImage = "SELECT imageURL FROM review,imagereview WHERE imagereview.reviewID = review.reviewID AND review.reviewID = '$_GET[review]' LIMIT 6;";
      $dataRetrieveImage = mysqli_query($dbcon,$sqlcmdImage);
      $numOfImage = mysqli_num_rows($dataRetrieveImage);
      $rowImage = mysqli_fetch_row($dataRetrieveImage);
      $imageURLMain = "sysimage/noimg.jpg";

      //Get related comment
      $sqlcmdComment = "SELECT commentText, commentDate, account.accountName FROM comment, review,account WHERE comment.reviewID = review.reviewID AND comment.accountID = account.accountID AND comment.reviewID = '$_GET[review]' ORDER BY comment.commentDate DESC;";
      $dataRetrieveComment = mysqli_query($dbcon,$sqlcmdComment);
      $numOfComment = mysqli_num_rows($dataRetrieveComment);
    }
    else{
      header('Location: mainPage.php');
    }
  ?>

  <title>Review - <?php echo $rowReview[0]?></title>
<style type='text/css'>
body{
  font-family:'Beatnik SF';
}
#nav{
  color: #4C4C4C;
  font-family: 'Beatnik SF';
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
  font:20px 'Beatnik SF';
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
  color:#4c4c4c;}

#nav ul li a:hover { text-decoration:none;
    color:#fff;}

#nav ul li ul li:hover { background: #999; }
#nav ul li:hover ul {
      display: block;
      opacity: 1;
      visibility: visible;
    }
#nav ul li ul li a{text-decoration:none; color:#fff;}

div#gamedetail p{font-size:30px; font-weight:bolder;}
div#gamedetail img{border:double 30px;border-radius:15px;}
div#gamedetail{
  font-family:'Beatnik SF';
  font-size:20px;
  color:#4c4c4c;
  padding:10px;
  text-align:center;
}
div#gamedetail a:hover p:hover{text-decoration:underline;}
div#gamedetail p.small-size-author
{
  font-weight: normal;
  font-size:14px;
  font-family:"Calibri";
}

div#gamephoto
{
  padding-left: 30px;
  border : 3px solid;
  border-radius : 20px;
  margin-top: 20px;
  margin-bottom : 20px;
}

div#gamephoto h2
{
  font-family:"Calibri";
  font-size: 30px;
}
div#gamephoto span {margin-left:17px;}
div#gamephoto span a img{
  display: inline;
  text-align:center;
  height:138;
  width:238;
  margin: 5px;
  margin-right:10px;
  border: 3px solid #ddd;
  border-radius:15px;
}

div#gamephoto span a,div#gamephoto span a:hover, div#gamephoto span a:active,
div#gamephoto span a:visited
{
  cursor : default;
  text-decoration:none;
}

div#review
{
  margin: 20 px;
  padding-left: 30px;
  border-radius:20px;
  border:3px solid;
}
div#comment{text-align:center;}
div#commented{
  line-height:1.5;
  margin:10px 50px;
  background-color:#4c4c4c;
  width: auto;
  height:auto;
  padding:20px;
  color:#fff;
  border-radius:20px;
  border:double 15px;
}

h2
{
  font-family: "Calibri";
  font-size: 30px;
}

</style>
</head>
<body>
  <div id='nav'>

    <ul>
      <li><a target='' href='mainPage.php'>Home</a></li> | &nbsp;
      <li><a target='' href='showAllNews.php'>News</a></li> | &nbsp;
      <li>
        <a target='' href='gametype.php'>Game Types</a>
        <ul style='width:183px;'>
          <li><a href="genre.php?genre=Action">Actions</a></li>
          <li><a href="genre.php?genre=Racing">Racing</a></li>
          <li><a href="genre.php?genre=Shooting">Shooting</a></li>
          <li><a href="genre.php?genre=Sports">Sports</a></li>
          <li><a href="genre.php?genre=Strategey">Strategy</a></li>
          <li><a href="genre.php?genre=Survival">Survival</a></li>
        </ul>
      </li> | &nbsp;
      <li><a target='' href='showAllReview.php'>Reviews</a></li> | &nbsp;
      <li><a target='' href='contactus.html'>Contact Us</a></li>
    </ul>
  </div>

  <div id='gamedetail'>
    <?php
    $reviewDate = substr($rowReview[1],0,10);
    echo"
    <a target'' href='gameDetails.php?game=$rowReview[4]' style='text-decoration:none; color:#4c4c4c;'>
      <p style='background-color:#ddd;padding:20px;'>$rowReview[0]</p>
    </a>
    <p class='small-size-author'>By $rowReview[3] on $reviewDate</p>";
    if ($numOfImage > 0){
      echo"
      <img width=580px height=300px src ='$rowImage[0]'>
      ";
    }
    ?>
    <br><br>
  </div>


  <?php
    echo "
    <div id='review'>
      <p style='font-size:30px; font-family: Calibri; text-align: left;'><strong>Review:</strong></p>
      <p style='font-size:18px; font-family: Calibri; font-weight: normal;'>$rowReview[2]</p>
    </div>
    ";
  ?>

  <div id='gamephoto'>
    <h2> Gallery: </h2>
    <?php
      if($numOfImage > 1) {
        while($rowImage = mysqli_fetch_row($dataRetrieveImage)){
          echo "
            <span>
              <a target='' href=''>
                <img src='$rowImage[0]' alt='$rowReview[0]' >
              </a>
            </span>
          ";
        }
      }
      else{
        echo "
            <h2 style='text-align:center;'>------- No image available -------</h2>
        ";
      }
    ?>
  </div>

  <br><br>
  <div style='background-color:#ddd;padding:30px;'>
    <h2> Comment: </h2>
    <?php
      if($numOfComment > 0){
        while($rowComment = mysqli_fetch_row($dataRetrieveComment)){
          echo "
            <div id='commented'>
              <p><span><strong>$rowComment[2]</strong></span><span style='margin-left:80%'>$rowComment[1]</span></p>
              <span><p>$rowComment[0]</p></span>
            </div>
            ";
          }
    }
    else {
      echo "
        <h2 style='text-align:center;'> ------- No Comment in this post -------  </h2>
      ";
    }
    ?>
  </div>
  <br><br>

  <form id = 'commentForm' action='review.php' onsubmit='return validateComment()' method='post'>
    <?php
      //check if cookie exist, and change the login bar
      if(isset($_COOKIE['userName'])){
        echo "
              <div id='comment'>
                  <p style='margin-top:-15px;'><textarea style='font-size:14px;'name='comments' id='comments' rows='5' cols='160'
                    placeholder='Type your comment here. '></textarea>
                    <input style='margin-left:83%;' id= 'submitComment' name = 'submitComment' type='submit' value='Submit' />
                    <input type='hidden' value='$rowReview[5]' name ='reviewID'/>
                    <input type='hidden' value='$_COOKIE[userID]' name ='accountID'/>
                  </p>
                </div>


  ";
  ?>
  <?php
    } else{
      echo"
        <h3 style='text-align:center;'> Please <a href='login.html'>Login </a> to comment </h2>
        ";
      }
  ?>
</form>

<br><br>

<p></p>

</script>
</body>
</html>
