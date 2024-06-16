<?php
class Billard {
    private $bi_id;
    private $s_id;
    private $e_id;
    private $bi_ref;
    private $player_1;
    private $player_2;
    private $game;
    private $payment_status;
    private $payment_mode;
    private $amount;
    private $bi_status;

    // Default constructor
    public function __construct() { }

    // Getter and Setter for bi_id
    public function getBiId() {
        return $this->bi_id;
    }

    public function setBiId($bi_id) {
        $this->bi_id = $bi_id;
    }

    // Getter and Setter for s_id
    public function getSId() {
        return $this->s_id;
    }

    public function setSId($s_id) {
        $this->s_id = $s_id;
    }

    // Getter and Setter for e_id
    public function getEId() {
        return $this->e_id;
    }

    public function setEId($e_id) {
        $this->e_id = $e_id;
    }

    // Getter and Setter for bi_ref
    public function getBiRef() {
        return $this->bi_ref;
    }

    public function setBiRef($bi_ref) {
        $this->bi_ref = $bi_ref;
    }

    // Getter and Setter for player_1
    public function getPlayer1() {
        return $this->player_1;
    }

    public function setPlayer1($player_1) {
        $this->player_1 = $player_1;
    }

    // Getter and Setter for player_2
    public function getPlayer2() {
        return $this->player_2;
    }

    public function setPlayer2($player_2) {
        $this->player_2 = $player_2;
    }

    // Getter and Setter for game
    public function getGame() {
        return $this->game;
    }

    public function setGame($game) {
        $this->game = $game;
    }

    // Getter and Setter for payment_status
    public function getPaymentStatus() {
        return $this->payment_status;
    }

    public function setPaymentStatus($payment_status) {
        $this->payment_status = $payment_status;
    }

    // Getter and Setter for payment_mode
    public function getPaymentMode() {
        return $this->payment_mode;
    }

    public function setPaymentMode($payment_mode) {
        $this->payment_mode = $payment_mode;
    }

    // Getter and Setter for amount
    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    // Getter and Setter for bi_status
    public function getBiStatus() {
        return $this->bi_status;
    }

    public function setBiStatus($bi_status) {
        $this->bi_status = $bi_status;
    }
}




?>