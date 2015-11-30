$(document).ready(function() {
        $('#btnReset').on('click', function(e) {
		e.preventDefault();
		$('#fname').val("");
		$('#fname').css("border-color", "");
		$('#lname').val("");
		$('#lname').css("border-color", "");
		$('#email').val("");
		$('#email').css("border-color", "");
		$('#phone').val("");
		$('#phone').css("border-color", "");
		$('#street').val("");
		$('#street').css("border-color", "");
		$('#city').val("");
		$('#city').css("border-color", "");
		$('#state').val("");
		$('#state').css("border-color", "");
		$('#zip').val("");
		$('#zip').css("border-color", "");
		$('#radioM').prop("checked", false);
		$('#radioF').prop("checked", false);
        });

	$('#submitSaveChanges, #submitAddUser').on('click', function(e) {
		e.preventDefault();
		var errors = validateForm();
		if (errors.length > 0) {
                	var str = "";
                	for (var i = 0; i < errors.length; i++)
                        	str += (errors[i] + '\n');
                	alert(str);
        	} else {
			// Happily submit the form
			$('#fname').css("border-color", "");
			$('#lname').css("border-color", "");
			$('#email').css("border-color", "");
			$('#phone').css("border-color", "");
			$('#street').css("border-color", "");
			$('#city').css("border-color", "");
			$('#state').css("border-color", "");
			$('#zip').css("border-color", "");
			
			$.ajax({
				type: "POST",
				url: "add_edit_user.php",
				data: getSerializedFormData() + "&action=" + getParameterByName("action") + "&id=" + getParameterByName("id"),
				success: function(data) {
					location.href = "user_list.php";
				},
				error: function(jqxhr, msg, err) {
					alert("There was an error processing your request. Please try again later.");
				}
			});
		}
	});

	$('#btnRemove').on('click', function(e) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "add_edit_user.php",
			data: getSerializedFormData() + "&action=remove" + "&id=" + getParameterByName("id"),
			success: function(data) {
				location.href = "user_list.php";
			},
			error: function(jqxhr, msg, err) {
				alert("There was an error processing your request. Please try again later.");
			}
		});
	});
});

function validateForm() {
	var stateAbbrevs = new Array("AE","AP","AL","AK","AS","AZ","AR","CA","CO","CT","DE","DC","FM","FL","GA","GU","HI","ID","IL","IN","IA","KS","KY","LA","ME","MH","MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","MP","OH","OK","OR","PW","PA","PR","RI","SC","SD","TN","TX","UT","VT","VI","VA","WA","WV","WI","WY");
	var errors = [];

	var fname = $('#fname').val();
	if (fname == "") {
		errors.push("* First name must be present");
		$('#fname').css("border-color", "red");
	}
	if (fname.substring(0, 1) != fname.substring(0, 1).toUpperCase()) {
		errors.push("* First letter of first name must be uppercase");
		$('#fname').css("border-color", "red");
	}
	
	var lname = $('#lname').val();
	if (lname == "") {
		errors.push("* Last name must be present");
		$('#lname').css("border-color", "red");
	}
	if (lname.substring(0, 1) != lname.substring(0, 1).toUpperCase()) {
		errors.push("* First letter of last name must be uppercase");
		$('#lname').css("border-color", "red");
	}

	var email = $('#email').val();
	var regex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
	
	if (email == "") {
		errors.push("* Email must be present");
		$('#email').css("border-color", "red");
	}
	if (!regex.test(email)) {
		errors.push("* Email is not of the correct form (user@domain.com)");
		$('#email').css("border-color", "red");
	}

	var phone = $('#phone').val();
	regex = /^(\+0?1\s)?\d{3}?[\s.-]\d{3}[\s.-]\d{4}$/;

	if (phone == "") {
		errors.push("* Phone number must be present");
		$('#phone').css("border-color", "red");
	}
	if (!regex.test(phone)) {
		errors.push("* Phone number is not of correct form (123-456-7890)");
		$('#phone').css("border-color", "red");
	}

	var street = $('#street').val();
	
	if (street == "") {
		errors.push("* Street must be present");
		$('#street').css("border-color", "red");
	}

	var city = $('#city').val();
	
	if (city == "") {
		errors.push("* City must be present");
		$('#city').css("border-color", "red");
	}
	if (city.substring(0, 1) != city.substring(0, 1).toUpperCase()) {
		errors.push("* First letter of city must be uppercase");
		$('#city').css("border-color", "red");
	}

	var state = $('#state').val();

	if (state == "") {
		errors.push("* State must be present");
		$('#state').css("border-color", "red");
	}
	if (state != state.toUpperCase()) {
		errors.push("* State must be uppercase abbreviation");
		$('#state').css("border-color", "red");
	}
	var foundState = false;
	for (var i = 0; i < stateAbbrevs.length; i++) {
		if (stateAbbrevs[i] == state) {
			foundState = true;
			break;
		}
	}
	if (!foundState) {
		errors.push("* State abbreviation does not represent a valid US state.");
		$('#state').css("border-color", "red");
	}

	var zip = $('#zip').val();
	
	if (zip == "") {
		errors.push("* Zip code must be present");
		$('#zip').css("border-color", "red");
	}
	if (isNaN(zip)) {
		errors.push("* Zip code must be numeric");
		$('#zip').css("border-color", "red");
	}
	if (zip.length < 5 || zip.length > 6) {
		errors.push("* Zip code must be either 5 or 6 digits");
		$('#zip').css("border-color", "red");
	}

	if (!$('#radioM').is(':checked') && !$('#radioF').is(':checked'))
		errors.push("* A gender must be selected");

	return errors;
}

function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function getSerializedFormData() {
	var queryStr = "";
	queryStr += ('fname=' + $('#fname').val() + '&');
	queryStr += ('lname=' + $('#lname').val() + '&');
	queryStr += ('email=' + $('#email').val() + '&');
	queryStr += ('phone=' + $('#phone').val() + '&');
	queryStr += ('street=' + $('#street').val() + '&');
	queryStr += ('city=' + $('#city').val() + '&');
	queryStr += ('state=' + $('#state').val() + '&');
	queryStr += ('zip=' + $('#zip').val() + '&');
	queryStr += ('gender=' + $('input:radio[name=sex]:checked').val());
	return queryStr;
}
