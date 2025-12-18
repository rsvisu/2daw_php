https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/ProgramacionWeb/Sesiones

# Usuario:ManuelRomero/ProgramacionWeb/ProgramacionWeb/Sesiones - WikiEducator

[![TemaSesiones.png](https://es.wikieducator.org/images/b/bc/TemaSesiones.png)](https://es.wikieducator.org/Archivo:TemaSesiones.png)

## Contenido

\[[ocultar](#)\] 

-   [1 _**¡Construyendo componentes!**_](#.C2.A1Construyendo_componentes.21)  -   [1.1 Las sesiones](#Las_sesiones)
    -   [1.2 Ideas generales de las sesiones](#Ideas_generales_de_las_sesiones)
    -   [1.3 SSID de la sesión](#SSID_de_la_sesi.C3.B3n)
    -   [1.4 Configuración](#Configuraci.C3.B3n)
    -   [1.5 Creando la sesión](#Creando_la_sesi.C3.B3n)    -   [1.5.1 Crear y usar una sesión](#Crear_y_usar_una_sesi.C3.B3n)

    -   [1.6 Eliminando la sesión](#Eliminando_la_sesi.C3.B3n)
    -   [1.7 Actividades](#Actividades)

### Las sesiones

[![Icon preknowledge.gif](https://es.wikieducator.org/images/6/64/Icon_preknowledge.gif)](https://es.wikieducator.org/Archivo:Icon_preknowledge.gif)

¿Qué son las sesiones?

-   Una sesión es un mecanismo que permite mantener información entre distintas interacciones entre un cliente (navegador) y un servidor.
-   Podríamos verla como una _**conversación**_ entre dos partes.
-   Por defecto, una sesión dura mientras el navegador esté abierto, aunque esto puede configurarse para que persista más tiempo si se usa una cookie de sesión.
-   Durante la sesión, se pueden establecer variables cuyos valores estarán disponibles en el servidor para los distintos **scripts** solicitados por el cliente.

_**cliente**_.

-   Es una forma de hacer que variables estén disponibles en múltiples páginas.

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Por _**cliente**_ siempre entendemos un determinado navegador con una ip concreta.

[![Icon qmark.gif](https://es.wikieducator.org/images/c/c6/Icon_qmark.gif)](https://es.wikieducator.org/Archivo:Icon_qmark.gif)

Por qué necesitamos sesiones

Porque la programación web está basado en http, un protocolo sin estado.

-   Muchas veces _**necesitamos**_ mantener valores de variables entre diferentes scripts invocados por un mismo cliente.

### Ideas generales de las sesiones

-   A diferencia de las cookies, las variables de sesión se almacenan en el _**servidor**_.

[![Icon qmark.gif](https://es.wikieducator.org/images/c/c6/Icon_qmark.gif)](https://es.wikieducator.org/Archivo:Icon_qmark.gif)

Cookies

Sabemos qué son las _**cookies**_.

-   Tienen un tiempo limitado de existencia.
-   Para identificar al usuario que generó las variables de sesión, el servidor genera una clave única que es enviada al navegador y almacenada en una _**cookie**_.
-   Luego, cada vez que el navegador solicita otra página al mismo sitio, envía esta _**cookie**_ (clave única) con la cual el servidor identifica de qué navegador proviene la petición y puede rescatar de un archivo de texto las variables de sesión que se han creado.
-   Cuando han pasado 20 minutos sin peticiones por parte de un cliente (navegador) las variables de sesión son eliminadas automáticamente (se puede configurar el entorno de PHP para variar este tiempo).
-   Las **variables de sesión** son más seguras que las **cookies**, ya que su contenido se almacena en el servidor y no es visible directamente para el cliente.
-   Desventaja: requieren espacio en el servidor, lo que puede ser un problema si hay muchas sesiones activas.
-   No tiene que estar enviándose continuamente como sucede con las cookies.
-   Cuando el navegador del cliente está configurado para desactivar las cookies las variables de sesión, tienen forma de funcionar (enviando la clave como parámetro en cada hipervínculo).
-   Desventaja: ocupa espacio en el servidor.

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Dónde se almacenan

Las variables de sesión se almacenen en el servidor

### SSID de la sesión

Estas ideas son transparentes para el programador, no las tenemos que controlar, pero por higiene intelectual en la programación web, conviene conocer que

-   Existen dos maneras de mantener el SSID de la sesión
1.  Utilizando cookies, tema ya visto.
2.  Propagando el SID en un parámetro de la URL. El SID se añade como una parte más de la URL, de la forma:
```
 [http://www.misitioweb.com/tienda/listado.php?PHPSESSID=34534fg4ffg34ty](http://www.misitioweb.com/tienda/listado.php?PHPSESSID=34534fg4ffg34ty)

```
-   En el ejemplo anterior, el SID es el valor del parámetro PHPSESSID.

En php todas estas acciones se realizan de forma transparente para el programador, es decir, como desarrolladores podemos directamente utilizar las sesiones en php sin necesidad de tener que transmitir el SSID. Directemente **php** nos ofrece _**supervariables**_ y _**funciones**_ para gestionarlo.

### Configuración

Existen una serie de _**directivas**_ para configurar las sesiones, que conviene conocer. Como toda configuración tendemos a mantener su estado por defecto, lo cual es relativamente cómodo, pero no siempre práctico.

[![Icon qmark.gif](https://es.wikieducator.org/images/c/c6/Icon_qmark.gif)](https://es.wikieducator.org/Archivo:Icon_qmark.gif)

Ubicación del fichero de configuración

Dónde está el fichero de configuración de php.

-   Las directivas de configuración de las sesiones pueden consultarse con la función \`phpinfo()\` y modificarse en el archivo de configuración de PHP, **php.ini**.
-   Para ver todas las directivas [http://es.php.net/manual/es/session.configuration.php](http://es.php.net/manual/es/session.configuration.php)
-   Algunas directivas de configuración que pueden resultar de interés:

session.use\_cookies

Indica si se deben usar cookies (1) o propagación en la URL (0) para almacenar el SID.

session.use\_only\_cookies

Se debe activar (1) si utilizas cookies para almacenar los SID y deseas desactivar la propagación del SID a través de la URL, ya que esta técnica puede ser vulnerable a ataques como el secuestro de sesiones (session hijacking).

session.save\_handler

Se utiliza para indicar a PHP cómo debe almacenar los datos de la sesión del usuario. Existen cuatro opciones: en ficheros (files), en memoria (mm), en una base de datos SQLite (sqlite) o utilizando para ello funciones que debe definir el programador (user). El valor por defecto (files) funcionará sin problemas en la mayoría de los casos.

session.name

Determina el nombre de la cookie que se utilizará para guardar el SID. Su valor por defecto es PHPSESSID.

session.auto\_start

Su valor por defecto es 0, y en este caso deberás usar la función _**session\_start()**_ para gestionar el inicio de las sesiones. Si usas sesiones en el sitio web, puede ser buena idea cambiar su valor a 1 para que PHP active de forma automática el manejo de sesiones. No obstante por seguridad mejor hacerlo de forma explícita cuando lo necesites.

session.cookie\_lifetime

Si utilizas la URL para propagar el SID, éste se perderá cuando cierres tu navegador. Sin embargo, si utilizas cookies, el SID se mantendrá mientras no se destruya la cookie. En su valor por defecto (0), las cookies se destruyen cuando se cierra el navegador. Si quieres que se mantenga el SID durante más tiempo, debes indicar en esta directiva ese tiempo en segundos.

session.gc\_maxlifetime

Indica el tiempo en segundos que se debe mantener activa la sesión, aunque no haya ninguna actividad por parte del usuario. Su valor por defecto es 1440. Es decir, pasados 24 minutos desde la última actividad por parte del usuario, se cierra su sesión automáticamente.

### Creando la sesión

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Qué es una de sesión

De forma coloquial

Una sesión es la duración de la conexión que se establece entre un cliente (navegador/ip) y un servidor.

-   Mientras dura la sesión puedo establecer variables de sesión y acceder a ellas.
-   Si abro un navegador y accedo a un sitio web, se establece la sesión.
-   Al cerrar el navegador se cierra la sesión (esto es en teoría).

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** A veces se queda la sesión abierta por temas de cache o de la _**cookie**_ que mantiene el id de sesión

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Comparación de qué es una sesión</p></td></tr><tr><td></td><td><ul><li>Por comparación es como si entrara en un centro comercial</li><li>Mientras en estoy en él estoy dentro de mi sesión</li><li>Cuando salgo se cierra la sesión</li><li>Mientra estoy dentro podrían mantener información a usar en diferentes tiendas (productos comprados, pe.).</li></ul></td></tr></tbody></table>

#### Crear y usar una sesión

-   Para usar sesiones, hay que especificarlo de forma explícita.
-   En función de cómo esté configurado la directiva _**session.auto\_start**_
-   Si esta activada, la sesión comienza automáticamente al conectarse a un sitio
-   Si no está activada la iniciaremos con la función _**session\_start()**_. (Esta es la opción recomendada).
-   Un vez creada la sesión establecemos la variable y su valor en la superglobal $\_SESSION

```
<?php
session\_start();
...
$\_SESSION\['nombre'\]\='manuel';
....
 
?>
```

-   Ahora hemos establecido la variable de sesión _**nombre**_.
-   De esta forma en futuras navegaciones mientras dure la sesión o conversación entre el usuario cliente y el servidor, podrá acceder a la variable de sesion **nombre** puedo acceder.
-   En otro fichero php podré acceder al valor del nombre del usuario .

```
<?php
session\_start();
...
$usuario \= $\_SESSION\['nombre'\];
....
?>
```

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Una vez creada la sesión podemos almacenar/consultar información de la misma consultando la variable superglobal _**$\_SESSION**_

### Eliminando la sesión

-   Se puede configurar para que de forma automática se eliminen los datos de una sesión pasados un determinado tiempo
-   También podemos actuar directamente sobre una sesión eliminando información

session\_unset.

Elimina las variables almacenadas en la sesión actual, pero no elimina la información de la sesión del dispositivo de almacenamiento usado.

session\_destroy.

Elimina completamente la información de la sesión del dispositivo de almacenamiento.

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Cuando se hace un cambio de estado (login, cambio de permisos, ...): regenerar id.

```
 session\_regenerate\_id()

```

[![Icon reading.jpg](https://es.wikieducator.org/images/1/1e/Icon_reading.jpg)](https://es.wikieducator.org/Archivo:Icon_reading.jpg)

Documentación

-   [http://www.php.net/manual/es/booSek.session.php](http://www.php.net/manual/es/booSek.session.php)
-   [http://www.w3schools.com/php/php\_sessions.asp](http://www.w3schools.com/php/php_sessions.asp)
-   [http://www.mclibre.org/consultar/php/lecciones/php\_sesiones.html](http://www.mclibre.org/consultar/php/lecciones/php_sesiones.html)

### Actividades

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Registro de acceso

-   Vamos a simular un sitio web con autentificación por base de datos.
-   Siguiendo el esquema que se muestra

[![App logueo1.png](https://es.wikieducator.org/images/thumb/3/3a/App_logueo1.png/800px-App_logueo1.png)](https://es.wikieducator.org/Archivo:App_logueo1.png)

-   Al abrir la aplicación se nos pedirá que nos logueemos (usuario y password)
-   Para ello debe de haber una base de datos llamada _**dwes**_ con una tabla llamada _**usuarios**_ que tiene dos campos _**usuario**_ y _**pass**_ según se muestra en la imagen (crea el fichero sql para crearlo)
-   Debemos crear una tupla con los valores _**dwes**_ y _**abc123.**_ como nombre y password respectivamente (crealo en el fichero sql)

[![Tabla usuarios.png](https://es.wikieducator.org/images/3/36/Tabla_usuarios.png)](https://es.wikieducator.org/Archivo:Tabla_usuarios.png)

-   Al dar _**Validar**_ comprobaremos si existe una tupla con esos valores
-   En caso de que no exista nos quedaremos en la misma pantalla con un mensaje de error que diga _**Datos incorrectos**_ (ver imagen).
-   Si es correcto iremos a la pantalla _**sitio1.php**_ donde veremos la información según se muestra
-   Desde ahí podemos ir a _**sitio2.php**_ o bien _**desconectar**_
-   Debemos jugar con la variable de sesion $\_SESSION\['usuario'\] para verificar si estamos logueados
-   En caso de querer acceder a _**sitio1.php**_ o bien a _**sitio2.php**_ sin estar logueado, iremos directamente a _**index.php**_ con el mensaje _**Debes loguearte**_ (ver imagen)

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Contador de visitas

Haz un programa que cuente el número de visitas a una página en una misma sesión

-   A la página podremos acceder por la url o haciendo un click en un botón de tipo submit
```
[http://manuel.infenlaces.com/dwes/index.php?num\_practica](http://manuel.infenlaces.com/dwes/index.php?num_practica)\=8

```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Contador de accesos a una página

-   Haz un programa que cuente el número de visitas a una página en una misma sesión
-   A la página podremos acceder por la url o haciendo un click en un botón de tipo submit
```
[http://manuel.infenlaces.com/dwes/index.php?num\_practica](http://manuel.infenlaces.com/dwes/index.php?num_practica)\=8

```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Contador de acceso a un usuario

-   En este caso queremos contar cuantas veces accede un determinado usuario a nuestra página
-   El programa visualizará en cada acceso el número total de accesos de cada usuario, indicando su nombre y número de acceso.
```
[http://manuel.infenlaces.com/dwes/index.php?num\_practica](http://manuel.infenlaces.com/dwes/index.php?num_practica)\=9

```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Control de acceso

-   En este caso queremos mostrar un formulario con nombre y password ("alumno", "password")
-   Dejamos solamente 3 intentos seguidos para acceder
-   En caso de el intento sea incorrecto, mostraremos un mensaje "Datos incorrectos, le quedan X intentos"
-   En caso de que insertemos correctamente iremos a una página llamado sitio.php donde mostraremos un mensaje de bienvenida y el nombre de la persona que accede
-   Desde sito.php, será posible navegar a una tercera página llamada navegando.php donde se mostrará otro mensaje con el nombre del usuario y la última hora a la que accedió
-   Desde la segunda página se podrá cerrar sesión, en cuyo caso deberemos de pasar a la primer página
-   Estas dos páginas solo deberá de ser posible acceder si nos hemos logueado, si no, no nos dejará, mostrando un mensaje y reenviándonos a la página index.php en 3 segundos.

 \[[▼](#)\]Css para el login |
| --- |

```
[http://manuel.infenlaces.com/dwes/index.php?num\_practica](http://manuel.infenlaces.com/dwes/index.php?num_practica)\=11

```