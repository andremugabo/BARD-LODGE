<?php

class Products {
    private $p_id;
    private $p_code;
    private $pc_id;
    private $p_package;
    private $p_name;
    private $unity_id;
    private $p_status;

    // Default constructor
    public function __construct() {
        // You can initialize default values or perform other setup here
    }

    // Getter and Setter for p_id
    public function getPId() {
        return $this->p_id;
    }

    public function setPId($p_id) {
        $this->p_id = $p_id;
    }

    // Getter and Setter for p_code
    public function getPCode() {
        return $this->p_code;
    }

    public function setPCode($p_code) {
        $this->p_code = $p_code;
    }

    // Getter and Setter for pc_id
    public function getPcId() {
        return $this->pc_id;
    }

    public function setPcId($pc_id) {
        $this->pc_id = $pc_id;
    }

    // Getter and Setter for p_name
    public function getPName() {
        return $this->p_name;
    }

    public function getPPackage() {
        return $this->p_package;
    }

    public function setPPackage($p_package) {
        $this->p_package= $p_package;
    }

    public function setPName($p_name) {
        $this->p_name = $p_name;
    }

    // Getter and Setter for unity_id
    public function getUnityId() {
        return $this->unity_id;
    }

    public function setUnityId($unity_id) {
        $this->unity_id = $unity_id;
    }

    // Getter and Setter for p_status
    public function getPStatus() {
        return $this->p_status;
    }

    public function setPStatus($p_status) {
        $this->p_status = $p_status;
    }
}








?>