<?php
class Expense {
    private $exp_id;
    private $s_id;
    private $exp_category;
    private $exp_description;
    private $exp_amount;
    private $exp_date;
    private $exp_status;

    // Default Constructor
    public function __construct() {
    }

    // Getter methods
    public function getExpId() {
        return $this->exp_id;
    }

    public function getSId() {
        return $this->s_id;
    }

    public function getExpCategory() {
        return $this->exp_category;
    }

    public function getExpDescription() {
        return $this->exp_description;
    }

    public function getExpAmount() {
        return $this->exp_amount;
    }

    public function getExpDate() {
        return $this->exp_date;
    }

    public function getExpStatus() {
        return $this->exp_status;
    }

    // Setter methods
    public function setExpId($exp_id) {
        $this->exp_id = $exp_id;
    }

    public function setSId($s_id) {
        $this->s_id = $s_id;
    }

    public function setExpCategory($exp_category) {
        $this->exp_category = $exp_category;
    }

    public function setExpDescription($exp_description) {
        $this->exp_description = $exp_description;
    }

    public function setExpAmount($exp_amount) {
        $this->exp_amount = $exp_amount;
    }

    public function setExpDate($exp_date) {
        $this->exp_date = $exp_date;
    }

    public function setExpStatus($exp_status) {
        $this->exp_status = $exp_status;
    }
}

?>