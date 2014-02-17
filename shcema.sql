-- SCHEMA --

-- Dropping and creating a table for users(note PRIMARY KEY)
DROP TABLE users;
CREATE TABLE users (
	id serial PRIMARY KEY NOT NULL,
	name VARCHAR(20),
	password VARCHAR(40),
	level integer,
	exp integer,
	email VARCHAR(30)
);

-- Dropping and creating a table for task
DROP TABLE task;
CREATE TABLE tasks (
	id serial PRIMARY KEY NOT NULL,
	userID integer,
	title VARCHAR(40),
	description VARCHAR(400),
	totalSlot integer,
	remainingSlot integer
)