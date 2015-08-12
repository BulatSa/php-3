<?php
	ini_set('error_reporting', E_DEPRECATED); //E_DEPRECATED E_ALL
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);

  abstract class UserAbstract {
		abstract function showinfo();
	}
	
	class User extends UserAbstract {
		public $name;
		public $login;
		public $password;

		function __construct($name, $login, $password) {
			$this->name = $name;
			$this->login = $login;
			$this->password = $password;
		}

		function showInfo() {
			echo "Name is {$this->name}";
			$this->drawLine();
			echo "Login is {$this->login}";
			$this->drawLine();
			echo "Password is {$this->password}";
			$this->drawLine();
		}

		function drawLine() {
			echo "<br>";
		}

		function __destruct() {
			echo "Пользователь {$this->name} удален<br>";
		}
	}

	class SuperUser extends User {
		public $role;

		function __construct($name, $login, $password, $role) {
			parent::__construct($name, $login, $password);
			$this->role = $role;
		}

		function showInfo() {
			echo "<hr>";
			parent::showInfo();
			echo "Role is {$this->role}";
			$this->drawLine();
		}
	}

$user1 = new User("Vasya", "Vas", "1234");
$user1->showInfo();

$user2 = new SuperUser("Petya", "Pet", "4321", "Default User");
$user2->showInfo();