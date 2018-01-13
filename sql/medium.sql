-- set database collation to UTF-8
ALTER DATABASE akhamsamran1_CHANGE_ME CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- this is the table for profile:
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
	blogId BINARY (16) NOT NULL,
-- here are the rest of the attributes for blog entity:
	blogTitle VARCHAR (128) NOT NULL,
	blogContent VARCHAR (65335) NOT NULL,
	blogDate TIMESTAMP (8) NOT NULL,
	-- here is the unique index:
	UNIQUE (blogId),
	-- assigned Primary Key:
	PRIMARY KEY(blogId)
);