<?php

abstract class Employee {
   protected $_id;
   protected $_name;
   protected $_surname;
   protected $_age;
  
	public function getId() {
    	return $this->_id;
 	}
	
  	public function setId($id) {
    	$this->_id = $id;
  	}
  
  	public function getName() {
    	return $this->_name;
 	}
	
  	public function setName($name) {
    	$this->_name = $name;
  	}
  
  	public function getSurname() {
    	return $this->_surname;
 	}
	
  	public function setSurname($surname) {
    	$this->_surname = $surname;
  	}
  
  	public function getAge() {
    	return $this->_age;
 	}
	
  	public function setAge($age) {
    	$this->_age = $age;
  	}
  
}