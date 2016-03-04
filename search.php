<!DOCTYPE HTML>
<html>
<head>
<meta charset= "utf-8" content="text/html">
<title>Search - Gaming Galaxy</title>
<link rel="stylesheet" type="text/css" href="loginNsearch.css">

<script>
  function redirectToGamePage(x){
    alert(x);
    window.location = x;
  }
</script>

<?php
  include("config.php");
  $searchall = "";
  $numOfRows = 0;
  $numOfNews = 0;
  if(isset($_GET['searchButton'])){
    $upperGameName = strtoupper($_GET["searchName"]);
    $searchpost = $_GET['searchPost'];
    $searchword = $_GET['searchWord'];
    $searchall = "all";
    if($searchword == "exact"){
      if ($searchpost == "game"){
        $sqlcmd = "SELECT imageURL, gameName ,gameGenre, gameRating, gameDescription,gameReleaseDate,gameUserRating, game.gameID FROM game, imagegame WHERE game.gameID = imagegame.gameID AND (game.gameName = '$upperGameName')  GROUP BY imagegame.gameID;";
        $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
        //Get the total number of row for LOOP
        $numOfRows = mysqli_num_rows($dataRetrieve);

        $searchall = "game";
      }
      elseif ($searchpost == "news"){

        $sqlcmdNews = "SELECT imageURL, newsTitle ,newsDate, accountName,news.newsID FROM game, news, imagenews,account WHERE news.gameID = game.gameID AND news.newsID = imagenews.newsID AND news.accountID = account.accountID AND (game.gameName = '$upperGameName') GROUP BY imagenews.newsID; ;";
        $dataRetrieveNews = mysqli_query($dbcon,$sqlcmdNews);
        $numOfNews = mysqli_num_rows($dataRetrieveNews);

        $searchall = "news";
      }
      elseif ($searchpost == "review"){
        $sqlcmdReview = "SELECT imageURL, reviewTitle ,reviewDate, accountName,review.reviewID FROM game, review, imagereview,account WHERE review.gameID = game.gameID AND review.reviewID = imagereview.reviewID AND review.accountID = account.accountID AND (game.gameName = '$upperGameName') GROUP BY imagereview.reviewID; ;";
        $dataRetrieveReview = mysqli_query($dbcon,$sqlcmdReview);
        $numOfReview = mysqli_num_rows($dataRetrieveReview);

        $searchall = "review";
      }
      else {
        $sqlcmd = "SELECT imageURL, gameName ,gameGenre, gameRating, gameDescription,gameReleaseDate,gameUserRating, game.gameID FROM game, imagegame WHERE game.gameID = imagegame.gameID AND (game.gameName = '$upperGameName')  GROUP BY imagegame.gameID;";
        $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
        //Get the total number of row for LOOP
        $numOfRows = mysqli_num_rows($dataRetrieve);

        $sqlcmdNews = "SELECT imageURL, newsTitle ,newsDate, accountName,news.newsID FROM game, news, imagenews,account WHERE news.gameID = game.gameID AND news.newsID = imagenews.newsID AND news.accountID = account.accountID AND (game.gameName = '$upperGameName') GROUP BY imagenews.newsID; ;";
        $dataRetrieveNews = mysqli_query($dbcon,$sqlcmdNews);
        $numOfNews = mysqli_num_rows($dataRetrieveNews);

        $sqlcmdReview = "SELECT imageURL, reviewTitle ,reviewDate, accountName,review.reviewID FROM game, review, imagereview,account WHERE review.gameID = game.gameID AND review.reviewID = imagereview.reviewID AND review.accountID = account.accountID AND (game.gameName = '$upperGameName') GROUP BY imagereview.reviewID; ;";
        $dataRetrieveReview = mysqli_query($dbcon,$sqlcmdReview);
        $numOfReview = mysqli_num_rows($dataRetrieveReview);
      }
    }
    elseif ($searchword == "any"){
      if ($searchpost == "game"){
        $sqlcmd = "SELECT imageURL, gameName ,gameGenre, gameRating, gameDescription,gameReleaseDate,gameUserRating, game.gameID FROM game, imagegame WHERE game.gameID = imagegame.gameID AND (game.gameName = '$upperGameName' OR game.gameName LIKE '%$upperGameName' OR game.gameName LIKE '$upperGameName%' OR game.gameName LIKE '%$upperGameName%')  GROUP BY imagegame.gameID;";
        $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
        //Get the total number of row for LOOP
        $numOfRows = mysqli_num_rows($dataRetrieve);

        $searchall = "game";
      }
      elseif ($searchpost == "news"){
        $sqlcmdNews = "SELECT imageURL, newsTitle ,newsDate, accountName,news.newsID FROM game, news, imagenews,account WHERE news.gameID = game.gameID AND news.newsID = imagenews.newsID AND news.accountID = account.accountID AND (game.gameName = '$upperGameName' OR game.gameName LIKE '%$upperGameName' OR game.gameName LIKE '$upperGameName%' OR game.gameName LIKE '%$upperGameName%') GROUP BY imagenews.newsID; ;";
        $dataRetrieveNews = mysqli_query($dbcon,$sqlcmdNews);
        $numOfNews = mysqli_num_rows($dataRetrieveNews);
        $searchall = "news";
      }
      elseif ($searchpost == "review"){
        $sqlcmdReview = "SELECT imageURL, reviewTitle ,reviewDate, accountName,review.reviewID FROM game, review, imagereview,account WHERE review.gameID = game.gameID AND review.reviewID = imagereview.reviewID AND review.accountID = account.accountID AND (game.gameName = '$upperGameName') GROUP BY imagereview.reviewID; ;";
        $dataRetrieveReview = mysqli_query($dbcon,$sqlcmdReview);
        $numOfReview = mysqli_num_rows($dataRetrieveReview);

        $searchall = "review";
      }
      else {
        $sqlcmd = "SELECT imageURL, gameName ,gameGenre, gameRating, gameDescription,gameReleaseDate,gameUserRating, game.gameID FROM game, imagegame WHERE game.gameID = imagegame.gameID AND (game.gameName = '$upperGameName' OR game.gameName LIKE '%$upperGameName' OR game.gameName LIKE '$upperGameName%' OR game.gameName LIKE '%$upperGameName%')  GROUP BY imagegame.gameID;";
        $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
        //Get the total number of row for LOOP
        $numOfRows = mysqli_num_rows($dataRetrieve);

        $sqlcmdNews = "SELECT imageURL, newsTitle ,newsDate, accountName,news.newsID FROM game, news, imagenews,account WHERE news.gameID = game.gameID AND news.newsID = imagenews.newsID AND news.accountID = account.accountID AND (game.gameName = '$upperGameName' OR game.gameName LIKE '%$upperGameName' OR game.gameName LIKE '$upperGameName%' OR game.gameName LIKE '%$upperGameName%') GROUP BY imagenews.newsID;";
        $dataRetrieveNews = mysqli_query($dbcon,$sqlcmdNews);
        $numOfNews = mysqli_num_rows($dataRetrieveNews);

        $sqlcmdReview = "SELECT imageURL, reviewTitle ,reviewDate, accountName,review.reviewID FROM game, review, imagereview,account WHERE review.gameID = game.gameID AND review.reviewID = imagereview.reviewID AND review.accountID = account.accountID AND (game.gameName = '$upperGameName' OR game.gameName LIKE '%$upperGameName' OR game.gameName LIKE '$upperGameName%' OR game.gameName LIKE '%$upperGameName%') GROUP BY imagereview.reviewID;";
        $dataRetrieveReview = mysqli_query($dbcon,$sqlcmdReview);
        $numOfReview = mysqli_num_rows($dataRetrieveReview);
      }
    }
  }
