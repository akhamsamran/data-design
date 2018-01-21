<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 1/19/2018
 * Time: 8:03 PM
 */
/**
 * this is a clap (similar to a like in twitter) class for a blogging website like Medium
 *
 * clap class stores a unique id for clapId, the blogId for which the clap was given, and the profileID for the profile who gave the clap.  Each clap is unique, since each profileId can give many/multiple "claps" to a blog.  Having a compound clapId as unique will not allow this, therefore a non-compound unique ID is required.
 **/
class Clap {
	/**
	 * add use validate Uuid.php
	 **/
	use \Edu\Cnm\DataDesign\ValidateUuid
}