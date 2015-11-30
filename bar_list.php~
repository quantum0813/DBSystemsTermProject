<?php
include_once 'db_connect.php';
include_once 'functions.php';

$barList = getBars($mysqli);
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="bar_list.css">
		<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script src="bar_list.js"></script>
		<title>Bar and Beer Listing</title>
	</head>
	<body>
		<table id="headerTable">
			<tr id="headerRow">
				<td id="pageTitle"><span>Bar List</span></td>
				<td align="right" id="addUserCol">
					<button id="new-user">Add Bar</button>
					<input type="text" id="searchBox">
					<select id="searchAttr">
						<option value="id">ID</option>
						<option value="fname">First Name</option>
						<option value="lname">Last Name</option>
						<option value="email">Email</option>
						<option value="phone">Phone</option>
						<option value="addr">Street</option>
						<option value="city">City</option>
						<option value="state">State</option>
						<option value="zip">Zip</option>
						<option value="gender">Gender</option>
					</select>
					<button id="btnSearchUsers">Search</button>
				</td>
			</tr>
		</table>

		<div id="accordion">
			<?php
				for ($i = 0; $i < count($barList); $i++) {
					$headerText = '';
					$headerText .= ('<h3><strong>' . $barList[$i]['barName'] . '</strong>');
					$headerText .= ' - ';
					$headerText .= ($barList[$i]['barStreet'] . ', ' . $barList[$i]['barCity'] . ', ' . $barList[$i]['barState'] . '  ' . $barList[$i]['barZip']);
					$headerText .= '</h3>';
					echo($headerText);
					$beersTable = '<div><table>';
					$beersTable .= '<tr><th>Name</th><th>Maker</th><th>Type</th><th>Rating</th><th>Price</th></tr>';
					for ($j = 0; $j < count($barList[$i]['beerList']); $j++) {
						$beersTable .= '<tr>';
						$beersTable .= ('<td>' . $barList[$i]['beerList'][$j]['beerName'] . '</td>');
						$beersTable .= ('<td>' . $barList[$i]['beerList'][$j]['beerMaker'] . '</td>');
						$beersTable .= ('<td>' . $barList[$i]['beerList'][$j]['beerType'] . '</td>');
						$beersTable .= ('<td>' . $barList[$i]['beerList'][$j]['beerRating'] . '/10</td>');
						$beersTable .= ('<td>$' . number_format($barList[$i]['beerList'][$j]['beerPrice'], 2, '.', '') . '</td>');
						$beersTable .= '</tr>';
					}
					$beersTable .= '</table></div>';
					echo($beersTable);
				}
			?>
		</div>
	</body>

	<br/>

	<button class="addBtn" id="btnAddNewBarBeer">Add New Bar/Beer</button>
	<button class="addBtn" id="btnEditBarBeer">Edit Bar/Beer</button>

	<br/><br/>
	<a href="help.php"><h4>Help</h4></a>
</html>
