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

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$matchs_total_count = Game::count_all_games();

$paginate = new Paginate($page, $matchs_per_page, $matchs_total_count);

$sql = "SELECT * FROM matchs ORDER BY id DESC ";
$sql .= "LIMIT {$matchs_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";
$games = Game::find_this_query($sql);


	foreach ($games as $game) {

        echo "<tr>";
		echo "<td>".$game->id."</td>";
                        
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

<div class="row">

	<ul class="pagination">

	<?php

	if($paginate->page_total() > 1) {

		if($paginate->has_previous()) {

			echo "<li class='previous'><a href='index.php?page={$paginate->previous()}''>Previous</a></li>";

		}

		for ($i=1; $i <= $paginate->page_total(); $i++) { 
			
			if($i == $paginate->current_page) {

				echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";

			} else {

				echo "<li><a href='index.php?page={$i}''>{$i}</a></li>";

			}

		}

		if($paginate->has_next()) {

			echo "<li class='next'><a href='index.php?page={$paginate->next()}''>Next</a></li>";

		}

	}

?>

</ul>
</div>
