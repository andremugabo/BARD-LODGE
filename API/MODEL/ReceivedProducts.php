<?php
class ReceivedProducts
{
    private $received_id;
    private $s_id;
    private $p_id;
    private $qty_rec;

    // Default constructor
    public function __construct()
    {
        // Initialize properties if needed
    }

    // Getters
    public function getReceivedId()
    {
        return $this->received_id;
    }

    public function getSId()
    {
        return $this->s_id;
    }

    public function getPId()
    {
        return $this->p_id;
    }

    public function getQtyRec()
    {
        return $this->qty_rec;
    }

    // Setters
    public function setReceivedId($received_id)
    {
        $this->received_id = $received_id;
    }

    public function setSId($s_id)
    {
        $this->s_id = $s_id;
    }

    public function setPId($p_id)
    {
        $this->p_id = $p_id;
    }

    public function setQtyRec($qty_rec)
    {
        $this->qty_rec = $qty_rec;
    }
}





?>