-- SCHEMA --

-- Dropping and creating a table (note PRIMARY KEY)
DROP TABLE users;
CREATE TABLE users (
	id serial PRIMARY KEY NOT NULL,
	name VARCHAR(20),
	password VARCHAR(40),
	level integer,
	exp integer,
	email VARCHAR(30)
);