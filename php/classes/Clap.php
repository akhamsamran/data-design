<?php

/**
 * add namespace
 **/
namespace Edu\Cnm\DataDesign;
require_once("autoload.php");
require_once(dirname(__DIR__ . "autoload.php"));
use Ramsey\Uuid\Uuid;
/**
 * this is a clap (similar to a like in twitter) class for a blogging website like Medium
 *
 * clap class stores a unique id for clapId, the blogId for which the clap was given, and the profileID for the profile who gave the clap.  Each clap is unique, since each profileId can give many/multiple "claps" to a blog.  Having a compound clapId as unique will not allow this, therefore a non-compound unique ID is required.
 **/
class Clap implements \JsonSerializable {
	/**
	 * add use validate Uuid.php
	 **/
	use ValidateUuid;
	/**
	* id for this clap, this is the primary key
	* this is a unique index
	**/
	private $clapId;
	/**
	* id for the blog to which the clap is given, this is a foreign key
	**/
	private $clapBlogId;
	/**
	* id for the profile who gave the clap, this is a foreign key
	**/
	private $clapProfileId;

	/**
	 * constructor for this blog
	 *
	 * @param Uuid/string $newClapId new clap id
	 * @param Uuid/string $newClapBlogId new blog id for the blog that received a clap
	 * @param Uuid/string $newBlogProfileId new profile id for the profile that gave the clap
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentationhttps://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newClapId, $newClapBlogId, $newClapProfileId) {
		try{
			$this->setClapId($newClapId);
			$this->setClapBlogId($newClapBlogId);
			$this->setClapProfileId($newClapProfileId);
		}		//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for clap id
	 *
	 * @return Uuid/string value for the value of clap id
	 **/
	public function getClapId(): uuid {
		return $this->clapId;
	}
	/**
	 * mutator method for clap id
	 *
	 * @param string|Uuid $newClapId for the new value of the clap id
	 * @throws \InvalidArgumentException if $newClapId is not positive
	 * @throws \TypeError if $newClapId is not an integer
	 **/
	public function setClapId($newClapId): void {
		try {
			$uuid = self::validateUuid($newClapId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// store and convert the clap id
		$this->clapId = $uuid;
	}
	/**
	 * accessor method for clap blog id
	 *
	 * @return string|Uuid value for the value of clap blog id
	 **/
	public function getClapBlogId(): uuid {
		return $this->clapBlogId;
	}
	/**
	 * mutator method for clap blog id
	 *
	 * @param string|Uuid $newClapBlogId for the new value of the clap blog id
	 * @throws \InvalidArgumentException if $newClapBlogId is not positive
	 * @throws \TypeError if $newClapBlogId is not an integer
	 **/
	public function setClapBlogId($newClapBlogId): void {
		try {
			$uuid = self::validateUuid($newClapBlogId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// store and convert the clap blog id
		$this->clapBlogId = $uuid;
	}
	/**
	 * accessor method for clap blog id
	 *
	 * @return string|Uuid value for the value of clap blog id
	 **/
	public function getClapProfileId() : uuid {
		return $this->clapProfileId;
	}
	/**
	 * mutator method for clap profile id
	 *
	 * @param string|Uuid $newClapProfileId for the new value of the clap profile id
	 * @throws \InvalidArgumentException if $newClapProfileId is not positive
	 * @throws \TypeError if $newClapProfileId is not an integer
	 **/
	public function setClapProfileId($newClapProfileId) : void {
		try {
			$uuid = self::validateUuid($newClapProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//store and convert the clap profile id
		$this->clapProfileId = $uuid;
	}

	/**
	 * inserts this Clap into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template (using the PDO prepare statement)
		$query = "INSERT INTO clap(clapId, clapBlogId, clapProfileId) VALUES(:clapId, :ClapBlogId, :clapProfileId)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template (using PDO execute statement)
		$parameters = ["clapId" => $this->clapId->getBytes(), "clapBlogId" => $this->clapBlogId->getBytes(), "clapBlogProfile" => $this->clapBlogId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Clap from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM clap WHERE clapId = :clapId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["clapId" => $this->clapId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Clap in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE clap SET clapBlogId = :clapBlogId, clapProfileId = :clapProfile WHERE clapId = :clapId";
		$statement = $pdo->prepare($query);

		$parameters = ["clapId" => $this->clapId->getBytes()," clapBlogId" =>$this->clapBlogId->getBytes];
		$statement->execute($parameters);
	}



	/**
	 * gets the Clap by clap id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $clapId clap id to search for
	 * @return Blog|null Blog found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getClapbyClapId(\PDO $pdo, $clapId) : ?Clap {
		// sanitize the clapId before searching
		try {
			$clapId = self::validateUuid($clapId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT clapId, clapBlogId, clapProfileId FROM clap WHERE clapId = :clapId";
		$statement = $pdo->prepare($query);

		// bind the clap id to the place holder in the template
		$parameters = ["clapId" => $clapId->getBytes()];
		$statement->execute($parameters);

		// grab the clap from mySQL
		try {
			$clap = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$clap = new Clap($row["clapId"], $row["clapBlogId"], $row["clapProfileId"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($clap);
	}

	/**
	 * gets the Clap by blog id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $clapBlogId blog id to search by
	 * @return \SplFixedArray SplFixedArray of Claps found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getClapByClapBlogId(\PDO $pdo, $clapBlogId) : \SplFixedArray {

		try {
			$clapBlogId = self::validateUuid($clapBlogId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT clapId, clapBlogId, clapProfileId FROM clap WHERE clapBlogId = :clapBlogId";
		$statement = $pdo->prepare($query);
		// bind the clapBlogId to the place holder in the template
		$parameters = ["clapBlogId" => $clapBlogId->getBytes()];
		$statement->execute($parameters);
		// build an array of claps
		$claps = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$clap = new Clap($row["clapId"], $row["clapBlogId"], $row["clapProfileId"]);
				$claps[$claps->key()] = $clap;
				$claps->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($claps);
	}



	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["clapId"] = $this->clapId->toString();
		$fields["clapBlogId"] = $this->clapBlogId->toString();
		$fields["clapProfileId"] = $this->clapProfileId->toString();

		return($fields);
	}







}