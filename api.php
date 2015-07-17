<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'classes/Company.class.php';
$outMsg="NO MESSAGE";
$outStatusCode=500;

function printResultInJson(){
	global $outMsg, $outStatusCode;
	$arr = array('statusCode' => $outStatusCode, 'msg' => utf8_encode($outMsg)); //json_encode() will convert to null any non-utf8 String
	echo json_encode($arr);
}
parse_str($_SERVER['QUERY_STRING'], $params);

try{
	if (isset($params['action'])  &&  strlen($params['action'])>0){
		$action = ( (isset($params['action'])) ? $params['action'] : null );
      switch (strtolower($params['action'])) {
       case "addemployee":
         $name = ( (isset($params['name'])) ? $params['name'] : null );
         $surname = ( (isset($params['surname'])) ? $params['surname'] : null );
         $profession = ( (isset($params['profession'])) ? $params['profession'] : null );
         $companyId = ( (isset($params['companyId'])) ? $params['companyId'] : null );
         if ($name != null  &&  $surname != null  &&  $profession != null  &&  $companyId != null){
           $type = ( (isset($params['type'])) ? $params['type'] : null );
           $age = ( (isset($params['age'])) ? $params['age'] : null );
           $company = new Company($companyId);
           if (strtolower($profession)=="programmer" ){
             $employee = new Programmer();
           }else{
             $employee = new Designer();
           }
           $employee->setName($name);
           $employee->setSurname($surname);
           $employee->setAge($age);
           $employee->setType($type);
           $result = $company->addEmployee($employee);
           $outMsg="addemployee processed. New EmployeeID: ".$result;
           $outStatusCode=200;
         }else{
           $outMsg="name, surname, profession and companyId are mandatory parameters";
           $outStatusCode=500;
         }
         break;
       case "addcompany":
         $name = ( (isset($params['name'])) ? $params['name'] : null );
         if ($name != null){
           $company = new Company(null,$name);
           $outMsg="addcompany processed. New CompanyID: \n".$company->getId();
           $outStatusCode=200;
         }else{
           $outMsg="name is a mandatory parameter";
           $outStatusCode=500;
         }
         break;
       case "getemployees":
         $companyId = ( (isset($params['companyId'])) ? $params['companyId'] : null );
         if ($companyId != null){
           $company = new Company($companyId);
           $companyEmployees = $company->getEmployees();
           if ($companyEmployees == null){
             $outMsg="getemployees executed. There are no employees in DB for the Company given";
           }else{
             $outMsg="getemployees executed. Employees data: ".print_r($companyEmployees,TRUE);
           }
           $outStatusCode=200;
         }else{
           $outMsg="companyId parameter is mandatory";
           $outStatusCode=500;
         }
       	break;
        case "getemployeebyid":
         $employeeId = ( (isset($params['employeeId'])) ? $params['employeeId'] : null );
         $companyId = ( (isset($params['companyId'])) ? $params['companyId'] : null );
         if ($companyId != null  &&  $employeeId != null){
           $company = new Company($companyId);
           $employee = $company->getEmployeeById($employeeId);
           if ($employee != null){
             $outMsg="getemployeebyid executed. Employee data: ".print_r($employee,TRUE);
           }else{
             $outMsg="getemployeebyid executed. Employee not found in DB";
           }
           $outStatusCode=200;
         }else{
           $outMsg="companyId and employeeId parameters are mandatory";
           $outStatusCode=500;
         }
       	break;
        case "getemployeesageavg":
         $companyId = ( (isset($params['companyId'])) ? $params['companyId'] : null );
         if ($companyId != null){
           $company = new Company($companyId);
           $avg = $company->getEmployeesAgeAverage();
           if ($avg == null){
             $outMsg="getemployeeageavg executed. There are no employees in DB. Age average is 0";
           }else{
             $outMsg="getemployeeageavg executed. The Age average of all employees is ".$avg;
           }
           $outStatusCode=200;
         }else{
           $outMsg="itemId and employeeId parameters are mandatory";
           $outStatusCode=500;
         }
       	break;
       default:
         $outMsg="Action parameter must contain a valid value!";
         $outStatusCode=500;
     }
	}else{
		$outMsg="Action parameter must be present!";
		$outStatusCode=500;
	}
} catch (Exception $e) {
	$outMsg="Error! Error details: ".(string)$e;
	$outStatusCode=500;
}
printResultInJson();
?>