//Code based on code from Section 4 activity

function validate_film(form) {
	var error = "";
	t_error = validate_title(form.title);
	a_error = validate_actors(form.actors);
	d_error = validate_director(form.director);

	
	if (t_error != "") { error += t_error + "\n"; }
	if (a_error != "") { error += a_error + "\n"; }
	if (d_error != "") { error += d_error + "\n"; }

	if (t_error == "" && a_error == "" && d_error == "") {
		return true;
	} else {
		alert("Please fix the following error(s):\n" + error);
		return false;
	}
	return true;

}


function validate_title(field) {
	var value = field.value.trim();
	var error = "";
	field.className = 'valid';

	if (value.length == 0) {
		field.className = 'invalid';
		error += "Please enter a title. ";
	}

	var chars = /[A-Za-z0-9]+/;
	if (!chars.test(value)) { //field contains no letters/numbers
		field.className = 'invalid';
		error += "Title must contain at least one letter or number. ";
	}
	if (value.length > 200) {
		field.className = 'invalid';
		error += "The title is too long. ";
	}

	var msg = document.getElementById("title_msg");
	msg.innerHTML = error;
	return error;

}


function validate_actors(field) {
	var value = field.value.trim();
	var error = "";
	field.className = 'valid';

	var comma = /^[,]+$/;
	var chars = /^[A-Za-z,'. ]+$/;
	if (value.length == 0 || comma.test(value)) {
		field.className = 'invalid';
		error += "Please enter one or more actors. ";
	} else if (!chars.test(value)) { //field contains any chars other than {a-z A-Z , ' .}
		field.className = 'invalid';
		error += "Actor name(s) contains one or more invalid characters. ";
	}
	if (value.length > 250) {
		field.className = 'invalid';
		error += "Too many actors. ";
	}

	var msg = document.getElementById("actors_msg");
	msg.innerHTML = error;
	return error;
}


function validate_director(field) {
	var value = field.value.trim();
	var error = "";
	field.className = 'valid';

	var chars = /^[A-Za-z'. ]+$/;
	if (value.length == 0) {
		field.className = 'invalid';
		error += "Please enter a director. ";
	} else if (!chars.test(value)) { //field contains any chars other than {a-z A-Z ' .}
		field.className = 'invalid';
		error += "Director name contains one or more invalid characters. ";
	}


	if (value.length > 50) {
		field.className = 'invalid';
		error += "Director name input too long. ";
	}

	var msg = document.getElementById("director_msg");
	msg.innerHTML = error;
	return error;
}
