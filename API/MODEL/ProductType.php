<?php

class ProductType {

    private $pt_id;
    private $pt_name;

    // Default constructor
    public function __construct() { }

    // Getters
    public function getPtId() {
        return $this->pt_id;
    }

    public function getPtName() {
        return $this->pt_name;
    }

    // Setters
    public function setPtId($pt_id) {
        $this->pt_id = $pt_id;
    }

    public function setPtName($pt_name) {
        $this->pt_name = $pt_name;
    }
}








?>