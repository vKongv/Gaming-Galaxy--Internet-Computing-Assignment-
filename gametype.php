<html>
<head>

<?php
  include("config.php");
  $gameType = array("Action", "Racing", "Shooting", "Sports","Strategy","Simulation");
?>
<meta charset ="utf-8">
<title>Game Types - Gaming Galaxy</title>
<style type="text/css">
h2{
  font-family : Beatnik SF;
  font-size : 25px;
  text-align : center;
}
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
  color:#4c4c4c;}

#nav ul li a:hover { text-decoration:none;
    color:#fff;}

#nav ul li ul li:hover { background: #999; }
#nav ul li:hover ul {
      display: block;
      opacity: 1;
      visibility: visible;
}
#nav ul li ul li a{text-decoration:none; color:#fff;}
p#genre {
  margin-bottom:-8px;
  margin-left:20px;
  font: 20px "Beatnik SF";
}

p#genre span#genre a {
  width:30px;
  text-decoration:none;
  color:#4c4c4c;
  font-size:14px;
}
p#genre span#genre a:hover {
  text-decoration:underline;
  color:#4c4c4c;
}

p#genre span#genre a:visited, p#genre span#genre a:active {
  text-decoration:none;
  color:#4c4c4c;
}

div.genre #action, div.genre #racing, div.genre #shooter, div.genre #sports,
div.genre #strategy, div.genre #simulation {
  text-align:center-left;
  border:5px solid #ddd;
  border-radius:10px;
  height:215px;
  width:auto;
  padding:3px;
  margin:10px;
  background-color:#eee;
}
div.genre #action span, div.genre #racing span, div.genre #shooter span,
div.genre #sports span, div.genre #strategy span, div.genre #simulation span {
  display:inline-block;
  padding-right: 35px;
  padding-left: 35px;
  padding-top:5px;
  padding-bottom:5px;
  height: 135px;
  width: 160px;
  text-align: center;
}

div.genre #action span img, div.genre #racing span img, div.genre #shooter span img,
div.genre #sports span img, div.genre #strategy span img, div.genre #simulation span img {
  display: inline;
  text-align:center;
  height:130;
  width:190;
  margin: 5px;
  margin-right:10px;
  border: 3px solid #ffffff;
  border-radius:15px;
}

div.genre #action span a:hover img, div.genre #racing span a:hover img, div.genre #shooter span a:hover img,
div.genre #sports span a:hover img, div.genre #strategy span a:hover img, div.genre #simulation span a:hover img {
  border-color:orange;
}

