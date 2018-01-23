<?php

/**
 * add namespace
 **/
namespace Edu\Cnm\Akhamsamran1\DataDesign;
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
	use \Edu\Cnm\DataDesign\ValidateUuid;
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