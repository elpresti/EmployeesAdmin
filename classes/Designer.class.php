<?php
class Designer extends Employee {
  private $type; //position held
  
  public function getType() {
    	return $this->_type;
  }
	
  public function setType($type) {
    	$this->_type = $type;
  }
  
}

?>