<?php
$delimiter = '|';
function print_films($file_ptr) {
	while (!feof($file_ptr)) {
		$line = fgets($file_ptr);
		$arr = explode($delimiter, $line);

		echo($line . "<br>");
	}
}
?>