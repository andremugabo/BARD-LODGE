<?php
class Closing_general_stock {
    private $cgs_id;
    private $s_ref;
    private $p_id;
    private $p_qty;
    private $p_pprice;
    private $cgs_date;

    // Default constructor (accepts optional parameters for initialization)
    public function __construct() {
        
    }

    // Getters
    public function getCgsId(){
        return $this->cgs_id;
    }

    public function getSRef(){
        return $this->s_ref;
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

    public function getCgsDate(){
        return $this->cgs_date;
    }

    // Setters
    public function setCgsId($cgs_id) {
        $this->cgs_id = $cgs_id;
    }

    public function setSRef($s_ref) {
        $this->s_ref = $s_ref;
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

    public function setCgsDate($cgs_date) {
        $this->cgs_date = $cgs_date;
    }
}


?>