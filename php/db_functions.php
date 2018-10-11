<?php
require_once('db_credentials.php');
require_once('utilities.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $database = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  $database->set_charset("utf8mb4");
} catch(Exception $e) {
  error_log($e->getMessage());
  exit('Error connecting to database');
}


class MyData {
	private $database;
	
	function __construct($database) {
		$this->database = $database;
	}

	function search($key, $location, $category) {
		$bindp_type ="";
		$bindp_argv = array();
		
		$sql  = "SELECT * FROM custom_events WHERE finish > CURDATE() ";
		if ($key != "") {
			# $sql .= "AND LOWER(name) LIKE '%" . $this->keyword . "%' OR LOWER(description) LIKE '%" . $this->keyword . "%' ";
			# $sql .= "AND LOWER(name) LIKE ? OR LOWER(description) LIKE CONCAT('%',?,'%') ";

			$sql .= "AND LOWER(name) LIKE ? OR LOWER(description) LIKE ? ";
			$bindp_type .= "ss";
			$bindp_argv[] = "%{$key}%";
			$bindp_argv[] = "%{$key}%";
		}
		if ($location != "") {
			# $sql .= "AND LOWER(REPLACE(location,' ', '')) = '" . $this->location . "' ";
			$sql .= "AND LOWER(REPLACE(location,' ', '')) = ? ";
			$bindp_type .="s";
			$bindp_argv[] = "{$location}";
	}
		if ($category != "") {
			# $sql .= "AND LOWER(REPLACE(category,' ', '')) = '" . $this->category . "' ";
			$sql .= "AND LOWER(REPLACE(category,' ', '')) = ? ";
			$bindp_type .="s";
			$bindp_argv[] = "{$category}";
		}
		##
		# To avoid SQL injection issue, replaced mysqli_query by
		# prepare/bind_param and execute
		#$result = mysqli_query($this->database,$sql);
		#
		
		$stmt = $this->database->prepare($sql);
		if ($bindp_type != "") {
			// ... is to unpack bindp_argv (available since PHP 5.6)
			$stmt->bind_param($bindp_type, ...$bindp_argv);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	
	function free_data($data) {
		mysqli_free_result($data);
	}
	
	
} // end MyData

?>
