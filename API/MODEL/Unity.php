<?php

class Unity {
    private $unity_id;
    private $unity_name;

    // Default constructor
    public function __construct() {
        // You can initialize default values or perform other setup here
    }

    // Getter and Setter for unity_id
    public function getUnityId() {
        return $this->unity_id;
    }

    public function setUnityId($unity_id) {
        $this->unity_id = $unity_id;
    }

    // Getter and Setter for unity_name
    public function getUnityName() {
        return $this->unity_name;
    }

    public function setUnityName($unity_name) {
        $this->unity_name = $unity_name;
    }
}







?>