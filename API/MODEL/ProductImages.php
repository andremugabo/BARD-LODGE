<?php 

class ProductImages {
    private $pi_id;
    private $p_id;
    private $pi_image;

    // Default constructor
    public function __construct() {
        // You can initialize default values or perform other setup here
    }

    // Setter for p_id
    public function setPId($p_id) {
        $this->p_id = $p_id;
    }

    // Getter for p_id
    public function getPId() {
        return $this->p_id;
    }

    // Setter for pi_image
    public function setPiImage($pi_image) {
        $this->pi_image = $pi_image;
    }

    // Getter for pi_image
    public function getPiImage() {
        return $this->pi_image;
    }

    public function setPiId($pi_id) {
        $this->pi_id = $pi_id;
    }

    // Getter for pi_id
    public function getPiId() {
        return $this->pi_id;
    }
}






?>