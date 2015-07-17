
Nota: la carpeta donde queden alojados los archivos de la APP deben tener permisos para la creación y modificación de archivos

http://runnerp12.codenvycorp.com:51054/api.php?action=addcompany&name=Google
http://runnerp12.codenvycorp.com:51054/api.php?action=addcompany&name=Microsoft
http://runnerp12.codenvycorp.com:51054/api.php?action=addcompany&name=Apple

Prestamos atención a los CompanyID devueltos, ya que serán los que deberemos usar en adelante.
Tambien podemos ver el contenido de la tabla Company en la "DB", ingresando a
http://runnerp12.codenvycorp.com:51054/Company.json

http://runnerp12.codenvycorp.com:51054/api.php?action=addemployee&companyId=1&name=Juan%20Carlos&surname=Perez&age=26&profession=Programmer&type=Python%20developer
http://runnerp12.codenvycorp.com:51054/api.php?action=addemployee&companyId=1&name=Roberto&surname=Pettinato&age=32&profession=Designer&type=Graphic%20designer
http://runnerp12.codenvycorp.com:51054/api.php?action=addemployee&companyId=2&name=Romina&surname=Olazabal&age=26&profession=Programmer&type=PHP%20Developer

Prestamos atención a los CompanyID devueltos, ya que serán los que deberemos usar en adelante.
Tambien podemos ver el contenido de la tabla Company en la "DB", ingresando a
http://runnerp12.codenvycorp.com:51054/Employee.json


http://runnerp12.codenvycorp.com:51054/api.php?action=getemployees&companyId=1
http://runnerp12.codenvycorp.com:51054/api.php?action=getemployees&companyId=2
http://runnerp12.codenvycorp.com:51054/api.php?action=getemployees&companyId=3 //Company not found


http://runnerp12.codenvycorp.com:51054/api.php?action=getemployeebyid&companyId=1&employeeId=2
http://runnerp12.codenvycorp.com:51054/api.php?action=getemployeebyid&companyId=1&employeeId=2
http://runnerp12.codenvycorp.com:51054/api.php?action=getemployeebyid&companyId=1&employeeId=3 //Employee not found in companyId=3
http://runnerp12.codenvycorp.com:51054/api.php?action=getemployeebyid&companyId=2&employeeId=3

http://runnerp12.codenvycorp.com:51054/api.php?action=getemployeesageavg&companyId=1
http://runnerp12.codenvycorp.com:51054/api.php?action=getemployeesageavg&companyId=2