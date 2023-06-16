<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact 
{
#[Assert\NotBlank(message:"le champ null est vide")]
   private $name;
#[Assert\NotBlank(message:"le champ null est vide")]
   private $lastname;
#[Assert\Email(message:"yours email {{value}} is not correct"),
Assert\NotBlank()]
   private $email;
#[Assert\NotBlank()]
   private $contact;
#[Assert\NotBlank()]
   private $messages;
   /**
    * @var Property
    */
   private $property;
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
public function getMessages():string{
    return $this->messages;
}
public function setMessages(string $messages):self{
    $this->messages=$messages;
    return $this;
}
public function getProperty():Property{
    return $this->property;
}
public function setProperty(Property $property):self{
    $this->property=$property;
    return $this;
}
}