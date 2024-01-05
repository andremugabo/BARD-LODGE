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

    
    
}





?>