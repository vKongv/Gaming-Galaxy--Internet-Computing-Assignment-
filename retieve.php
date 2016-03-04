<html>
<head>
<title>Retrieve data from database </title>
<link rel="stylesheet" href="styling.css" type="text/css">
</head>
<body>


<?php

$hostname = "localhost";
$username ="root";
$password = "";

//connect to database
$database = mysql_connect($hostname, $username, $password);


if(!$database){
    die('Could Not Connect: ' . mysql_error());
}

//select database
$db_selected = mysql_select_db("review",$database)
    or die("Could Not Connect");


$result= mysql_query("SELECT * FROM review ");



while($row = mysql_fetch_array($result))
{
    echo '<div >';
    echo '<br/>';
    echo 'GameName :'.$row['GameName'].'<br/>';
    echo 'AuthorName :'.$row['AuthorName'].'<br/>';
    echo 'Articles :'.$row['Articles'].'<br/>';
    echo 'Rating :'.$row['Rating'].'/5'.'<br/>';
    echo 'Date :'.$row['Date'].'<br/>';
    echo '<br/>';
    echo '</div>';


}
mysql_close($database);


//close the connection


?>

</body>
</html>
