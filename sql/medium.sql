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

-- delete whole rows from table profile:
DELETE FROM profile
WHERE profileID=1234555;

DELETE FROM profile
WHERE profileEmail='bettyg@gmail.com';

DELETE FROM profile
WHERE profileLastName = 'Gilmore';

DELETE FROM profile
WHERE profileFirstName="Ace-K";

-- use UNHEX REPLACE to convert UUID into BINARY, and remove dashes:
INSERT INTO profile(profileId, profileFirstName, profileLastName, profileEmail, profileHash, profileSalt)
VALUES UNHEX(REPLACE ('e6bb6b29-52e5-4b00-956b-a67cf5246bbe', '-', '')), 'Jean-Luc', 'Picard', 'jlpicard@starfleet.go.us',12345,12345);

-- what do I put in for foreign key for the blogProfileId-OKAY-use the whole unhex thingy for the profle who wrote it:
INSERT INTO blog(blogId, blogProfileId, blogTitle, blogContent)
	VALUE(UNHEX(REPLACE('3345d41a-541e-482a-9dcb-a0f545f3dabc', '-', '')), UNHEX(REPLACE('a401e9ef-e1b5-41c6-a428-205a3452f4a8', '-', '')), 'My Favorite Cupcake', 'Cupcake ipsum dolor sit amet wafer candy carrot cake. Apple pie chocolate sesame snaps pastry biscuit cookie cake marzipan. Cheesecake liquorice sweet roll jelly sweet roll. Fruitcake fruitcake bonbon cookie pastry dessert chocolate cake cookie topping.');


-- change my profileId for person lastname Khamsamran (when working with UUID's you have to use the entire "UNHEX(REPLACE" string:
UPDATE profile
SET profileId=UNHEX(REPLACE('a401e9ef-e1b5-41c6-a428-205a3452f4a8', '-', ''))
WHERE profileLastName = 'Khamsamran';

UPDATE profile
SET profileId=UNHEX(REPLACE('6cd70bf17-5774-75ca-44a5-c42662b575f', '-', ''))
WHERE profileLastName = 'Gilmore';

UPDATE profile
SET profileFirstName='Anna'
WHERE profileId=UNHEX(REPLACE('a401e9ef-e1b5-41c6-a428-205a3452f4a8', '-', ''));



-- to see the profileId's from profile:
SELECT profileId
FROM profile;

SELECT blogContent
FROM blog;

SELECT profileId, profileFirstName, profileLastName, profileEmail
FROM profile
WHERE <filter expression>

-- add missing attribute for activation token to table, profile:
ALTER TABLE profile
	ADD profileActivationToken CHAR(32);
-- add missing attribute for activation token to table, profile
ALTER TABLE profile
	ADD profileAboutMe VARCHAR(500);

-- increased character count from 1000 to 10000:
ALTER TABLE blog
	MODIFY blogContent VARCHAR(10000);

-- join
SELECT clapProfileId, profileId
	FROM clap
	INNER JOIN profile ON profile.profileId = clap.clapProfileId
	WHERE clapId = UNHEX(REPLACE('3345d41a-541e-482a-9dcb-a0f545f3dabc', '-', ''));



INSERT INTO blog(blogId,blogProfileId,blogTitle,blogContent)
VALUES (UNHEX(REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')), UNHEX(REPLACE('e6bb6b29-52e5-4b00-956b-a67cf5246bbe', '-', '')), 'Spaceships for Dummies', 'Unidentified vessel travelling at sub warp speed, bearing 235.7. Fluctuations in energy readings from it, Captain. All transporters off. A strange set-up, but I''d say the graviton generator is depolarized. The dark colourings of the scrapes are the leavings of natural rubber, a type of non-conductive sole used by researchers experimenting with electricity. The molecules must have been partly de-phased by the anyon beam.');

-- here is the stuff to insert in the clap table:
INSERT INTO clap(clapId, clapProfileId, clapBlogId)
VALUES (UNHEX(REPLACE('47f35df0-bff8-46b4-b669-0f15a3dae3c4', '-', '')),
		  UNHEX(REPLACE('a401e9ef-e1b5-41c6-a428-205a3452f4a8', '-', '')),
		  UNHEX(REPLACE('30d28a7e-192b-4f54-b97d-ba6166eb7433', '-', '')));


-- in order to do the following join, you must first INSERT the data in the clap table:
SELECT clapProfileId, profileId
FROM clap
	INNER JOIN profile ON profile.profileId = clap.clapProfileId
WHERE clapId = UNHEX(REPLACE('47f35df0-bff8-46b4-b669-0f15a3dae3c4', '-', ''));