<?php
//include('classes/DbManager.class.php');

function __autoload($class_name){
	include_once $class_name . '.class.php';
}

class Company {
   private $_id;
   private $_name;
   private $_employees;
  
	public function __construct($id=null,$name=null) {
     if ($id != null){
        $company = DbManager::getInstance()->getDbAndTable('Company')->select( 'Company', DbManager::$_COLNAME_ID, $id );
        if ($company != null  &&  sizeof($company)>0){
          $this->setId($company[0][DbManager::$_COLNAME_ID]);
          $this->setName($company[0][DbManager::$_COLNAME_COMPANY_NAME]);
          //echo "companyID and name setter: ".$this->getId().", ".$this->getName();
        }else{
          //echo "company retrieved is null or has a size of 0";
        }
     }else{
       if ($name != null){
         $this->setName($name);
         $this->saveCompany();
       }else{
         echo "error! ID or Name parameters are mandatory to create a Company object";
       }
     }
   }
  
   /* I choose writing old and plain getters and setters, instead of using magic methods __get and __set */
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
  
  	public function getCompanyEmployees() {
    	return $this->_employees;
 	}
	
  	public function setCompanyEmployees($employees) {
    	$this->_employees = $employees;
  	}
  
	public function addEmployee($employee){ //expecting an object of type Programmer or Designer 
     $employee->setId(DbManager::getInstance()->getNextId('Employee'));
     $rowData = array(
				DbManager::$_COLNAME_ID => $employee->getId(),
				DbManager::$_COLNAME_EMPLOYEE_NAME => $employee->getName(),
				DbManager::$_COLNAME_EMPLOYEE_SURNAME => $employee->getSurname(),
				DbManager::$_COLNAME_EMPLOYEE_AGE => $employee->getAge(),
            DbManager::$_COLNAME_EMPLOYEE_PROFESSION => get_class($employee),
            DbManager::$_COLNAME_EMPLOYEE_TYPE => $employee->getType(),
            DbManager::$_COLNAME_EMPLOYEE_COMP_ID => $this->getId()
		);
		if (DbManager::getInstance()->getDbAndTable('Employee')->insert('Employee', $rowData) > 0){
			return (DbManager::getInstance()->getNextId('Employee') - 1);
		}else{
			return "Error trying to add a new employee";
		}
   }
	
	public function getEmployees(){
     //$this->setCompanyEmployees(DbManager::getInstance()->getDbAndTable('Employee')->selectAll('Employee'));
     $employeesDbFormated = DbManager::getInstance()->getDbAndTable('Employee')->select('Employee',DbManager::$_COLNAME_EMPLOYEE_COMP_ID,$this->getId());
     $this->setCompanyEmployees(DbManager::getInstance()->format_employee_dbToObject($employeesDbFormated));
     if ($this->getCompanyEmployees() != null  &&  sizeof($this->getCompanyEmployees())>0){
       return $this->getCompanyEmployees();
     }else{
       return null;
     }
	}
	
	public function getEmployeesAgeAverage(){
      $avg = 0;
      $employees = $this->getEmployees();
      if ($employees != null  &&  sizeof($employees)>0){
        $sum = 0;
        if (is_array($employees)){
          foreach ($employees as $employee){
            $sum = $sum + $employee->getAge();
          }
          $avg = $sum / sizeof($employees);
        }else{
          $avg = $employees->getAge();
        }
        return $avg;
      }else{
        return null;
      }
	}
  
	public function getEmployeeByID($employeeId){
     $this->getEmployees($this->getId());
     if ($this->getCompanyEmployees() == null){
       return null;
     }
     //echo "employees of companyID ".$this->getId().", are: ".print_r($this->getCompanyEmployees(),TRUE);
     if (is_array($this->getCompanyEmployees())){
       foreach($this->getCompanyEmployees() as $employee){
         if ($employee->getId() == $employeeId){
           //echo ".employee matched!"; 
           return $employee;
         }else{
           //echo ".employee readed (but not matched with ".$employeeId."): ".print_r($employee,TRUE);
         }
       }
     }else{
       if ($this->getCompanyEmployees()->getId() == $employeeId){
         //echo ".employee matched!"; 
         return $this->getCompanyEmployees();
       }else{
         //echo ".employee readed (but not matched with ".$employeeId."): ".print_r($employee,TRUE);
       }
     }
     return null;
     //other way could be: $employee = DbManager::getInstance()->getDbAndTable('Employee')->select( 'Employee', DbManager::$_COLNAME_ID, $employeeId );
     //return $this->employees->getEmployeeByID($employeeId);
	}
  
  	public function saveCompany(){
      if ($this->getId() != null){ //update
        $companyToUpdate = $this->getDbAndTable('Company')->select('Company', DbManager::$_COLNAME_ID, $this->getId());
        if (sizeof($companyToUpdate) != 1){
          $companyToUpdate[DbManager::$_COLNAME_ID] = $this->getId();
        }
        $companyToUpdate[DbManager::$_COLNAME_COMPANY_NAME] = $this->getName();
        return DbManager::getInstance()->getDbAndTable('Company')->update('Company', DbManager::$_COLNAME_ID, $company->getId(), $companyToUpdate);
      }else{//create
        $this->setId(DbManager::getInstance()->getNextId('Company'));
        $newCompany[DbManager::$_COLNAME_ID] = $this->getId();
        $newCompany[DbManager::$_COLNAME_COMPANY_NAME] = $this->getName();
        if (DbManager::getInstance()->getDbAndTable('Company')->insert('Company', $newCompany) > 0){
			  return (DbManager::getInstance()->getNextId('Company') - 1);
        }else{
           return "Error trying to add a new Company";
        }
      }
  }
  
  
}

?>