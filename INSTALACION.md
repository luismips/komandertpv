#INSTALACION KomanderTPV
================

KomanderTPV es un sistema desarrollado con HTML, PHP y JavaScript. Corre bajo un servidor Apache y un servidor de base de datos MySQL. Utiliza dompdf, Ghostscript y GSview para la impresión de documentos.

Actualmente no existe un archivo de instalación para facilitar su puesta en marcha. Espero tener tiempo para crear una instalación más fácil y automatizada, ya que es una de las tareas pendientes, junto con un backend mejorado para no tener que usar phpMyAdmin para realizar ciertas configuraciones.

Ahora que el sistema es de código abierto se podrá mejorar todo más rápidamente gracias a la colaboración de todas aquellas personas que quieran participar en el proyecto.

=================


##REQUISITOS

- Servidor web: 
	
	a) Xampp: http://sourceforge.net/projects/xampp/<br/>
	b) Wamp: http://www.wampserver.com/
	
	- httpd.conf debe estar configurado para permitir acceso desde cualquier equipo en la red.
	- Configurar según timezone en php.ini

- dompdf: https://github.com/dompdf/dompdf

- Ghostcript: http://www.ghostscript.com/	

- GSview: http://pages.cs.wisc.edu/~ghost/gsview/index.htm
	
- Poner una IP fija en el equipo servidor
	
	


##INSTALACION

- Crear base de datos en MySQL (Cualquier nombre es bueno)

- Importar uno de los archivos sql a la base de datos creada:

	- demo.sql: Base de datos de demostración.
	- wkomander: Base de datos vacía.

- La carpeta principal de dompdf debe ser renombrada para que su nombre sea 'dompdf'. Una vez renombrada, meter dentro de otra carpeta con el nombre 'pdf'.

- Copiar las carpetas 'wkomander' y 'pdf' dentro del directorio público de Apache (/www o /httpdocs dependiendo del sistema operativo)
	- La carpeta 'wkomander' se puede renombrar al nombre que prefiera. Si lo cambia, tendrá que indicarlo modificando la variable '_APP_FOLDER_' dentro del archivo config.php


##CONFIGURACION


- Abrir archivo /wkomander/clases/db/config.php y modificar según las necesidades.

- Datos de la empresa:
	- Acceder a la base de datos (localhost/phpmyadmin)
	- Entrar en la tabla empresa y añadir o editar una nueva empresa. Se pueden añadir las empresas que necesite. La empresa seleccionada está indicada en el valor '_EMPRESA_' dentro del arhivo config.php.

- Configurar impresora de caja:
	- Cambiar nombre a la impresora de caja y poner: 'tiket'
	- Modificar los siguientes archivos para cambiar la ruta de 'gsprint':
		- tiket.php
		- tiket_todo.php
		- abrir_cliente.php
		- /clases/_pte.php
	(Buscar en cada archivo la palabra 'Ghostgum' y sustituir por la ruta correcta donde esté instalado gsprint)

- Rellenar las tablas básicas:
	- Añadir usuarios: Tabla 'usuarios' (el campo 'nivel' es la id_nivel de la tabla 'niveles')
	- Añadir zonas: Tabla 'zonas'
	- Añadir mesas: Tabla 'puntos'
	- Configurar Familias, artículos y modificadores desde el usuario 'admin'.
	

La configuración es un poco tediosa debido a que no hay creado un backend aún para todas las tareas de administración(sólo familias, artículos y modificadores). Poco a poco se irá creando esa funcionalidad y documentación necesaria para que no sea una tarea pesada.

Puedes escribirme a luismips@gmail.com si necesitas soporte.







