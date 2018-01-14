<?php

class Game {

public $id;
public $team_a_name;
public $team_b_name;
public $score_a;
public $score_b;
public $map_name;
public $pseudo;
public $nb_kill;
public $assist;
public $death;
public $hs;
public $players;
public $team;
public $total_kills_team_a;
public $total_kills_team_b;
public $total_assist_team_a;
public $total_assist_team_b;
public $total_death_team_a;
public $total_death_team_b;
public $team_a_flag;
public $team_b_flag;
public $killer_id;
public $weapon;
public $gun;
public $max_round;
public $team_win;


public static function find_all_games() {

	return self::find_this_query("SELECT * FROM matchs");
	
}

public static function find_this_query($sql) {
	global $database;

		$result_set = $database->query($sql);
		$the_object_array = array();

	while($row = mysqli_fetch_array($result_set)) {

		$the_object_array[] = static::instantation($row);
	}

	return $the_object_array;
}

public function find_game_by_id($game_id) {
	global $database;

	$the_result_array = self::find_this_query("SELECT * FROM matchs WHERE id= $game_id");

	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}

public function find_map_by_id($game_id) {
	global $database;

	$the_result_array = self::find_this_query("SELECT * FROM maps WHERE id= $game_id");

	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}

public function find_players_by_id($game_id) {
	global $database;

		$sql  = "SELECT * FROM players";
		$sql .= " WHERE match_id = $game_id";
		$sql .= " ORDER BY nb_kill DESC";

		return self::find_this_query($sql);

}

public function count_team_a_kills($game_id) {
	global $database;

	$the_result_array = self::find_this_query("SELECT team, SUM(nb_kill) AS total_kills_team_a FROM players WHERE match_id= $game_id AND team = 'a'");

	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}

public function count_team_b_kills($game_id) {
	global $database;

	$the_result_array = self::find_this_query("SELECT team, SUM(nb_kill) AS total_kills_team_b FROM players WHERE match_id= $game_id AND team = 'b'");

	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}

public function count_team_a_assist($game_id) {
	global $database;

	$the_result_array = self::find_this_query("SELECT team, SUM(assist) AS total_assist_team_a FROM players WHERE match_id= $game_id AND team = 'a'");

	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}

public function count_team_b_assist($game_id) {
	global $database;

	$the_result_array = self::find_this_query("SELECT team, SUM(assist) AS total_assist_team_b FROM players WHERE match_id= $game_id AND team = 'b'");

	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}

public function count_team_a_death($game_id) {
	global $database;

	$the_result_array = self::find_this_query("SELECT team, SUM(death) AS total_death_team_a FROM players WHERE match_id= $game_id AND team = 'a'");

	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}

public function count_team_b_death($game_id) {
	global $database;

	$the_result_array = self::find_this_query("SELECT team, SUM(death) AS total_death_team_b FROM players WHERE match_id= $game_id AND team = 'b'");

	return !empty($the_result_array) ? array_shift($the_result_array) : false;

}

public static function instantation($the_record){

	$the_object = new self;

    foreach ($the_record as $the_attribute => $value) {

    	if($the_object->has_the_attribute($the_attribute)) {

    		$the_object->$the_attribute = $value;
    	}
    }
        return $the_object;
}

private function has_the_attribute($the_attribute) {

	$object_properties = get_object_vars($this);

	return array_key_exists($the_attribute, $object_properties);

}

public static function count_all_games() {
	global $database;

		$sql = "SELECT COUNT(*) FROM matchs";
		$result_set = $database->query($sql);
		$row = mysqli_fetch_array($result_set);

		return array_shift($row);

} //end of count all

public static function favorite_weapon($game_id, $killer_id) {
	global $database;

		$sql  = "SELECT weapon, count(*) as gun FROM player_kill ";
		$sql .= " WHERE match_id= $game_id";
		$sql .= " AND killer_id  = $killer_id";
		$sql .= " GROUP BY weapon ORDER BY COUNT(weapon) DESC LIMIT 1";

		$result_set = $database->query($sql);
		return $result_set;

}

public static function round_series($game_id) {
	global $database;

		$sql  = "SELECT * FROM round_summary";
		$sql .= " WHERE match_id = $game_id";

		return self::find_this_query($sql);
}

public static function count_rounds_played($game_id) {
	global $database;

		$sql = "SELECT COUNT(*) FROM round_summary";
		$sql .= " WHERE match_id = $game_id";
		$result_set = $database->query($sql);
		$row = mysqli_fetch_array($result_set);

		return array_shift($row);

} //end of count all

} //class finish

?>
