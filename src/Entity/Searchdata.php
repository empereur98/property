<?php
namespace App\Entity;

class Searchdata{
    /**
     * @var int|null
     */
    private $maxPrice;
    /**
     * @var int|null
     */
    private $minSurface;
public function setMaxprice(int $maxPrice):self{
    $this->maxPrice=$maxPrice;
    return $this;
}
public function setMinsurface(int $minSurface):self{
    $this->minSurface=$minSurface;
    return $this;
}
public function getMaxprice():?int{
   return $this->maxPrice;
}
public function getMinsurface():?int{
    return $this->minSurface;
}

}