<?php

class IncomeDetails {
    private $ind_id;
    private $s_id;
    private $ind_name;
    private $ind_details;
    private $ind_amount;

    public function __construct() {
        
    }

    // Getter methods
    public function getIndId() {
        return $this->ind_id;
    }

    public function getSId() {
        return $this->s_id;
    }

    public function getIndName() {
        return $this->ind_name;
    }

    public function getIndDetails() {
        return $this->ind_details;
    }

    public function getIndAmount() {
        return $this->ind_amount;
    }

    // Setter methods
    public function setIndId($ind_id) {
        $this->ind_id = $ind_id;
    }

    public function setSId($s_id) {
        $this->s_id = $s_id;
    }

    public function setIndName($ind_name) {
        $this->ind_name = $ind_name;
    }

    public function setIndDetails($ind_details) {
        $this->ind_details = $ind_details;
    }

    public function setIndAmount($ind_amount) {
        $this->ind_amount = $ind_amount;
    }
}


?>