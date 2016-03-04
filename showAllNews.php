<!DOCTYPE html>
<html>
<head>
  <?php
    include ("config.php");

    //Get the review related info
    $sqlcmdNews = "SELECT newsTitle, newsDate, newsText, account.accountName, news.newsID,imagenews.imageURL FROM imagenews,news,account WHERE imagenews.newsID = news.newsID AND news.accountID = news.accountID GROUP BY news.newsID;";
    $dataRetrieveNews = mysqli_query($dbcon,$sqlcmdNews);
  ?>

<script type = "text/javascript">
  function toNewsPage(x){
    window.location = x;
  }
</script>

<title>News - Gaming Galaxy</title>
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
      <li style="border:solid;border-color:#999; border-radius:5px;"><a target="" href="NewsRetrieve.php">News</a></li> | &nbsp;
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
      <li><a target="" href="showAllReview.php">Reviews</a></li> | &nbsp;
      <li><a target="" href="contactus.html">Contact Us</a></li>
    </ul>
  </div>
</div>

<?php
  while($rowNews = mysqli_fetch_row($dataRetrieveNews)){
    $title = $rowNews[0];
    if (strlen($rowNews[0]) > 30){
      $title = substr($rowNews[0],0,30).'...';
    }

    $text = $rowNews[2];
    if (strlen($rowNews[2]) > 200){
      $text = substr($rowNews[2],0,197)."...";
    }
    $url = "NewsRetrieve.php?ID=$rowNews[4]";

    $date = substr($rowNews[1],0,10);
    echo "
    <p id = 'url' style ='font-size : 0px;'>$url</p>";?>
    <div class='container' onclick = "toNewsPage('<?php echo $url;?>')">
      <h2 style='margin-bottom:-1px;'><?php echo $title;?></h2>
      <a><img src='<?php echo $rowNews[5];?>' alt='<?php echo $rowNews[0]?>' width='310' height='190'></a>
      <p style='margin-top:-3px; margin-left:50px; text-align:left;'>by <?php echo $rowNews[3];?><span style='margin-left:130px;'><?php echo $date;?></span></p>
      <div class='desc'><p><?php echo $text;?></p></div>
      <?php
      echo "
    </div>
    ";
}
?>
<p></p>
</body>
</html>
