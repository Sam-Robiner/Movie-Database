<?php
$delimiter = '|';
if(isset($_POST["add_film"])) {
	$file = fopen("films.txt", "a+");

	//Code taken from Section 3 activity solution
	if(!$file) {
		die("Error opening films.txt file");
	}

	//Clean up user input (see files_coaster_exercise_solution)
	$title = $_POST["title"];
	$actors = $_POST["actors"];
	$director = $_POST["director"];
	$genre = $_POST["genre"];
	$rating = $_POST["rating"];

	$tempArray = array($title, $actors, $director, $genre, $rating);

	$entry = implode($delimiter, $tempArray);
	$write = fputs($file, $entry . "\n");
	if(!$write) {
		echo "Error writing to file";
	}

	fclose($file);
}
?>