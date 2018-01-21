<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 1/19/2018
 * Time: 8:04 PM
 **/
/**
 * blog or article class for a website like Medium
 *
 * this blog contains all the articles or blogs written by the members listed in the profile.  Blog includes title, blog content, Date, and the author.  Other information could be added, such as topics, subtitles, etc.
 *
 * @author Anna Khamsamran <akhamsamran1@cnm.edu>
 * @see Dylan McDonald <dmcdonald21@cnm.edu>
 *
 **/
class blog{
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
	 * title for the blog
	 **/
	private $blogTitle;
	/**
	 * content of the blog
	 **/
	private $blogContent;
	/**
	 * date the blog was submitted
	 **/
	private $blogDate;
	/**
	 *accessor method for blog id
	 *
	 * @returns string value for blog id
	 **/
	public function getBlogId() {
		return $this->blogId;
	}
	/**
	 * mutator method for blog id
	 *
	 * @param Uuid /string $newBlogId for the new value of the blog id
	 * @throws InvalidArgumentException if $newBlogId is not positive
	 * @throws TypeError if $newBlogId is not an integer
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
	 * @returns int $newBlogProfileId
	 */
	public function getBlogProfileId() {
		return $this->blogProfileId;
	}
	/**
	 * mutator method for blog profile id
	 *
	 * @param  Uuid/string $newBlogProfileId new value of blog profile id
	 * * @throws RangeException if $newProfileId is not positive
	 * @throws TypeError if $newTweetProfileId is not an integer
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









}

/?>