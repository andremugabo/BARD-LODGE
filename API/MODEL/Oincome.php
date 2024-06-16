<?php

class Oincome {
    private $oi_id;
    private $oi_category;
    private $oi_name;
    private $oi_price;
    private $oi_status;

    // Default constructor
    public function __construct() { }

    // Getter and Setter for oi_id
    public function getOiId() {
        return $this->oi_id;
    }

    public function setOiId($oi_id) {
        $this->oi_id = $oi_id;
    }

    // Getter and Setter for oi_category
    public function getOiCategory() {
        return $this->oi_category;
    }

    public function setOiCategory($oi_category) {
        $this->oi_category = $oi_category;
    }

    // Getter and Setter for oi_name
    public function getOiName() {
        return $this->oi_name;
    }

    public function setOiName($oi_name) {
        $this->oi_name = strtoupper($oi_name);
    }

    // Getter and Setter for oi_price
    public function getOiPrice() {
        return $this->oi_price;
    }

    public function setOiPrice($oi_price) {
        $this->oi_price = $oi_price;
    }

    // Getter and Setter for oi_status
    public function getOiStatus() {
        return $this->oi_status;
    }

    public function setOiStatus($oi_status) {
        $this->oi_status = $oi_status;
    }
}




?>