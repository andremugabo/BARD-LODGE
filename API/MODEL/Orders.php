<?php
class Orders {
    private $o_id;
    private $o_ref;
    private $e_id;
    private $s_id;
    private $o_date;
    private $o_table;
    private $o_amount;
    private $o_payment;
    private $payment_mode;
    private $c_name;
    private $c_phone;
    private $o_status;

    // Default constructor
    public function __construct() {
        
    }

    // Getter methods
    public function getOId() {
        return $this->o_id;
    }
    public function getORef() {
        return $this->o_ref;
    }

    public function getEId() {
        return $this->e_id;
    }

    public function getSId() {
        return $this->s_id;
    }

    public function getODate() {
        return $this->o_date;
    }

    public function getOTable() {
        return $this->o_table;
    }

    public function getOAmount() {
        return $this->o_amount;
    }

    public function getOPayment() {
        return $this->o_payment;
    }

    public function getPaymentMode() {
        return $this->payment_mode;
    }

    public function getCName() {
        return $this->c_name;
    }

    public function getCPhone() {
        return $this->c_phone;
    }

    public function getOStatus() {
        return $this->o_status;
    }

    // Setter methods
    public function setOId($o_id) {
        $this->o_id = $o_id;
    }

    public function setORef($o_ref) {
        $this->o_ref = $o_ref;
    }

    public function setEId($e_id) {
        $this->e_id = $e_id;
    }

    public function setSId($s_id) {
        $this->s_id = $s_id;
    }

    public function setODate($o_date) {
        $this->o_date = $o_date;
    }

    public function setOTable($o_table) {
        $this->o_table = $o_table;
    }

    public function setOAmount($o_amount) {
        $this->o_amount = $o_amount;
    }

    public function setOPayment($o_payment) {
        $this->o_payment = $o_payment;
    }


    public function setPaymentMode($payment_mode) {
        $this->payment_mode = $payment_mode;
    }

    public function setCName($c_name) {
        $this->c_name = $c_name;
    }

    public function setCPhone($c_phone) {
        $this->c_phone = $c_phone;
    }



    public function setOStatus($o_status) {
        $this->o_status = $o_status;
    }
}







?>