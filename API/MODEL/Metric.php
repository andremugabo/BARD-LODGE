<?php

class Metric
{ 
    private $m_id;
    private $e_id;
    private $s_id;
    private $m_desc;

    // Constructor
    // public function __construct($m_id,$e_id, $s_id, $m_desc)
    // {   $this->m_id = $m_id; 
    //     $this->e_id = $e_id;
    //     $this->s_id = $s_id;
    //     $this->m_desc = $m_desc;
    // }

    // Getter methods
    public function getMId()
    {
        return $this->m_id;
    }
    public function getEId()
    {
        return $this->e_id;
    }

    public function getSId()
    {
        return $this->s_id;
    }

    public function getMDesc()
    {
        return $this->m_desc;
    }

    // Setter methods
    public function setMId($m_id)
    {
        $this->m_id = $m_id;
    }
    public function setEId($e_id)
    {
        $this->e_id = $e_id;
    }

    public function setSId($s_id)
    {
        $this->s_id = $s_id;
    }

    public function setMDesc($m_desc)
    {
        $this->m_desc = $m_desc;
    }
}







?>