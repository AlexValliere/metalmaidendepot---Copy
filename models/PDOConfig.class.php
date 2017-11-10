<?php
class PDOConfig extends PDO
{
	private $dsn;
	private $user;
	private $pass;

	public function __construct() {
		require(CONFIG_DIR . "database.php");
		$this->dsn = $DB_DSN;
		$this->user = $DB_USER;
		$this->pass = $DB_PASSWORD;
		parent::__construct( $this->dsn, $this->user, $this->pass, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 COLLATE utf8_unicode_ci" ) );
	}
}
?>