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
<title>Post a review - Gaming Galaxy</title>
<link rel="stylesheet" type="text/css" href="css/form.css"> 
</head>
<body>
	<a target="" href="mainPage.php" style="margin:20px;text-decoration:none; color:#fff; font-size:20px;">&lt;&nbsp;Back</a>
	<?php if(isset($_COOKIE['userName'])){
				if($_COOKIE['userType'] == "Admin"){
	?>
	<h1 style="text-align:center;">New review to add...</h1>
	<form id = "submitPost" action = "reviewsUpload.php" onsubmit ="return validateInput()" method = "post" enctype = "multipart/form-data">
	    <div id="container">
				<p>Enter Title:
		    <input type = "text" id = "reviewTitle" name = "reviewTitle" style = "font-size:16px; width:400px; padding:5px;"> (Required)</p>

				Choose Game Name:
				<select id = "reviewGameName" name = "reviewGameName" style="font-size:16px;">
					<option selected disabled value = "">---Choose Your Game Name---</option>
					<?php
						while($rows = mysqli_fetch_row($dataRetrieve)){
					?>
						<option value = "<?php echo $rows[0];?>"><?php echo $rows[0];?></option>
					<?php
					}
					?>

				</select> (Required)
				<br/><br/>

				<p>Enter Reviews:</p>
		    <textarea id = "reviewText" name = "reviewText" rows = "12" cols = "120"
				style="background-color:#eee;border-radius:10px;font-size:16px;line-height:1.5;"></textarea> (Required)
		     <br/>
				 <br/>

				Enter rating:
				<select name = "rating" style="font-size:16px;">
					<option selected value ="1"> 1 </option>
					<option value ="2"> 2 </option>
					<option value ="3"> 3 </option>
					<option value ="4"> 4 </option>
					<option value ="5"> 5 </option>
				</select> (Required)

			<p>Select image(s) to upload:
		    <input type = "file" name = "reviewImages[]" multiple="multiple" accept="image/*"></p>

		</div>

	    <input type = "submit" name = "submit" value = "Post" style="font-size:20px;margin-left:80%; margin-top:-130px;">
			<input type = "hidden" name = "accountID" value = "<?php echo $_COOKIE['userID'];?>">
			<p style ="color : red; font-size : 20px;">* = required field. </p>
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

<script type = "text/javascript">
	function validateInput() {
		var title = document.forms["submitPost"]["reviewTitle"].value;
		var reviewText = document.forms["submitPost"]["reviewText"].value;
		var gameName = document.forms["submitPost"]["reviewGameName"].value;

		//Check title
		if(title == null || title == ""){
			alert ("Title is required.");
			return false;
		}

		if(gameName == null || gameName == "" || gameName == "---Choose Your Game Name---"){
			alert ("Please choose game.");
			return false;
		}

		if(reviewText == null || reviewText == "" || reviewText.length <= 50){
			alert ("Please type more than 50 words in review text.");
			return false;
		}


		return true;
	}
</script>
</body>
</html>
