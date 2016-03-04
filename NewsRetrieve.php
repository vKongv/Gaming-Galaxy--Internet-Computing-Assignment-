<?php
include ("config.php");

//Initial data
$newsID = $_GET['ID'];
$imageURL = array();

$target_images = 'SELECT imageURL FROM imagenews';
$dataRetreive = mysqli_query($dbcon, $target_images);

//Increase the newsHit by 1
$sqlcmd = "UPDATE news SET newsHit = newsHit + 1 WHERE gameID = '$_GET[ID]';";
$dataRetrieve = mysqli_query($dbcon,$sqlcmd);

//get news' data
$sqlcmd = "SELECT * FROM news WHERE newsID = '$newsID'";
$dataRetreive = mysqli_query($dbcon, $sqlcmd);
$row = mysqli_fetch_row($dataRetreive);
$newsTitle = $row[1];
$newsDate = $row[2];
$newsText = $row[3];
$accountID = $row[4];
$newsHit = $row[6];

//seperate date with time
$date = substr($newsDate, 0, 10);
$time = substr($newsDate, 11, -3);

echo "<html>
<head>
<title> $newsTitle </title>";
?>
<link rel = 'stylesheet' href = 'NewsRetrieveStyle.css' type = 'text/css'>
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

<?php
//get account's data
$sqlcmd = "SELECT accountName FROM account WHERE accountID = '$accountID'";
$dataRetreive = mysqli_query($dbcon, $sqlcmd);
$row = mysqli_fetch_row($dataRetreive);
$accountName = $row[0];

//get title image by URL
$sqlcmd = "SELECT imageURL FROM imagenews WHERE newsID = '$newsID'";
$dataRetreive = mysqli_query($dbcon, $sqlcmd);
for($currentRow = 0; $row = mysqli_fetch_assoc($dataRetreive) ; $currentRow++){
	if (!$row){
		$imageURL[$currentRow] = "sysimage/noimg.jpg";
	}
	else{
		$imageURL[$currentRow] = $row["imageURL"];
	}
}

//Title
echo "<div id='newsDetail'>";
echo "<table>
		<tr>
        <td valign='top'><a class = 'news-Title'>$newsTitle</a></td>
        </tr>

		<tr>
		<td>by $accountName on $date" . str_repeat('&nbsp;', 160 - strlen($accountName)) . "Current visitor: $newsHit</td>
		</tr>

		</table>";

//Title image
echo "<p style = 'text-align: center'><img src = " . $imageURL[0] . " alt = 'Title Image' height = 390px width = 500px></p>
		</div>";

//news
echo "<div id = 'newsText'>
	  <h2>News: </h2>
	  $newsText
	  </div>";

//images
echo "<div id = 'newsImages'>";

for($currentRow = 1; $currentRow < sizeof($imageURL); $currentRow++){
echo "
      <span>
      <a>
		<img src = '$imageURL[$currentRow]' alt='' >
      </a>
      </span>
      ";
}

for($i = 5 ; $i >= sizeof($imageURL); $i--){
echo "
      <span>
      <a>
        <img src = 'image/noimg.jpg' alt='' >
      </a>
      </span>
      ";
}
echo "</div>";
?>

</body>
</html>
