<?php
class Closing_sales_report {
    private $csr_id;
    private $s_ref;
    private $unity_id;
    private $p_id;
    private $p_qty;
    private $p_pprice;
    private $p_sprice;
    private $csr_date;

    // Default constructor (accepts optional parameters for initialization)
    public function __construct() {
        
    }

    // Getters
    public function getCsrId(){
        return $this->csr_id;
    }

    public function getSRef(){
        return $this->s_ref;
    }

    public function getUnityId(){
        return $this->unity_id;
    }

    public function getPId(){
        return $this->p_id;
    }

    public function getPQty(){
        return $this->p_qty;
    }

    public function getPPrice(){
        return $this->p_pprice;
    }

    public function getPSprice(){
        return $this->p_sprice;
    }

    public function getCsrDate(){
        return $this->csr_date;
    }

    // Setters
    public function setCsrId($csr_id) {
        $this->csr_id = $csr_id;
    }

    public function setSRef($s_ref) {
        $this->s_ref = $s_ref;
    }

    public function setUnityId($unity_id) {
        $this->unity_id = $unity_id;
    }

    public function setPId($p_id) {
        $this->p_id = $p_id;
    }

    public function setPQty($p_qty) {
        $this->p_qty = $p_qty;
    }

    public function setPPrice($p_pprice) {
        $this->p_pprice = $p_pprice;
    }

    public function setPSprice($p_sprice) {
        $this->p_sprice = $p_sprice;
    }

    public function setCsrDate($csr_date) {
        $this->csr_date = $csr_date;
    }
}


?>