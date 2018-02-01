function returnonenter(e) {
	var keycode;
	
	if (window.event)
		keycode = window.event.keyCode;
	else if (e)
		keycode = e.which;
	else
		return true;

	return (keycode != 13);
}

function submitonenter(e, id) {
	var keycode;
	
	if (window.event)
		keycode = window.event.keyCode;
	else if (e)
		keycode = e.which;
	else
		return true;

	if (keycode == 13) {
		var button = document.getElementById(id);
		if (button)
			button.click();
		return false;
	}
	else
		return true;
}

function focusonenter(e, id) {
	var keycode;
	
	if (window.event)
		keycode = window.event.keyCode;
	else if (e)
		keycode = e.which;
	else
		return true;

	if (keycode == 13) {
		var field = document.getElementById(id);
		if (field)
			field.focus();
		return false;
	}
	else
		return true;
}

function focuson(id) {
	var e=document.getElementById(id);
	if (e)
		e.focus();
}
