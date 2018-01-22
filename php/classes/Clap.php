<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 1/19/2018
 * Time: 8:03 PM
 */
/**
 * add namespace
 **/
namespace Edu\Cnm\Akhamsamran1\DataDesign;
require_once("autoload.php");
require_once(dirname(__DIR__ . "autoload.php");
use Ramsey\Uuid\Uuid;
/**
 * this is a clap (similar to a like in twitter) class for a blogging website like Medium
 *
 * clap class stores a unique id for clapId, the blogId for which the clap was given, and the profileID for the profile who gave the clap.  Each clap is unique, since each profileId can give many/multiple "claps" to a blog.  Having a compound clapId as unique will not allow this, therefore a non-compound unique ID is required.
 **/
class Clap {
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









}