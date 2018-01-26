<?php

/**
 * add namespace
 **/
namespace Edu\Cnm\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__ . "autoload.php"));
use Ramsey\Uuid\Uuid;


/**
 * Typical profile for a bloging or article sharing website like Medium
 *
 * This profile is an abbvreviated example of a profile of a user of a blogging website, including ID, name, hash, and salt...other attributes specific to the person can be added as required, for example contact info, etc.
 *
 * @author Anna Khamsamran <akhamsamran1@cnm.edu>
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 *
 **/
class Profile implements \JsonSerializable {
	/**
	 * add use validate Uuid.php
	 **/
	use ValidateUuid;
	/**
	 * id for this Profile; this is the primary key
	 * this is a unique index
	 **/
	private $profileId;
	/**
	 * biographical information "about me" for the profile
	**/
	private $profileAboutMe;
	/**
	 * access token for the profile
	 **/
	private $profileActivationToken;
	/**
	 * email for the profile
	 **/
	private $profileEmail;
	/**
	 * first name of the profile
	 **/
	private $profileFirstName;
	/**
	 * hash for the profile
	 **/
	private $profileHash;
	/**
	 * last name of the profile
	 **/
	private $profileLastName;
	/**
	 * salt for the profile
	 **/
	private $profileSalt;

	/**
	 * constructor for this profile
	 *
	 * @param int $newProfileId new profile id
	 * @param string $newProfileAboutMe new bio info called about me
	 * @param string $newProfileActivationToken new activation token
	 * @param string $newProfileEmail new email for the profile
	 * @param string $newProfileFirstName new first name for the profile
	 * @param string $newProfileHash new hash for the profile
	 * @param string $newProfileLastName new last name for the profile
	 * @param String $newProfileSalt new salt for the profle
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentationhttps://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, $newProfileAboutMe, $newProfileActivationToken, $newProfileEmail,$newProfileFirstName, $newProfileHash, $newProfileLastName, $newProfileSalt) {
		try{
			$this->setProfileId($newProfileId);
			$this->setProfileAboutMe($newProfileAboutMe);
			$this->setprofileActivationToken($newProfileActivationToken);
			$this->setprofileEmail($newProfileEmail);
			$this->setprofileFirstName($newProfileFirstName);
			$this->setprofileHash($newProfileHash);
			$this->setprofileLastName($newProfileLastName);
			$this->setprofileSalt($newProfileSalt);

		}		//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for profile id
	 *
	 * @return string|Uuid value of profile id
	 **/
	public function getProfileId() : uuid {
		return($this->profileId);
	}
	/**
	 * mutator method for profile id
	 *
	 * @param string|Uuid $newProfileId new value of profile id
	 * @throws \UnexpectedValueException if $newProfileId is not an integer
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if the profile Id is not
	 **/
	public function setProfileId( $newProfileId): void {
		try {
			$uuid = self::validateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->profileId = $uuid;

	}	/**
	 * accessor method for profile about me
	 *
	 * @return string value of profile about me
	 **/
	public function getprofileAboutMe(): string {
		return ($this->profileAboutMe);
	}
	/**
	 * mutator method for profile about me
	 *
	 * @param string $newProfileAboutMe new value of profile about me
	 * @throws \UnexpectedValueException if $newProfileAboutMe is not a string
	 **/
	public function setProfileAboutMe($newProfileAboutMe) {
		$newProfileAboutMe = filter_var($newProfileAboutMe, FILTER_SANITIZE_STRING);
		if($newProfileAboutMe === false) {
			throw(new \UnexpectedValueException("About me is not a valid string"));
		}
		//convert and store the profile about me
		$this->profileAboutMe = $newProfileAboutMe;
	}

	/**accessor method for profile activation token
	 *
	 * @return string value of profile activation token
	 **/
	public function getProfileActivationToken() : string {
		return ($this->profileActivationToken);
	}
	/**
	 * mutator method for profile access token
	 *
	 * @param string $newProfileActivationToken new value of access token
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setProfileActivationToken(?string $newProfileActivationToken): void {
		if($newProfileActivationToken === null) {
			$this->profileActivationToken = null;
			return;
		}
		$newProfileActivationToken = strtolower(trim($newProfileActivationToken));
		if(ctype_xdigit($newProfileActivationToken) === false) {
			throw(new\InvalidArgumentException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newProfileActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
			}
		//convert and store profile activation token
		$this->profileActivationToken = $newProfileActivationToken;
	}

	/**
	 * accessor method for profile email
	 *
	 * @return string value of profile email
	 **/
	public function getProfileEmail(): string {
		return($this->profileEmail);
	}
	/**
 	* mutator method for profile email
	 *
	 * @param string $newProfileEmail new value of profile email
	 * @throws \UnexpectedValueException if $newProfileEmail is not a valid email or insecure
	 * @throws \RangeException if $newProfileEmail is > 128 characters
	 * @throws \TypeError if $newProfileEmail is not a string
	 **/
	public function setProfileEmail(string $newProfileEmail): void {
		// verify the email is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("profile email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("profile email is too large"));
		}
		//convert and store profile email
		$this->profileEmail = $newProfileEmail;
	}
	/**
	 * profile accessor method for profile first name
	 *
	 * @return string value of profile first name
	 */
	public function getProfileFirstName() : string {
		return($this->profileFirstName);
	}
	/**
	 * mutator method for profile first name
	 *
	 * @param string $newProfileFirstName new profile first name
	 * @throws \UnexpectedValueException if $newProfileFirstName is not a string
	 * @throws \RangeException if $newProfileFirstName is >50 characters
	 */
	public function setProfileFirstName($newProfileFirstName) {
		$newProfileFirstName = filter_var($newProfileFirstName, FILTER_SANITIZE_STRING);
		if($newProfileFirstName === false) {
			throw(new \UnexpectedValueException("First name is not a string"));
		}
		//verify the first name will fit in the database
		if(strlen($newProfileFirstName) > 50) {
			throw(new \RangeException("First name too long"));
		}
		//convert and store profile first name
		$this->profileFirstName = $newProfileFirstName;
	}

