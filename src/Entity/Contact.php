<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact 
{
#[Assert\NotBlank(message:"le champ null est vide")]
   private $name;
#[Assert\NotBlank(message:"le champ null est vide")]
   private $lastname;
#[Assert\Email(message:"yours email {{value}} is not correct")]
   private $email;
#[Assert\regex('[0-9]{7}')]
   private $contact;
public function getName():string{
    return $this->name;
}
public function getLastname():string{
    return $this->lastname;
}
public function getEmail(){
    return $this->email;
}
public function getContact(){
    return $this->contact;
}
public function setName($name):self{
    $this->name=$name;
    return $this;
}
public function setLastname($lastname):self{
    $this->lastname=$lastname;
    return $this;
}
public function setContact($contact){
    $this->contact=$contact;
}
public function setEmail($email):self{
    $this->email=$email;
    return $this;
}
}