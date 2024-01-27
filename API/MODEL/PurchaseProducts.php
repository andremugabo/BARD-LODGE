<?php
class PurchaseProducts
{
    private $purchase_id;
    private $s_id;
    private $p_id;
    private $qty_pur;
    private $pprice;

    // Default constructor
    public function __construct()
    {
        // Initialize properties if needed
    }

    // Getters
    public function getPurchaseId()
    {
        return $this->purchase_id;
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
        return $this->pprice;
    }


    public function getQtyPur()
    {
        return $this->qty_pur;
    }

    // Setters
    public function setPurchaseId($purchase_id)
    {
        $this->purchase_id = $purchase_id;
    }

    public function setSId($s_id)
    {
        $this->s_id = $s_id;
    }

    public function setPId($p_id)
    {
        $this->p_id = $p_id;
    }

    public function setPPrice($pprice)
    {
        $this->pprice = $pprice;
    }

    public function setQtyPur($qty_pur)
    {
        $this->qty_pur = $qty_pur;
    }
}





?>