<?php
class GStock
{
    private $gs_id;
    private $s_id;
    private $p_id;
    private $p_qty;
    private $p_pprice;
    private $gs_date;

    // Default constructor
    public function __construct()
    {
        // Initialize properties if needed
    }

    // Getters
    public function getGsId()
    {
        return $this->gs_id;
    }

    public function getSId()
    {
        return $this->s_id;
    }

    public function getPId()
    {
        return $this->p_id;
    }

    public function getPPrice()
    {
        return $this->p_pprice;
    }

    public function getPQty()
    {
        return $this->p_qty;
    }

    public function getGsDate()
    {
        return $this->gs_date;
    }

    // Setters
    public function setGsId($gs_id)
    {
        $this->gs_id = $gs_id;
    }

    public function setSId($s_id)
    {
        $this->s_id = $s_id;
    }

    public function setPId($p_id)
    {
        $this->p_id = $p_id;
    }

    public function setPPrice($p_pprice)
    {
        $this->p_pprice = $p_pprice;
    }

    public function setPQty($p_qty)
    {
        $this->p_qty = $p_qty;
    }

    public function setGsDate($gs_date)
    {
        $this->gs_date = $gs_date;
    }
}








?>