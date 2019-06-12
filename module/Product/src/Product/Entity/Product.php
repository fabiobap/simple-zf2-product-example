<?php
namespace Product\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Product{
    
    /** 
    @ORM\Id 
    @ORM\GeneratedValue(strategy="AUTO") 
    @ORM\Column(type="integer") 
    */
    private $id;
    /** @ORM\Column(type="string")*/
    private $name;
    /** @ORM\Column(type="decimal", scale = 2)*/
    private $price;
    /** @ORM\Column(type="string") */
    private $description;
    
    public function __construct($name, $price, $description){
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }
    
    public function getId(){
        return $this->id;
    }  
    
    public function getName(){
        return $this->name;
    }
    
    public function getPrice(){
        return $this->price;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function setPrice($price){
        $this->price = $price;
    }    
    public function setDescription($description){
        $this->description = $description;
    }
}