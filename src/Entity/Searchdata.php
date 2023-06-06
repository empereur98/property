<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\ObjectType;

class Searchdata{
    /**
     * @var int|null
     */
    private $maxPrice;
    /**
     * @var int|null
     */
    private $minSurface;
    /**
     * @var ArrayCollection|null;
     */
    private $options;
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
public function getOptions():?ArrayCollection{
    return $this->options;
}
public function setOptions(ArrayCollection $options):?self{
    $this->options=$options;
    return $this;
}
}