-- SCHEMA --

-- Dropping and creating a table (note PRIMARY KEY)
DROP TABLE users;
CREATE TABLE users (
	id serial PRIMARY KEY NOT NULL,
	name VARCHAR(20),
	password VARCHAR(20),
	-- need encryption here
	level real,
	email VARCHAR(30)
);

