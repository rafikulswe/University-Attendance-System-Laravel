<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>
 
## Project Purpose
Fingerprint attendance system are available in any university. But when any employee forget to give attendance by fingerprint device, they will be absent on this working day. For recovering this he/she have to apply to administrative office for the missing attendance manually. This project is developed for this purpose as if they can put their attendance by using this web application software and then administrative person will be approve his/her attendance.

## Working Procedure
This project have three types of accessing system- Admin, Supervisor, Employee. 

Admin Role:
Here admin create Supervisor account and also create employee account too. And can assign employee under the supervisor. Here admin can manage supervisors. Admin can approved supervisor's schedule and missing attendances and view report with pdf by weekly, monthly, yearly.

Supervisor Role: 
Here supervisor can manage his employees whose are assigned under him by Admin. Supervisor can put his/her missing attendance and weekly schedule routine wish. He can also view his own attendance report. Another activities of supervisor is managing employee, Supervisor can Approved Employees schedule and missing attendances and view report with pdf.

Employee Role:
Here Employee can make his schedule of his routine wish and give missing attendance. can view his own report.

## Configurations
After download this project create a database to your localhost server and configure it to your env file of this project and then run the migration by using command or in import the database which is put in database folder of this projcet name own_finance.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
