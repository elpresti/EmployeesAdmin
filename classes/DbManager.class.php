<?php
/*
function __autoload($class_name){
	include_once $class_name . '.class.php';
}
*/
final class DbManager {
   private static $instance = null;	
   private $_dbInstance = null;
	private $_dbPath = "./";
	public static $_COLNAME_ID = "id";
	public static $_COLNAME_EMPLOYEE_NAME = "name";
	public static $_COLNAME_EMPLOYEE_SURNAME = "surname";
	public static $_COLNAME_EMPLOYEE_AGE = "age";
	public static $_COLNAME_EMPLOYEE_TYPE = "type";
	public static $_COLNAME_EMPLOYEE_PROFESSION = "profession";
	public static $_COLNAME_EMPLOYEE_COMP_ID = "companyid";
	public static $_COLNAME_COMPANY_NAME = "name";
	
	private function __construct() { }
   public function __clone() { }
   public static function getInstance(){
     if (is_null(self::$instance)) {
       self::$instance = new DbManager();
     } 
     return self::$instance;
   }

	public function getDbAndTable($tableName=null){
     	if ($tableName == null){
         $tableName = "unknownCompany"; //default value
      }
		if ($this->_dbInstance == null){
			$this->_dbInstance = new JsonDB($this->_dbPath);
		}
     	try{
			$this->_dbInstance->selectAll($tableName);
      }catch(Exception $e){
      	$this->_dbInstance->createTable($tableName);
      }
		return $this->_dbInstance;
	}

	public function getNextId($tableName){
		$fullTable = $this->getDbAndTable($tableName)->selectAll($tableName);
      if ($fullTable == null){
        $fullTable = array(); //table empty 
      }
      $tableInArray = array_values($fullTable);
		$lastElement = end($tableInArray);
		if (sizeof($lastElement)>=1){
			return $lastElement[DbManager::$_COLNAME_ID]+1;
		}else{
			return 1;
		}
	}
/*
  public function saveEntity($entity){
    if ($entity instanceof Company ){
      $company = (Company)$entity;
      if ($company->getId() != null){ //update
        $itemToUpdate = $this->getDbAndTable(get_class($entity))->select(get_class($entity), DbManager::$_COLNAME_ID, $company->getId());
        if (sizeof($itemToUpdate) != 1){
          $itemToUpdate[DbManager::$_COLNAME_ID] = $company->getId();
        }
        $itemToUpdate[DbManager::$_COLNAME_COMPANY_NAME] = $company->getName();
        return DbManager::getInstance()->getDbAndTable(get_class($entity))->update(get_class($entity), DbManager::$_COLNAME_ID, $company->getId(), $itemToUpdate);
      }else{//create
        return "Error trying to add a new employee";
      }
    }
    $this->getDbAndTable(get_class('Company'))->
  }
*/

	public function format_employee_dbToObject($employeeDb){
     if ($employeeDb == null  ||  sizeof($employeeDb)==0){
       return null;
     }
     if (sizeof($employeeDb)>1){
       $employeeObjectArray = array();
       foreach($employeeDb as $oneEmployeeDb){
         $employeeObj = new $oneEmployeeDb[$this::$_COLNAME_EMPLOYEE_PROFESSION]();
         $employeeObj->setId($oneEmployeeDb[$this::$_COLNAME_ID]);
         $employeeObj->setName($oneEmployeeDb[$this::$_COLNAME_EMPLOYEE_NAME]);
         $employeeObj->setSurname($oneEmployeeDb[$this::$_COLNAME_EMPLOYEE_SURNAME]);
         $employeeObj->setAge($oneEmployeeDb[$this::$_COLNAME_EMPLOYEE_AGE]);
         $employeeObjectArray[]=$employeeObj;
       }
       return $employeeObjectArray;
     }else{
       $employeeObj = new $employeeDb[0][$this::$_COLNAME_EMPLOYEE_PROFESSION]();
       $employeeObj->setId($employeeDb[0][$this::$_COLNAME_ID]);
       $employeeObj->setName($employeeDb[0][$this::$_COLNAME_EMPLOYEE_NAME]);
       $employeeObj->setSurname($employeeDb[0][$this::$_COLNAME_EMPLOYEE_SURNAME]);
       $employeeObj->setAge($employeeDb[0][$this::$_COLNAME_EMPLOYEE_AGE]);
       return $employeeObj;
     }
   }

}
?>