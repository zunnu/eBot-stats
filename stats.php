<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/stream.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<div class="container">


<?php
require_once("includes/init.php");

$search= $_GET['id'];

$found_game = Game::find_game_by_id($search);

$found_map = Game::find_map_by_id($search);


echo '<center>';
echo '<div class=score>';

    if($found_game->score_a > $found_game->score_b) {

    echo "<td><span class='team1'>" .$found_game->team_a_name." <font color='green'> ".$found_game->score_a." </font>:  <font color='red'> ".$found_game->score_b." </font> <span class='team2'> ".$found_game->team_b_name." </td>";
              
}   elseif($found_game->score_a < $found_game->score_b) {

    echo "<td><span class='team1'>".$found_game->team_a_name." <font color='red'> ".$found_game->score_a." </font>:  <font color='green'> ".$found_game->score_b." </font> <span class='team2'> ".$found_game->team_b_name." </td>";

}   else {

    echo "<td><span class='team1'>".$found_game->team_a_name." <font color='blue'> ".$found_game->score_a." </font> &nbsp;:&nbsp; <font color='blue'>".$found_game->score_b."</font> <span class='team2'> ".$found_game->team_b_name." </td>";

}

echo '</div>';

echo '<h3 class="map"> '.$found_map->map_name.' </h3>';

echo '</center>';
    echo '<table class="table table-condensed">
    <thead>
      <tr>';
    if (file_exists('img/flags/'.strtolower($found_game->team_a_flag).'.png')) {
        echo '<th class="team_a_name">'.$found_game->team_a_name.'<img src="img/flags/'.strtolower($found_game->team_a_flag).'.png"</th>';
    } else {
        echo '<th class="team_a_name">'.$found_game->team_a_name.'</th>';
    }
   echo '<th class="text_color">Frags</th>
        <th class="text_color">Assists</th>
        <th class="text_color">Deaths</th>
        <th class="text_color">K/D</th>
        <th class="text_color">HS %</th>
        <th class="text_color">Best Weapon</th>
      <thead>
      </tr>';

$players = Game::find_players_by_id($search);

foreach ($players as $player) {

  if($player->team =='a') {

    if($player->nb_kill > '0' && $player->death > '0') {
        $kd = round($player->nb_kill / $player->death, 2);
    } else {
        $kd = '0';
    }

    if($player->hs > "0" && $player->nb_kill > "0") {
        $headshot = round($player->hs / $player->nb_kill * 100, 2);
    } else {
        $headshot = '0';
    }

    $killer_id = $player->id;
    $weapons = Game::favorite_weapon($search, $killer_id);

if(mysqli_num_rows($weapons) > 0) {
  while($row = mysqli_fetch_array($weapons)) {

    $weapon_name = $row['weapon'];

        echo '<tr>';
        echo '<td class="player">'.$player->pseudo.'</td>';
        echo '<td class="frags">'.$player->nb_kill.'</td>';
        echo '<td class="assist">'.$player->assist.'</td>';
        echo '<td class="death">'.$player->death.'</td>';
        echo '<td class="kd">'.$kd.'</td>';
        echo '<td class="hs">'.$headshot.'%</td>';
    if (file_exists('img/weapons/'.$weapon_name.'.png')) {
        echo '<td class="weapon"><img src="img/weapons/'.$weapon_name.'.png"'.'</td>';
    } else {
        echo '<td class="weapon">'.$weapon_name.'</td>';
    }
}
} else {
        echo '<td class="player">'.$player->pseudo.'</td>';
        echo '<td class="frags">'.$player->nb_kill.'</td>';
        echo '<td class="assist">'.$player->assist.'</td>';
        echo '<td class="death">'.$player->death.'</td>';
        echo '<td class="kd">'.$kd.'</td>';
        echo '<td class="hs">'.$headshot.'%</td>';
}
}
echo '</tr>';
} //end foreach

