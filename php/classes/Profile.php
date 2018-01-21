<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 1/19/2018
 * Time: 1:29 PM
 */

/**
 * Typical profile for a bloging or article sharing website like Medium
 *
 * This profile is an abbvreviated example of a profile of a user of a blogging website, including ID, name, hash, and salt...other attributes specific to the person can be added as required, for example contact info, etc.
 *
 * @author Anna Khamsamran <akhamsamran1@cnm.edu>
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 *
 **/
class Profile {
	/**
	 * id for this Profile; this is the primary key
	 **/
	private $profileId;
	/**
	 * biographical information "about me" for the profile
	**/
	private $profileAboutMe;
	/**
	 * access token for the profile
	 **/
	private $profileAccessToken;
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
	 * @param string $newProfileAboutMe
	 * @param string $newProfileAccessToken
	 * @param string $newProfileEmail
	 * @param string $newProfileFirstName
	 * @param string $newProfileHash
	 * @param string $newProfileLastName
	 * @param String $newProfileSalt
	 * @throws UnexpectedValueException if any of the parameters are invalid
	 **/
	public function __construct($newProfileId, $newProfileAboutMe, $newProfileAccessToken, $newProfileEmail,$newProfileFirstName, $newProfileHash, $newProfileLastName, $newProfileSalt) {
		try{
			$this->setProfileId($newProfileId);
			$this->setProfileAboutMe($newProfileAboutMe);
			$this->profileAccessToken($newProfileAccessToken);
			$this->profileEmail($newProfileEmail);
			$this->profileFirstName($newProfileFirstName);
			$this->profileHash($newProfileHash);
			$this->profileLastName($newProfileLastName);
			$this->profileSalt($newProfileSalt);
		} catch(UnexpectedValueException $exception){
			//rethrow to the caller
		throw(new UnexpectedValueException("Unable to construct Profile", 0, $exception));
		}
	}


}
?>