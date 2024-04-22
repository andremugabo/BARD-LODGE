<?php
class Notification {
    private $n_id;
    private $s_id;
    private $o_ref;
    private $e_id;
    private $p_id;
    private $p_qty;
    private $unity_id;

    // Default constructor
    public function __construct() {
        // No parameters required for the default constructor
    }

    // Getter methods
    public function getNId() {
        return $this->n_id;
    }

    public function getSId() {
        return $this->s_id;
    }

    public function getORef() {
        return $this->o_ref;
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

    // Setter methods
    public function setNId($n_id) {
        $this->n_id = $n_id;
    }

    public function setSId($s_id) {
        $this->s_id = $s_id;
    }

    public function setORef($o_ref) {
        $this->o_ref = $o_ref;
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
}

?>