div.detail {
  text-align: center;
  font-family: "Beatnik SF";
  font-size:16px;
  margin-left:30px;
  margin-top:5px;
  margin-bottom: auto;
}
</style>
</head>
<body>
  <div id="nav">

    <ul>
    <li>  <a target="" href="mainPage.php">Home</a></li> | &nbsp;
    <li><a target="" href="showAllNews.php">News</a></li> | &nbsp;
    <li style="border:solid;border-color:#999; border-radius:5px;">
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
  for ($index = 0; $index < sizeof($gameType); $index++){
    $numOfRows = 0;
    $sqlGetGameType = "SELECT game.gameID, imagegame.imageURL, gameName FROM imagegame, game WHERE game.gameID = imagegame.gameID AND game.gameGenre = '$gameType[$index]' GROUP BY game.gameID;";
    $dataRetrieve = mysqli_query($dbcon,$sqlGetGameType);
    //Get the total number of row for LOOP
    $numOfRows = mysqli_num_rows($dataRetrieve);

    if($numOfRows > 0){
    echo "
    <div class='genre'>
      <p id='genre'>$gameType[$index]<span id='genre'><a target='_blank' href='genre.php?genre=$gameType[$index]' style='margin-left:1255px;'>&gt;&gt; more</a></span></p>
      <div id='action'>
    ";
    }
    while($rows = mysqli_fetch_row($dataRetrieve)){
      if($numOfRows > 0){
      echo "
              <span>
                <a target='' href='gameDetails.php?game=$rows[0]'>
                <img src='$rows[1]' alt='$rows[2]'>
                </a>
                <div class='detail'>$rows[2]</div>
              </span>
        ";
      }

    }
    echo "
    </div>
  </div>
    ";
  }
  ?>

  <!--
  <div class="genre">
    <p id="genre">ACTION<span id="genre"><a target="_blank" href="genre.html" style="margin-left:1255px;">>> more</a></span></p>
    <div id="action">
          <span>
            <a target="" href="gameDetails.html">
            <img src="ryse.jpg" alt="ryse">
            </a>
            <div class="detail">Ryse: Son of Rome</div>
          </span>
          <span>
            <a target="" href="gameDetails.html">
              <img src="assasin.jpg" alt="assasins creed">
            </a>
            <div class="detail">Assasins Creed Rogue</div>
          </span>
          <span>
            <a target="" href="gameDetails.html">
              <img src="som.jpg" alt="Shadow of Mordor">
            </a>
            <div class="detail">Middle-earth: Shadow of Mordor</div>
          </span>
          <span>
            <a target="" href="gameDetails.html">
              <img src="watchdog.jpg" alt="Watch Dogs" >
            </a>
            <div class="detail">Watch Dogs</div>
          </span>
          <span>
            <a target="" href="gameDetails.html">
              <img src="MGSV2.jpg" alt="MGSV" >
            </a>
            <div class="detail">Metal Gear Solid V: Ground Zeros</div>
          </span>
    </div>
    <p id="genre">RACING<span id="genre"><a target="_blank" href="genre.html" style="margin-left:1255px;">>> more</a></span></p>
    <div id="racing">
      <span>
        <a target="" href="gameDetails.html">
          <img src="thecrew.jpg" alt="The Crew" >
        </a>
        <div class="detail">The Crew</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="n4s.jpg" alt="needforspeed" >
        </a>
        <div class="detail">Need for Speed: Most Unwanted</div>
      </span>
      <span>
          <a target="" href="gameDetails.html">
          <img src="GRID.jpg" alt="GRID" >
          </a>
          <div class="detail">GRID: Autosport</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="dsf.jpg" alt="Driver: San Francisco" >
        </a>
        <div class="detail">Driver: San Francisco</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="gta5.jpg" alt="GTA5" >
        </a>
        <div class="detail">Grand Theft Auto 5</div>
      </span>
    </div>
    <p id="genre">SHOOTER<span id="genre"><a target="_blank" href="genre.html" style="margin-left:1245px;">>> more</a></span></p>
    <div id="shooter">
      <span>
        <a target="" href="gameDetails.html">
          <img src="codaw.png" alt="Call Of Duty" >
        </a>
        <div class="detail">Call Of Duty: Advance Warfare</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="battle.jpg" alt="Battle Field" >
        </a>
        <div class="detail">Battlefield Hardline</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="hl2.jpg" alt="Half-Life 2">
        </a>
        <div class="detail">Half-Life 2</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="cs.jpg" alt="counter strike">
        </a>
        <div class="detail">Counter Strike: Global Offensive</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="loadout.jpg" alt="loadout">
        </a>
        <div class="detail">Loadout</div>
      </span>
    </div>
    <p id="genre">SPORTS<span id="genre"><a target="_blank" href="genre.html"  style="margin-left:1262px;">>> more</a></span></p>
    <div id="sports">
      <span>
        <a target="" href="gameDetails.html">
          <img src="pes.jpg" alt="pes 2015" >
        </a>
        <div class="detail">Pro Evolution Soccer 2015</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="fifa15.jpg" alt="fifa15" >
        </a>
        <div class="detail">FIFA 15</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="sd.jpg" alt="slamdunk" >
        </a>
        <div class="detail">Slam Dunk</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="fm.jpg" alt="football manager">
        </a>
        <div class="detail">Football Manager 2015</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="nba.jpg" alt="nba 2k15">
        </a>
        <div class="detail">NBA 2K15</div>
      </span>
    </div>
    <p id="genre">STRATEGY<span id="genre"><a target="_blank" href="genre.html" style="margin-left:1238px;">>> more</a></span></p>
    <div id="strategy">
      <span>
        <a target="" href="gameDetails.html">
          <img src="dota2.jpg" alt="dota" >
        </a>
        <div class="detail">Dota 2</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="lol.jpg" alt="LOL">
        </a>
        <div class="detail">League of Legends</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="coc.png" alt="coc">
        </a>
        <div class="detail">Clash of Clans</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="warcraft.jpg" alt="warcraftL">
        </a>
        <div class="detail" style="margin-left:20px;">World of Warcraft: Warlords of Draenor</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="sw.jpg" alt="battleline">
        </a>
        <div class="detail">Battleline: Steel Warfare</div>
      </span>
    </div>
    <p id="genre">SIMULATION<span id="genre"><a target="_blank" href="genre.html" style="margin-left:1215px;">>> more</a></span></p>
    <div id="simulation">
      <span>
        <a target="" href="gameDetails.html">
          <img src="hayday.jpg" alt="hayday" >
        </a>
        <div class="detail">Hay Day</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="minecraft.jpg" alt="minecraft">
        </a>
        <div class="detail">Minecraft</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="sb.jpg" alt="simcity">
        </a>
        <div class="detail">SimCity BuildIt</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="town.jpg" alt="township">
        </a>
        <div class="detail">Township</div>
      </span>
      <span>
        <a target="" href="gameDetails.html">
          <img src="ts4.png" alt="thesim4">
        </a>
        <div class="detail">The Sims 4</div>
      </span>
    </div>
  </div>
-->
</body>
</html>
