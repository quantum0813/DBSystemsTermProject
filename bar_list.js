$(document).ready(function() {
	$( "#accordion" ).accordion({
		icons: icons
	});

	$('#btnAddNewBarBeer').on('click', function() {
		location.href = 'add_bar_beer.php';
	});
	
	/*for (var i = 0; i < elems.length; i++) {
		$(elems[i]).on('click', function() {
			var url = "edit_user.php?action=edit" + "&id=" + this.id.substr(9);
			window.location = url;
		});
	}
	
	$('#btnSearchUsers').on('click', function() {
		$.ajax({
			type: "POST",
			url: "add_edit_user.php",
			data: createQueryString(),
			success: function(data) {
				setupTable(JSON.parse(data));
			},
			error: function(jqxhr, msg, err) {
				alert("There was an error processing your request. Please try again later.");
			}
		});
	});*/
});

/*function createQueryString() {
	var queryStr = "";
	queryStr += "action=search&";
	queryStr += ("type=" + $('#searchAttr option:selected').val() + "&");
	queryStr += ("query=" + $('#searchBox').val());
	return queryStr;
}

function setupTable(users) {
	var userTable = $('#userTable');
	var html = "<thead><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Street</th><th>City</th><th>State</th><th>Zip</th><th>Date Added</th><th>Gender</th><th>Edit</th></thead><tbody>";
	for (var i = 0; i < users.length; i++) {
		var tr = (i % 2 == 0) ? '<tr class="even">' : '<tr class="odd">';
		html += tr;
		html += ('<td>' + users[i].id + '</td>');
		html += ('<td>' + users[i].fname + '</td>');
		html += ('<td>' + users[i].lname + '</td>');
		html += ('<td>' + users[i].email + '</td>');
		html += ('<td>' + users[i].phone + '</td>');
		html += ('<td>' + users[i].street + '</td>');
		html += ('<td>' + users[i].city + '</td>');
		html += ('<td>' + users[i].state + '</td>');
		html += ('<td>' + users[i].zip + '</td>');
		html += ('<td>' + users[i].date + '</td>');
		html += ('<td>' + (users[i].gender == "m" ? "Male" : "Female") + '</td>');
		html += ('<td><button class="editUser" id="edit-user' + users[i].id + '">Edit</button>' + '</td>');
		html += '</tr>';
	}
	$(userTable).html(html);
}*/
