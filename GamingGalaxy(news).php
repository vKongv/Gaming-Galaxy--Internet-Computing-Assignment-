<!DOCTYPE html>
<html>

<head><meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
<meta charset = "utf-8" content = "text/html">
<title>News - Gaming Galaxy</title>
<style type = "text/css">
div#header
{
	position: relative;
	margin-top: 0px;
	margin-left: auto;
	margin-right: auto;
	text-align: left;
}
div#contain
{
	position: relative;
	top:180px;
	left:30px;
	width:1350px;
	height:2375px;
	border:1px solid #000;
	text-align: left;
}
body
{
	background-image:url('background.jpg');
	background-repeat:no-repeat;
	background-size:30%;
	background-position: 50% 10%;
	background-color: #393939;
	text-align: center;
	margin: 0;
}
</style>

<style type="text/css">
a, p
{
	font-family: "Beatnik SF";
	font-size: 21px;
	//color: #00BFFF;
	text-decoration: none;
}
a:visited
{
	color: #00BFFF;
}
a:active
{
	color: #00BFFF;
}
a:hover
{
	color: #00BFFF;
	text-decoration: underline;
}
p, span, div, ol, ul, li, input, textarea, form
{
	margin: 0;
	padding: 0;
}
</style>
<style type = "text/css">
#nav
{
	color: #00BFFF;
	font-family: "Beatnik SF";
	font-size: 21px;
	font-weight: normal;
	font-style: normal;
	margin: 0;
	padding: 0;
}
#nav a
{
	margin : 30px;
	color: #00BFFF;
	text-decoration: none;
}
#nav a:hover
{
	color: #00BFFF;
	text-decoration: underline;
}
#nav span
{
	margin: 0px 7px 0px 0px;
}
</style>
</head>

<body>
<!-- header -->
<div id = "header">

  <a href = "" title="Login" style = "position:absolute; top:40px; left:50px">Login / Sign Up</a>

  <p title = "Search" style = "position:absolute; right:50px; top:40px">Search:
    <input type="text" name="search" style="color:orange; font-size:16px; background-color:#FFFFFF;
     padding:5px; opacity: 0.5">
  </p>

  <div id="nav" style = "position:absolute; top:100px; left:300px;  width:1844px; height:136px;z-index:1">

    <span><a href="" title="News">News</a>          |</span>
    <span><a href="" title="Platforms">Platforms</a>          |</span>
    <span><a href="" title="Game Types">Game Types</a>          |</span>
    <span><a href="" target="_blank" title="Reviews">Reviews</a>          |</span>
    <span><a href="" title="Contact Us">Contact Us</a></span>
  </div>
  <span><a href="" title="Post" style = 'position:absolute; top:150px; right:80px'>New post</a></span>
</div>

<!-- contain -->
<div id = "contain">
<?php
include ("config.php");

//initial data
$newsTitle = array();
$newsText = array();

$accountName = array();

$newsID = array();
$imageURL = array();

//box count
$newsBox = array();

//get number of news
$sqlcmd = 'SELECT COUNT(*) FROM news';
$dataRetreive = mysqli_query($dbcon, $sqlcmd);
$row = mysqli_fetch_row($dataRetreive);
$rowNumber = $row[0];

//get news' data
$sqlcmd = 'SELECT * FROM news';
$dataRetreive = mysqli_query($dbcon, $sqlcmd);
for($currentRow = 0; $result = mysqli_fetch_assoc($dataRetreive); $currentRow++) {
	$newsTitle[$currentRow] = $result["newsTitle"];
	$newsText[$currentRow] = $result["newsText"];
	$newsID[$currentRow] = $result["newsID"];
}

//get accounts' data
$sqlcmd = 'SELECT accountName FROM account, news WHERE account.accountID = news.accountID';
$dataRetreive = mysqli_query($dbcon, $sqlcmd);
for($currentRow = 0; $result = mysqli_fetch_assoc($dataRetreive); $currentRow++) {
	$accountName[$currentRow] = $result["accountName"];
}

//get title image by URL
for ($currentRow = 0; $currentRow < sizeof($newsID); $currentRow++){
	$sqlcmd = "SELECT imageURL FROM imagenews WHERE newsID = '$newsID[$currentRow]'";
	$dataRetreive = mysqli_query($dbcon, $sqlcmd);
	$row = mysqli_fetch_row($dataRetreive);

	if (!$row){
		$imageURL[$currentRow] = "";
	}
	else{
		$imageURL[$currentRow] = $row[0];
	}
}

for($topD = 35, $currentRow = 0; $currentRow < $rowNumber; $topD = $topD + 550){
	for($leftD = 35; $leftD <= 715; $leftD = $leftD + 680){
		if ($currentRow >= $rowNumber){
			continue;
		}

		echo "<p><div id = newsBox[$currentRow] style = 'position:absolute; top:" . $topD . "px; left:" . $leftD . "px; width:600px; height:500px; border:1px solid #000;'>
		<img src = " . $imageURL[$currentRow] . " alt = 'Title Image' style = 'position:relative; left:200px; height:150px; width:200px'>
		<br/>" . str_repeat('&nbsp;', 5) . " Title: $newsTitle[$currentRow]" . str_repeat('&nbsp;', 50) . " Writer: $accountName[$currentRow]<br/><br/>
		<p style = 'resize: none; position:absolute; top:190px; left:5px; width:590px; height:300px; background-color: transparent; border: 0px solid #000000;'>" .
		$newsText[$currentRow] . "
		</p>
		<div> Hello </div>
	</div></p>";

		$currentRow++;
	}
}

echo "<input type = 'hidden' value = 'newsBox'>";
?>
</div>

</body>
</html>
