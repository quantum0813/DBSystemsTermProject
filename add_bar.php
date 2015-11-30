<?php
include_once 'db_connect.php';
include_once 'functions.php';
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="add_bar.css">
		<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script src="bar_list.js"></script>
		<title>Add New Bar</title>
	</head>
	<body>
		<?php
			$bars = getBarNames($mysqli);
		?>
		<div class="header" style="margin-bottom: 20px;">Add New Bar</div>

		<form id="userDataForm" action="add_bar_beer.php" method="POST">
			<table>
				<tr>
					<td style="display: none;"><input id="action" name="action" type="hidden" value="addBar">addBar</input></td>
					<td><span class="inputTitle">Bar Name</span></td>
					<td><input id="barName" name="barName" type="text"></input></td>
				</tr>
				<tr>
					<td><span class="inputTitle">Address</span></td>
					<td><input id="address" name="address" type="text"></input></td>
				</tr>
				<tr>
                                        <td><span class="inputTitle">City</span></td>
                                        <td><input id="city" name="city" type="text"></input></td>
                                </tr>
				<tr>
                                        <td><span class="inputTitle">State</span></td>
                                        <td><input id="state" name="state" type="text"></input></td>
                                </tr>
				<tr>
                                        <td><span class="inputTitle">Zip</span></td>
                                        <td><input id="zip" name="zip" type="text"></input></td>
                                </tr>
				<tr>
					<td><input id="submitAddBar" type="submit" value="Add Bar"></input></td>
					<td><input id="btnReset" type="reset" value="Reset"></input></td>
				</tr>
			</table>
		</form>

		<div class="header" style="margin: 20px 0 20px 0;">Add New Beer</div>

		<form id="userDataForm" action="add_bar_beer.php" method="POST">
			<table>
				<tr>
					<td style="display: none;"><input id="action" name="action" type="hidden" value="addBeer">addBeer</input></td>
					<td><span class="inputTitle">Bar Name</span></td>
					<td>
						<select id="barName" name="barName" style="width: 100%;">
							<?php
								for ($i = 0; $i < count($bars); $i++) {
									$optionTxt = '<option value="';
									$optionTxt .= $bars[$i];
									$optionTxt .= ('">' . $bars[$i] . '</option>');
									echo($optionTxt);
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><span class="inputTitle">Beer Name</span></td>
					<td><input id="beerName" name="beerName" type="text"></input></td>
				</tr>
				<tr>
                                        <td><span class="inputTitle">Maker</span></td>
                                        <td><input id="maker" name="maker" type="text"></input></td>
                                </tr>
				<tr>
                                        <td><span class="inputTitle">Type</span></td>
                                        <td><input id="type" name="type" type="text"></input></td>
                                </tr>
				<tr>
                                        <td><span class="inputTitle">Rating</span></td>
                                        <td><input id="rating" name="rating" type="text"></input></td>
                                </tr>
				<tr>
                                        <td><span class="inputTitle">Price</span></td>
                                        <td><input id="price" name="price" type="text"></input></td>
                                </tr>
				<tr>
					<td><input id="submitAddBeer" type="submit" value="Add Beer"></input></td>
					<td><input id="btnReset" type="reset" value="Reset"></input></td>
				</tr>
			</table>
		</form>
	</body>
</html>
