<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">


<center><table class="main" border=1>
<tr>
<th>ID</th>
<th>Score</th>
<th>Stream button</th>
</tr></center>

<?php
require_once("includes/init.php");

    $games = Game::find_all_games();

	foreach ($games as $game) {

        echo "<tr>";
		echo "<td>".$game->id."</td>";

	//echo "<br>";
                        
    if($game->score_a > $game->score_b) {

		echo "<td>".$game->team_a_name." &nbsp;-&nbsp; <font color='green'> ".$game->score_a." </font>:  <font color='red'> ".$game->score_b." </font> &nbsp;-&nbsp; ".$game->team_b_name." </td>";
						  
} 	elseif($game->score_a < $game->score_b) {

		echo "<td>".$game->team_a_name." &nbsp;-&nbsp; <font color='red'> ".$game->score_a." </font>:  <font color='green'> ".$game->score_b." </font> &nbsp;-&nbsp; ".$game->team_b_name." </td>";

} 	else {

		echo "<td>".$game->team_a_name." &nbsp;-&nbsp;<font color='blue'> ".$game->score_a." </font> &nbsp;:&nbsp; <font color='blue'>".$game->score_b."</font> &nbsp;-&nbsp; ".$game->team_b_name." </td>";

}

	//STATS button
    echo "<form method='GET' action='stats.php'>";
    echo "<input type='hidden' name='id' value='".$game->id."'>";
    echo "<td> <input class='btn btn-info btn-block' type='submit' name='Stream' value='Stream/stats'></td>";
    echo "</form>";
    echo "</tr>";
    
}


?>

</div>
</table>
