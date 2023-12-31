<?php

class Users {
    private $u_id;
    private $e_id;
    private $u_name;
    private $u_password;
    private $u_status;

    // Constructor
    public function __construct($e_id, $u_name, $u_password, $u_status) {
        $this->e_id = $e_id;
        $this->u_name = $u_name;
        $this->u_password = $u_password;
        $this->u_status = $u_status;
    }

    // Getter methods
    public function getUId() {
        return $this->u_id;
    }

    public function getEId() {
        return $this->e_id;
    }

    public function getUName() {
        return $this->u_name;
    }

    public function getUPassword() {
        return $this->u_password;
    }

    public function getUStatus() {
        return $this->u_status;
    }

    // Setter methods
    public function setUId($u_id) {
        $this->u_id = $u_id;
    }

    public function setEId($e_id) {
        $this->e_id = $e_id;
    }

    public function setUName($u_name) {
        $this->u_name = $u_name;
    }

    public function setUPassword($u_password) {
        $this->u_password = $u_password;
    }

    public function setUStatus($u_status) {
        $this->u_status = $u_status;
    }
}







?>