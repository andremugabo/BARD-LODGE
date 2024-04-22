<?php
require_once 'db.php';
require_once(__DIR__ . '/../MODEL/Metric.php');



class MetricDao extends db{
    
    public function createMetric(Metric $metric)
    {
        $e_id = $metric->getEId();
        $s_id = $metric->getSId();
        $m_desc = $metric->getMDesc();

        $query = "INSERT INTO metric (e_id, s_id, m_desc) VALUES (?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result  = $statement->execute(array(
            $e_id,
            $s_id,
            $m_desc            
        ));
        return $result;
    }


    public function countMetric(){
        $query = "SELECT * FROM metric";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $result = $statement->rowCount();
        return $result;
    }

    public function selectMetricByNonSession(){
        $query = "SELECT employees.*, sessions.*, metric.* FROM metric JOIN employees ON metric.e_id = employees.e_id 
        LEFT JOIN sessions ON sessions.s_id = metric.s_id WHERE sessions.s_id IS NULL ORDER BY metric.m_id DESC";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
    }
    
    public function selectMetricBySession(Metric $metric){
        $s_id = $metric->getSId();
        $query = "SELECT employees.*, sessions.*, metric.* FROM metric JOIN employees ON metric.e_id = employees.e_id 
         JOIN sessions ON sessions.s_id = metric.s_id WHERE sessions.s_id = ? ORDER BY metric.m_id DESC";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$s_id]);
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
    }

    public function selectMetricByEmployee(Metric $metric){
        $id = $metric->getEId();
        $query = "SELECT employees.*, sessions.*, metric.* FROM metric JOIN employees ON metric.e_id = employees.e_id 
         JOIN sessions ON sessions.s_id = metric.s_id WHERE metric.e_id = ? ORDER BY metric.m_id DESC";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
    }
    
}





?>