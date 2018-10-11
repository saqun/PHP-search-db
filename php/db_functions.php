<?php
require_once('db_credentials.php');
require_once('utilities.php');

$database = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

class MyData {
	private $database;
	private $keyword;
	private $location;
	private $category;
	
	function __construct($database) {
		$this->database = $database;
	}
	function build_search_info($key, $location, $category) {
		$this->keyword = empty_str($key)?"":h($key);
		$this->location = empty_str($location)?"":h($location);
		$this->category = empty_str($category)?"":h($category);
	}
	
	function search($key, $location, $category) {
		$this->build_search_info($key, $location, $category);
		
		$sql  = "SELECT * FROM custom_events WHERE finish > CURDATE() ";
		if ($this->keyword != "") {
			$sql .= "AND LOWER(name) LIKE '%" . $this->keyword . "%' OR LOWER(description) LIKE '%" . $this->keyword . "%' ";
		}
		if ($this->location != "") {
			$sql .= "AND LOWER(REPLACE(location,' ', '')) = '" . $this->location . "' ";
		}
		if ($this->category != "") {
			$sql .= "AND LOWER(REPLACE(category,' ', '')) = '" . $this->category . "' ";
		}
		$result = mysqli_query($this->database,$sql);
		return $result;
	}
	
	function free_data($data) {
		mysqli_free_result($data);
	}
	
	function get_keyword() {
		return $this->keyword;
	}
	function get_location() {
		return $this->location;
	}
	function get_category() {
		return $this->category;
	}
	
} // end MyData

?>
