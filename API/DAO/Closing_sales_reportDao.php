<?php
require_once 'db.php';
require_once(__DIR__ . '/../MODEL/Closing_sales_report.php');


class Closing_sales_reportDao extends db{
    public function createSReport(Closing_sales_report $csReport){
        $s_ref = $csReport->getSRef();
        $unity_id = $csReport->getUnityId();
        $p_id = $csReport->getPId();
        $p_qty = $csReport->getPQty();
        $p_pprice = $csReport->getPPrice();
        $p_sprice = $csReport->getPSPrice();
        $query = "INSERT INTO closing_sales_report(s_ref,unity_id,p_id,p_qty,p_pprice,p_sprice) VALUES(?,?,?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $result = $statement->execute(array(
            $s_ref,
            $unity_id ,
            $p_id, 
            $p_qty,
            $p_pprice,
            $p_sprice
        ));
        return $result;
    }


    public function selectSReportBySRef(Closing_sales_report $csReport) {
        $s_ref = $csReport->getSRef();
        $query = "SELECT unity.*,products.*,sessions.*,closing_sales_report.* FROM closing_sales_report 
        JOIN products ON products.p_id = closing_sales_report.p_id 
        JOIN sessions ON sessions.s_ref = closing_sales_report.s_ref 
        JOIN unity ON unity.unity_id = closing_sales_report.unity_id WHERE closing_sales_report.s_ref = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute(array(
            $s_ref
        ));
        while($result = $statement->fetchAll(PDO::FETCH_ASSOC))
        {
            return $result;
        }
    }
}






?>