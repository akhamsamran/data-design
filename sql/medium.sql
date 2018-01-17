ALTER DATABASE akhamsamran1 CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- profile table:
CREATE TABLE profile(
	-- here is attribute for primary key:
	profileId BINARY(16) NOT NULL,
	-- here are the rest of the attributes for profile entity:
	profileFirstName VARCHAR(50) NOT NULL,
	profileLastName VARCHAR(50) NOT NULL,
	profileEmail VARCHAR(128) NOT NULL,
	-- here are verification attributes for entity:
	profileHash CHAR(128) NOT NULL,
	profileSalt CHAR(64) NOT NULL,
	-- unique index created:
	UNIQUE (profileId),
	-- Primary key indicated:
	PRIMARY KEY(profileId)
);

-- this is the table for blog:
CREATE TABLE blog(
	-- this is the attribute for primary key:
	blogId BINARY(16) NOT NULL,
	-- this is the attribute for foreign key:
	blogProfileId BINARY(16) NOT NULL,
	-- here are the rest of the attributes for blog entity:
	blogTitle VARCHAR(128) NOT NULL,
	blogContent VARCHAR(1000) NOT NULL,
	blogDate TIMESTAMP(6) NOT NULL,
	-- here is the unique index:
	UNIQUE (blogId),
	-- index foreign key:
	INDEX(blogProfileId),
	-- create foreign keys and reference/relationship:
	FOREIGN KEY(blogProfileId) REFERENCES profile(profileId),
	-- assign Primary Key:
	PRIMARY KEY(blogId)
);

-- this is the table for clap:
CREATE TABLE clap(
	-- this is the attribute for primary key. I need to find out if this really needs to be BINARY(16), as claps don't really need a UTF number, couldn't they just be an autoincrementing INT or BIGINT?:
	clapId BINARY(16) NOT NULL,
	-- other attributes for clap (both foreign keys):
	clapProfileId BINARY(16) NOT NULL,
	clapBlogId BINARY(16) NOT NULL,
	-- set unique index:
	UNIQUE (clapId),
	INDEX(clapProfileId),
	INDEX(clapBlogId),
	-- create foreign keys and relationships:
	FOREIGN KEY(clapProfileId) REFERENCES profile(profileId),
	FOREIGN KEY(clapBlogId) REFERENCES blog(blogId),
	-- create primary key:
	PRIMARY KEY (clapID)
);

-- insert info into table profile. note-cannot enter UUID, so used random#instead(also don't know what salt and hash should be so used 12345):
INSERT INTO profile(profileId, profileFirstName, profileLastName, profileEmail, profileHash, profileSalt)
VALUES(12345, 'Anna', 'Khamsamran', 'akhamsamran@gmail.com', 12345, 12345);
INSERT INTO profile(profileId, profileFirstName, profileLastName, profileEmail, profileHash, profileSalt)
VALUES(1234555, 'Elizabeth', 'Gilmore', 'bettyg@gmail.com', 12345, 12345);

-- delete info from table profile:
DELETE FROM profile
WHERE profileID=1234555;
DELETE FROM profile
WHERE profileEmail='bettyg@gmail.com';
