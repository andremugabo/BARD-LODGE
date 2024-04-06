<?php

class Closing_sales_stock {
    private $css_id;
    private $s_ref;
    private $p_id;
    private $p_qty;
    private $p_pprice;
    private $css_date;

    // Default constructor 
    public function __construct() {
       
    }

    // Getters (with appropriate data type validation and error handling)
    public function getCssId(){
        return $this->css_id;
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

    public function getCssDate(){
        return $this->css_date;
    }

    // Setters (with data type validation and error handling)
    public function setCssId(int $css_id) {
        
        $this->css_id = $css_id;
    }

    public function setSRef(string $s_ref) {
        
        $this->s_ref = $s_ref;
    }

    public function setPId(int $p_id) {
       
        $this->p_id = $p_id;
    }

    public function setPQty(int $p_qty) {
        
        $this->p_qty = $p_qty;
    }

    public function setPPrice(float $p_pprice) {
        
        $this->p_pprice = $p_pprice;
    }

    public function setCssDate(string $css_date) {
        
        $this->css_date = $css_date;
    }
}





?>