	/**
	 * access method for profile hash
	 *
	 * @return string value of profile hash
	 **/
	public function getProfileHash(): string {
		return($this->profileHash);
	}
	/**
	 * mutator method for profile hash
	 *
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 */
	public function setProfileHash(string $newProfileHash): void {
		//enforce that the hash is properly formatted
		$newProfileHash = trim($newProfileHash);
		$newProfileHash = strtolower($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("profile password hash empty or insecure"));
		}
		//enforce that the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileHash)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the hash is exactly 128 characters.
		if(strlen($newProfileHash) !== 128) {
			throw(new \RangeException("profile hash must be 128 characters"));
		}
		//store the hash
		$this->profileHash = $newProfileHash;
	}
	/**
	 * accessor method for profile last name
	 *
	 * @return string value of profile last name
	 */
	public function getProfileLastName() : string {
		return ($this->profileLastName);
	}
	/**
	 * mutator method for profile last name
	 *
	 * @param string $newProfileLastName
	 * @throws \InvalidArgumentException if the $newProfileLastName is not a
	 * @throws \RangeException if the $newProfileLastName is > 50 characters
	 */
	public function setProfileLastName(string $newProfileLastName) {
		$newProfileLastName = filter_var($newProfileLastName, FILTER_SANITIZE_STRING);
		if ($newProfileLastName === false) {
			throw(new \InvalidArgumentException("Last name is not a string"));
		}
		//verify the last name will fit in the database
		if(strlen($newProfileLastName) > 50) {
			throw(new \RangeException("First name too long"));
		}
		//convert and store profile last name
		$this->profileLastName = $newProfileLastName;
	}
	/**
	 *accessor method for profile salt
	 *
	 * @return string representation of the salt hexadecimal
	 */
	public function getProfileSalt(): string {
		return $this->profileSalt;
	}
	/**
	 * mutator method for profile salt
	 *
	 * @param string $newProfileSalt
	 * @throws \InvalidArgumentException if the salt is not secure
	 * @throws \RangeException if the salt is not 64 characters
	 * @throws \TypeError if the profile salt isn't a string
	 */
	public function setProfileSalt(string $newProfileSalt): void {
		//enforce that the salt is properly formatted
		$newProfileSalt = trim($newProfileSalt);
		$newProfileSalt = strtolower($newProfileSalt);
		//enforce that the salt is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileSalt)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the salt is exactly 64 characters.
		if(strlen($newProfileSalt) !== 64) {
			throw(new \RangeException("profile salt must be 128 characters"));
		}
		//store the salt
		$this->profileSalt = $newProfileSalt;
	}


	/**
	 * inserts this Profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template (using the PDO prepare statement)
		$query = "INSERT INTO profile(profileId, profileAboutMe, profileActivationToken, profileEmail, profileFirstName, profileHash, profileLastName, profileSalt) VALUES(:profileId, :profileAboutMe, :profileActivationToken, :profileEmail, :profileFirstName, :profileHash, :profileLastName, :profileSalt)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template (using PDO execute statement)
		$parameters = ["profileId" => $this->profileId->getBytes(), "profileAboutMe" => $this->profileAboutMe, "profileActivationToken" => $this->profileActivationToken, "profileEmail" => $this->profileEmail, "profileFirstName" => $this->profileFirstName, "profileHash" => $this->profileHash, "profileLastName" => $this->profileLastName, "profileSalt" => $this->profileSalt];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}


	/**
	 * updates this Profile in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE clap SET ProfileId = :ProfileId, profileAboutMe = :profileAboutMe, profileActivationToken =:profileActivationToken, profileEmail = :profileEmail, profileFirstName = :profileFirstName, profileHash = :profileHash, profileLastName = :profileLastName, profileSalt = :profileSalt WHERE ProfileId = :ProfileId";
		$statement = $pdo->prepare($query);

		$parameters = ["profileId" => $this->profileId->getBytes()," profileAboutMe" =>$this->profileAboutMe, "profileActivationToken" => $this->profileActivationToken, "profileEmail" => $this->profileEmail, "profileFirstName" => $this->profileFirstName, profileHash => $this->profileHash, $this->profileLastName => $this->profileLastName, profileSalt => $this->profileSalt];
		$statement->execute($parameters);
	}


	/**
	 * gets the Profile by Profile id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $profileId profile id to search for
	 * @return Blog|null Blog found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getProfileByProfileId(\PDO $pdo, $profileId) : ?Profile {
		// sanitize the profileId before searching
		try {
			$profileId = self::validateUuid($profileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT profileId, profileActivationToken, profileAboutMe, profileEmail, profileFirstName, profileHash, ProfileLastName, profileSalt FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		// bind the profile id to the place holder in the template
		$parameters = ["profileId" => $profileId->getBytes()];
		$statement->execute($parameters);

		// grab the profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new profile($row["profileId"], $row["profileActivationToken"], $row["profileAboutMe"], $row["profileEmail"],  $row["profileFirstName"], $row["profileHash"], $row["profileLastName"], $row["profileSalt"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}

	/**
	 * gets the profile by profileAboutMe
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $profileAboutMe profile About Me to search by
	 * @return \SplFixedArray SplFixedArray of Profiles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileAboutMe(\PDO $pdo, string $profileAboutMe) : \SplFixedArray {
	// sanitize the description before searching
		$profileAboutMe = trim($profileAboutMe);
		$profileAboutMe = filter_var($profileAboutMe, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($profileAboutMe) === true) {
			throw(new \PDOException("profile about me is invalid"));
		}

// escape any mySQL wild cards
$profileAboutMe = str_replace("_", "\\_", str_replace("%", "\\%", $profileAboutMe));

// create query template
$query = "SELECT profileId, profileAboutMe, profileActivationToken, profileFirstName, profileHash, profileLastName, profileSalt FROM profile WHERE profileAboutMe LIKE :profileAboutMe";
$statement = $pdo->prepare($query);

// bind the profile About Me content to the place holder in the template
$profileAboutMe = "%$profileAboutMe%";
$parameters = ["profileAboutMe" => $profileAboutMe];
$statement->execute($parameters);

// build an array of profiles
$profiles = new \SplFixedArray($statement->rowCount());
$statement->setFetchMode(\PDO::FETCH_ASSOC);
while(($row = $statement->fetch()) !== false) {
	try {
		$profile = new Profile ($row["profileId"], $row["profileActivationToken"], $row["profileAboutMe"], $row["profileEmail"],  $row["profileFirstName"], $row["profileHash"], $row["profileLastName"], $row["profileSalt"]);
		$profiles[$profiles->key()] = $profile;
		$profiles->next();
	} catch(\Exception $exception) {
		// if the row couldn't be converted, rethrow it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
}
return($profiles);
}

	/**
	 * gets the profile by profileEmail
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $profileEmail profile Email to search by
	 * @return \SplFixedArray SplFixedArray of Profiles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileEmail(\PDO $pdo, string $profileEmail) : \SplFixedArray {
		// sanitize the description before searching
		$profileEmail = trim($profileEmail);
		$profileEmail = filter_var($profileEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($profileEmail) === true) {
			throw(new \PDOException("profile email is invalid"));
		}

// escape any mySQL wild cards
		$profileEmail = str_replace("_", "\\_", str_replace("%", "\\%", $profileEmail));

// create query template
		$query = "SELECT profileId, profileAboutMe, profileActivationToken, profileFirstName, profileHash, profileLastName, profileSalt FROM profile WHERE profileEmail LIKE :profileEmail";
		$statement = $pdo->prepare($query);

// bind the profile Email content to the place holder in the template
		$profileEmail = "%$profileEmail%";
		$parameters = ["profileEmail" => $profileEmail];
		$statement->execute($parameters);

// build an array of profiles
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new Profile ($row["profileId"], $row["profileActivationToken"], $row["profileAboutMe"], $row["profileEmail"],  $row["profileFirstName"], $row["profileHash"], $row["profileLastName"], $row["profileSalt"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}


	/**
	 * gets the profile by profileFirstName
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $profileFirstName profile FirstName to search by
	 * @return \SplFixedArray SplFixedArray of Profiles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileFirstName(\PDO $pdo, string $profileFirstName) : \SplFixedArray {
		// sanitize the description before searching
		$profileFirstName = trim($profileFirstName);
		$profileFirstName = filter_var($profileFirstName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($profileFirstName) === true) {
			throw(new \PDOException("profile first name is invalid"));
		}

// escape any mySQL wild cards
		$profileFirstName = str_replace("_", "\\_", str_replace("%", "\\%", $profileFirstName));

// create query template
		$query = "SELECT profileId, profileAboutMe, profileActivationToken, profileFirstName, profileHash, profileLastName, profileSalt FROM profile WHERE profileFirstName LIKE :profileFirstName";
		$statement = $pdo->prepare($query);

// bind the profile FirstName content to the place holder in the template
		$profileFirstName = "%$profileFirstName%";
		$parameters = ["profileFirstName" => $profileFirstName];
		$statement->execute($parameters);

// build an array of profiles
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new Profile ($row["profileId"], $row["profileActivationToken"], $row["profileAboutMe"], $row["profileEmail"],  $row["profileFirstName"], $row["profileHash"], $row["profileLastName"], $row["profileSalt"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}

	/**
	 * gets the profile by profile Last Name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $profileLastName profile LastName to search by
	 * @return \SplFixedArray SplFixedArray of Profiles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileLastName(\PDO $pdo, string $profileLastName) : \SplFixedArray {
		// sanitize the description before searching
		$profileLastName = trim($profileLastName);
		$profileLastName = filter_var($profileLastName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($profileLastName) === true) {
			throw(new \PDOException("profile last name is invalid"));
		}

// escape any mySQL wild cards
		$profileLastName = str_replace("_", "\\_", str_replace("%", "\\%", $profileLastName));

// create query template
		$query = "SELECT profileId, profileAboutMe, profileActivationToken, profileFirstName, profileHash, profileLastName, profileSalt FROM profile WHERE profileLastName LIKE :profileLastName";
		$statement = $pdo->prepare($query);

// bind the profile FirstName content to the place holder in the template
		$profileLastName = "%$profileLastName%";
		$parameters = ["profileLastName" => $profileLastName];
		$statement->execute($parameters);

// build an array of profiles
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new Profile ($row["profileId"], $row["profileActivationToken"], $row["profileAboutMe"], $row["profileEmail"],  $row["profileFirstName"], $row["profileHash"], $row["profileLastName"], $row["profileSalt"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}



	/**
	 * gets all Profiles
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Profiles found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllProfiles(\PDO $pdo) : \SPLFixedArray {
		// create query template
		$query = "SELECT profileId, profileAboutMe, profileActivationToken, profileFirstName, profileHash, profileLastName, profileSalt FROM profile";
		$statement = $pdo->prepare($query);
		$statement->execute();

// build an array of profiles
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new profile($row["profileId"], $row["profileActivationToken"], $row["profileAboutMe"], $row["profileEmail"],  $row["profileFirstName"], $row["profileHash"], $row["profileLastName"], $row["profileSalt"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}




	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["profileId"] = $this->profileId->toString();
		unset($fields["profileActivationToken"]);
		unset($fields["profileHash"]);
		unset($fields["profileSalt"]);

		return($fields);
	}


}
?>