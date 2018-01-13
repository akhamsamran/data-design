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
	blogId BINARY(16) NOT NULL,
	-- this is the attribute for foreign key:
	blogProfileId BINARY(16) NOT NULL,
-- here are the rest of the attributes for blog entity:
	blogTitle VARCHAR(128) NOT NULL,
	blogContent VARCHAR(65335) NOT NULL,
	blogDate TIMESTAMP(8) NOT NULL,
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
	FOREIGN KEY (clapProfileId) REFERENCES profile(profileId),
	FOREIGN KEY (clapBlogId) REFERENCES blog(blogId),
	-- create primary key:
	PRIMARY KEY (clapID)
);