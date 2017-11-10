<?php
require_once(HELPERS_DIR . 'users/filter_validate_username.php');
require_once(HELPERS_DIR . 'users/filter_validate_email.php');

class User
{
	protected $_id;
	protected $_username;
	protected $_username_canonical;
	protected $_email;
	protected $_enabled;
	protected $_password;
	protected $_locked;
	protected $_roles;
	protected $_registred_on;

	static $verbose = false;

	public function __construct( array $kwargs ) {
		$this->hydrate($kwargs);
		if (self::$verbose == True)
		{
			echo '[Creating user]<br />';
			echo 'id : ' . $this->getId() . '<br />';
			echo 'username : ' . $this->getUsername() . '<br />';
			echo 'canonical username : ' . $this->getUsername_canonical() . '<br />';
			echo 'email : ' . $this->getEmail() . '<br />';
			echo 'enabled : ' . $this->getEnabled() . '<br />';
			echo 'password : ' . $this->getPassword() . '<br />';
			echo 'locked : ' . $this->getLocked() . '<br />';
			echo 'roles : ' . $this->getRoles() . '<br />';
			echo 'registred on : ' . $this->getRegistred_on() . '<br />';
		}
	}

	public function hydrate( array $kwargs ) {
		foreach ($kwargs as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method))	{ $this->$method($value); }
		}
	}

	public function validUser() {
		if ((filter_validate_username($this->getUsername()) == True) AND (filter_validate_email($this->getEmail()) == True))
			return True;
		else
			return False;
	}

	public function getId()						{ return $this->_id; }
	public function getUsername()				{ return $this->_username; }
	public function getUsername_canonical()		{ return $this->_username_canonical; }
	public function getEmail()					{ return $this->_email; }
	public function getEnabled()				{ return $this->_enabled; }
	public function getPassword()				{ return $this->_password; }
	public function getLocked()					{ return $this->_locked; }
	public function getRoles()					{ return explode(',', $this->_roles); }
	public function getRegistred_on()			{ return $this->_registred_on; }

	public function getEmail_canonical() {
		$email_canonical = NULL;
		if ($this->_email && filter_validate_email($this->_email) == True)
		{
			$email_canonical = explode('@', $this->_email);
			$email_canonical[1] = strtolower($email_canonical[1]);
			$email_canonical = implode('@', $email_canonical);
		}
		return ($email_canonical);
	}

	public function has_roles($roles) {
		if (in_array($roles, $this->getRoles()))
			return True;
		return (False);
	}

	public function setId ( $id ) {
		$id = (int) $id;
	
		if (is_int($id) && $id > 0)
			$this->_id = $id;
		else
			$this->_id = NULL;
	}

	public function setUsername( $username ) {
		if (filter_validate_username($username) == True)
		{
			$this->_username = $username;
			$this->setUsername_canonical($username);
		}
	}

	public function setUsername_canonical( $username ) {
		if (filter_validate_username($username) == True)
			$this->_username_canonical = post_slug($username);
	}

	public function setEmail( $email ) {
		if (filter_validate_email($email) == True)
			$this->_email = $email;
	}

	public function setEnabled( $enabled ) {
		$enabled = (int) $enabled;

		if ($enabled != 0 AND $enabled != 1)
			$this->_enabled = 0;
		else
			$this->_enabled = $enabled;
	}

	public function setPassword( $password ) {
		if (!empty($password))
			$this->_password = $password;
	}

	public function setLocked( $locked ) {
		$locked = (int) $locked;

		if ($locked != 0 AND $locked != 1)
			$this->_locked = 0;
		else
			$this->_locked = $locked;
	}

	public function setRoles( $roles ) {
		if (!empty($roles))
			$this->_roles = $roles;
		else
			$this->_roles = [];
	}

	public function setRegistred_on( $registred_on ) {
		$this->_registred_on = $registred_on;
	}

	public function confirmEmail( $token ) {
		if ($this->_enabled == 0 && isset($token) && !empty($token))
		{
			$token = (int) $token;

			if ($token == strtotime($this->_registred_on))
			{
				$this->_enabled = 1;
				return true;
			}
		}
		return false;
	}
}
?>