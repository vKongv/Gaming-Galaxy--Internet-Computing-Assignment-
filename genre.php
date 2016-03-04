<!DOCTYPE html>
<html>
<head>
  <?php
    include ("config.php");
    if(isset($_GET["genre"])){
    $sqlcmd = "SELECT gameName,gameID FROM game WHERE gameGenre = '$_GET[genre]';";
    $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
    $numOfRows = mysqli_num_rows($dataRetrieve);
    $genre = "";
    for($i = 0; $i < strlen($_GET["genre"]); $i++){
      $genre = $genre . " " . substr($_GET["genre"],$i,1);
      $genre = strtoupper($genre);
    }
  }
  ?>
  <meta charset="utf-8">
  <title>Action</title>
  <style type="text/css">
  body{
    font-family:"Beatnik SF";
    color:#ddd;
    background-image:url("background.jpg");
    background-size:100%;
  }

  p#title{
    margin-top:30px;
    text-align:center;
    font-size:50px;
    font-weight:bold;
  }
  p#desc{
    margin:0 80px;
    text-align:center;
    width:90%;
    font-family:"calibri";
    font-size:20px;
    line-height:2.0;
  }
  h3{
    margin:20px 80px;
    font-size:25px;
  }
  ul li{margin-left:50px;}
  ul span
  {
    float:left;
  }
  ul span li a
  {
    font-size : 20px;
    font-family : "Calibri";
    text-decoration : none;
    color : #ddd;
  }
  ul span li a:hover
  {
    text-decoration : underline;
  }
  ul span li a:visited
  {
    color : #ddd;

  }

  </style>
</head>
<body>
  <br>
  <a target="" href="gametype.php" style="margin:20px;text-decoration:none; color:#fff; font-size:20px;">&lt;&nbsp;Back</a>
  <p id="title"><?php echo $genre; ?></p>
  <h3>List of <?php echo $_GET["genre"]?> Games:</h3>
  <?php
      $max = 0;
      while(true){

        if($max < $numOfRows){
  ?>
    <ul>
  <?php
      while($rows = mysqli_fetch_row($dataRetrieve)){
        if($max == 0 || $max % 3 != 0){
        if($max % 4 == 0){

  ?>
    <span style = "margin-left : 20%;"><li><a href = "gameDetails.php?game=<?php echo $rows[1];?>"><?php echo $rows[0];?></a></li></span>
    <?php
  }else{
    ?>
    <span><li><a href = "gameDetails.php?game=<?php echo $rows[1];?>"><?php echo $rows[0];?></a></li></span>

    <?php
  }}
    $max ++;
  }
  ?>
</ul>
<?php
}
else{
  break;
}
}
?>




</body>
</html>
