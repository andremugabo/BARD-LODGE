<?php 


class db{
	
	private $host = "159.65.182.253";
	private $user = "cjvnsqvtmy";
	private $pswd = "GreenWorld@2024";
	private $dbName = "cjvnsqvtmy";

	public function connect()
	{
		$dsn = "mysql:host =". $this->host .";dbname=" . $this->dbName;
		$pdo = new PDO($dsn,$this->user,$this->pswd);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
		// if ($pdo) {
		// 	echo"true";
		// } else {
		// 	echo"false";
		// 	return;
		// }
		
		return $pdo;
	}
}
// $db =  new db();
// print_r($db->connect());
 ?>
