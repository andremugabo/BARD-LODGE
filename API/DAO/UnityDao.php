<?php
require_once 'db.php';
require_once (__DIR__.'/../MODEL/Unity.php');




class UnityDao extends db{
    public function createUnity(Unity $unity) {
        $unity_name = $unity->getUnityName();

        $query = "INSERT INTO unity (unity_name) VALUES (?)";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $unity_name            
        ));
        return $result;
    }


    public function checkIfUnityExist(Unity $Unity)
    {
        $unity_name = $Unity->getUnityName();
        $query = "SELECT  *  FROM unity WHERE unity.unity_name = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $unity_name
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function checkIfUnityExistById(Unity $Unity)
    {
        $unity_id = $Unity->getUnityId();
        $query = "SELECT  *  FROM unity WHERE unity.unity_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $unity_id,
        ));
        $result = $statement->rowCount();
        return $result;
    }

    public function selectUnity() {
        $query = "SELECT * FROM unity ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
        
        
    }

    public function selectOneUnity(Unity $Unity){
        $unity_id = $Unity->getUnityId();
		$sql = "SELECT * FROM unity WHERE unity.unity_id =? ";
		$statement = $this->connect()->prepare($sql);
		$statement->execute(array(
			$unity_id
		));

		$result = $statement->fetch();
		return $result;
		
	}

    public function updateUnity(Unity $unity)
    {
        $unity_name = $unity->getUnityName();
        $unity_id = $unity->getUnityId();
        $query = "UPDATE unity SET unity.unity_name = ? WHERE unity.unity_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $unity_name,
            $unity_id
        ));
        $result = $statement->execute();
        return $result;
    }
    

}




?>