https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/Mysqli

# Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/Mysqli - WikiEducator

De WikiEducator

Saltar a: [navegación](#mw-navigation), [buscar](#p-search)

[![Php logo.png](https://es.wikieducator.org/images/d/d1/Php_logo.png)](https://es.wikieducator.org/Archivo:Php_logo.png)

Bases de datos: El servidor es fundamental

**¡Las bases de datos: Parte fundamental en el servidor de desarrollos web**

**PHP Un lenguaje de script al lado del servidor**

[Bases de datos](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/BD "Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/BD")  | [Sql](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/SQL "Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/SQL")  | [MySql](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/MySql "Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/MySql")  | **Mysqli**  | [PDO](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/PDO "Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/PDO")  | [Ejercicios](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/ejercicios "Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/ejercicios")  |  [Práctica mysqli](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/practica_mysqli "Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/practica mysqli") | [Práctica PDO](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/practica "Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/bd/practica")  |  [Práctica de la tieneda](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/practicaTienda "Usuario:ManuelRomero/ProgramacionWeb/Distancia2018/practicaTienda") | [Volver](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Contenido "Usuario:ManuelRomero/ProgramacionWeb/Contenido")

-   [1 Mysqli](#Mysqli)  -   [1.1 Mysql y su extensión mysqli para php](#Mysql_y_su_extensi.C3.B3n_mysqli_para_php)
    -   [1.2 Cerrar una base de datos](#Cerrar_una_base_de_datos)    -   [1.2.1 Cambiar la base de datos](#Cambiar_la_base_de_datos)

    -   [1.3 Ejecutando sentencias SQL: DML (insert, delete, update, select)](#Ejecutando_sentencias_SQL:_DML_.28insert.2C_delete.2C_update.2C_select.29)    -   [1.3.1 INSERT, UPDATE Y DELETE: Método _**query(...)**_](#INSERT.2C_UPDATE_Y_DELETE:_M.C3.A9todo_query.28....29)

    -   [1.4 Escapar caracteres](#Escapar_caracteres)
    -   [1.5 Clausula SELECT con query](#Clausula_SELECT_con_query)
    -   [1.6 Método query](#M.C3.A9todo_query)
    -   [1.7 Transacciones](#Transacciones)
    -   [1.8 Injecciones SQL](#Injecciones_SQL)    -   [1.8.1 Entrar en la plataforma sin tener acceso](#Entrar_en_la_plataforma_sin_tener_acceso)

    -   [1.9 Consultas preparadas](#Consultas_preparadas)
    -   [1.10 Parametrizar las consultas preparadas](#Parametrizar_las_consultas_preparadas)
    -   [1.11 Consultas preparadas que retornan valores](#Consultas_preparadas_que_retornan_valores)
    -   [1.12 ¿Cuándo es necesario usar store\_result()?](#.C2.BFCu.C3.A1ndo_es_necesario_usar_store_result.28.29.3F)

### Mysqli

Para trabajar con las extensiones, las usaremos siempre orientadas a objetos, aunque tengan la correspondiente funcionalidad en el lenguaje estructurado.

-   Para recordar muy brevemente posemos usar el siguiente enlace
```
[http://www.desarrolloweb.com/articulos/1540.php](http://www.desarrolloweb.com/articulos/1540.php)

```

Uso básico de un recurso de tipo _**mysqli**_

-   Recordamos que para crear una nueva instancia de una clase usamos el operador _**new**_

```
    $miObjeto \= new Clase();
```

-   Para acceder a los diferentes métodos del objeto instaciado, usamos el operador de indirección _**\->**_

```
 $miObjeto\->metodo($parametros);
```

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Acciones básicas que hemos de aprender

Para trabajar con una base de datos, siempre hemos de seguir una serie de acciones

1.- Concetarnos a la base de datos

```
Esto será crear una instancia de un objeto de conexión

```

2.- Verificar que la conexión se ha realizado

```
Si, por el motivo que fuera, no nos hemos podido conectar,generalmente:
  1.- Informaremos de ello
  2.- Cerraremos la conexión 

```

3.- Realizaremos las operativas que necesitemos

```
Ejecutaremos sentencias SQL y recogeremos el resultado de la consulta
Generalmente informaremos de algo al usuario de la aplicación  

```

4.- Cerraremos la conexión

```
Un aspecto que puede pasar desapercibido, pero muy importante

```

#### Mysql y su extensión mysqli para php

CONECTARNOS A LA BASE DE DATOS

-   A continuación iremos viendo como implementar las acciones básicas en el lenguaje

Conectarse

-   Para conectarse a una base de datos , creamos una instacia de la clase mysqli de la forma

```
 $miConexion \= new mysqli(....);
```

Extensión Mysqli

-   El _**constructor**_ de la clase puede recibir hasta **5 parámetros**, de los cuales _**4**_ se suelen usar con bastante frecuencia
1.  _**$host**_ nombre o ip del equipo (null o localhost, identificaría el equipo actual).i
2.  _**$usario**_ es el usuario de la base de datos
3.  _**$pass**_
4.  _**$nombreBD**_
5.  _**$puerto**_
6.  _**$shocket**_

Ejemplo new mysqli(...)

```
 $host\="localhost"
 $usuario\="manolo";
 $pass\="romero";
 $nombreBD\="alumnos";
 
 $miConexion \= new mysqli ($host,$usuario,$pass,$nombreBD);
 if ($miConexion\==null)
     echo"No se ha podido crear el objeto. 
          Seguramente no tiene instalada la extensión mysqli.
          Prueba a instalar apt install php-mysql   ";
 else
     echo "Objeto creado";
```

([![Comment.gif](https://es.wikieducator.org/images/d/db/Comment.gif)](https://es.wikieducator.org/Archivo:Comment.gif): Pruena a ver el contenido del objeto con _**var\_dump**_, así podrás observar los atributos que tenemos disponibles. Son todos muy intuitivos y los iremos viendo a lo largo de este tema.)

```
var\_dump($miConexion);
```

mysqli(...)

-   Esta función retorna el recurso de la conexión.

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Aunque hablemos de mysqli como una clase, en realidad es una clase especial conocida como recurso.

**Un recurso a diferencia de una clase no se puede serializar para pasar entre scripts.**

-   Para gestionar los errores de la conexión, debemos de usar los atributos:
1.  _**connect\_errno**_: Número o códiog del error que se ha producido en la conexión. 0 implica que no hay error.
2.  _**connect\_error**_:Descripción del error en forma de string. "" (cadena vacía) es la descripción cuando no ha habido error en la conexión.

de la clase _**mysqli**_.

-   El echo de que se pueda instanciar o el objeto de la clase, no implica que se haya realizado la conexión.
-   Este atributo aporta información sobre el error o contiene null si no se ha producido ninguno.
-   En el código anterior

```
if ($miConexion\->connect\_error) {
 echo "ERROR;
 echo "Error: Fallo al conectarse a MySQL debido a: \\n";
 echo "Errno: " . $mysqli->connect\_errno . "\\n";
 echo "Error: " . $mysqli->connect\_error . "\\n";
}
```

-   Para ver información sobre la conexión se puede usar los atributos _**$server\_info**_ o _**$host\_info**_

[![Icon summary.gif](https://es.wikieducator.org/images/c/c7/Icon_summary.gif)](https://es.wikieducator.org/Archivo:Icon_summary.gif)

Objetivo

```
$conesion\= new mysqli($host,$user,$pass,$bd);
$conesion\->conect\_error
$conesion\->conect\_errno
$conesion\->server\_info
$conesion\->host\_info
```

Opciones por defecto

---
-   Hay muchas opciones de **mysqli** que se pueden configurar en el fichero _**php.ini**_, no es algo que normalmente se modifique, pero por curiosidad las comentamos aquí.
-   Aquí tenemos alguna de ellas

mysqli.allow\_persistent

Permite crear conexiones persistentes.

mysqli.default\_port

Número de puerto TCP predeterminado a utilizar cuando se conecta al Servidor de base de datos.

---

mysqli.reconnect

Indica si se debe volver a conectar automáticamente en caso de que se pierda la conexión.

mysqli.default\_host.

Host predeterminado a usar cuando se conecta al servidor de base de datos.

mysqli.default\_user.

Nombre de usuario predeterminado a usar cuando se conecta al servidor de base de datos.

mysqli.default\_pw

Contraseña predeterminada a usar cuando se conecta al servidor de base de datos.

-   La lista completa la podemos ver en el siguiente link
```
[http://php.net/manual/es/mysqli.configuration.php](http://php.net/manual/es/mysqli.configuration.php)

```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

-   Configura dicho fichero, para poder conectar a la base de datos sin aportar parámetros al constructor
-   Luego déjalo como estaba :)

#### Cerrar una base de datos

Cerrar conexión

-   Cuando ya no vamos a utilizar más la conexión la cerramos para liberar recursos.
-   Es importante hacer esta acción de forma explícita

```
$miConexion\->close();
```

##### Cambiar la base de datos

-   Si hemos seleccionado una base de datos, o no hemos seleccionado ninguna y queremos cambiar a otra

```
$miConexion\->select\_db("nombre\_base\_datos");
```

-   Cuando ya no vamos a usar un recurso, conviente y repito CONVIENE, liberarlo.

```
$miConexion\->close();
```

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Es muy importante liberar un recurso reservado una vez que ya no se vaya a usar mas.

#### Ejecutando sentencias SQL: DML (insert, delete, update, select)

-   En SQL sabemos que tenmos tres tipos de lenguajes DDL, DML, DCL
-   Nos vamos a centrar en el DML, Leguane de maniputación de datos
-   Podemos clasificar en dos tipos de clúsulas:
1.  las que no devuelven registros de datos (INSERT, DELETE, UPDATE)  1.  Generalmente retornan un entero que es el número de filas aceptadas o un booleano que indica si se realizó no la operación

DML

1.  Las que pueden retornan una colección de filas (SELECT), generalmente conocidas como cursor.
-   En mysqli podemos enviar cualquiera de estas claúsulas con el método _**query**_

##### INSERT, UPDATE Y DELETE: Método _**query(...)**_

El método _**query**_, es un método de la clase _**mysqli**_ que permite enviar una **sentencia sql** a la base de datos con la que tengamos conexión. En función del tipo de consulta, el método nos puede devolver los siguientes valores:

1.  _**Booleano**_ (con las sentencias **Insert, Update, Delete**); indica si la acción se realizó o no correctamente.
2.  _**mysqli\_result**_ (con la sentencia **Select**); si la consulta es de tipo _**select**_, el método retornará un conjunto de filas (0 o más); Dispondremos de esta información en un objeto del la clase **mysql\_result**. Esta clase la estudiamos posteriormente.

Hay que tener en cuenta que este método modifica el objeto de la clase _**mysqli**_ pudiendo afectar a los siguiente atributos:

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Atributos que puede modificar _**query()**_

1.  _**$affected\_rows**_. Número de filas modificadas por la acción.
2.  _**$error, $errno**_. En caso de producir un error la sentencia.
3.  _**$insert\_id**_ Devuelve el id autogenerado que se utilizó en la última inserción.

[![Icon summary.gif](https://es.wikieducator.org/images/c/c7/Icon_summary.gif)](https://es.wikieducator.org/Archivo:Icon_summary.gif)

Objetivo

```
//Me conecto a la base de datos
$miConexion \= new mysqli("localhost", "root", "root", "dwes");
 
//Me preparo sentencias
//Actuaré sobre la tabla tienda (ver BD anterior)
//Tiene los campos cod (autogenerado de forma incremental), 
//nombre y tlf (ambos de tipo varchar)
$sentenciaInsert\="INSERT INTO tienda (nombre, tlf) 
  VALUES ('Tienda centro', '111-155226')";
$sentenciaDelete\="DELETE FROM tienda
  WHERE nombre = 'Tienda centro' ";
$sentenciaUpdate\="UPDATE tabla tienda 
 SET nombre = 'Tienda principal'  
 WHERE  nombre = 'Tienda centro'";
 
 
//Hago una consulta de tipo insert
$resultado\=miConexion\->query($sentenciaInsert)
if($resultado){
   echo"Se han insertado  $miConexion->affected\_rows 
        filas en esta acción <br />";
   echo "en la inserción se asignó el id autogenerado $miConexion->insert\_id
        <br />";
}
```

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** _**Muy importante**_ observa el tema de las comillas, los valores de las instrucciones sql sin son de tipo varchar deben de ir entre comillas

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

'_Tip:_ Muy importante _**para la BD es igual comilla simple ''''''**_ que comillas dobles _**"**_

[![Icon qmark.gif](https://es.wikieducator.org/images/c/c6/Icon_qmark.gif)](https://es.wikieducator.org/Archivo:Icon_qmark.gif)

Pregunta

_**Qué pasa si en nombre de la tienda es por ejemplo Technology's house**_

-   Habría que escapar ese carácter

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Inserción de datos

-   Realiza una aplicación para insertar datos en una tabla llamada usuarios
-   Insertaremos _**Nombre**_, _**Password**_ y edad
-   Verificaremos la insercción accediendo a la base de datos con phpmyadmin
-   El password que esté cifrada

#### Escapar caracteres

Consiste en que de una forma automática si una cadena de caracteres tiene comillas, que estás queden escapadas para que formen parte de la cadena de caracteres y no especifique delimitación de la cadena.

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Método para escapar cadenas

-   Es un método de la clase _**mysqli**_

```
string mysqli\_real\_scape\_string ( mysqli $conexion, string $cadena\_a\_escapar )
```

También se puede usar como método de la clase

```
$conexion \= new mysqli(..);
$cadena \= $conexion\->real\_scape\_string(....);
```

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Escapar caracteres</p></td></tr><tr><td></td><td><ul><li>suponemos que tenemos una tabla llamada <b>acciones</b> que tiene el campo <b>descripcion</b> y <b>cod_usuario</b></li><li>Quiero insertar este valor para descripcion como muestra el siguiente código:</li></ul><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="co1">//...</span>
<span class="re0">$descripción</span>  <span class="sy0">=</span> <span class="st0">"I don't want go animal's house"</span>
<span class="co1">//Esta asignación es correcta</span>
<span class="co1">//...</span>
<span class="re0">$consulta</span> <span class="sy0">=</span> <span class="st0">"INSERT INTO acciones VALUES (1, '<span class="es4">$descripcion</span>')"</span>
<span class="co1">//...</span></pre></div><p>si yo miro el contenido de la variable <i><b>$consulta</b></i> que es lo que pasare al método <i><b>query()</b></i></p><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1">INSERT INTO acciones VALUES <span class="br0">(</span><span class="nu0">1</span><span class="sy0">,</span> <span class="st_h">'I don'</span>t want go animal<span class="st_h">'s house'</span><span class="br0">)</span></pre></div><ul><li>Esto a la hora de insertar me generará un error, ya que el gestor interpreta que el contenido para el campo <i><b>descripcion</b></i> es 'I don'</li><li>Para evitar esto yo querría que el valor de <i><b>$descripcion</b></i> estuviera escapado</li></ul><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1">INSERT INTO acciones VALUES <span class="br0">(</span><span class="nu0">1</span><span class="sy0">,</span> <span class="st_h">'I don\'t want go animal\'s house'</span><span class="br0">)</span></pre></div><pre>se puede conseguir
</pre><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="co1">//...</span>
<span class="re0">$descripción</span>  <span class="sy0">=</span> <span class="re0">$conexion</span><span class="sy0">-&gt;</span><span class="me1">real_scape_string</span><span class="br0">(</span><span class="st0">"I don't want go animal's house"</span><span class="br0">)</span><span class="sy0">;</span>
<span class="co1">//...</span>
<span class="re0">$consulta</span> <span class="sy0">=</span> <span class="st0">"INSERT INTO acciones VALUES (1, '<span class="es4">$descripcion</span>')"</span>
<span class="co1">//...</span></pre></div></td></tr></tbody></table>

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

'_Tip: **Alternativamente al método de la clase mysqli, podemos usar con metodología estructurada la función**_ mysql\_real\_scape\_string()

[![Icon inter.gif](https://es.wikieducator.org/images/9/9a/Icon_inter.gif)](https://es.wikieducator.org/Archivo:Icon_inter.gif)

Recursos de la Web

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Observa el tema de las comillas, los valores de las instrucciones **sql** sin son de tipo _**varchar**_ deben de ir entre comillas

```
$miConexion\->query($sentenciasDelete);
$resultado \=$miConexion\->query($sentenciaDELETE);
if ($resultado){
    echo "Se han borrado $miConexion->affected\_rows filas ";
}
 
$miConexion\->query($sentenciasUpdate);
$resultado \= $miConexion\->query($sentenciaUPDATE);
if ($resultado){
    echo "Se han actualizado $miConexion->affected\_rows filas ";
}
</sourece\>
</div\>
<div class\="slide"\>
 
<source lang\=php\>
$miConexion\->query($sentenciasInsert);
$resultado \= $miConexion\->query($sentenciaINSERT);
if ($resultado){
    echo "Se han insertado $miConexion->affected\_rows filas ";
}
```

-   Observemos su uso en el ejemplo

```
 
  //Establecemos la conexión
  $miConexion \= new mysqli('localhost', 'manolo', '12345.', 'baseDatosPrueba');
 
  //Capturamos un posible error
  $error \= $miConexion\->connect\_errno;
 
  //En caso de error informamos de ello
  if ($error \== null) {
    $resultado \= $miConexion\->query('DELETE FROM stock WHERE unidades=0');
     if ($resultado) {
       print "<p>Se han borrado $miConexion->affected\_rows registros.</p>";
    }
  }
  $miConexion\->close();
}
```

#### Clausula SELECT con query

-   Tenemos dos maneras de realizar consultas con mysqli
1.  query
2.  real\_query
-   En el primero caso el método nos retorna un cursor que será de la clase _**mysqli\_result**_.
-   En el segundo caso nos retornará un booleano y para leer los datos deberemos usar o _**store\_result**_ o _**use\_result**_ según veamos a continuación.

-   El método _**query**_ con una sentencia de tipo _**select**_ como parámetro, nos retorna un objeto de la clase mysqli\_result. Esta clase (recurso) implemente la interfaz _**Traversable**_, lo que le hace iterable en los datos que contiene.
-   Esta clase contiene el resultado de la consulta como un conjunto de filas, pero no lo tiene como un atributo visible, si no como parte de los métodos que tenemos disponibles para obtenerlo (los metodos fetch\_xxxx)

#### Método query

-   Una vez que tenemos los datos almacenados debemos saber acceder.
-   Tenemos 4 formas de poder acceder a los datos según usemos un método u otro.
-   Cuando hablamos de acceder a los datos, estamos estableciendo la forma de extraer cada fila, registro o tupla resultado de ejecutar la consulta.

fetch\_array()

Va obteniendo cada registro como un array

Este array podemos usar tanto de forma indexada, como asociativa (con el nombre del campo)

fetch\_assoc()

En este caso el array que retorna es asociativo

fetch\_row()

En este caso el array que retorna es indexado

fetch\_object()

En este caso en lugar de retornar un array, retorna un objeto, donde cada campo son los diferentes atributos de ese objeto

-   En todos los casos cada vez que leemos un elemento de mysqli\_result, lo que por comparativa sería un cursor, vamos avanzando al siguiente. Cuando hayamos leído todos retornaría null

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

-   Obtén todos los registros de la tabla familia
-   visualízalos en una tabla usando los tres modos de lectura de datos vistos anteriormente

-   Para liberar un recurso del tipo _**mysqli\_result**_, usamos el método _**free()**_;

-   La clase _**mysqli\_result**_, además de los métodos vistos tiene un par de atributos interesantes

int $field\_count;

Nos dice cuantas columnos tiene el query actual

int $num\_rows;

Nos dice cuantas filas hemos obtenido con la consulta

-   Tenemos una lista completa
```
[http://es.php.net/manual/es/class.mysqli-result.php](http://es.php.net/manual/es/class.mysqli-result.php)

```

[![Icon summary.gif](https://es.wikieducator.org/images/c/c7/Icon_summary.gif)](https://es.wikieducator.org/Archivo:Icon_summary.gif)

Objetivo

```
$conexion\= new mysqli($host,$user,$pass,$bd);
if ($conexion\->connect\_errno\==null){
   $resultado \= $conexion\->query($consulta);
   $numFilas \= $resultado\->num\_rows;
   $numCampos \= $resultado\->fields\_count;
   echo "La consulta ha retornado $numFilas filas con  $numCampos columnas";
   $fila \= $resultado\->fetch\_array();
   while ( $fila){
          echo"El valor del primer campo es $fila\[0\]";
          $fila \= $resultado\->fetch\_array();
   }
   $resultado\->free();
   $conexion\->close();
}
```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

Haciendo una consulta del tipo select \* from producto where pvp < 200, realiza un código que visualizce en una tabla los resultados

#### Transacciones

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Definición

-   Una transacción es un conjunto de acciones u operaciones que
-   Esta se realizan contra una base de datos de modo que o bien se realizan correctamente todas
-   o no se realiza ninguna

-   Supongamos que hacemos una transferencia bancaria; cuando menos implica descontar dinera de una cuenta e ingresaro en otra

Transacciones

-   Ahora supongamos que nada mas descontar el dinero de una cuenta se cae la luz y se apaga el servidor
-   Esto creará una inconsistencia en la base de datos
-   Por defecto en mysqli cada acción con la base de datos es una transacción en sí misma, pero esto se puede modificar

```
 $conexion \= new mysqli(..);
 $conexion\->autocommit(false);
 .....
```

-   Si se ha desactivado el autocommit, para terminar una transacción debemos usar los métodos _**commit**_ o _**rollback**_

```
 $conexion \= new mysqli(..);
 $conexion\->autocommit(false);
 .....
 
 if (CondicionOK){
    //Terminamos la transacción confirmando todas las acciones sobre la base de 
    //datos desde que se inició la  transacción
    $conexion\->commit();
 }else{
    //Terminamos la transacción deshaciendo  todas 
    //las acciones sobre la base de datos desde que se inició la     
    //transaccion, y dejando la base de datos igual que estaba al principio
  $conexion\->rollback();
  }
```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

Ejercicio de transacciones

#### Injecciones SQL

-   Es un problema de seguridad importante, que hay que conocer y evitar
-   Existe mucha documentación al respecto, en general podemos afirmar que un buen conocimiento de SQL proporcina herramientas tanto para poder establecer este tipo de ataques, como para podernos prevenir de ellos.
-   Aportamos referenicas de web que nos pueden interesar consultar

-   A continuación y usando el ejemplo anterior de _**acceso**_ vamos a probar a realizar un sencillo ataques sql.
1.  Entrar en la plataforma sin tener acceso

##### Entrar en la plataforma sin tener acceso

-   Entramos en una página y vemos el siguiente acceso

[![MiAcceso.png](https://es.wikieducator.org/images/7/75/MiAcceso.png)](https://es.wikieducator.org/Archivo:MiAcceso.png)

-   Como no sabemos el usuario ni contraseña probamos a ver si se puede hacer una inserción no controlada
-   Como programadores esperamos que en el código haya algo del estilo, como es nuestro caso

```
 $nombre\=$\_POST\['usuario'\];
 $pass\=$\_POST\['pass'\];
 
 $consulta\="select \* from usuarios where nombre = \\"$nombre\\" and pass = \\"$pass\\" ";
 $resultado \= $conexion\->query($consulta);
```

-   Si todo fuera normal y nombre fuera por ejemplo "maría" la consulta que se envía al servidor sería

```
      select \* from usuarios where nombre \= "maria"
```

-   Esta consulta si existe el usuario maría nos retornará una tupla, si no no devolverá ninguna.

Inyecciones sql

-   Pero si añadimos más cosas obtendremos segura una respuesta, por ejemplo si en el codigo $nombre="maria or \\"1\\"= \\"1\\" "
-   Entonces la consulta quedaría

```
      select \* from usuarios where nombre \= "maria" or "1"\="1"
```

-   Que nos devolverá todas las filas

-   Así que si introducimos estos datos

[![MiAccesoInjeccion.png](https://es.wikieducator.org/images/3/39/MiAccesoInjeccion.png)](https://es.wikieducator.org/Archivo:MiAccesoInjeccion.png)

-   Entramos al sistema sin conocer usuario y contraseña

[![AccesoInjectado.png](https://es.wikieducator.org/images/thumb/0/01/AccesoInjectado.png/800px-AccesoInjectado.png)](https://es.wikieducator.org/Archivo:AccesoInjectado.png)

#### Consultas preparadas

-   Una consulta preparada consiste en establecer una consulta como si fuera una variable y ejecutarla posteriormente tantas veces como sea necesario.
-   Estas consultas se almacenan en el servidor y están listas para ser ejecutadas cuando sea necesario. El servidor solo tiene que analizarlas una vez
-   Para trabajar con consultas preparadas, debemos usar la clase _**mysqli\_stmt**_, e inicializarla con el método _**stmt\_init**_

```
   $conexion \= new mysqli('localhost', 'dwes', 'abc123.', 'dwes');
   //Preparo el objeto $consulta para crear consultas preparadas en él
   $consulta \= $conexion\->stmt\_init();
```

Los pasos para trabajar con consultas preparadas son:

1.  Preparar la consulta en el servidor MySQL utilizando el método _**prepare**_.
2.  Ejecutar la consulta, tantas veces como sea necesario, con el método _**execute**_.
3.  Una vez que ya no se necesita más, se debe ejecutar el método _**close**_.

```
$consulta \= $conexion\->stmt\_init();
$consulta\->prepare('INSERT INTO familia (cod, nombre) VALUES ("TABLET", "Tablet PC")');
$consulta\->execute();
$consulta\->close();
$conexion\->close();
```

#### Parametrizar las consultas preparadas

-   El uso real de las consultas preparadas es que los valores que pasas se asignen antes de ejectuar la consulta.
-   La idea es preapara la consulta sin indicar los valores.
-   Asignar los valores y ejectuar la consulta cuantas veces sea necesario.
-   Veamos el proceso

Parametrizar la consulta

-   Consiste en indicar en la consulta preparada en lugar de los valores, signos de interrogación _**?**_
-   En el caso anterior

```
$consulta\->prepare('INSERT INTO familia (cod, nombre) VALUES (?,?);
```

-   Ahora habría que asigar los valores. Para ello usamos el método _**bind\_param'**_
```
bind\_param(tipoDatos, variables\_con\_los\_valores)

```

-   Este método recibe dos tipos de parámetros
1.  El primero es una cadena de caracteres, donde cada carácter especifica el tipo de valor que va a recibir cada uno de los valores esperados en la consulta.
-     -   La codificación sería :
1.  _**s**_: cadena de caracteres
2.  _**i**_: número entero
3.  _**d**_: número float
4.  _**b**_: valor binario (BLOB (**binary large object**))

Consultas preparadas

-   En nuestro caso como va a recibir en los dos parámetros cada uno una cadena de caracteres sería _**"ss"**_
1.  El segundo grupo sería cada uno de los valores.SIEMPRE hay que especificar variables
-   En el ejemplo que estamos siguiendo

```
$consulta \= $conexion\->stmt\_init();
$consulta\->prepare('INSERT INTO familia (cod, nombre) VALUES (?, ?)');
$cod\_producto \= "TABLET";
$nombre\_producto \= "Tablet PC";
$consulta\->bind\_param('ss', $cod\_producto, $nombre\_producto);
```

-   Insisto en que siempre hay que especificar _**variables**_, nunca directamente valores.
-   Vemos el siguiente ejemplo:

```
$consulta\->bind\_param('ss', 'TABLET', 'Tablet PC');  // Genera un error
```

[![Icon summary.gif](https://es.wikieducator.org/images/c/c7/Icon_summary.gif)](https://es.wikieducator.org/Archivo:Icon_summary.gif)

Objetivo

```
$conexion \= new mysqli(...);
$consulta \= $conexion\->stmt\_init();
$consulta\->prepare(...sentencia ... con ???)
$consulta\->bind\_param('s-i-b-d(tipo\_de\_valores)',
            valores\_en\_variables\_respectivos\_a\_????');
$consulta->execute();
$consulta->close();
$conexion->close();
```

#### Consultas preparadas que retornan valores

-   En caso de que la consulta preparada retorne valores, se pueden recuperar de dos formas:  -   Usando el método **bind\_result()** y **fetch()**
    -   Usando el método **get\_result()** (requiere que PHP tenga activado el controlador **mysqlnd**)
-   Ambas formas permiten recorrer los resultados de una consulta SELECT preparada.
-   A continuación, veremos ambas formas con ejemplos.

Consultas preparadas que generan valores

-   En caso de que la consulta preparada retorne valores se recogen con el método **bind\_result**
-   Este método recibirá variables en los que se almacenarán los valores de las columnas resultado de la sentencia
-   Posteriormente, para recorre el conjunto de valores, usamos el método **fetch()**

Vemos el siguiente ejemplo

```
$consulta \= $conexion\->stmt\_init();
$consulta\->prepare('SELECT producto, unidades FROM stock WHERE unidades<2');
$consulta\->execute();
$consulta\->bind\_result($producto, $unidades);
while($consulta\->fetch()) {
	print "<p>Producto $producto: $unidades unidades.</p>";
}
$consulta\->close();
$conexion\->close();
```

-   Este método necesita declarar de antemano una variable por cada columna del resultado.
-   Para recorrer las filas usamos un bucle con **fetch()**.
-   Es útil cuando conocemos con certeza la estructura de la tabla o del resultado.

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

-   Modifica el ejercicio anterior usando consultas parametrizadas
-   Por ejemplo: que el número mínimo de unidades se reciba como parámetro
-   En caso de que no coincidas, se lanzará una excepción.

**Puede ser necesario, ejectuar el método store\_result previo a otras acciones**:

#### ¿Cuándo es necesario usar store\_result()?

-   El método **store\_result()** no siempre es obligatorio, pero sí es recomendable o necesario en algunas situaciones específicas.
-   Su función es almacenar todos los resultados devueltos por una consulta SELECT preparada en memoria.

¿Cuándo es necesario o recomendable?

-   Cuando queremos conocer el número de filas devueltas con **$stmt->num\_rows**.  -   Sin store\_result(), num\_rows devuelve 0.\*\*
-   Cuando vamos a extraer los datos más tarde, no justo después de ejecutar la consulta.  -   store\_result() mantiene los datos en memoria y disponibles.\*\*
-   Cuando queremos recorrer los resultados más de una vez.  -   Normalmente solo puedes hacer un fetch(), pero con store\_result() puedes volver atrás.\*\*
-   Cuando no vamos a extraer todas las filas.  -   Si no usamos store\_result() y dejamos resultados pendientes, la conexión puede quedar bloqueada.\*\*

¿Cuándo no es necesario?

-   Cuando vamos a extraer todas las filas inmediatamente, una tras otra con **fetch()**.
-   Cuando no necesitamos contar filas ni reutilizar los resultados después.

Resumen

 Caso de uso | ¿Es necesario store\_result()? |
| --- | --- |
 Usar **$stmt->num\_rows** | Sí |
 Hacer fetch() inmediatamente | No |
 Extraer solo algunas filas | Sí |
 Usar los datos más tarde | Sí |
 Liberar la conexión tras ejecutar SELECT | Sí |

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

-   Si tienes dudas, puedes usar **store\_result()** sin problema: funciona bien y evita errores futuros.
-   Pero ten en cuenta que consume más memoria, especialmente si hay muchas filas.

Recuperar valores con get\_result

```
$consulta \= $conexion\->prepare('SELECT producto, unidades FROM stock WHERE unidades < ?');
$consulta\->bind\_param("i", $limite);
$limite \= 2;
$consulta\->execute();
 
$resultado \= $consulta\->get\_result(); // obtenemos el mysqli\_result
 
while ($fila \= $resultado\->fetch\_assoc()) {
    echo "<p>Producto {$fila\['producto'\]}: {$fila\['unidades'\]} unidades.</p>";
}
 
$consulta\->close();
$conexion\->close();
```

-   Este método es más flexible y cómodo para trabajar con arrays asociativos.
-   Es útil cuando queremos mostrar tablas completas o cuando el número de columnas puede cambiar.
-   No requiere declarar una variable por cada columna.
-   Solo funciona si PHP fue compilado con el controlador **mysqlnd** (MySQL Native Driver).

Comparativa entre bind\_result y get\_result

 Método | Ventajas | Limitaciones |
| --- | --- | --- |
 **bind\_result()** | Más eficiente en memoria y compatible universalmente | Requiere declarar variables y conocer la estructura de la consulta |
 **get\_result()** | Muy fácil de usar y compatible con arrays asociativos | Solo funciona si el servidor PHP usa mysqlnd |

-   Aquí hay un enlace para una información completa sobre consultas preparadas:

[http://php.net/manual/es/class.mysqli-stmt.php](http://php.net/manual/es/class.mysqli-stmt.php)

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Práctica de tienda

-   Vamos a trabajar con la base de datos de la tienda
-   Lo primero usando la herramienta workbench generamos el modelo de tablas de la base de datos dwes y la analizamos
-   Crea una página web en la que se muestre el stock existente de un determinado producto en cada una de las tiendas.
-   Para seleccionar el producto concreto utiliza un cuadro de selección dentro de un formulario en esa misma página.

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Práctica de tienda

-   Puedes usar como base los siguientes ficheros css y plantilla adjuntos.
-   Añade la opción de modificar el número de unidades del producto en cada una de las tiendas.
-   Utiliza una consulta preparada para la actualización de registros en la tabla stock.
-   No es necesario tener en cuenta las tareas de inserción  -   (no existían unidades anteriormente)

-   Tampoco las de borrado (si el número final de unidades es cero).