<?php
class UsersManager
{
	private $_dbhandler;

	public function __construct( $dbhandler ) {
		$this->setDbhandler( $dbhandler );
	}

	public function getDbhandler() { return $this->_dbhandler; }

	public function add( User $user ) {
		$query = $this->_dbhandler->prepare('INSERT INTO `users`
			SET username = :username, username_canonical = :username_canonical, email = :email, enabled = :enabled, password = :password, locked = :locked, roles = :roles');

		$query->bindValue(':username', $user->getUsername());
		$query->bindValue(':username_canonical', $user->getUsername_canonical());
		$query->bindValue(':email', $user->getEmail());
		$query->bindValue(':enabled', $user->getEnabled(), PDO::PARAM_INT);
		$query->bindValue(':password', $user->getPassword());
		$query->bindValue(':locked', $user->getLocked(), PDO::PARAM_INT);
		$query->bindValue(':roles', implode(',', $user->getRoles()));

		$query->execute();

		$usersManager = new UsersManager($this->_dbhandler);
		$user = $usersManager->get($usersManager->username_exists($user->getUsername()));
	}

	public function count() {
		return $this->_dbhandler->query('SELECT COUNT(*) FROM `users`')->fetchColumn();
	}

	public function exists($id) {
		if (is_numeric($id))
			return (bool) $this->_dbhandler->query('SELECT COUNT(*) FROM `users` WHERE id = ' . $id)->fetchColumn();
	}

	public function username_exists($username) {
		$query = $this->_dbhandler->prepare('SELECT id FROM `users` WHERE username = :username');
		$query->execute(array(':username' => $username));

		return $query->fetchColumn();
	}

	public function username_canonical_exists($username_canonical) {
		$query = $this->_dbhandler->prepare('SELECT id FROM `users` WHERE username_canonical = :username_canonical');
		$query->execute(array(':username_canonical' => $username_canonical));

		return $query->fetchColumn();
	}

	public function email_exists($email) {
		$query = $this->_dbhandler->prepare('SELECT id FROM `users` WHERE email = :email');
		$query->execute(array(':email' => $email));

		return $query->fetchColumn();
	}

	public function delete(User $user) {
		$this->_dbhandler->exec("DELETE FROM `users` WHERE id = " . $user->getId());
	}

	public function get($id) {
		$id = (int) $id;

		$query = $this->_dbhandler->query('SELECT * FROM `users` WHERE id = ' . $id);
		$data = $query->fetch(PDO::FETCH_ASSOC);

		return new User($data);
	}

	public function get_all() {
		$users = array();

		$query = $this->_dbhandler->query('SELECT * FROM `users` ORDER BY username_canonical');

		while ($data = $query->fetch(PDO::FETCH_ASSOC))
		{
			$users[] = new User($data);
		}

		return $users;
	}

	public function update( User $user ) {
		$query = $this->_dbhandler->prepare('UPDATE `users`
			SET username = :username, username_canonical = :username_canonical, email = :email, enabled = :enabled, password = :password, locked = :locked, roles = :roles WHERE id = :id');

		$query->bindValue(':username', $user->getUsername());
		$query->bindValue(':username_canonical', $user->getUsername_canonical());
		$query->bindValue(':email', $user->getEmail());
		$query->bindValue(':enabled', $user->getEnabled(), PDO::PARAM_INT);
		$query->bindValue(':password', $user->getPassword());
		$query->bindValue(':locked', $user->getLocked(), PDO::PARAM_INT);
		$query->bindValue(':roles', implode(',', $user->getRoles()));
		$query->bindValue(':id', $user->getId(), PDO::PARAM_INT);

		$query->execute();
	}

	public function setDbhandler( PDO $dbhandler ) {
		$this->_dbhandler = $dbhandler;
	}
}
?>