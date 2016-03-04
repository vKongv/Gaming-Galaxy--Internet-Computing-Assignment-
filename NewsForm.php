<html>
<head>
	<?php

		if(isset($_COOKIE["userName"])){
		include ("config.php");
		$sqlcmd = "SELECT gameName, gameID FROM game;";
		$dataRetrieve = mysqli_query($dbcon,$sqlcmd);
		$numOfRows = mysqli_num_rows($dataRetrieve);
	}
	?>
<title>Post a News - Gaming Galaxy</title>
<link rel="stylesheet" type="text/css" href="css/form.css"> 
</head>
<body>
	<a target="" href="mainPage.php" style="margin:20px;text-decoration:none; color:#fff; font-size:20px;">&lt;&nbsp;Back</a>
	<?php if(isset($_COOKIE['userName'])){
				if($_COOKIE['userType'] == "Admin"){
	?>
	<h1 style="text-align:center;">New post to add...</h1>
	<form id = "submitPost" action = "NewsUploadNews.php" method = "post" enctype = "multipart/form-data">
	    <div id="container">
				<p>Enter Title:
		    <input type = "text" name = "newsTitle" size="120pt" maxlength = "255" style = "margin-right : 100px; font-size:16px;"></p><br/><br/>

				Choose Game Name:
				<select name = "newsGameName" style="font-size:16px;">
					<option selected disabled value = "">---Choose Your Game Name---</option>
					<?php
						while($rows = mysqli_fetch_row($dataRetrieve)){
					?>
						<option value = "<?php echo $rows[0];?>"><?php echo $rows[0];?></option>
					<?php
					}
					?>

				</select>
				<br/><br/>

		    <p>Enter Text:</p>
		    <textarea name = "newsText" rows = "12" cols = "120"
				style="background-color:#eee;border-radius:10px;font-size:16px;line-height:1.5;"></textarea>
		     <br/>

			<p>Select image(s) to upload:
		    <input type = "file" name = " newsImages[]" multiple="multiple" accept="image/*"></p>
		</div>

	    <input type = "hidden" value = "newsID">
	    <input type = "submit" name = "submit" value = "Post" style="font-size:20px;margin-left:80%; margin-top:-130px;">
				<input type = "hidden" name = "accountID" value = "<?php echo $_COOKIE['userID'];?>">
	</form>

	<?php
		}
		elseif ($_COOKIE['userType'] == "User"){
	?>
		<div id = "errorMessage">
		<h2> Only admin is allowed to post review/news. </h2>
	</div>
	<?php
		}
	}
		else {
	?>
	<div id = "errorMessage">
			<h2> Please <a href="login.html">Login </a> as admin to post review/news. If you are not admin, you are not allowed to post review/news </h2>
	</div>
	<?php
		}
	?>

	<p style="font-size:16px;background-color:#4c4c4c; color:#fff;padding:10px;">&copy; 2015 Gaming Galaxy. All right reserved. Privacy notice.</p>

</body>
</html>
