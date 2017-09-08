<?php

class GlobalStats extends BaseModel{

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Account');
		$query->execute();
		$rows = $query->fetchAll();
		$accounts = array();
		foreach($rows as $row){
			$accounts[] = new Account(array(
				'id' => $row['id'],
				'email' => $row['email'],
				'password' => $row['password'],
				'first_name' => $row['first_name'],
				'last_name' => $row['last_name'],
				'phone_number' => $row['phone_number']
				));
		}
		return $accounts;
	}

	public static function authenticate($email, $password){
		$query = DB::connection()->prepare('SELECT * FROM Account WHERE email = :email AND password = :password LIMIT 1');
		$query->execute(array('email' => $email, 'password' => $password));
		$row = $query->fetch();
		if($row){
			$account = new Account(array(
				'id' => $row['id'],
				'email' => $row['email'],
				'password' => $row['password'],
				'first_name' => $row['first_name'],
				'last_name' => $row['last_name'],
				'phone_number' => $row['phone_number']
				));
			return $account;
		}else{
			return null;
		}
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Account WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		if($row){
			$account = new Account(array(
				'id' => $row['id'],
				'email' => $row['email'],
				'password' => $row['password'],
				'first_name' => $row['first_name'],
				'last_name' => $row['last_name'],
				'phone_number' => $row['phone_number']
				));
			return $account;
		}else{
			return null;
		}
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Account (email, password, first_name, last_name, phone_number) VALUES (:email, :password, :first_name, :last_name, :phone_number) RETURNING id');
		$query->execute(array('email' => $email, 'password' => $password, 'first_name' => $first_name, 'last_name' => $last_name, 'phone_number' => $phone_number));
		$row = $query->fetch();
		$this->id = $row['id'];
	}

	public function errors(){
		$errors = array(
			/* stuff for validating the values here
			*/
		);
		$errors = array_filter($errors);
		return $errors;
	}
}