<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Homepage</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <?php
        $style_path = 'css/main.css';
        $version = filemtime( $style_path);
        echo "<link rel='stylesheet' href='$style_path?ver=$version'>";

        $script_path1 = 'Scripts/validate.js';
        $version = filemtime( $script_path1);
        echo "<script src='$script_path1?ver=$version'></script>";

        $script_path2 = 'Scripts/search.js';
        $version = filemtime( $script_path1);
        echo "<script src='$script_path2?ver=$version'></script>";
    ?>
</head>
<body>
    <div id="banner">Sam's Film Database</div>
    <div id=body_main>
    <div id="film_form">
        <h1>Add Film</h1>
        <form name="add_film" action="homepage.php" method="post" onsubmit="return validate_film(this);">
            <table id="form_add">
            <tr>
                <td>Film title:</td>
                <td><input type="text" name="title" onchange="validate_title(this);" /></td>
                <td id="title_msg"></td>
            </tr>
            <tr>
            	<td>Actors:</td>
                <td><input type="text" name="actors" onchange="validate_actors(this);" /></td>
                <td id="actors_msg"></td>
            </tr>
            <tr>
            	<td>Director:</td>
                <td><input type="text" name="director" onchange="validate_director(this);" /></td>
                <td id="director_msg"></td>
            </tr>
            <tr>
            	<td>Genre:</td>
                <td><select name="genre">
                		<option value="Comedy">Comedy</option>
                		<option value="Drama">Drama</option>
                		<option value="Horror">Horror</option>
                		<option value="Documentary">Documentary</option>
                		<option value="Family">Family</option>
                		<option value="Action">Action</option>
                        <option value="Romance">Romance</option>
            	    </select></td>
            </tr>
            <tr>
            	<td>Rating:</td>
                <td>
                	<select name="rating">
                		<option value="G">G</option>
                		<option value="PG">PG</option>
                		<option value="PG13">PG-13</option>
                		<option value="R">R</option>
                	</select></td>
            </tr>
            <tr>
            	<td><input type="submit" name="add_film" value="Add film" /></td>
            </tr>
            </table>
        </form>
    </div>
    <?php include("add_film.php"); ?>

    <div id="search_form">
        <h1>Search film database</h1>
        <label for="search_field_select">Search by: </label>
        <select id="search_field_select">
            <option value="" selected=""></option>
            <option value="fname">Name</option>
            <option value="factors">Actor</option>
            <option value="fdirector">Director</option>
            <option value="fgenre">Genre</option>
            <option value="frating">Rating</option>
        </select>
        <input type="text" id="search_input">
        <button id="search_button">Search</button>
    </div>


    <h1>Films</h1>
    <div id="film_list">
        <?php 
            $delimiter = '|';
            $file_ptr = fopen("films.txt", "r");
            if (!$file_ptr) {
                echo "Error opening file";
                exit;
            }
            $films = array();
            while (!feof($file_ptr)) {
                $line = fgets($file_ptr);
                $film = explode($delimiter, $line);
                $films[] = $film;
            }

            foreach($films as $film) {
                if (is_array($film) && count($film) == 5) {
                    echo "<div class='film_info'>";
                    echo "<div class='fname'>" . htmlentities($film[0]) . "</div>";
                    echo "<div class=factors>Actors: " . htmlentities($film[1]) . "</div>";
                    echo "<div class=fdirector>Directed by: " . htmlentities($film[2]) . "</div>";
                    echo "<div class=fgenre>" . htmlentities($film[3]) . "</div>";
                    echo "<div class=frating>Rated " . htmlentities($film[4]) . "</div>";
                    echo "</div>";
                }
            }
        ?>
    </div>
    </div>
</body>
</html>