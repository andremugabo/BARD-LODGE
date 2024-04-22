<?php  


class SpecialDetails
{
    private $od_id;
    private $s_id;
    private $o_id;
    private $e_id;
    private $p_id;
    private $pt_id;
    private $p_qty;
    private $unity_id;
    private $p_price;
    private $s_price;
    private $od_time;

    // Default constructor
    public function __construct()
    {
        // Optional initializations if needed
    }

    // Getters

    public function getOdId()
    {
        return $this->od_id;
    }

    public function getSId()
    {
        return $this->s_id;
    }

    public function getOId()
    {
        return $this->o_id;
    }

    public function getEId()
    {
        return $this->e_id;
    }

    public function getPId()
    {
        return $this->p_id;
    }

    public function getPtId()
    {
        return $this->pt_id;
    }

    public function getPQty()
    {
        return $this->p_qty;
    }

    public function getUnityId()
    {
        return $this->unity_id;
    }

    public function getPPrice()
    {
        return $this->p_price;
    }

    public function getSPrice()
    {
        return $this->s_price;
    }

    public function getOdTime()
    {
        return $this->od_time;
    }

    // Setters

    public function setOdId($od_id)
    {
        $this->od_id = $od_id;
    }

    public function setSId($s_id)
    {
        $this->s_id = $s_id;
    }

    public function setOId($o_id)
    {
        $this->o_id = $o_id;
    }

    public function setEId($e_id)
    {
        $this->e_id = $e_id;
    }

    public function setPId($p_id)
    {
        $this->p_id = $p_id;
    }

    public function setPtId($pt_id)
    {
        $this->pt_id = $pt_id;
    }

    public function setPQty($p_qty)
    {
        $this->p_qty = $p_qty;
    }

    public function setUnityId($unity_id)
    {
        $this->unity_id = $unity_id;
    }

    public function setPPrice($p_price)
    {
        $this->p_price = $p_price;
    }

    public function setSPrice($s_price)
    {
        $this->s_price = $s_price;
    }

    public function setOdTime($od_time)
    {
        $this->od_time = $od_time;
    }
}


?>