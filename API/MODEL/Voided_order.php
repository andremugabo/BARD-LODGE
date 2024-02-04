<?php
class Voided_order {
    private $v_id;
    private $o_id;
    private $e_id;
    private $p_id;
    private $p_qty;
    private $unity_id;
    private $v_reason;

    // Default constructor
    public function __construct() {
        // Initialize properties if needed
    }

    // Setters
    public function setVId($v_id) {
        $this->v_id = $v_id;
    }

    public function setOId($o_id) {
        $this->o_id = $o_id;
    }

    public function setEId($e_id) {
        $this->e_id = $e_id;
    }

    public function setPId($p_id) {
        $this->p_id = $p_id;
    }

    public function setPQty($p_qty) {
        $this->p_qty = $p_qty;
    }

    public function setUnityId($unity_id) {
        $this->unity_id = $unity_id;
    }

    public function setVReason($v_reason) {
        $this->v_reason = $v_reason;
    }

    // Getters
    public function getVId() {
        return $this->v_id;
    }

    public function getOId() {
        return $this->o_id;
    }

    public function getEId() {
        return $this->e_id;
    }

    public function getPId() {
        return $this->p_id;
    }

    public function getPQty() {
        return $this->p_qty;
    }

    public function getUnityId() {
        return $this->unity_id;
    }

    public function getVReason() {
        return $this->v_reason;
    }
}

?>