<?php

class ProductCategory {
    private $pc_id;
    private $pt_id;
    private $pc_name;

    // Default constructor
    public function __construct() {
        // You can initialize default values or perform other setup here
    }

    // Getter for pc_id
    public function getPcId() {
        return $this->pc_id;
    }

    // Setter for pc_id
    public function setPcId($pc_id) {
        $this->pc_id = $pc_id;
    }

    // Getter for pt_id
    public function getPtId() {
        return $this->pt_id;
    }

    // Setter for pt_id
    public function setPtId($pt_id) {
        $this->pt_id = $pt_id;
    }

    // Getter for pc_name
    public function getPcName() {
        return $this->pc_name;
    }

    // Setter for pc_name
    public function setPcName($pc_name) {
        $this->pc_name = $pc_name;
    }
}



?>