?>


</head>

<body>

  <a class = "big-link top-left" href = "mainPage.php">Home</a>

  <div id = "search-container">
    <form id = "loginDetail" action="" method="get">
    <p class="center"> <input class = "search-box" id = "searchName" name="searchName" placeholder="Type game name here" type="text">
                       <input class = "button" type = "submit" id ="searchButton" name = "searchButton" value="Search"></p>
    <p class = "center"> Search by :
      <select name ="searchWord">
      <option value="exact"> Exact word </option>
      <option value="any"> Any word </option>
    </select>

    <select name ="searchPost">
      <option value="all"> All posts </option>
      <option value="game"> Game </option>
      <option value="news"> News </option>
      <option value="review"> Review </option>
    </select>
    </p>

  </form>
  </div>




  <!-- This is the place we show data  -->
  <?php if(isset($dataRetrieve) || isset($dataRetrieveNews) || isset($dataRetrieveReview) ){ ?>
    <div id = "data-container">
      <?php
      if ($searchall == "all" || $searchall == "game"){
          echo "<h2> Game </h2>";
          echo "<table>";
          if ($numOfRows > 0){
          while($row = mysqli_fetch_row($dataRetrieve)){
            if (strlen($row[4]) > 200){
              $row[4] = substr($row[4],0,197).'...';
            }
            echo "
                <tr >
                  <td valign='top' rowspan = '6'><img width = 200px height = 200px class ='search-game' src ='$row[0]'></td>
                </tr>

                <tr>
                  <td valign='top' colspan = '2'><a target = '_blank' href='gameDetails.php?game=$row[7]'>$row[1]</a></td>
                </tr>

                <tr>
                  <td valign='top'><strong>Genre:</strong> </td>
                  <td valign='top'>$row[2] </td>
                </tr>

                <tr>
                  <td valign='top'><strong>Rating:</strong></td>
                  <td valign='top'> Admin/User  $row[3]/$row[6]</td>
                </tr>

                <tr>

                  <td valign='top'><strong>Desctiption:</strong></td>
                  <td valign='top'> $row[4]</td>
                </tr>

                <tr>
                  <td valign='top'><strong>Release Date:</strong></td>
                  <td valign='top'> $row[5]</td>
                </tr>";
                }
              }
              else {
                 echo "<tr><p class = 'center'> No related game found! </p></tr>";
              }
            echo "</table>";
          }

          if($searchall == "all" || $searchall == "news"){
            echo "<h2> News </h2>";

            if($numOfNews > 0 ){
            while($rowNews = mysqli_fetch_row($dataRetrieveNews)){
              echo " <table>
                  <tr >
                    <td valign='top' rowspan = '9'><img width = 200px height = 200px class ='search-game' src ='$rowNews[0]'></td>
                  </tr>

                  <tr>
                    <td colspan = '6' valign ='top'><a class = 'big-title' href = 'NewsRetrieve.php?ID=$rowNews[4]'>$rowNews[1]</a></td>
                  </tr>

                  <tr>
                    <td valign='top'><a href ='#' class = 'small-link'>$rowNews[2] </a></td>
                    <td valign='top'><a href ='#' class = 'small-link'>$rowNews[3]</a></td>
                  </tr>

                  <tr><td>&nbsp</td></tr>
                  <tr><td>&nbsp</td></tr>
                  <tr><td>&nbsp</td></tr>
                  <tr><td>&nbsp</td></tr>
                  <tr><td>&nbsp</td></tr>
                  <tr><td>&nbsp</td></tr>
                  ";
                  }
                }
                else{
                  echo "<tr><p class = 'center'> No related news found! </p></tr>";
                }

          echo "</table>";
        }

        if($searchall == "all" || $searchall == "review"){
          echo "<h2> Review </h2>";
        if($numOfReview > 0 ){
          while($rowReview = mysqli_fetch_row($dataRetrieveReview)){
            echo "<table>
              <tr >
                <td valign='top' rowspan = '9'><img width = 200px height = 200px class ='search-game' src ='$rowReview[0]'></td>
              </tr>

              <tr>
                <td colspan = '6' valign ='top'><a class = 'big-title' href = 'reviewDetails.php?review=$rowReview[4]'>$rowReview[1]</a></td>
              </tr>

              <tr>
                <td valign='top'><a href ='#' class = 'small-link'>$rowReview[2] </a></td>
                <td valign='top'><a href ='#' class = 'small-link'>$rowReview[3]</a></td>
              </tr>

              <tr><td>&nbsp</td></tr>
              <tr><td>&nbsp</td></tr>
              <tr><td>&nbsp</td></tr>
              <tr><td>&nbsp</td></tr>
              <tr><td>&nbsp</td></tr>
              <tr><td>&nbsp</td></tr>
              ";
            }
          }
          else{
            echo "<tr><p class = 'center'> No related review found! </p></tr>";
          }
      echo "</table>";
    }
  }
  ?>
  </div>
</body>
</html>
