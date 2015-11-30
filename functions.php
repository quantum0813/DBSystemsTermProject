<?php
	include_once 'db_connect.php';
	
	function getBars($mysqli) {
		$barName = "";
		$barStreet = "";
		$barCity = "";
		$barState = "";
		$barZip = -1;

		$beerName = "";
		$beerMaker = "";
		$beerType = "";
		$beerRating = -1;
		$beerPrice = -1;

		$barList = array();
		
		$prepStmtGetBeers = "SELECT beers.name AS beerName, beers.maker, beers.type, beers.rating, serves.barName, bars.street, bars.city, bars.state, bars.zip, serves.price, serves.beerName FROM beers LEFT JOIN serves ON beers.name = serves.beerName LEFT JOIN bars ON bars.name = serves.barName";
		$stmtGetBeers = $mysqli->prepare($prepStmtGetBeers);
		if ($stmtGetBeers) {
			$beers = array();
			$stmtGetBeers->execute();
			$stmtGetBeers->store_result();
			$stmtGetBeers->bind_result($beerName, $beerMaker, $beerType, $beerRating, $barName, $barStreet, $barCity, $barState, $barZip, $beerPrice, $discardVar);
			while ($stmtGetBeers->fetch()) {
				$arr = array("barName" => $barName, "barStreet" => $barStreet, "barCity" => $barCity, "barState" => $barState, "barZip" => $barZip, "beerName" => $beerName, "beerMaker" => $beerMaker, "beerType" => $beerType, "beerRating" => $beerRating, "beerPrice" => $beerPrice);
				array_push($beers, $arr);
			}
			$stmtGetBeers->close();
		}

		// Added bars list
		$addedBars = [];
		for ($i = 0; $i < count($beers); $i++) {
			if (!in_array($beers[$i]['barName'], $addedBars)) {
				$barInfo = array();
				$barInfo['barName'] = $beers[$i]['barName'];
				$barInfo['barStreet'] = $beers[$i]['barStreet'];
				$barInfo['barCity'] = $beers[$i]['barCity'];
				$barInfo['barState'] = $beers[$i]['barState'];
				$barInfo['barZip'] = $beers[$i]['barZip'];
				$barInfo['beerList'] = [];

				$barList[] = $barInfo;
				$addedBars[] = $beers[$i]['barName'];
			}
		}

		for ($i = 0; $i < count($barList); $i++) {
			for ($j = 0; $j < count($beers); $j++) {
				if ($barList[$i]['barName'] === $beers[$j]['barName']) {
					$beerInfo = array();
					$beerInfo['beerName'] = $beers[$j]['beerName'];
					$beerInfo['beerMaker'] = $beers[$j]['beerMaker'];
					$beerInfo['beerType'] = $beers[$j]['beerType'];
					$beerInfo['beerRating'] = $beers[$j]['beerRating'];
					$beerInfo['beerPrice'] = $beers[$j]['beerPrice'];
					$barList[$i]['beerList'][] = $beerInfo;
				}
			}
		}

		return $barList;
	}

	function getUserInfo($userId, $mysqli) {
                $usrId = -1;
		$fname = "";
                $lname = "";
                $email = "";
                $phone = "";
                $dateAdded = "";
                $gender = "";
                $addr = "";
                $city = "";
                $state = "";
                $zip = "";
		
		$prepStmtGetUsers = "SELECT * FROM users WHERE id = ?";
                $stmtGetUsers = $mysqli->prepare($prepStmtGetUsers);
                if ($stmtGetUsers) {
                        $userInfo = array();
			$stmtGetUsers->bind_param('i', $userId);
                        $stmtGetUsers->execute();
                        $stmtGetUsers->store_result();
                        $stmtGetUsers->bind_result($usrId, $fname, $lname, $email, $phone, $dateAdded, $gender, $addr, $city, $state, $zip);
                        while ($stmtGetUsers->fetch()) {
                                $arr = array("id" => $usrId, "fname" => $fname, "lname" => $lname, "email" => $email, "phone" => $phone, "date" => $dateAdded, "gender" => $gender, "street" => $addr, "city" => $city, "state" => $state, "zip" => $zip);
                                array_push($userInfo, $arr);
                        }
                        $stmtGetUsers->close();
                }
                return $userInfo;
	}

	function addBar($barName, $address, $city, $state, $zip, $mysqli) {
		$prepStmtAddBar = "INSERT INTO bars (name, street, city, state, zip) VALUES (?, ?, ?, ?, ?)";
		$stmtAddBar = $mysqli->prepare($prepStmtAddBar);
		if ($stmtAddBar) {
			$stmtAddBar->bind_param('sssss', $barName, $address, $city, $state, $zip);
			$stmtAddBar->execute();
			$stmtAddBar->close();
		}
	}

	function addBeer($barName, $beerName, $maker, $type, $rating, $price, $mysqli) {
		$prepStmtAddBeer = "INSERT INTO beers (name, maker, type, rating) VALUES (?, ?, ?, ?)";
		$stmtAddBeer = $mysqli->prepare($prepStmtAddBeer);
		if ($stmtAddBeer) {
			$stmtAddBeer->bind_param('ssss', $beerName, $maker, $type, $price);
			$stmtAddBeer->execute();
			$stmtAddBeer->close();
		}

		$prepStmtAddServes = "INSERT INTO serves (barName, beerName, price) VALUES (?, ?, ?)";
		$stmtAddServes = $mysqli->prepare($prepStmtAddServes);
		if ($stmtAddServes) {
			$stmtAddServes->bind_param('ssd', $barName, $beerName, $price);
			$stmtAddServes->execute();
			$stmtAddServes->close();
		}
	}

	function getBarNames($mysqli) {
		$prepStmtGetBarNames = "SELECT name FROM bars";
		$stmtGetBarNames = $mysqli->prepare($prepStmtGetBarNames);
		if ($stmtGetBarNames) {
			$bars = array();
			$barName = '';
			$stmtGetBarNames->execute();
			$stmtGetBarNames->store_result();
			$stmtGetBarNames->bind_result($barName);
			while ($stmtGetBarNames->fetch())
				array_push($bars, $barName);
			$stmtGetBarNames->close();
		}
		return $bars;
	}

	function updateUser($id, $fname, $lname, $email, $phone, $gender, $street, $city, $state, $zip, $mysqli) {
		$prepStmtUpdateUser = "UPDATE users SET fname = ?, lname = ?, email = ?, phone = ?, gender = ?, addr = ?, city = ?, state = ?, zip = ? WHERE id = ?";
		$stmtUpdateUser = $mysqli->prepare($prepStmtUpdateUser);
		if ($stmtUpdateUser) {
			$stmtUpdateUser->bind_param('sssssssssi', $fname, $lname, $email, $phone, $gender, $street, $city, $state, $zip, $id);
			$stmtUpdateUser->execute();
			$stmtUpdateUser->close();
		}
	}

	function removeUser($id, $mysqli) {
		$prepStmtDeleteUser = "DELETE FROM users WHERE id = ?";
		$stmtDeleteUser = $mysqli->prepare($prepStmtDeleteUser);
		if ($stmtDeleteUser) {
			$stmtDeleteUser->bind_param('i', $id);
			$stmtDeleteUser->execute();
			$stmtDeleteUser->close();
		}
	}

	function searchUsers($type, $query, $mysqli) {
		$usrId = -1;
		$fname = "";
		$lname = "";
		$email = "";
		$phone = "";
		$dateAdded = "";
		$gender = "";
		$addr = "";
		$city = "";
		$state = "";
		$zip = "";
		$users = [];

		$prepStmtSearchUsers = ("SELECT * FROM users WHERE " . $type . " RLIKE ?");
		$stmtSearchUsers = $mysqli->prepare($prepStmtSearchUsers);
		if ($stmtSearchUsers) {
			$stmtSearchUsers->bind_param('s', $query);
			$stmtSearchUsers->execute();
                        $stmtSearchUsers->store_result();
                        $stmtSearchUsers->bind_result($usrId, $fname, $lname, $email, $phone, $dateAdded, $gender, $addr, $city, $state, $zip);
                        while ($stmtSearchUsers->fetch()) {
                                $arr = array("id" => $usrId, "fname" => $fname, "lname" => $lname, "email" => $email, "phone" => $phone, "date" => $dateAdded, "gender" => $gender, "street" => $addr, "city" => $city, "state" => $state, "zip" => $zip);
                                array_push($users, $arr);
                        }
                        $stmtSearchUsers->close();
		}
		echo(json_encode($users));
	}
?>
