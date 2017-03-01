<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Homepage</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <script src="Scripts/validate.js"></script>

</head>
<body>
    <div id="banner">Sam's Film Database</div>
    <div id=body_main>
    <div id="film_form">
        <h1>Add Film</h1>
        <form name="add_film" action="index.php" method="post" onsubmit="return validate_film(this);">
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
        <form name="search_film" action="index.php" method="post">
            <label for="search_field_select">Search by: </label>
            <select id="search_field_select">
                <option value="empty" selected=""></option>
                <option value="fname_search">Name</option>
                <option value="fdirector_search">Director</option>
            </select>
            <input type="text" name="search_input" id="search_input">
            <input type="submit" name="search" value="search">
        </form>
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
                if (isset($_POST['search']) && isset($_POST['search_field_select']) && $_POST['search_field_select'] != "empty") {
                    //Searching
                    if ($_POST['search_field_select'] == 'fname_search') {
                        //Search by title
                        $input = $_POST["search_input"];
                        $pattern = '/^[$input]/';
                        if (preg_match($pattern, $film[0])) {
                            $films[] = $film;
                        }
                    }

                    if ($_POST['search_field_select'] == 'fdirector_search') {
                        //Search by director
                        $input = $_POST["search_input"];
                        $pattern = '/^[$input]/';
                        if (preg_match($pattern, $film[2])) {
                            $films[] = $film;
                        }
                    }

                } else {
                    //No search -> show no matter what
                    $films[] = $film;
                }
                
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
    <a href="citation.html">Banner image citation</a>
</body>
</html>