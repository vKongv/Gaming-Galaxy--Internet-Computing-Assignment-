<?php
  include ("config.php");

  $target_dir = "image/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  if(isset($_POST["submit"])){
    //$check = getimaesize($_FILES["image"]["tmp_name"]);
      //if(check !== false){
          //echo "File is an image - " . $check["mime"] . ".";
          //$uploadOk = 1;
        //}
        //else{
        //  echo "File is not an image";
        //  $uploadOk = 0;
        //}
    //  }

      if($uploadOk == 0){
        echo "Sorry, your file was not uploaded.";
      }
      else{
        if (move_uploaded_file($_FILES["image"]["tmp_name"],$target_file)){
          echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
          $sqlcmd = "INSERT INTO image (imageID,imageURL) VALUES ('I100001','$target_file')";
          $dataRetreive = mysqli_query($dbcon,$sqlcmd);
        }
        else{
          echo "Sorry, there was an error uploading your file.";
        }
      }
    }
?>
