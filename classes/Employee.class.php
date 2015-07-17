<?php
/*
function __autoload($class_name){
	include_once $class_name . '.class.php';
}
*/
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
  /*
  public function getEmployees(){
		return DbManager::getInstance()->getDbAndTable('Employee')->selectAll('Employee');
  }
  
  public function getEmployeeByID($employee_id){
				
		$query = "SELECT *,
						 (
							SELECT GROUP_CONCAT(skills.name)
							  FROM employee_skill
						 LEFT JOIN skills ON skills.id = employee_skill.skills_id
							 WHERE employees.id = employee_skill.employee_id
						 ) AS 'skills'
					FROM employees WHERE employees.id = :employee_id ;";

		return $this->_db->query($query, array( ':employee_id' => $employee_id));
	}
  */
}