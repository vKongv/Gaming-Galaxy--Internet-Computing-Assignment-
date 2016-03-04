<!DOCTYPE html>
<html>
<head>
  <?php
    include("config.php");
    $sqlcmd = 'SELECT imageURL from image WHERE imageID = "I100001"';
    $dataRetreive = mysqli_query($dbcon,$sqlcmd);
    $row = mysqli_fetch_row($dataRetreive);
  ?>
</head>
<body>

<form action ="uploadImage.php" method = "post" enctype = "multipart/form-data">
  Select image to upload:
    <input type = "file" name = "image" id = "image">
    <input type = "submit" value = "Upload Image" name = "submit">
</form>
<img src = '<?php echo $row[0]; ?>' width = "200px" height = "100px" alt ="imageOfDB">
</body>
</html>
