<?php

class Game {

protected static $db_table = "players";
protected static $db_table_fields = array('id', 'match_id', 'pseudo','nb_kill', 'team', 'assist', 'dead', 'hs');
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

	$sql  = "SELECT * FROM " . self::$db_table;
	$sql .= " WHERE match_id = " . $database->escape_string($game_id);
	$sql .= " ORDER BY nb_kill DESC";

	return self::find_this_query($sql);

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


} //class finish

?>
