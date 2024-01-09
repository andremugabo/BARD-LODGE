<?php

class Price {
    private $price_id;
    private $p_id;
    private $sprice;
    private $eprice;
    private $pprice;
    private $unity_id;
    private $startdate;
    private $enddate;

    // Default constructor
    public function __construct() {
        // You can initialize default values or perform other setup here
    }

    // Getter and Setter for price_id
    public function getPriceId() {
        return $this->price_id;
    }

    public function setPriceId($price_id) {
        $this->price_id = $price_id;
    }

    // Getter and Setter for p_id
    public function getPId() {
        return $this->p_id;
    }

    public function setPId($p_id) {
        $this->p_id = $p_id;
    }

    // Getter and Setter for sprice
    public function getSPrice() {
        return $this->sprice;
    }

    public function setSPrice($sprice) {
        $this->sprice = $sprice;
    }

    // Getter and Setter for eprice
    public function getEPrice() {
        return $this->eprice;
    }

    public function setEPrice($eprice) {
        $this->eprice = $eprice;
    }

    // Getter and Setter for pprice
    public function getPPrice() {
        return $this->pprice;
    }

    public function setPPrice($pprice) {
        $this->pprice = $pprice;
    }

    // Getter and Setter for unity_id
    public function getUnityId() {
        return $this->unity_id;
    }

    public function setUnityId($unity_id) {
        $this->unity_id = $unity_id;
    }

    // Getter and Setter for startdate
    public function getStartDate() {
        return $this->startdate;
    }

    public function setStartDate($startdate) {
        $this->startdate = $startdate;
    }

    // Getter and Setter for enddate
    public function getEndDate() {
        return $this->enddate;
    }

    public function setEndDate($enddate) {
        $this->enddate = $enddate;
    }
}






?>