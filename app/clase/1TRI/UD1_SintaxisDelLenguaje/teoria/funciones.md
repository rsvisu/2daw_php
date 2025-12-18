https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/funciones_de_php

# Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/funciones de php - WikiEducator

De WikiEducator

Saltar a: [navegación](#mw-navigation), [buscar](#p-search)

[![Php logo.png](https://es.wikieducator.org/images/d/d1/Php_logo.png)](https://es.wikieducator.org/Archivo:Php_logo.png)

LENGUAJE PHP: **EL LENGUAJE EN GENERAL**

**¡El servidor te responde**

**PHP Un lenguaje de script al lado del servidor**

[Introducción](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/Introducci%C3%B3n "Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/Introducción")  | [Sintaxis](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/Sintaxis "Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/Sintaxis") | [Escribiendo](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/Introducci%C3%B3n_leerl_escribir "Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/Introducción leerl escribir")  | [Declaraciones](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/declaraciones "Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/declaraciones")  | [Estructuras de control](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/estrucutras_control "Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/estrucutras control")  | [Expresiones](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/expresiones "Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/expresiones")  | [Más sobre sintaxis](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/otros_aspectos "Usuario:ManuelRomero/ProgramacionWeb/Sintaxis/otros aspectos")  | **funciones propias de php** | [Ejercicios](https://es.wikieducator.org/ManuelRomero/ProgramacionWeb/Sintaxis/ejercicios "ManuelRomero/ProgramacionWeb/Sintaxis/ejercicios")  | [Práctica](https://es.wikieducator.org/ManuelRomero/ProgramacionWeb/Sintaxis/practica "ManuelRomero/ProgramacionWeb/Sintaxis/practica")  | [Volver](https://es.wikieducator.org/Usuario:ManuelRomero/NewPHP/Distancia "Usuario:ManuelRomero/NewPHP/Distancia")

-   [1 Funciones propias de php sobre tipos y valores](#Funciones_propias_de_php_sobre_tipos_y_valores)
-   [2 Funciones para determinar existencia de variables](#Funciones_para_determinar_existencia_de_variables)
-   [3 Funciones de fechas](#Funciones_de_fechas)  -   [3.1 time()](#time.28.29)
    -   [3.2 date()](#date.28.29)
    -   [3.3 strtotime()](#strtotime.28.29)
    -   [3.4 strftime()](#strftime.28.29)
    -   [3.5 checkdate(mes, dia, year)](#checkdate.28mes.2C_dia.2C_year.29)

-   [4 Funciones propias de php sobre tipos y valores](#Funciones_propias_de_php_sobre_tipos_y_valores_2)  -   [4.1 Funciones para determinar existencia de variables](#Funciones_para_determinar_existencia_de_variables_2)
    -   [4.2 Funciones de fechas](#Funciones_de_fechas_2)    -   [4.2.1 time()](#time.28.29_2)
        -   [4.2.2 date()](#date.28.29_2)
        -   [4.2.3 strtotime()](#strtotime.28.29_2)
        -   [4.2.4 strftime()](#strftime.28.29_2)
        -   [4.2.5 checkdate(mes, dia, year)](#checkdate.28mes.2C_dia.2C_year.29_2)

## Funciones propias de php sobre tipos y valores

```
[http://php.net/manual/es/ref.var.php](http://php.net/manual/es/ref.var.php)

```
-   Existen una serie (muchas) de funciones que son interesantes de conocer
-   Estas funciones ya están creadas y se pueden usar directamente
-   Están relacionadas con los tipos de datos y valores
-   Alguna de ellas son extremadamente útiles y utilizadas, por ejemplo antes de procesar un dato, hay que ver que dicho dato tenga valor.
-   A continuación trataremos alguna de ellas

[var\_dump](http://es1.php.net/manual/es/function.var-dump.php)

```
 void var\_dump($expresion)
```

-   Nos da información sobre la estructura de un valor resultado de una expresion

[isset](http://es1.php.net/manual/es/function.isset.php)

```
 bool isset ( $variable )
```

-   verifica que una variable tiene valor (está definida y no tiene un valor null)

```
<?php
 $VariableValor\= 5;
 print ("El valor de la variable es $VariableValor");
 print ("El valor de otra variable es $OtraVariableValor");
 if (isset($VariableValor))
     print ("VariableValor tiene valor asignado");
 else
     print ("VariableValor no no tiene valor asignado");
 if (isset($OtraVariableValor))
     print ("OtraVariableValor tiene valor asignado");
 else
     print ("OtraVariableValor no no tiene valor asignado");
  ?>
```

## Funciones para determinar existencia de variables

Tenemos tres funciones muy parecidas pero no del todo iguales

 Función | Significado |
| --- | --- |
 **is\_null($variable)** | Determina si una variable ($variable) tiene valor null |
 **empty($variable)** | Determina si una variable ($variables)está vacía |
 **isset($variable)** | Determina is una variable ha sido definida y no tiene un valor vacío. |

-   Es importante saber qué es para php un valor nulo, o si está vacía que no son conceptos sinónimos

Valor null

```
 $a\=null //$a tiene valor null.
 is\_null($a) //true
 unset($a) //Se destruye la variable y toma el valor null
 is\_null($a) //true
 //$b una variable que no existe tiene el valor null
 is\_null($b) //true
```

Variable vacía

```
 $a\=null //$a está vacía
 empty($a) //true
 $a\="";
 empty($a) //true
 $a\="hola";
 empty($a) //false
 unset($a);
 empty($a) //true
 $a\=false;
 empty($a) //true !OJO!
 $a\=0;
 empty($a) //true !OJO!
```

-   Puedes ver la siguiente app en la que puedes aportar valores
```
[http://manuel.infenlaces.com/apuntes/existencia\_valor\_variables](http://manuel.infenlaces.com/apuntes/existencia_valor_variables)

```
-   Tener en cuenta que si evaluamos si una variable está vacía no es

[empty](http://es1.php.net/manual/es/function.empty.php)

```
bool empty ($varriable)
```

-   Determina si una variable no existe. Devuelve true si no existe o su valor está vacío

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

Probamos las fuciones var\_dump() que nos da información sobre el valor y el tipo

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

Usando la función xxxyyy donde xxx e yyy será dec oct bin o hex para convertir el valor de un sistema numérico a otro

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

-   Define las siguientes variables que se especifican en el código siguiente y verifica el resultado con empty()

```
 $num\=0;
 $nombre\="";
 $nombre\=null;
 $nombre\="0";
 $pregunta \= FALSE;
```

[gettype](http://es1.php.net/manual/es/function.gettype.php)\]

-   Devuelve el tipo de una variable

```
string gettype($variable)
```

[\[1\]](http://es1.php.net/manual/es/function.is-bool.phpis_bool)[is-double](http://es1.php.net/manual/es/function.is-double.php) [is-int](http://es1.php.net/manual/es/function.is-int.php), is-xxx

-   son funciones donde xxx especificado en el último nombre, puede ser cualquiera de los tipos

[![Funciones is-xxx.png](https://es.wikieducator.org/images/f/f6/Funciones_is-xxx.png)](https://es.wikieducator.org/Archivo:Funciones_is-xxx.png)

-   Todas ellas devuelve un booleano que indica si la variable, valor o expresion es o no de ese tipo,

```
string is\_int($variable);
string is\_double($variable);
string is\_bool($variable);
string is\_integer($variable);
string is\_null($variable);
string is\_string($variable);
...
```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

Visualizar de qué tipo es la expresión mostrada en el código siguiente y visualiza el valor de la expresión

```
  $a\=5;
```

[unset](http://php.net/manual/es/function.unset.php)

-   Destruye la variable especificada perdiéndose su valor

void unset ($var)

## Funciones de fechas

-   En php hay muchas fucniones para gestionar fechas, siendo esta una tarea frecuente el las aplicaciones web.

[![Icon inter.gif](https://es.wikieducator.org/images/9/9a/Icon_inter.gif)](https://es.wikieducator.org/Archivo:Icon_inter.gif)

Referencias de funciones de fechas en php

-   Vamos a estudiar 5 funciones siendo dos de ellas muy utilizadas

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Funciones de fechas

-   En php se trabaja mucho con las fechas. Para tal cometido existe una clase llamada DateTime y DateTimeInterface ([https://www.php.net/manual/es/class.datetime.php](https://www.php.net/manual/es/class.datetime.php)), pero muchas de sus acciones se pueden hacer de forma imperativa con funciones que vamos a ver.

### time()

```
Obtiene una marca de tiempo 
[https://www.php.net/manual/es/function.time.php](https://www.php.net/manual/es/function.time.php)

```
-   Esta es una función muy importante en php que conviene entender bien.
-   Me retorna el número de segundos transcurridos desde el 1 de Enero de 1970 00:00:00 GMT.

Esta fecha está relacionada con el sistema operativo UNIX que empezó a hacerse visible a partir del año 1970

[![Icon inter.gif](https://es.wikieducator.org/images/9/9a/Icon_inter.gif)](https://es.wikieducator.org/Archivo:Icon_inter.gif)

Un poco de historia desde wikipedia

-   La función time retorna un entero largo numérico

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

usar time()

-   Prueba a visualizar el retorno de la función _**time()**_
-   Mira lo que ocurre si recargas la página en ejecución, como se van actualizando los segundos

[![Icon qmark.gif](https://es.wikieducator.org/images/c/c6/Icon_qmark.gif)](https://es.wikieducator.org/Archivo:Icon_qmark.gif)

Pregunta

Entiendes por qué camba el valor

 \[[▼](#)\]Porbando time() |
| --- |

### date()

-   La función convierte un timestamp en una fecha como cadena de caracteres con el formato que le especifiquemos
-   Para ver los _**metaracteres**_ que representan el formato puedes ver la referencia web de la función

Esta función admite dos parámetros, uno de ellos es obligatoria

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

funcion date()

```
data("formato\_fecha", "timestamp") 

```

parámetro 1

formato\_fecha

Es un string formado por metacaracteres y caracteres literales que establece el formato en el cual queremos ver la fecha (d/m/y H:i:s), por ejemplo, donde _**d**_ representa el número de día, _**m**_ del mes ... y los caracteres _**/**_ y _**:**_ apareceran literales en la cadena

parametro 2

timestamp

Es una fecha en formato timestamp o entero largo como segundos desde una fecha Si no se establece, se toma el instante actual, es decir el resultado de la función time()

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Ejemplo de uso de date

```
<?php
 
$fecha\_actual \=date("d/m/Y H:i:s");
echo "<h1>La fecha actual es $fecha\_actual</h1>";
 
$fecha\_futura \=date("d/m/Y H:i:s", time()+24\*60\*60);
echo "<h1>La fecha de mañana será  $fecha\_futura</h1>";
```

### strtotime()

```
Convierte un string a fecha. [https://www.php.net/manual/es/function.strtotime.php](https://www.php.net/manual/es/function.strtotime.php)

```
-   Esta función admite dos parámetros, uno de ellos es obligatoria

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

funcion strtotime

```
strtotime("fecha\_como\_string", "timestamp") 

```

parámetro 1

fecha\_como\_string

```
Es una cadena que representa una fecha
Debemos facilitarla con el formato que entienda el sistema 
Por defecto "mes/dia/year"

```

parametro 2

timestamp

```
Es una fecha en formato timestamp o entero largo como segundos desde una fecha

```

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Recuerda que stamptime es un entero largo que respresenta un número de segundos desde el 1 de enero de 1970

Si quisiéramos cambiar el formato, podemos usar la función data\_default\_timezone\_set("Zona\_horaria")

-   Por ejemplo

```
<?php
$dia\= 27;
$mes \= 12;
$year \= 2001;
 
$fecha\_string\="$dia\-$mes\-$year";
date\_default\_timezone\_set('Europe/Madrid');
$tiempo \= strtotime($fecha\_string);
echo "<h1>Marca de tiempo de $fecha\_string <span style='color:red'>$tiempo</h1>";
```

El código anterior imprimirá

[![Strtotime1.png](https://es.wikieducator.org/images/e/e1/Strtotime1.png)](https://es.wikieducator.org/Archivo:Strtotime1.png)

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Ejemplo de uso de strtotime

```
<?php
$dia \=27;
$mes\=11;
$year\=2001;
 
$fecha \="$mes/$dia/$year";
$time \= strtotime($fecha);
echo "<h2>Valor de $fecha es $time</h2>h2>";
<br/>
```

### strftime()

```
[https://www.php.net/manual/es/function.strftime.php](https://www.php.net/manual/es/function.strftime.php)

```
-   Da formato a una fecha según el idioma establecido
-   Para poder ver el uso de esta función , debemos establecer uno de los idiomas que tengamos instalados en el sistema.
-   Para realizar esta acción debemos usar la función _**setlocale**_

setlocale()

```
[https://www.php.net/manual/es/function.setlocale.php](https://www.php.net/manual/es/function.setlocale.php)

```

Esta función establece un idioma para la fecha, monedas,... Para poder usar esta función debemos tener instalado en el sistema ese conjunto de caracteres de formato para la localidad deseada

Para ver las localidades instaladas puedes usar el comando

```
 locale \-a
```

Para instalar nuevas localidades

```
 sudo dpkg-reconfigure locales
```

-   Saldrá un menú y seleccionaremos las localidades. Para los ejercicios debes tener instaladso
1.  es\_ES.UTF-8 Español
2.  fr\_FR.UTF-8 Francés
3.  en\_US.UTF-8 Inglés

Para instalar una localidad concreta

```
 sudo locale-gen "en\_US.utf8"
```

Esta función retorna false o bien la localidad esablecida, si todo ha ido bien

### checkdate(mes, dia, year)

-   Esta función recibe tres enteros que representan una fecha y retorna un booleano que idica si la fecha es o no correcta

## Funciones propias de php sobre tipos y valores

```
[http://php.net/manual/es/ref.var.php](http://php.net/manual/es/ref.var.php)

```
-   Existen una serie (muchas) de funciones que son interesantes de conocer
-   Estas funciones ya están creadas y se pueden usar directamente
-   Están relacionadas con los tipos de datos y valores
-   Alguna de ellas son extremadamente útiles y utilizadas, por ejemplo antes de procesar un dato, hay que ver que dicho dato tenga valor.
-   A continuación trataremos alguna de ellas

[var\_dump](http://es1.php.net/manual/es/function.var-dump.php)

```
 void var\_dump($expresion)
```

-   Nos da información sobre la estructura de un valor resultado de una expresion

[isset](http://es1.php.net/manual/es/function.isset.php)

```
 bool isset ( $variable )
```

-   verifica que una variable tiene valor (está definida y no tiene un valor null)

```
<?php
 $VariableValor\= 5;
 print ("El valor de la variable es $VariableValor");
 print ("El valor de otra variable es $OtraVariableValor");
 if (isset($VariableValor))
     print ("VariableValor tiene valor asignado");
 else
     print ("VariableValor no no tiene valor asignado");
 if (isset($OtraVariableValor))
     print ("OtraVariableValor tiene valor asignado");
 else
     print ("OtraVariableValor no no tiene valor asignado");
  ?>
```

### Funciones para determinar existencia de variables

Tenemos tres funciones muy parecidas pero no del todo iguales

 Función | Significado |
| --- | --- |
 **is\_null($variable)** | Determina si una variable ($variable) tiene valor null |
 **empty($variable)** | Determina si una variable ($variables)está vacía |
 **isset($variable)** | Determina is una variable ha sido definida y no tiene un valor vacío. |

-   Es importante saber qué es para php un valor nulo, o si está vacía que no son conceptos sinónimos

Valor null

```
 $a\=null //$a tiene valor null.
 is\_null($a) //true
 unset($a) //Se destruye la variable y toma el valor null
 is\_null($a) //true
 //$b una variable que no existe tiene el valor null
 is\_null($b) //true
```

Variable vacía

```
 $a\=null //$a está vacía
 empty($a) //true
 $a\="";
 empty($a) //true
 $a\="hola";
 empty($a) //false
 unset($a);
 empty($a) //true
 $a\=false;
 empty($a) //true !OJO!
 $a\=0;
 empty($a) //true !OJO!
```

-   Puedes ver la siguiente app en la que puedes aportar valores
```
[http://manuel.infenlaces.com/apuntes/existencia\_valor\_variables](http://manuel.infenlaces.com/apuntes/existencia_valor_variables)

```
-   Tener en cuenta que si evaluamos si una variable está vacía no es

[empty](http://es1.php.net/manual/es/function.empty.php)

```
bool empty ($varriable)
```

-   Determina si una variable no existe. Devuelve true si no existe o su valor está vacío

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

Probamos las fuciones var\_dump() que nos da información sobre el valor y el tipo

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

Usando la función xxxyyy donde xxx e yyy será dec oct bin o hex para convertir el valor de un sistema numérico a otro

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

-   Define las siguientes variables que se especifican en el código siguiente y verifica el resultado con empty()

```
 $num\=0;
 $nombre\="";
 $nombre\=null;
 $nombre\="0";
 $pregunta \= FALSE;
```

[gettype](http://es1.php.net/manual/es/function.gettype.php)\]

-   Devuelve el tipo de una variable

```
string gettype($variable)
```

[\[2\]](http://es1.php.net/manual/es/function.is-bool.phpis_bool)[is-double](http://es1.php.net/manual/es/function.is-double.php) [is-int](http://es1.php.net/manual/es/function.is-int.php), is-xxx

-   son funciones donde xxx especificado en el último nombre, puede ser cualquiera de los tipos

[![Funciones is-xxx.png](https://es.wikieducator.org/images/f/f6/Funciones_is-xxx.png)](https://es.wikieducator.org/Archivo:Funciones_is-xxx.png)

-   Todas ellas devuelve un booleano que indica si la variable, valor o expresion es o no de ese tipo,

```
string is\_int($variable);
string is\_double($variable);
string is\_bool($variable);
string is\_integer($variable);
string is\_null($variable);
string is\_string($variable);
...
```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Actividad

Visualizar de qué tipo es la expresión mostrada en el código siguiente y visualiza el valor de la expresión

```
  $a\=5;
```

[unset](http://php.net/manual/es/function.unset.php)

-   Destruye la variable especificada perdiéndose su valor

void unset ($var)

### Funciones de fechas

-   En php hay muchas fucniones para gestionar fechas, siendo esta una tarea frecuente el las aplicaciones web.

[![Icon inter.gif](https://es.wikieducator.org/images/9/9a/Icon_inter.gif)](https://es.wikieducator.org/Archivo:Icon_inter.gif)

Referencias de funciones de fechas en php

-   Vamos a estudiar 5 funciones siendo dos de ellas muy utilizadas

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Funciones de fechas

-   En php se trabaja mucho con las fechas. Para tal cometido existe una clase llamada DateTime y DateTimeInterface ([https://www.php.net/manual/es/class.datetime.php](https://www.php.net/manual/es/class.datetime.php)), pero muchas de sus acciones se pueden hacer de forma imperativa con funciones que vamos a ver.

#### time()

```
Obtiene una marca de tiempo 
[https://www.php.net/manual/es/function.time.php](https://www.php.net/manual/es/function.time.php)

```
-   Esta es una función muy importante en php que conviene entender bien.
-   Me retorna el número de segundos transcurridos desde el 1 de Enero de 1970 00:00:00 GMT.

Esta fecha está relacionada con el sistema operativo UNIX que empezó a hacerse visible a partir del año 1970

[![Icon inter.gif](https://es.wikieducator.org/images/9/9a/Icon_inter.gif)](https://es.wikieducator.org/Archivo:Icon_inter.gif)

Un poco de historia desde wikipedia

-   La función time retorna un entero largo numérico

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

usar time()

-   Prueba a visualizar el retorno de la función _**time()**_
-   Mira lo que ocurre si recargas la página en ejecución, como se van actualizando los segundos

[![Icon qmark.gif](https://es.wikieducator.org/images/c/c6/Icon_qmark.gif)](https://es.wikieducator.org/Archivo:Icon_qmark.gif)

Pregunta

Entiendes por qué camba el valor

 \[[▼](#)\]Porbando time() |
| --- |

#### date()

-   La función convierte un timestamp en una fecha como cadena de caracteres con el formato que le especifiquemos
-   Para ver los _**metaracteres**_ que representan el formato puedes ver la referencia web de la función

Esta función admite dos parámetros, uno de ellos es obligatoria

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

funcion date()

```
data("formato\_fecha", "timestamp") 

```

parámetro 1

formato\_fecha

Es un string formado por metacaracteres y caracteres literales que establece el formato en el cual queremos ver la fecha (d/m/y H:i:s), por ejemplo, donde _**d**_ representa el número de día, _**m**_ del mes ... y los caracteres _**/**_ y _**:**_ apareceran literales en la cadena

parametro 2

timestamp

Es una fecha en formato timestamp o entero largo como segundos desde una fecha Si no se establece, se toma el instante actual, es decir el resultado de la función time()

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Ejemplo de uso de date

```
<?php
 
$fecha\_actual \=date("d/m/Y H:i:s");
echo "<h1>La fecha actual es $fecha\_actual</h1>";
 
$fecha\_futura \=date("d/m/Y H:i:s", time()+24\*60\*60);
echo "<h1>La fecha de mañana será  $fecha\_futura</h1>";
```

#### strtotime()

```
Convierte un string a fecha. [https://www.php.net/manual/es/function.strtotime.php](https://www.php.net/manual/es/function.strtotime.php)

```
-   Esta función admite dos parámetros, uno de ellos es obligatoria

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

funcion strtotime

```
strtotime("fecha\_como\_string", "timestamp") 

```

parámetro 1

fecha\_como\_string

```
Es una cadena que representa una fecha
Debemos facilitarla con el formato que entienda el sistema 
Por defecto "mes/dia/year"

```

parametro 2

timestamp

```
Es una fecha en formato timestamp o entero largo como segundos desde una fecha

```

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Recuerda que stamptime es un entero largo que respresenta un número de segundos desde el 1 de enero de 1970

Si quisiéramos cambiar el formato, podemos usar la función data\_default\_timezone\_set("Zona\_horaria")

-   Por ejemplo

```
<?php
$dia\= 27;
$mes \= 12;
$year \= 2001;
 
$fecha\_string\="$dia\-$mes\-$year";
date\_default\_timezone\_set('Europe/Madrid');
$tiempo \= strtotime($fecha\_string);
echo "<h1>Marca de tiempo de $fecha\_string <span style='color:red'>$tiempo</h1>";
```

El código anterior imprimirá

[![Strtotime1.png](https://es.wikieducator.org/images/e/e1/Strtotime1.png)](https://es.wikieducator.org/Archivo:Strtotime1.png)

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Ejemplo de uso de strtotime

```
<?php
$dia \=27;
$mes\=11;
$year\=2001;
 
$fecha \="$mes/$dia/$year";
$time \= strtotime($fecha);
echo "<h2>Valor de $fecha es $time</h2>h2>";
<br/>
```

#### strftime()

```
[https://www.php.net/manual/es/function.strftime.php](https://www.php.net/manual/es/function.strftime.php)

```
-   Da formato a una fecha según el idioma establecido
-   Para poder ver el uso de esta función , debemos establecer uno de los idiomas que tengamos instalados en el sistema.
-   Para realizar esta acción debemos usar la función _**setlocale**_

setlocale()

```
[https://www.php.net/manual/es/function.setlocale.php](https://www.php.net/manual/es/function.setlocale.php)

```

Esta función establece un idioma para la fecha, monedas,... Para poder usar esta función debemos tener instalado en el sistema ese conjunto de caracteres de formato para la localidad deseada

Para ver las localidades instaladas puedes usar el comando

```
 locale \-a
```

Para instalar nuevas localidades

```
 sudo dpkg-reconfigure locales
```

-   Saldrá un menú y seleccionaremos las localidades. Para los ejercicios debes tener instaladso
1.  es\_ES.UTF-8 Español
2.  fr\_FR.UTF-8 Francés
3.  en\_US.UTF-8 Inglés

Para instalar una localidad concreta

```
 sudo locale-gen "en\_US.utf8"
```

Esta función retorna false o bien la localidad esablecida, si todo ha ido bien

#### checkdate(mes, dia, year)

-   Esta función recibe tres enteros que representan una fecha y retorna un booleano que idica si la fecha es o no correcta