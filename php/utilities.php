<?php
	function h($string="") {
		return htmlspecialchars($string);
	}
	
	function empty_str($str) {
		if (isset($str) && strlen($str) > 0) {
			return false;
		} else {
			return true;
		}		
	}
	
?>
	