// total team a
 $kills_team_a = Game::count_team_a_kills($search);
 $assist_team_a = Game::count_team_a_assist($search);
 $death_team_a = Game::count_team_a_death($search);
 
 echo '<tr>';
    echo '<td class="total">Total</td>';
    echo '<td class="total_kills">'.$kills_team_a->total_kills_team_a.'</td>';
    echo '<td class="total_assist">'.$assist_team_a->total_assist_team_a.'</td>';
    echo '<td class="total_death">'.$death_team_a->total_death_team_a.'</td>';
 echo '</tr>';

    echo '<table class="table table-condensed">
      <thead>
      <tr>';
    if (file_exists('img/flags/'.strtolower($found_game->team_b_flag).'.png')) {
        echo '<th class="team_a_name">'.$found_game->team_b_name.'<img src="img/flags/'.strtolower($found_game->team_b_flag).'.png"</th>';
    } else {
        echo '<th class="team_a_name">'.$found_game->team_b_name.'</th>';
    }
   echo '<th class="text_color">Frags</th>
        <th class="text_color">Assists</th>
        <th class="text_color">Deaths</th>
        <th class="text_color">K/D</th>
        <th class="text_color">HS %</th>
        <th class="text_color">Best Weapon</th>
      <thead>
      </tr>';

foreach ($players as $player) {

  if($player->team =='b') {

    if($player->nb_kill > '0' && $player->death > '0') {
        $kd = round($player->nb_kill / $player->death, 2);
    } else {
        $kd = '0';
    }

    if($player->hs > "0" && $player->nb_kill > "0") {
        $headshot = round($player->hs / $player->nb_kill * 100, 2);
    } else {
        $headshot = '0';
    }

    $killer_id = $player->id;
    $weapons = Game::favorite_weapon($search, $killer_id);

if(mysqli_num_rows($weapons) > 0) {
  while($row = mysqli_fetch_array($weapons)) {

    $weapon_name = $row['weapon'];

        echo '<tr>';
        echo '<td class="player">'.$player->pseudo.'</td>';
        echo '<td class="frags">'.$player->nb_kill.'</td>';
        echo '<td class="assist">'.$player->assist.'</td>';
        echo '<td class="death">'.$player->death.'</td>';
        echo '<td class="kd">'.$kd.'</td>';
        echo '<td class="hs">'.$headshot.'%</td>';
    if (file_exists('img/weapons/'.$weapon_name.'.png')) {
        echo '<td class="weapon"><img src="img/weapons/'.$weapon_name.'.png"'.'</td>';
    } else {
        echo '<td class="weapon">'.$weapon_name.'</td>';
    }
}
} else {
        echo '<td class="player">'.$player->pseudo.'</td>';
        echo '<td class="frags">'.$player->nb_kill.'</td>';
        echo '<td class="assist">'.$player->assist.'</td>';
        echo '<td class="death">'.$player->death.'</td>';
        echo '<td class="kd">'.$kd.'</td>';
        echo '<td class="hs">'.$headshot.'%</td>';
}
}
echo "</tr>";
}//end foreach

// Round series
$rounds = Game::round_series($search);

$round_count = 0;
$count_rounds = Game::count_rounds_played($search);

if($count_rounds > '0') {
    $round_series_size = 1140 / ($count_rounds);
} else {
    $round_series_size = '0';
}

echo '<div class="progress">';

foreach ($rounds as $round) {
    
    if($round_count == '15') {
        echo '<div class="progress-bar round_halftime" role="progressbar" style="width: '.$round_series_size.'"></div>';
    }

    if($round->team_win == 'a') {
        echo '<div class="progress-bar round_team_a" role="progressbar" style="width: '.$round_series_size.'"></div>';
        $round_count = $round_count + 1;
    } elseif ($round->team_win == 'b') {
        echo '<div class="progress-bar round_team_b" role="progressbar" style="width: '.$round_series_size.'"></div>';
        $round_count = $round_count + 1;
    }
}

echo '</div>';

// total team b
 $kills_team_b = Game::count_team_b_kills($search);
 $assist_team_b = Game::count_team_b_assist($search);
 $death_team_b = Game::count_team_b_death($search);

echo '<tr>';
    echo '<td class="total">Total</td>';
    echo '<td class="total_kills">'.$kills_team_b->total_kills_team_b.'</td>';
    echo '<td class="total_assist">'.$assist_team_b->total_assist_team_b.'</td>';
    echo '<td class="total_death">'.$death_team_b->total_death_team_b.'</td>';
echo '</tr>';

?>

</div>
</body>
</html>