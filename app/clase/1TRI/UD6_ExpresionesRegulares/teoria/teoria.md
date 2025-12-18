https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Objetos/e_r

# Usuario:ManuelRomero/ProgramacionWeb/Objetos/e r - WikiEducator

De WikiEducator

Saltar a: [navegación](#mw-navigation), [buscar](#p-search)

[![PhpOpp.jpg](https://es.wikieducator.org/images/thumb/a/a1/PhpOpp.jpg/75px-PhpOpp.jpg)](https://es.wikieducator.org/Archivo:PhpOpp.jpg)

BLOQUE 2 PHP: **PROGRAMACIÓN ORIENTADO A OBJETOS**

_**¡Construyendo componentes!**_

**PHP Como lenguaje orientado a objetos**

[Conceptos básicos](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Objetos/introduccion "Usuario:ManuelRomero/ProgramacionWeb/Objetos/introduccion") |  **Expresiones Regulares** |  [Ejercicios](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Objetos/ejercicios "Usuario:ManuelRomero/ProgramacionWeb/Objetos/ejercicios") |  [Práctica2](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Objetos/practica2 "Usuario:ManuelRomero/ProgramacionWeb/Objetos/practica2") | [Volver](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Contenido "Usuario:ManuelRomero/ProgramacionWeb/Contenido")


[Práctica](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Objetos/practica "Usuario:ManuelRomero/ProgramacionWeb/Objetos/practica") | 

-   [1 Expresiones Regulares (ER)](#Expresiones_Regulares_.28ER.29)  -   [1.1 Delimitadores](#Delimitadores)

-   [2 Expresando la expresión regular=](#Expresando_la_expresi.C3.B3n_regular.3D)  -   [2.1 Expresiones regulares en PHP](#Expresiones_regulares_en_PHP)
    -   [2.2 Coincidencia exacta o solo que contenga](#Coincidencia_exacta_o_solo_que_contenga)

### Expresiones Regulares (ER)

Una **expresión regular** es un **patrón de búsqueda** formado por un conjunto de caracteres que siguen unas reglas. Sirve para comprobar si una cadena de texto **cumple** o **no cumple** ese patrón.

Las expresiones regulares son muy útiles para validar datos como **teléfonos**, **emails**, **URLs**, **códigos postales**, etc.

Podemos usar una expresión regular para dos tipos de comprobación:

1\. **Coincidencia exacta**: la cadena debe ajustarse completamente al patrón. 2. **Coincidencia parcial**: la cadena solo debe **contener** el patrón en alguna parte.

Antes de ver ejemplos, es necesario saber cómo se escribe una expresión regular en PHP y cómo se utiliza con funciones como **preg\_match()**, **preg\_replace()** o **preg\_split()**.

#### Delimitadores

Una expresión regular en PHP debe estar rodeada por un **carácter delimitador**, que marca el inicio y el final del patrón. Este carácter es **de elección libre**, siempre que no entre en conflicto con el contenido del propio patrón.

_El delimitador es imprescindible_ porque PHP necesita una forma inequívoca de saber que el primer parámetro de funciones como **preg\_match()**, **preg\_replace()** o **preg\_split()** es una **expresión regular** y no una cadena, un número o una constante. Si no hubiera delimitadores, PHP no podría distinguir el patrón del resto del código.

Además, los delimitadores _permiten añadir_ **modificadores** al final del patrón (como _i_ para mayúsculas/minúsculas o _m_ para modo multilínea). También es habitual elegir un delimitador que no aparezca dentro del propio patrón para evitar tener que escaparlo.

[![Icon inter.gif](https://es.wikieducator.org/images/9/9a/Icon_inter.gif)](https://es.wikieducator.org/Archivo:Icon_inter.gif)

Delimitadores

```
/una expresión/      // Carácter delimitador /
#^\[^0-9\]$#           // Carácter delimitador #
+php+                // Carácter delimitador +
%\[a\-zA\-Z0\-9\_\-\]%      // Carácter delimitador %
```

### Expresando la expresión regular=

Para escribir una expresión regular podemos usar caracteres literales (tal cual) o bien emplear **metacaracteres**, rangos y agrupamientos que permiten definir patrones más complejos.

En la siguiente tabla se resumen los metacaracteres más habituales. Tabla basada en el material de: [http://www.mclibre.org/consultar/php/lecciones/php\_expresiones\_regulares.html](http://www.mclibre.org/consultar/php/lecciones/php_expresiones_regulares.html)

 Patrón | Significado |
| --- | --- |
 c | carácter literal **c** |
 . | cualquier carácter |
 ^c | la cadena debe **empezar** por el carácter **c** |
 c$ | la cadena debe **terminar** por el carácter **c** |
 c+ | uno o más caracteres **c** |
 c\* | cero o más caracteres **c** |
 c? | cero o un carácter **c** |
 \\n | nueva línea |
 \\t | tabulador |
 \\ | carácter de **escape** para escribir caracteres especiales:
^ . \[ \] % ( ) \| \* ? { } \\

|
(cd) | agrupación: los caracteres **c** y **d** juntos |
c\|d | carácter **c** o carácter **d** |
c{n} | exactamente **n** repeticiones del carácter **c** |
c{n,} | **n o más** repeticiones del carácter **c** |
c{n,m} | entre **n** y **m** repeticiones del carácter **c** |
\[a-z\] | cualquier letra minúscula |
\[A-Z\] | cualquier letra mayúscula |
\[0-9\] | cualquier dígito |
\[cde\] | cualquiera de los caracteres **c**, **d** o **e** |
\[c-f\] | cualquier letra entre **c** y **f** (c, d, e o f) |
\[^c\] | cualquier carácter que **no** sea **c** |
\[\[:alnum:\]\] | cualquier letra o dígito |
\[\[:alpha:\]\] | cualquier letra |
\[\[:digit:\]\] | cualquier dígito |
\[\[:lower:\]\] | cualquier letra minúscula |
\[\[:punct:\]\] | cualquier signo de puntuación |
\[\[:space:\]\] | cualquier espacio en blanco |
\[\[:upper:\]\] | cualquier letra mayúscula |

#### Expresiones regulares en PHP

Son varias las funciones relacionadas con expresiones regulares en PHP: [http://php.net/manual/es/book.pcre.php](http://php.net/manual/es/book.pcre.php)

La función más utilizada es _**preg\_match($expresion, $cadena)**,_ que permite comprobar si una cadena cumple (o no) una expresión regular. [http://php.net/manual/es/function.preg-match.php](http://php.net/manual/es/function.preg-match.php)

#### Coincidencia exacta o solo que contenga

Es muy importante distinguir entre:

-   **Coincidencia parcial**: la cadena _contiene_ el patrón en algún punto.
-   **Coincidencia exacta**: la cadena debe **coincidir por completo** con el patrón (inicio y fin).

La expresión siguiente especifica una cadena que \*\*contenga\*\* uno o más números:

```
$exp \= /\[0\-9\]+/;
```

Ejemplos:

```
$cad1 \= "asdfljoieka1asdf"; // Cumple: contiene un número
$cad2 \= "1";               // Cumple
$cad3 \= "134124";          // Cumple
$cad4 \= "asdfasd4";        // Cumple
$cad5 \= "asdfasd";         // No cumple
```

Si queremos que la cadena **solo** contenga números:

-   debe **empezar** por un número → ^
-   debe **terminar** por un número → $

```
$exp \= /^\[0\-9\]+$/;
```

En el ejemplo anterior, solo **$cad3** cumple esta expresión.

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Validar expresiones regulares

-   Realiza un programa que permita insertar una expresión regular y una cadena.
-   Posteriormente debe validarse si la cadena cumple o no la expresión regular.

[![Icon inter.gif](https://es.wikieducator.org/images/9/9a/Icon_inter.gif)](https://es.wikieducator.org/Archivo:Icon_inter.gif)

Ver el ejercicio funcionando

 \[[▼](#)\]Validar expresiones Regulares (Código) |
| --- |

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Practica con expresiones regulares

Realiza una app que valide datos de entrada de un formulario

-   La aplicación va a validar los siguientes ítems:

[![Formulario datos personales.png](https://es.wikieducator.org/images/0/07/Formulario_datos_personales.png)](https://es.wikieducator.org/Archivo:Formulario_datos_personales.png)