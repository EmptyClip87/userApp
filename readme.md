###Steps to run:

1. run 'composer install' from project root

2. set database username and password in config.ini file

3. import db.sql database
    - first create a new blank database named _quantox_ in the MySQL shell to serve as a destination for your data.
    CREATE DATABASE quantox;
    
    - then log out of the MySQL shell and type the following on the command line:
    mysql -u [username] -p quantox < db.sql

4. run server form project root
	php -S localhost:1000 -t /public

5. '/' leads to the welcome page
   '/register' opens up a register form