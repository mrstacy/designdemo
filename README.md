Email Token Design Demo
=======================

This is a design challenge to create a microservice that can:
* Listen on port 80
* Accept an email address
* Generate an email token
* Return the generated token in the response

The email token is then used in combination with email address in email links to allow user to perform an action without requiring authentication. 

Dependencies
-------------
This demo should require no special dependencies except for PHP 5.6 or newer

External Libraries:
-------------------
* Composer - PHP package system
* Silex - micro-framework based on symfony components
* PHPUnit - PHP Unit Testing framework 

How to Install
---------------

```
git clone https://github.com/mrstacy/designdemo.git

cd designdemo

php composer.phar install
```

How to run locally:
------------

Start php built in web server (from root project directory):
```
php -S 0.0.0.0:80 public/index.php
```

Once server is started you can view REST endpoints in your browser
```
http://127.0.0.1/v1/email/emailaddress@gmail.com/token
http://127.0.0.1/v1/email/emailaddress@gmail.com/token/34c3836ca3d0325502f0999da4b9e480
```


REST Swagger documentation:
---------------------------
You can view swagger contract definition file here:
```
/contracts/emailToken.yaml
```

You can view these in swagger editor here:
* https://editor.swagger.io/?url=https://raw.githubusercontent.com/mrstacy/designdemo/master/contracts/emailToken.yaml


Running Tests:
---------------

In project root run the following to run tests
```
php vendor/phpunit/phpunit/phpunit
```