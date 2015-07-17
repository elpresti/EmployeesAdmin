Employees Admin Web App

Introducción:
El proyecto fué hecho a modo de API-WebService, para ser utilizado mediante HTTP Request s de tipo GET, pasando por URL los parametros que sean necesarios en cada caso.
El parametro "action" es obligatorio siempre, y sus posibles valores son:
- addcompany
- addemployee
- getemployees
- getemployeebyid
- getemployeesageavg

Debido a la pequeña magnitud del proyecto se optó por utilizar una librería PHP que simula una base de datos pero guarda las tablas en archivos, en formato JSON.


Guia de uso:
Paso 1:
Descargar de este repositorio los archivos y montarlos en un webserver Apache.


Paso 2:
Dar permisos de creación y modificación de archivos a las carpetas donde queden alojados estos archivos


Paso 3:
Para testear las funcionalidades requeridas en la consigna primero será necesario crear una o varias compañia/s. En este caso agregaremos tres, accediendo a las siguientes URLs:
http://...WEBAPP_BASEURL.../api.php?action=addcompany&name=Google
http://...WEBAPP_BASEURL.../api.php?action=addcompany&name=Microsoft
http://...WEBAPP_BASEURL.../api.php?action=addcompany&name=Apple

Prestamos atención a los CompanyID devueltos, ya que serán los que deberemos usar en los pasos siguientes.
Tambien podemos ver el contenido de la tabla Company en la "DB", ingresando a
http://...WEBAPP_BASEURL.../Company.json


Paso 4:
Testeamos la funcionalidad "addemployee", para esto agregaremos tres empleados, dos a una empresa y uno a otra, utilizando estas URLs:
http://...WEBAPP_BASEURL.../api.php?action=addemployee&companyId=1&name=Juan%20Carlos&surname=Perez&age=26&profession=Programmer&type=Python%20developer
http://...WEBAPP_BASEURL.../api.php?action=addemployee&companyId=1&name=Roberto&surname=Pettinato&age=32&profession=Designer&type=Graphic%20designer
http://...WEBAPP_BASEURL.../api.php?action=addemployee&companyId=2&name=Romina&surname=Olazabal&age=26&profession=Programmer&type=PHP%20Developer

Prestamos atención a los EmployeeID devueltos, ya que serán los que deberemos usar en adelante.
Tambien podemos ver el contenido de la tabla Employee en la "DB", ingresando a
http://...WEBAPP_BASEURL.../Employee.json


Paso 5:
Testearemos la funcionalidad "getemployees" para obtener el listado de los empleados de cada empresa creada:
http://...WEBAPP_BASEURL.../api.php?action=getemployees&companyId=1
http://...WEBAPP_BASEURL.../api.php?action=getemployees&companyId=2
http://...WEBAPP_BASEURL.../api.php?action=getemployees&companyId=3 //Company not found


Paso 6:
Con las siguientes URLs se puede verificar el funcionamiento de la funcionalidad "getemployeebyid"
http://...WEBAPP_BASEURL.../api.php?action=getemployeebyid&companyId=1&employeeId=1
http://...WEBAPP_BASEURL.../api.php?action=getemployeebyid&companyId=1&employeeId=2
http://...WEBAPP_BASEURL.../api.php?action=getemployeebyid&companyId=1&employeeId=3 //Employee not found in companyId=3
http://...WEBAPP_BASEURL.../api.php?action=getemployeebyid&companyId=2&employeeId=3


Paso 7:
Para obtener el promedio de edad de los empleados de cada compañia se debe utilizar la siguiente URL: 
http://...WEBAPP_BASEURL.../api.php?action=getemployeesageavg&companyId=1
http://...WEBAPP_BASEURL.../api.php?action=getemployeesageavg&companyId=2