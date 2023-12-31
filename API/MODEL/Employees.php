<?php

class Employees {
    private $e_id;
    private $e_regNumber;
    private $firstname;
    private $lastname;
    private $e_role;
    private $e_phone;
    private $e_idNumber;
    private $e_status;

    // Constructor
    public function __construct($e_id, $e_regNumber, $firstname, $lastname, $e_role, $e_phone, $e_idNumber, $e_status) {
        $this->e_id = $e_id;
        $this->e_regNumber = $e_regNumber;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->e_role = $e_role;
        $this->e_phone = $e_phone;
        $this->e_idNumber = $e_idNumber;
        $this->e_status = $e_status;
    }

    // Getter methods
    public function getEId() {
        return $this->e_id;
    }

    public function getERegNumber() {
        return $this->e_regNumber;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getERole() {
        return $this->e_role;
    }

    public function getEPhone() {
        return $this->e_phone;
    }

    public function getEIdNumber() {
        return $this->e_idNumber;
    }

    public function getEStatus() {
        return $this->e_status;
    }

    // Setter methods
    public function setEId($e_id) {
        $this->e_id = $e_id;
    }

    public function setERegNumber($e_regNumber) {
        $this->e_regNumber = $e_regNumber;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setERole($e_role) {
        $this->e_role = $e_role;
    }

    public function setEPhone($e_phone) {
        $this->e_phone = $e_phone;
    }

    public function setEIdNumber($e_idNumber) {
        $this->e_idNumber = $e_idNumber;
    }

    public function setEStatus($e_status) {
        $this->e_status = $e_status;
    }
}






?>