<?php

class achievement extends BaseModel{

  public $id, $name, $description, $logo_url, $levels;

  public function __construct($attributes){
		parent::__construct($attributes);
	}

  public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Achievement');
		$query->execute();
		$rows = $query->fetchAll();
		$achievements = array();
		foreach($rows as $row){
			$achievement[] = new Achievement(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'description' => $row['description'],
				'logo_url' => $row['logo_url'],
				'levels' => $row['levels']
				));
		}
		return $achievements;
	}

  public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Achievement WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		if($row){
			$achievement = new Achievement(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'description' => $row['description'],
				'logo_url' => $row['logo_url'],
				'levels' => $row['levels']
				));
			return $achievement;
		}else{
			return null;
		}
	}

}





 ?>
