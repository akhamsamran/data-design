<?php

/**
 * add namespace
 **/
namespace Edu\Cnm\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__ . "autoload.php"));

use Ramsey\Uuid\Uuid;
/**
 * blog or article class for a website like Medium
 *
 * this blog contains all the articles or blogs written by the members listed in the profile.  Blog includes title, blog content, Date, and the author.  Other information could be added, such as topics, subtitles, etc.
 *
 * @author Anna Khamsamran <akhamsamran1@cnm.edu>
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 *
 **/
class blog implements \JsonSerializable {
	/**
	 * add validate date and validate uuid
	 **/
	use ValidateUuid;
	use ValidateDate;
	/**
	 * id for this blog, this is the primary key
	 * this is a unique index
	 **/
	private $blogId;
	/**
	 * id for the profile author of the blog, this is a foreign key
	 **/
	private $blogProfileId;
	/**
	 * content of the blog
	 **/
	private $blogContent;
	/**
	 * date the blog was submitted
	 **/
	private $blogDate;
	/**
	 * title for the blog
	 **/
	private $blogTitle;

	/**
	 *accessor method for blog id
	 *
	 * @return string|Uuid value for blog id
	 **/
	public function getBlogId(): uuid {
		return $this->blogId;
	}
	/**
	 * constructor for this blog
	 *
	 * @param Uuid/string $newBlogId new blog id
	 * @param Uuid/string $newBlogProfileId new blog profile id for the profile who wrote the blog
	 * @param string $newBlogContent new content for this blog
	 * @param \DateTime|string|null $newBlogDate date and time blog was created or null if set to current date and time
	 * @param string $newBlogTitle the new title for the new blog
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentationhttps://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newBlogId, $newBlogProfileId, $newBlogContent, $newBlogDate, $newBlogTitle) {
		try {
			$this->setBlogId($newBlogId);
			$this->setBlogProfileId($newBlogProfileId);
			$this->setBlogContent($newBlogContent);
			$this->setBlogDate($newBlogDate);
			$this->setBlogTitle($newBlogTitle);
		}      //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * mutator method for blog id
	 *
	 * @param string|Uuid $newBlogId for the new value of the blog id
	 * @throws \InvalidArgumentException if $newBlogId is not positive
	 * @throws \TypeError if $newBlogId is not an integer
	 **/
	public function setBlogId($newBlogId): void {
		try {
			$uuid = self::validateUuid($newBlogId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// store and convert the blog id
		$this->blogId = $uuid;
	}

	/**
	 * accessor method for blog profile id
	 *
	 * @return string|Uuid $newBlogProfileId
	 */
	public function getBlogProfileId(): uuid {
		return $this->blogProfileId;
	}

	/**
	 * mutator method for blog profile id
	 *
	 * @param  string|Uuid $newBlogProfileId new value of blog profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newTweetProfileId is not an integer
	 **/
	public function setBlogProfileId($newBlogProfileId): void {
		try {
			$uuid = self::validateUuid($newBlogProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->tweetProfileId = $uuid;
	}
	/**
	 * accessor method for blog content
	 *
	 * @return string value for blog content
	 */
	/**
	 * @return mixed
	 */
	public function getBlogContent(): string {
		return $this->blogContent;
	}

	/**
	 * mutator method for blog content
	 *
	 * @param string $newBlogContent new value of blog content
	 * @throws \InvalidArgumentException if $newBlogContent is not a string or insecure
	 * @throws \RangeException if $newBlogContent is >20000 characters
	 * @throws \TypeError if $newBlogContent is not a string
	 */
	public function setBlogContent(string $newBlogContent): string {
		//verify the new blog content is secure
		$newBlogContent = trim($newBlogContent);
		$newBlogContent = filter_var($newBlogContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBlogContent) === true) {
			throw(new \InvalidArgumentException("content invalid or insecure"));
		}
		//verify blog content will fit in the database
		if(strlen($newBlogContent) > 20000) {
			throw(new \RangeException("content is too large"));
		}
		//convert and store new blog content
		$this->BlogContent = $newBlogContent;
	}
	/**
	 * accessor method for blog date
	 *
	 * @return \DateTime value for blog date
	 */
	/**
	 * @return mixed
	 */
	public function getBlogDate(): DateTime {
		return $this->blogDate;
	}

	/**
	 * mutator method for blog date
	 *
	 * @param \DateTime|string|null $newBlogDate tweet date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newBlogDate is not a valid object or string
	 * @throws \RangeException if $newBlogDate is a date that does not exist
	 **/
	public function setBlogDate($newBlogDate = null): void {
		// base case: if the date is null, use the current date and time
		if($newBlogDate === null) {
			$this->blogDate = new \DateTime();
			return;
		}
		// store the like date using the ValidateDate trait
		try {
			$newBlogDate = self::validateDateTime($newBlogDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//stores the blog date
		$this->tweetDate = $newBlogDate;
	}

	/**
	 * accessor method for blog title
	 *
	 * @return string $blogTitle
	 **/
	public function getBlogTitle(): string {
		return $this->blogTitle;
	}

	/**
	 * mutator method for blog title
	 *
	 * @param string $newBlogTitle new value for new blog title
	 * @throws \InvalidArgumentException if $newBlogTitle is not a string or insecure
	 * @throws \RangeException if $newBlogTitle is > 128 characters
	 * @throws \TypeError if $newBlogTitle is not a string
	 **/
	public function setBlogTitle(string $newBlogTitle): void {
		//verify the blog title is secure
		$newBlogTitle = trim($newBlogTitle);
		$newBlogTitle = filter_var($newBlogTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newBlogTitle) === true) {
			throw(new \InvalidArgumentException("Title empty or insecure"));
		}
		//verify the new blog title will fit in the database
		if(strlen($newBlogTitle) > 128) {
			throw(new \RangeException("title too long"));
		}
		//convert and store the blog title
		$this->blogTitle = $newBlogTitle;
	}


	/**
	 * inserts this Blog into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template (using the PDO prepare statement)
		$query = "INSERT INTO blog(blogId, blogProfileId, blogContent, blogDate, blogTitle) VALUES(:blogId, :blogProfileId, :blogContent, :blogDate, :blogTitle)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template (using PDO execute statement)
		$formattedDate = $this->blogDate->format("Y-m-d H:i:s.u");
		$parameters = ["blogId" => $this->blogId->getBytes(), "blogProfileId" => $this->blogProfileId->getBytes(), "blogContent" => $this->blogContent, "blogDate" => $formattedDate, "blogTitle" => $this->blogTitle];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Blog from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM blog WHERE blogId = :blogId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["blogId" => $this->blogId->getBytes()];
		$statement->execute($parameters);
	}


	/**
	 * updates this Blog in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE clap SET blogProfileId = :blogProfileId, blogContent = :blogContent, blogDate =:blogDate, blogTitle = :blogTitle WHERE blogId = :blogId";
		$statement = $pdo->prepare($query);

		$formattedDate = $this->blogDate->format("Y-m-d H:i:s.u");
		$parameters = ["blogId" => $this->blogId->getBytes()," blogProfileId" =>$this->clapBlogId->getBytes(), "blogContent" => $this->blogContent, "blogDate" => $formattedDate, "blogTitle" => $this->blogTitle];
		$statement->execute($parameters);
	}


	/**
	 * gets the Blog by blog id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $blogId blog id to search for
	 * @return Blog|null Blog found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getBlogByBlogId(\PDO $pdo, $blogId) : ?Blog {
		// sanitize the blogId before searching
		try {
			$blogId = self::validateUuid($blogId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT blogId, blogProfileId, blogContent, blogDate, blogTitle FROM blog WHERE blogId = :blogId";
		$statement = $pdo->prepare($query);

		// bind the blog id to the place holder in the template
		$parameters = ["blogId" => $blogId->getBytes()];
		$statement->execute($parameters);

		// grab the blog from mySQL
		try {
			$blog = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$blog = new Blog($row["blogId"], $row["blogProfileId"], $row["blogContent"], $row["blogDate"],  $row["blogTitle"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($blog);
	}


	/**
	 * gets the Blog by blog profile id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $blogProfileId blog profile id to search by
	 * @return \SplFixedArray SplFixedArray of Blogs found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBlogByBlogProfileId(\PDO $pdo, $blogProfileId) : \SplFixedArray {

		try {
			$blogProfileId = self::validateUuid($blogProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT blogId, blogProfileId, blogContent, blogDate, blogContent FROM blog WHERE blogProfileId = :blogProfileId";
		$statement = $pdo->prepare($query);
		// bind the blog profile id to the place holder in the template
		$parameters = ["blogProfileId" => $blogProfileId->getBytes()];
		$statement->execute($parameters);
		// build an array of blogs
		$blogs = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$blog = new Blog($row["blogId"], $row["blogProfileId"], $row["blogContent"], $row["blogDate"], $row["blogTitle"]);
				$blogs[$blogs->key()] = $blog;
				$blogs->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($blogs);
	}

	/**
	 * gets the blog by blog content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $blogContnet blog content to search by
	 * @return \SplFixedArray SplFixedArray of Blogs found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBlogByBlogContent(\PDO $pdo, string $blogContent) : \SplFixedArray {
		// sanitize the description before searching
		$blogContent = trim($blogContent);
		$blogContent = filter_var($blogContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($blogContent) === true) {
			throw(new \PDOException("blog content is invalid"));
		}

// escape any mySQL wild cards
		$blogContent = str_replace("_", "\\_", str_replace("%", "\\%", $blogContent));

// create query template
		$query = "SELECT blogId, blogProfileId, blogContent, blogDate, blogContent FROM blog WHERE blogContent = :blogContent";
		$statement = $pdo->prepare($query);

// bind the blog content content to the place holder in the template
		$blogContent = "%$blogContent%";
		$parameters = ["blogContent" => $blogContent];
		$statement->execute($parameters);

// build an array of blogs
		$blogs = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$blog = new Blog ($row["blogId"], $row["blogProfileId"], $row["blogContent"], $row["blogDate"],  $row["blogTitle"]);
				$blogs[$blogs->key()] = $blog;
				$blogs->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($blogs);
	}

	/**
	 * gets the blog by blog title
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $blogTitle blog title to search by
	 * @return \SplFixedArray SplFixedArray of Blogs found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBlogByBlogTitle(\PDO $pdo, string $blogTitle) : \SplFixedArray {
		// sanitize the description before searching
		$blogTitle = trim($blogTitle);
		$blogTitle = filter_var($blogTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($blogTitle) === true) {
			throw(new \PDOException("blog title is invalid"));
		}

// escape any mySQL wild cards
		$blogTitle = str_replace("_", "\\_", str_replace("%", "\\%", $blogTitle));

// create query template
		$query = "SELECT blogId, blogProfileId, blogContent, blogDate, blogContent FROM blog WHERE blogTitle = :blogTitlet";
		$statement = $pdo->prepare($query);

// bind the blog title content to the place holder in the template
		$blogTitle = "%$blogTitle%";
		$parameters = ["blogTitle" => $blogTitle];
		$statement->execute($parameters);

// build an array of blogs
		$blogs = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$blog = new Blog ($row["blogId"], $row["blogProfileId"], $row["blogContent"], $row["blogDate"],  $row["blogTitle"]);
				$blogs[$blogs->key()] = $blog;
				$blogs->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($blogs);
	}




	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["blogId"] = $this->blogId->toString();
		$fields["blogProfileId"] = $this->blogProfileId->toString();

		//format the date so that the front end can consume it
		$fields["blogDate"] = round(floatval($this->blogDate->format("U.u")) * 1000);
		return ($fields);
	}

}

?>