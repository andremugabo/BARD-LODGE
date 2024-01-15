<?php

class Sessions {
    private $s_id;
    private $s_ref;
    private $s_status;
    private $s_date;

    // Default Constructor
    public function __construct() {
        // You can initialize default values or perform any other setup here
    }

    // Getter for s_id
    public function getSId() {
        return $this->s_id;
    }

    // Setter for s_id
    public function setSId($s_id) {
        $this->s_id = $s_id;
    }

    // Getter for s_ref
    public function getSRef() {
        return $this->s_ref;
    }

    // Setter for s_ref
    public function setSRef($s_ref) {
        $this->s_ref = $s_ref;
    }

    // Getter for s_status
    public function getSStatus() {
        return $this->s_status;
    }

    // Setter for s_status
    public function setSStatus($s_status) {
        $this->s_status = $s_status;
    }

    // Getter for s_date
    public function getSDate() {
        return $this->s_date;
    }

    // Setter for s_date
    public function setSDate($s_date) {
        $this->s_date = $s_date;
    }
}







?>