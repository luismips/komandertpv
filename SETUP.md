#SETUP KomanderTPV
================

KomanderTPV is a system developed in HTML, PHP y JavaScript. It runs on an Apache server and using MySQL as database server. It uses Ghostscript and GSview to print documents.

Actually, there's no onstallation file to easy the setup. I hope to have some time to do it more comfortable, it's one of the TODO task just with a better backend so the user don't need phpMyAdmin for most of the admin work.

Now that the system is Open Source, it could be more efficient in less time thanks to the colaboration from people who want to contribute to the project.
 

=================


##REQUIREMENTS:

- Web server: 
	
	a) Xampp: http://sourceforge.net/projects/xampp/
	b) Wamp: http://www.wampserver.com/
	
	- httpd.conf must allow access to devices in the network.
	- Configure timezone in php.ini

- Ghostcript: http://www.ghostscript.com/	

- GSview: http://pages.cs.wisc.edu/~ghost/gsview/index.htm
	
- Put a static IP on the computer.
	
	


##SETUP

- Create a database in MySQL (Any name you hate)

- Import one of the next files to the just created database:

	- demo.sql: demo database with products, tables....
	- wkomander.sql: Empty database.

- Copy folders 'wkomander' and 'pdf' inside Apache's public folder (/www or /httpdocs depending on your OS)
	- You can rename 'wkomander' as you want. If you do so, you must edit config.php and change the variable '_APP_FOLDER_'.


##CONFIGURACION


- Abrir archivo /wkomander/clases/db/config.php y modificar seg�n las necesidades.

- Datos de la empresa:
	- Acceder a la base de datos (localhost/phpmyadmin)
	- Entrar en la tabla empresa y a�adir o editar una nueva empresa. Se pueden a�adir las empresas que necesite. La empresa seleccionada est� indicada en el valor _EMPRESA_ dentro del arhivo config.php.

- Configurar impresora de caja:
	- Cambiar nombre a la impresora de caja y poner: 'tiket'
	- Modificar los siguientes archivos para cambiar la ruta de 'gsprint':
		- tiket.php
		- tiket_todo.php
		- abrir_cliente.php
		- /clases/_pte.php
	(Buscar en cada archivo la palabra 'Ghostgum' y sustituir por la ruta correcta donde est� instalado gsprint)







