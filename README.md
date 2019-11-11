# Automated Payroll

### Problem Statement :
The purpose of an automated payroll application is to keep track of the attendance as well as payroll (salary) of the employees in an organization. This application should track whether the employee is within the office premises by obtaining the GPS location of the employee after every 10 seconds. This application helps the employer to prevent proxy attendace of the employee. Moreover, the HR of the company can easily calculate the payroll of the employee.

### Team :

|	|	|	|
|---|---|---|
|[Harsh Raj](https://github.com/harshraj22)  &nbsp;|  [Abhishek Raj](https://github.com/abhiisshheekk)  &nbsp;|  [Utkarsh Prakash](https://github.com/Utkarsh-1)|


### Screenshots :
![Screenshot from 2019-11-10 21-33-56](https://user-images.githubusercontent.com/46635452/68546921-ed3e8f80-0401-11ea-9168-c177774d9b22.png)

![Website](https://user-images.githubusercontent.com/46635452/68547020-c0d74300-0402-11ea-84e2-2d9ac11a5952.png)



### Built using :
  * HTML5 &nbsp; [Geolocation API](https://www.w3schools.com/html/html5_geolocation.asp)

  * HTML5 &nbsp; [Getusermedia API](https://www.html5rocks.com/en/tutorials/getusermedia/intro/)

  * Backend:
    * [PHP](https://www.php.net/) &nbsp; [Mysql](https://www.mysql.com/)
  * Frontend:
    * [HTML](https://www.w3schools.com/html/) &nbsp; [Bootstrap 4](https://getbootstrap.com/)

### Directory Structure :
  ```
  Automated_Payroll/
	├── LICENSE
	├── Payroll
	│   ├── admin
	│   │   ├── EmpSalary.txt
	│   │   ├── adminProfile.php
	│   │   ├── calcAllSalary.php
	│   │   ├── calcSalary.php
	│   │   ├── changeRate.php
	│   │   ├── createHr.php
	│   │   ├── createUser.php
	│   │   ├── displayUserStats.php
	│   │   ├── resetPass.php
	│   │   ├── showImage.php
	│   │   ├── showMap.php
	│   │   └── style.css
	│   ├── authenticate
	│   │   └── login.php
	│   ├── automate
	│   │   └── automate.php
	│   ├── filter.php
	│   ├── images
	│   │   ├── home.jpg
	│   │   ├── image1.jpg
	│   │   ├── image2.jpg
	│   │   ├── image3.jpg
	│   │   └── richie.jpg
	│   ├── index.css
	│   ├── index.html
	│   ├── index.php
	│   ├── user
	│   │   ├── imageCapture.js
	│   │   ├── logout.php
	│   │   ├── saveImage.php
	│   │   ├── userLoginImage.php
	│   │   ├── userLogoutImage.php
	│   │   ├── userProfile.js
	│   │   ├── userProfile.php
	│   │   └── userProfileFrontend.php
	│   └── user_images
	│       ├── ariana
	│       │   ├── 2019-11-10-in.png
	│       │   └── 2019-11-10-out.png
	│       └── jack
	│           ├── 2019-11-10-in.png
	│           └── 2019-11-10-out.png
	├── Problem_Statement
	│   └── Problem-2.pdf
	└── README.md
  ```

## Installation Guide :

 * Install [xammp/lamp]() on your machine

 * Create ```login.php``` in Payroll directory. 

 * Fill the following contents inside the ```login.php``` file:
	```php
		<?php
			$hostname = 'localhost';
			$username = 'root (or any other user)';
			$password = '<insert your xamp/lamp password>';
			$database = 'payroll';
			$admin_name = 'admin';
			$admin_pass = 'pass';
		?>
	```

 * Run ```automate.php``` from the automate directory to create the database named payroll. This file also creates tables named ```auth``` and ```hr_table```.

 * Go to your ```localhost/Automated_Payroll/Payroll```. 
Login with username as ```admin``` and password ```pass``` to access the admin account.

#### Admin Account:
1. The admin account shows the number and names of employees registered in the company.
2. On clicking on the name of the employee the admin can know the location details of the employee on the map as well as can calculate the salary of the employee.
Moreover, the admin can also change the password of the employee by clicking the reset password button.
3. The admin can add user by clicking the Add User button. Then a new sql table will be created with the username. Moreover, in the auth table the username of the user gets added.
4. The admin can add HR by clicking the ```Add HR``` button. Then in the ```hr_table``` the username of the HR gets added. Moreover, in the auth table the username of the HR gets added.
5. By clicking on ```Filter``` button in navbar, the admin can search the employee by his/her name to know more about the employee and also know which employees were present on a particular date by selecting the date.

Before logging out of the admin account make an account of an HR by clicking on the ```Add HR``` and filling his/her necessary details and then clicking ```Join```. Moreover, also add an user by clicking on the ```Add User``` and then filling his/her necessary details and then clicking ```Join```.

Logout from the admin account.

#### HR Account:
1. The HR account shows the number and names of employees registered in the company.
2. On clicking on the name of the employee the HR can know the location details of the employee on the map as well as can calculate the salary of the employee. Moreover, the HR can see the login and logout images of the employee for each date.
3. The HR can change the salary rate of the employee by entering the new salary rate in the text box on his/her home page and then clicking submit button.
4. By clicking on ```Filter``` button the admin can search the employee by his/her name to know more about the employee and also know which employees were present on a particular date by selecting the date.

Logout from the HR account.

#### Employee Account:
1. As soon as the employee logins his/her image is taken. The address where the login image is stored, is then stored in employee's username table.
2. After every 10 seconds the employee's location is tracked using GPS and then the latitute and longitude is stored in the employee's username table.  
3. When the employee clicks on ```logout``` button then his/her image is taken. The address where the logout image is stored is then stored in employee's username table.  

