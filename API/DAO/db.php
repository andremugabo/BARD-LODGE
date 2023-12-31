<?php 
function base(){
    echo str_replace("index.php","",$_SERVER['PHP_SELF']);
}

class db{
	
	private $host = "localhost";
	private $user = "root";
	private $pswd = "";
	private $dbName = "bardrodge";

	public function connect()
	{
		$dsn = "mysql:host =". $this->host .";dbname=" . $this->dbName;
		$pdo = new PDO($dsn,$this->user,$this->pswd);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
		if ($pdo) {
			echo"true";
		} else {
			echo"false";
			return;
		}
		
		return $pdo;
	}
}
// $db =  new db();
// print_r($db->connect());
 ?>