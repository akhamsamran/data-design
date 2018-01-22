<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 1/19/2018
 * Time: 8:04 PM
 ***/
/**
 * add namespace
 **/
namespace Edu\Cnm\Akhamsamran1\DataDesign;
require_once("autoload.php");
require_once(dirname(__DIR__ . "autoload.php");
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
class blog {
	/**
	 * add validate date and validate uuid
	 **/
	use \Edu\Cnm\DataDesign\ValidateUuid;
	use \Edu\Cnm\DataDesign\ValidateDate;
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
	 * @return Uuid string value for blog id
	 **/
	public function getBlogId() {
		return $this->blogId;
	}
	/**
	 * mutator method for blog id
	 *
	 * @param Uuid /string $newBlogId for the new value of the blog id
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
	 * @return int $newBlogProfileId
	 */
	public function getBlogProfileId() {
		return $this->blogProfileId;
	}
	/**
	 * mutator method for blog profile id
	 *
	 *@param  Uuid/string $newBlogProfileId new value of blog profile id
	 *@throws \RangeException if $newProfileId is not positive
	 *@throws \TypeError if $newTweetProfileId is not an integer
	 **/
	public function setBlogProfileId( $newBlogProfileId) : void {
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
	public function getBlogContent() {
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
	public function setBlogContent(string $newBlogContent) : void {
		//verify the new blog content is secure
		$newBlogContent = trim($newBlogContent);
		$newBlogContent = filter_var($newBlogContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newBlogContent)===true) {
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
	public function getBlogDate() {
		return $this->blogDate;
	}
	/**
	 * mutator method for blog date
	 *
	 * @param \DateTime|string|null $newBlogDate tweet date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newBlogDate is not a valid object or string
	 * @throws \RangeException if $newBlogDate is a date that does not exist
	 **/
	public function setBlogDate($newBlogDate = null) : void {
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
	public function getBlogTitle() {
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
	public function setBlogTitle(string $newBlogTitle) : void {
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









}

?>