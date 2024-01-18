<?php
class SStock
{
    private $ss_id;
    private $s_id;
    private $p_id;
    private $p_qty;
    private $ss_date;

    // Default constructor
    public function __construct()
    {
        // Initialize properties if needed
    }

    // Getters
    public function getSsId()
    {
        return $this->ss_id;
    }

    public function getSId()
    {
        return $this->s_id;
    }

    public function getPId()
    {
        return $this->p_id;
    }

    public function getPQty()
    {
        return $this->p_qty;
    }

    public function getSsDate()
    {
        return $this->ss_date;
    }

    // Setters
    public function setSsId($ss_id)
    {
        $this->ss_id = $ss_id;
    }

    public function setSId($s_id)
    {
        $this->s_id = $s_id;
    }

    public function setPId($p_id)
    {
        $this->p_id = $p_id;
    }

    public function setPQty($p_qty)
    {
        $this->p_qty = $p_qty;
    }

    public function setSsDate($ss_date)
    {
        $this->ss_date = $ss_date;
    }
}








?>