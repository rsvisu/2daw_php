https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/php/Aut_Ses_Coo/practica

# Usuario:ManuelRomero/ProgramacionWeb/php/Aut Ses Coo/practica - WikiEducator

### Descripción del juego

-   Se puede probar el juego el la web de prácticas
```
[http://web.infenlaces.com/dwes/practicas/MasterMind/](http://web.infenlaces.com/dwes/practicas/MasterMind/)

```
-   Este juego consiste en encontrar una secuencia de colores previamente establecida
-   Aquí una descripción del juego
```
[https://es.wikipedia.org/wiki/Mastermind](https://es.wikipedia.org/wiki/Mastermind)

```
-   Nosotras vamos a hacer una versión un poco personal, adaptándola a unas especificaciones propias, pero basadas en la filosofía del juego
-   Vamos a realizar la aplicación estableciendo una serie de requisitos y abordandolos de uno en uno

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Lista de requisitos

RF1.- Al conectarnos aparecerá una descripción del juego y la opción de jugar

RF2.- Al dar empezar mostrará la opción de jugar 4 desplegables para seleccionar el juego y la opción de jugar

RF3.- Jugar

RF4.- Valorar el resultado

RF5.- Mostrar jugadas

RF6.- Controlar fin de juego

15 jugadas o haber acertado la clave

-   En el siguiente diagrama de navegación (nombre que personalmente utilizo para este tipo de diagramas), podemos ver el flujo de ejecución de la aplicación

