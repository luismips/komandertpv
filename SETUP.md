#SETUP KomanderTPV
================

KomanderTPV is a system developed in HTML, PHP y JavaScript. It runs on an Apache server and using MySQL as database server. It uses dompdf, Ghostscript and GSview to print documents.

Actually, there's no installation file to easy the setup. I hope to have some time to do it more comfortable, it's one of the TODO task just with a better backend so the user don't need phpMyAdmin for most of the admin work.

Now that the system is Open Source, it could be more efficient in less time thanks to the colaboration from people who want to contribute to the project.
 

=================


##REQUIREMENTS:

- Web server: 
	
	a) Xampp: http://sourceforge.net/projects/xampp/
	b) Wamp: http://www.wampserver.com/
	
	- httpd.conf must allow access to devices in the network.
	- Configure timezone in php.ini
	
- dompdf: https://github.com/dompdf/dompdf

- Ghostcript: http://www.ghostscript.com/	

- GSview: http://pages.cs.wisc.edu/~ghost/gsview/index.htm
	
- Put a static IP on the computer.
	
	


##SETUP

- Create a database in MySQL (Any name you hate)

- Import one of the next files to the created database:

	- demo.sql: demo database with products, tables....
	- wkomander.sql: Empty database.
	
- dompdf main folder must be renamed to 'dompdf'. Once renamed, move it into another folder called 'pdf'.

- Copy folders 'wkomander' and 'pdf' inside Apache's public folder (/www or /httpdocs depending on your OS)
	- You can rename 'wkomander' as you want. If you do so, you must edit config.php and change the variable '_APP_FOLDER_'.


##CONFIGURATION


- Open /wkomander/clases/db/config.php and modify it as you need.

- Bussiness info:
	- Access to the database (localhost/phpmyadmin)
	- Go to the table 'empresa'. Add, edit or do what you need. You can add more than one. Bussiness in use will be indicated in the variable '_EMPRESA_' in config.php file.

- Setup tiket printer:
	- Change the name of the printer to: 'tiket'
	- Modify the path to 'gsprint' in the next files:
		- tiket.php
		- tiket_todo.php
		- abrir_cliente.php
		- /clases/_pte.php
	(Yo can look for 'Ghostgum' and replace the path to 'gsprint' for the right one)







