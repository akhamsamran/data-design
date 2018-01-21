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
	 * accessor method for profile id
	 *
	 * @return int value of profile id
	 **/
	public function getProfileId(){
		return($this->profileId);
	}

	/**
	 * mutator method for profile id
	 *
	 * @param int $newProfileId new value of profile id
	 * @throws UnexpectedValueException if $newProfileId is not an integer
	 **/
	public function setProfileId($newProfileId){
		$newProfileId = filter_var($newProfileId, FILTER_VALIDATE_INT);
		if($newProfileId === false) {
			throw(new UnexpectedValueException("profile id is not a valid integer"));
		}
		//convert and store the profile id
		$this->profileId = intval($newProfileId);
	}
	/**
	 * accessor method for profile about me
	 *
	 * @return string value of profile about me
	 **/
	public function getprofileAboutMe(){
		return ($this->profileAboutMe);
	}
	/**
	 * mutator method for profile about me
	 *
	 * @param string $newProfileAboutMe new value of profile about me
	 * @throws UnexpectedValueException if $newProfileAboutMe is not a string
	 **/
	public function setProfileAboutMe($newProfileAboutMe) {
		$newProfileAboutMe = filter_var($newProfileAboutMe, FILTER_SANITIZE_STRING);
		if($newProfileAboutMe === false) {
			throw(new UnexpectedValueException("About me is not a valid string"));
		}
		//convert and store the profile about me
		$this->profileAboutMe = $newProfileAboutMe;
	}

	/**accessor method for profile activation token
	 *
	 * @return string value of profile activation token
	 **/
	public function getProfileActivationToken() {
		return ($this->profileActivationToken);
	}
	/**
	 * mutator method for profile access token
	 *
	 * @param string ?$newProfileActivationToken new value of access token
	 * @throws UnexpectedValueException if $newProfileActivationToken is not a string
	 **/
	public function setProfileActivationToken($newProfileActivationToken) {
		$newProfileActivationToken = filter_var($newProfileActivationToken, FILTER_SANITIZE_STRING);
		if($newProfileActivationToken === false) {
			throw(new UnexpectedValueException("Activation token is not a valid string"));
		}
		//convert and store profile activation token
		$this->profileActivationToken = $newProfileActivationToken
	}









	/**
	 * constructor for this profile
	 *
	 * @param int $newProfileId new profile id
	 * @param string $newProfileAboutMe
	 * @param string $newProfileActivationToken
	 * @param string $newProfileEmail
	 * @param string $newProfileFirstName
	 * @param string $newProfileHash
	 * @param string $newProfileLastName
	 * @param String $newProfileSalt
	 * @throws UnexpectedValueException if any of the parameters are invalid
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
		} catch(UnexpectedValueException $exception){
			//rethrow to the caller
		throw(new UnexpectedValueException("Unable to construct Profile", 0, $exception));
		}
	}


}
?>