[![Diagrama nav mm.png](https://es.wikieducator.org/images/6/6c/Diagrama_nav_mm.png)](https://es.wikieducator.org/Archivo:Diagrama_nav_mm.png)

 \[[▼](#)\]Esqueleto del fichero jugar.php |
| --- |

Diagrama de clases

-   Debes implementar 3 clases, dos de ellas státicas (sería una librería, no crearemos objetos de la clase.

[![Clases mm.png](https://es.wikieducator.org/images/9/94/Clases_mm.png)](https://es.wikieducator.org/Archivo:Clases_mm.png)

-   A continuación vamos a analizar cada requisito.

### RF1 Página inicial

Al conectornos a la página, veremos un mensaje de bienvenida con una pequeña especificación del juego y un botón para empezar que nos llevará a otra página _**jugar.php**_  
[![MarterMindRF1.png](https://es.wikieducator.org/images/2/24/MarterMindRF1.png)](https://es.wikieducator.org/Archivo:MarterMindRF1.png)

-   Para la ventana se puede jugar con el css para dar al texto un poco de color.

-   En este caso he decidido crear un div de presentación y dar un poco de color a la lista de números, al h2 y al botón submit que me llevará a empezar el juego.

Un pantanllazo de la palicación

[![Index masterMind.png](https://es.wikieducator.org/images/thumb/8/86/Index_masterMind.png/450px-Index_masterMind.png)](https://es.wikieducator.org/Archivo:Index_masterMind.png)



### RF2 Empezar a jugar

-   Ahora vamos a ver qué código debemos de especificar para la página que vamos a tener en jugar.

-   Todas las acciones se realizarán en esta página, excepto la de dar información de final del juego, y como ya hemos visto, la primera pantalla que nos informa del juego.
-   Vamos a realizar la aplicación estableciendo una serie de requisitos y abordandolos de uno en uno

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Acciones para el requisito jugar

RF2.1.- Generar la clave

RF2.2.- Mostrar la clave

RF2.3.- Mostrar la clave

RF2.4.- Mostrar un menú para poder establecer una jugada

RF2.5.- Mostrar el botón de jugar con la partida establecida

-   Antes de poder establecer la implementación de estos requisitos vamos a pensar en la plantilla que hemos de generar o el diseño gráfico, pasa establecer dónde van a visualzarse la información.
-   Para ello usaremos display flex o diseño flexible dividiendo nuestra pantalla verticalemente en dos secciones.
-   Cada sección contendrá un tipo de información, el la primera tendremos 2 partes de información (opciones y menú de jugar) y a la derecha la información que corresponda en cada caso.
-   Vamos a establecer tres partes gráficas en nuestro juego:
-   Un posible mokup sacado directamente del css

[![Css MasterMind.png](https://es.wikieducator.org/images/thumb/a/ad/Css_MasterMind.png/600px-Css_MasterMind.png)](https://es.wikieducator.org/Archivo:Css_MasterMind.png)

-   Los contenidos que queremos que aparezcan en información deberán de ir en un div de información,
-   Así para cada parte
-   Ver el ejemplo siguiente
-   Ŝe puede copiar el css o usar uno propio, o no usar, pero debe de haber 3 zonas con tres tipos de información:

1.-Botones de acciones : Mostrar Clave, Resetear Password.  
2.-Menu de juego: 4 select para seleccionar la jugada y un botón de jugar  
3.-Información:\_ Segun proceda nos mostrará información según se especifica a continuación.

-   Tal cual está implemntado el código, se puede mostrar estas tres zonas siguiendo este esquema

```
<div class\="contenedorJugar"\>
    <div class\="opciones"\><!-- PArte izquierda de la pantalla, con dos secciones-->
        <h2\>OPCIONES</h2\>
        <fieldset\><!-- Sección de acciones -->
            <legend\>Acciones posibles</legend\>
            <h2\>Aquí las diferentes opciones</h2\>
            <h3\>un fieldset dentro de (<span style\="color:green"\>class=opciones</span\>)</h3\>
        </fieldset\>
        <fieldset\><!-- Sección de menú para realizar la jugada -->
            <legend\>Menú jugar</legend\>
            <h2\>Aquí el menú para jugar</h2\>
            <h3\>un fieldset dentro de (<span style\="color:green"\>class=opciones</span\>)</h3\>
            </form\>
        </fieldset\>
    </div\>
    <fieldset class\="informacion"\><!-- Parte derecha  de la pantalla para la información-->
        <h2\>INFORMACIÓN</h2\>
        <fieldset\>
            <legend\>Sección de información</legend\>
            <h3\>un fieldset dentro de (<span style\="color:green"\>class=información</span\>)</h3\>
        </fieldset\>
    </fieldset\>
</div\>
```

[![DiseñoGraficoMasterMind.png](https://es.wikieducator.org/images/d/d9/Dise%C3%B1oGraficoMasterMind.png)](https://es.wikieducator.org/Archivo:Dise%C3%B1oGraficoMasterMind.png)

-   Para este cometido se facilita el css al final del enunciado o en git que se indica

Ahora vamos a abordar cada una de las acciones

1.- Generar la clave

-   Debemos de generar una combinación de colores que el usuario a de acertar.
-   Esta combinación la llamaremos _**$clave**_ y será un array de 4 colores.
-   Los colores se establecerá a partir de una serie de colores previamente establecidos. Por ejemplo podemos usar los siguientes colores

```
  $colores \= \['Azul', 'Rojo', 'Naranja', 'Verde', 'Violeta', 'Amarillo', 'Marrón', 'Rosa'\];
```

-   Para impementar este requisito lo que tendremos que hacer es que si no existe la clave, la creamos y la guardamos en una variable de sesión, y si existe la leemos ya que la podremos necesitar posteriormente
-   Este requisito no genera ninguna salida para la página, por lo que no altera el contenido

2.- Visualizar la Clave

-   Para este requisito debemos de tener una opción (botón) que cuando el usuario lo presione se pueda visualizar la clave.

-   El botón o input de tipo submit deberá de estar el la sección de opciones.
-   El contenido de la clave deberá de aparecer en la sección de información.
-   Estebleceremos también que el texto que aparezca en el botón cambie, de forma que cuando presionemos _**Mostrar clave**_ nos muestre la clave y el texto del botón sea _**Ocultar clave**_.
-   A la vez si presionamos Ocultar clave que ya no se muestre y aparezca el texto que hubiera. Para ello vamos a controlar con una variable el texto que aparece en el botón.

Y el resultado

-   Con la opción de _**mostrar clave**_

[![Mm motrar clave.png](https://es.wikieducator.org/images/a/ad/Mm_motrar_clave.png)](https://es.wikieducator.org/Archivo:Mm_motrar_clave.png)

-   Cuando hemos presionado y ahora muestra _**ocultar clave**_

[![Mm ocultar clave.png](https://es.wikieducator.org/images/0/01/Mm_ocultar_clave.png)](https://es.wikieducator.org/Archivo:Mm_ocultar_clave.png)

3.-Mostrar el menú de jugadas y botón para jugar

-   Para ello tenemos que mostrar un formulario con 4 opciones para que el usuario elija 4 colores y un botón para darle a jugar
-   El resultado de dar a jugar lo implementaremos en el siguiente requisito.
-   Es importante que el formulario que generemos debe de estar en la sección de jugadas, para que aparezca ubicado en la sección que le hemos reservado en el diseño de la pantalla.
-   Vamos a usar una función que me devuelva un formulario, cada color lo seleccionaremos con un select ( un input desplegable con los colores permitidos)
-   Para que quede más vistoso, además del texto, cada opción tendrá un estilo en el class que se encargará de darle un color de fondo
-   Las opciones quedarán con colores

-   Observalo en el dibujo como van cambiando de color

[![Mm menu1.png](https://es.wikieducator.org/images/8/86/Mm_menu1.png)](https://es.wikieducator.org/Archivo:Mm_menu1.png)

-   PAra este comentido debemos hacer un pequeño javascript que implemento con el DOM de forma muy sencilla

<script> <script>

```
       function cambia\_color(numero) {
           color = document.getElementById("combinacion" + numero).value;
           elemento = document.getElementById("combinacion" + numero);
           elemento.className = color;
       }
   </script>

```

</script>

-   Claramente cada select (cada uno de los del menú), tendrá que tener un id con nombre _**combinacion1'**,_ **combinacion2**_,_ **combinacion3** _y_ **combinacion4**_._
-   Es importante también, para dar mayor usabilidad al juego incorporar dos elementos:

1.- Que se mantengan los colores de la última jugada  
2.- Que si no se han seleccionado los cuatro colores nos informe de ello, igualmente manteniendo los colores que sí se seleccionaron  

```
En la imagen siguiente vemos el resultado de haber selecconado 3 colores y presionar el botón jugar

```

[![Mm menu2.png](https://es.wikieducator.org/images/1/1e/Mm_menu2.png)](https://es.wikieducator.org/Archivo:Mm_menu2.png)  

### RF3.- Jugar

Este requisito es la parte fundamental de la partida  
Implicará que el usuario selecciona una jugada seleccionando los colores  
Ya le hemos dado un aspecto visual para que seleccionar la jugada tenga un poco de color, para ello hemos usado el css y un poco de java script (nunca está mal recordar, se aprende para no olvidar y usar).  
Ahora en nuestro script querremo considerar esta opcion (que le hemos dado a jugar), por lo que lo que queremos que ocurrra deberá estar en un

-   Ahora vamos a contemplar los siguietnes requisitos

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Requisito 3: jugar

-   _**RF3.1**_ .- leer La jugada
-   _**RF3.1**_ .- Compararla con la clave
-   _**RF3.2**_ .- Anotar la jugada en sesión.-
-   _**RF3.3**_ .- Informar del resultado de la jugada (colores/posiciones acertadas)

RF3.1

Comparar jugada:

-   Ahora la comparamos con la clave.
-   En ello queremos que la comparación nos aporte dos valores:
1.  El número de colores que hemos acertado
2.  El número de posiciónes, es decir, de los colores acertados cuantos los hemos especificado en la posición correcta.
-   A la hora de mostrar el mensaje del resultado de una jugada, usaremos un redondel negro por cada color acertado en posición y un redondel blanco por los colores acertados en posiciones erróneas. pondremos un número en cada redondel.  
    
-   Además añadiremos los colores seleccionados en cada jugada
-   En la imagen siguiente vemos un posible resultado

[![Mm resultado jugadas1.png](https://es.wikieducator.org/images/5/5d/Mm_resultado_jugadas1.png)](https://es.wikieducator.org/Archivo:Mm_resultado_jugadas1.png)  

-   Para ello será necesario almacenar en una variable de sesión un array con cada jugada

De cada jugada, debemos guardar los 4 colores con los que se ha jugado, el número de colores acertados y el número de posiciones (colores en el sitio esperado) [![Mm variable sesion.png](https://es.wikieducator.org/images/b/b7/Mm_variable_sesion.png)](https://es.wikieducator.org/Archivo:Mm_variable_sesion.png)  

### RF4.- Valorar el resultado

Este requisito es bastante sencillo de implementar  
No implica interactuación con el usuario, por lo que no detallaremos caso de uso, simplemente si al realizar una jugada hemos terminado vamos a ir a otra pantalla que nos especificará el fin del juego  

Esta situación se producirá la realizar 15 jugadas o al acertar los colores y posiciones

-   Al estar en la finalización del juego mostraremos todas las jugadas anteriores y el valor de la clave.