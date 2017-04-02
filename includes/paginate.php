<?php

class Paginate {

public $current_page;
public $matchs_per_page;
public $matchs_total_count;

	public function __construct($page=1, $matchs_per_page=4, $matchs_total_count=0) {

		$this->current_page =(int)$page;
		$this->matchs_per_page =(int)$matchs_per_page;
		$this->matchs_total_count =(int)$matchs_total_count;

	}

public function next() {

	return $this->current_page + 1;

}

public function previous() {

	return $this->current_page - 1;

}

public function page_total() {

	return  ceil($this->matchs_total_count/$this->matchs_per_page);

}

public function has_previous() {

	return $this->previous() >= 1 ? true : false;

}

public function has_next() {

	return $this->next() <= $this->page_total() ? true : false;

}

public function offset() {

	return ($this->current_page - 1 ) * $this->matchs_per_page;

}

} //class end

?>