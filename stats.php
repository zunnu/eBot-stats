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
      <tr>
        <th class="team_a_name">'.$found_game->team_a_name.'</th>
        <th class="frags_name">Frags</th>
        <th class="assist_name">Assists</th>
        <th class="death_name">Deaths</th>
        <th class="kd">K/D</th>
        <th class="hs">Headshot %</th>
      <thead>
      </tr>';


$players = Game::find_players_by_id($search);

foreach ($players as $player) {

  $kd = round($player->nb_kill / $player->death, 2);
  $headshot = round($player->hs / $player->nb_kill * 100, 2);

 if($player->team =='a') {


        echo '<tr>';
        echo '<td class="player">'.$player->pseudo.'</td>';
        echo '<td class="frags">'.$player->nb_kill.'</td>';
        echo '<td class="assist">'.$player->assist.'</td>';
        echo '<td class="death">'.$player->death.'</td>';
        echo '<td class="kd">'.$kd.'</td>';
        echo '<td class="hs">'.$headshot.'%</td>';
        echo '</tr>';


 }
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
      <tr>
        <th class="team_b_name">'.$found_game->team_b_name.'</th>
        <th class="frags_name">Frags</th>
        <th class="assist_name">Assists</th>
        <th class="death_name">Deaths</th>
        <th class="kd">K/D</th>
        <th class="hs">Headshot %</th>
      <thead>
      </tr>';

 foreach ($players as $player) {

$kd = round($player->nb_kill / $player->death, 2);
$headshot = round($player->hs / $player->nb_kill * 100, 2);

 if($player->team =='b') {

        echo '<tr>';
        echo '<td class="player">'.$player->pseudo.'</td>';
        echo '<td class="frags">'.$player->nb_kill.'</td>';
        echo '<td class="assist">'.$player->assist.'</td>';
        echo '<td class="death">'.$player->death.'</td>';
        echo '<td class="kd">'.$kd.'</td>';
        echo '<td class="hs">'.$headshot.'%</td>';
        echo "</tr>";



}
}//end foreach

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
