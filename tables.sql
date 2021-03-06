CREATE TABLE bars(
	name VARCHAR(250) NOT NULL,
	street VARCHAR(300) NOT NULL,
	city VARCHAR(250) NOT NULL,
	state VARCHAR(2) NOT NULL,
	zip INT(5) NOT NULL,
	PRIMARY KEY (name, street)
);

CREATE TABLE beers(
	name VARCHAR(250) NOT NULL,
	maker VARCHAR(200) NOT NULL,
	type VARCHAR(200) NOT NULL,
	rating INT(3) NOT NULL,
	PRIMARY KEY (name, maker)
);

CREATE TABLE serves(
	barName VARCHAR(250) NOT NULL,
	beerName VARCHAR(250) NOT NULL,
	price FLOAT(2,2) NOT NULL,
	PRIMARY KEY (barName, beerName)
);
