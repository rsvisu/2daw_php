https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/Introduccion

# Usuario:ManuelRomero/ProgramacionWeb/Funciones/Introduccion - WikiEducator

De WikiEducator

Saltar a: [navegación](#mw-navigation), [buscar](#p-search)

[![Funciones php.png](https://es.wikieducator.org/images/thumb/4/4e/Funciones_php.png/100px-Funciones_php.png)](https://es.wikieducator.org/Archivo:Funciones_php.png)

LENGUAJE PHP: **FUNCIONES EN PHP**

**¡El servidor te responde**

**PHP Un lenguaje de script al lado del servidor**

**Conceptos básicos**  | [Funciones Recursivas](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/Recursivas "Usuario:ManuelRomero/ProgramacionWeb/Funciones/Recursivas") | [Funciones Flecha](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/Flecha "Usuario:ManuelRomero/ProgramacionWeb/Funciones/Flecha")  | [Ejercicios](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/ejercicios "Usuario:ManuelRomero/ProgramacionWeb/Funciones/ejercicios")  | [Prácticas](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/practica "Usuario:ManuelRomero/ProgramacionWeb/Funciones/practica")  | [Volver](https://es.wikieducator.org/Usuario:ManuelRomero/NewPHP/Distancia "Usuario:ManuelRomero/NewPHP/Distancia")

-   [1 Funciones](#Funciones)  -   [1.1 Declaración de funciones](#Declaraci.C3.B3n_de_funciones)    -   [1.1.1 Identificador de función](#Identificador_de_funci.C3.B3n)
    -   [1.1.2 Parámetros formales](#Par.C3.A1metros_formales)

    -   [1.2 Proceso de creación / invocación de una función](#Proceso_de_creaci.C3.B3n_.2F_invocaci.C3.B3n_de_una_funci.C3.B3n)
    -   [1.3 Parámetros formales: Valores y referencias](#Par.C3.A1metros_formales:_Valores_y_referencias)
    -   [1.4 Variables dentro de una función](#Variables_dentro_de_una_funci.C3.B3n)

## Funciones

[![Icon objectives.jpg](https://es.wikieducator.org/images/9/91/Icon_objectives.jpg)](https://es.wikieducator.org/Archivo:Icon_objectives.jpg)

Objetivo

Las funciones son un elemento fundamental

-   Permiten crear código modular.
-   Ayudan a estructurar el programa de manera ordenada.

### Declaración de funciones

```
// Declarar una función
function nombre\_de\_funcion(\[tipo\_de\_parametro\] $parametro\_formal\[\=valor\_por\_defecto\], ...)\[: tipo\_retorno\]
{
    ...
    \[return ...\];
}
 
// Llamar
nombre\_de\_funcion($parametro\_real);
```

-   Es importante diferenciar entre **declarar** una función e **invocar** una función.
-   Aunque parece obvio, es un punto importante.

En la declaración de una función, tenemos dos partes

Su cabecera, de la declaración

Su contenido, es decir, lo que hace la función.

En la cabecera de la función podemos indentificar 3 elementos

1.-Nombre o identificación de la función

-     -   El nombre de la función es un identificador que empieza por una letra o guion bajo, seguido de 0 o más letras, números o guiones bajos.

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Expresión regular para el identificador de funciones:

```
_**\[a-zA-Z\_f\_\]\[a-zA-Z0-9\_\]\***_

```

2.-Parámetros formales

-     -   Se especifican entre paréntesis. (Los paréntesis son necesarios, aunque no haya parámetros).
      -   Se puede (debe) especificar el tipo de cada parámetro (a partir de la versión 7.2). (Type hiding)
      -   Se puede incluso especificar diferentes tipos en cada parámetro (Union Type). En este caso se separa por comas

```
//Función que solo recibe datos de tipo int o string
//Me muestra el dato y su tipo
function mostrar\_datos(int|string $dato): string
{
    $tipo \= gettype($dato);
    return "<h1>El dato $dato es de tipo $tipo</h1>";
}
```

-     -   Se puede asignar un valor por defecto (si un parámetro tiene valor por defecto, no es obligatorio proporcionarle un valor en la invocación).

```
function saludar(string $nombre \= "Invitado"): string
{
    return "<h1>Hola $nombre, bienvenido a nuestro sitio web</h1>";
}
```

-     -   El hecho de poder dar valores por defecto, nos permitirá sobrecargar una función, es decir, que según el número y tipo de los parámetros, pueda hacer una acción/es u otra/s.

3.-Tipo de retorno

-     -   Tambien se puede especificar que la función retorna diferentes valores

```
function sumar(int|float $a, int|float $b): int|float
{
    return $a + $b;
}
```

El contenido de la función

1.  Especifica el conjunto de acciones que realizará la función cuando sea invocada
2.  En el cuerpo de la función aparecerá la instrucción _**return**_, la cual finaliza la ejecución de la función y devuelve el flujo al programa, a la instrucción que llamó a la función. Esta instrucción no es obligatorio que aparezca, en el caso de que la función no retorne ningún valor puede no aparecer. Este tipo de subprogramas se conoce como procedimientos.
3.  **return** devolverá un valor del tipo que hayamos especificado.

---

#### Identificador de función

#### Parámetros formales

-   Son nombres de variables que usaremos al escribir el código o cuerpo de la función.
-   El nombre debe ser significativo y se convertirán en _**variables locales a la función**_.
-   Al finalizar la función, estas variables _**se eliminan de la memoria**_.

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Parámetros formales

Los parámetros formales son variables locales a la función.

### Proceso de creación / invocación de una función

Primero, declaramos la función

-   Esto implica reservar una zona de memoria identificada con el nombre de la función.
-   El contenido de esas posiciones de memoria será el conjunto de acciones de la función.
-   Estas acciones estarán definidas en función de los \*\*parámetros formales\*\* de la declaración.

[![Declaracion funcion.png](https://es.wikieducator.org/images/a/a1/Declaracion_funcion.png)](https://es.wikieducator.org/Archivo:Declaracion_funcion.png)

Invocación de la función

-   La invocación es una instrucción para ejecutar la función.

[![Invocacion funcion 1.png](https://es.wikieducator.org/images/a/ac/Invocacion_funcion_1.png)](https://es.wikieducator.org/Archivo:Invocacion_funcion_1.png)

-   Lo primero que ocurre es que el programa accede a esa zona de memoria.

[![Invocacion funcion 2.png](https://es.wikieducator.org/images/a/aa/Invocacion_funcion_2.png)](https://es.wikieducator.org/Archivo:Invocacion_funcion_2.png)

-   Luego, se asignan los valores reales de la invocación a los parámetros formales de la función.

[![Invocacion funcion 3.png](https://es.wikieducator.org/images/6/6d/Invocacion_funcion_3.png)](https://es.wikieducator.org/Archivo:Invocacion_funcion_3.png)

-   Cuando la función termina de ejecutarse, se retorna a la instrucción que sigue a la llamada.
-   Si la función devuelve un valor, este se asigna a la variable de la instrucción de asignación desde la cual se invocó.

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Ejercicio usando funciones

_**Escribe un programa en el que en el programa principal se declaren dos variables, $a y $b.**_

-   Crea una función que reciba como parámetros locales _**$a**_ y _**$b**_,
-   La función debe visualizar el valor de las variables, modificarlas, y volver a visualizarlas.
-   En el programa principal:
1.  Asigna valor a las variables.
2.  Visualízalas.
3.  Invoca la función.
4.  Visualiza de nuevo las variables.

-   Una posible solución

```
    <?php
       function a($a, $b){
           echo "Dentro de la función visualizando valores <hr />";
           echo "Valor de los parámetros \\$a = $a \\$b = $b <br />";
           $a += 5;
           $b += 5;
           echo "Valor de los parámetros \\$a = $a \\$b = $b <br />";
           echo "Salgo de la función";
       }
       //Programa principal
       $a \= 100;
       $b \= 200;
       echo "En el main antes de invocar la función visualizando variables<hr />";
       echo "Valor de variables \\$a = $a \\$b = $b <br />";
       a($a, $b);
       echo "En el main después de invocar la función visualizando variables<hr />";
       echo "Valor de variables \\$a = $a \\$b = $b <br />";
?>
```

### Parámetros formales: Valores y referencias

-   Como hemos visto, los parámetros formales reciben valores pasados en la invocación de la función.
-   Si queremos que la función pueda modificar el valor de los parámetros, debemos pasarlos \*\*por referencia\*\*.
-   Esto permite que se pase la dirección de memoria donde se guarda el valor, en lugar del valor en sí.
-   En PHP no podemos visualizar ni operar con la dirección de memoria, ya que no existe la aritmética de punteros.

Parámetros formales

Valores y referencias

Para pasar el parámetro por referencia, simplemente coloca el símbolo _**&**_ antes del nombre de la variable en la declaración de los parámetros:

```
function nombre\_funcion(&$paramRef1, &$paramRef2, $paramVal1){
   ...
}
```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Ejercicio usando funciones y parámetros

_**Escribe un programa donde en el programa principal se declaren tres variables: $a, $b y $c.**_

-   Crea una función que reciba como parámetros _**&$num1**_, _**&$num2**_ y _**$num3**_.
-   La función debe visualizar el valor de las variables, modificarlas, y volver a visualizarlas.
-   En el programa principal:
1.  Asigna valor a las variables.
2.  Visualízalas.
3.  Invoca la función.
4.  Visualiza de nuevo las variables.

```
  <?php
       function a(&$num1, &$num2, $num3){
           echo "Dentro de la función visualizando valores <hr />";
           echo "Valor de los parámetros \\$num1 = $num1 \\$num2 = $num2 \\$num3 = $num3<br />";
           $num1 += 5;
           $num2 += 5;
           $num3 += 5;
 
           echo "Valor de los parámetros \\$num1 = $num1 \\$num2 = $num2 \\$num3 = $num3<br />";
           echo "Salgo de la función";
       }
       //Programa principal
       $a \= 100;
       $b \= 200;
       $c \= 300;
       echo "En el main antes de invocar la función visualizando variables<hr />";
       echo "Valor de variables \\$a = $a \\$b = $b \\$c = $c <br />";
       a($a, $b, $c);
       echo "En el main después de invocar la función visualizando variables<hr />";
       echo "Valor de variables \\$a = $a \\$b = $b \\$c = $c <br />";
?>
```

Invocando funciones

-   Una vez creada una función, se puede invocar como si fuera una instrucción.
-   No sin razón, en ciertos contextos se refiere a funciones como "instrucciones virtuales".
-   En PHP, puedes invocar una función antes de declararla, siempre que esté en el mismo archivo.

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Ejemplo de invocación de funciones</p></td></tr><tr><td></td><td><p><a class="image" href="/Archivo:Icon_present.gif"><img height="48" width="48" src="/images/1/1c/Icon_present.gif" alt="Icon present.gif"></a></p><p><b>Tip:</b> Este código funcionará correctamente</p><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1">    <span class="kw2">&lt;?php</span>
      a<span class="br0">(</span><span class="nu0">5</span><span class="sy0">,</span> <span class="nu0">6</span><span class="br0">)</span><span class="sy0">;</span>  
      <span class="coMULTI">/*Más instrucciones*/</span>
      <span class="kw2">function</span> a<span class="br0">(</span><span class="re0">$a</span><span class="sy0">,</span> <span class="re0">$b</span><span class="br0">)</span><span class="br0">{</span>
          <span class="kw1">echo</span> <span class="st0">"Valor de <span class="es4">$a</span>"</span><span class="sy0">;</span>
          <span class="kw1">echo</span> <span class="st0">"Valor de <span class="es4">$b</span>"</span><span class="sy0">;</span>
      <span class="br0">}</span></pre></div></td></tr></tbody></table>

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Ejemplo de invocación de funciones</p></td></tr><tr><td></td><td><p><a class="image" href="/Archivo:Icon_present.gif"><img height="48" width="48" src="/images/1/1c/Icon_present.gif" alt="Icon present.gif"></a></p><p><b>Tip:</b> Este código no funcionará</p><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw2">&lt;?php</span>
      a<span class="br0">(</span><span class="nu0">5</span><span class="sy0">,</span> <span class="nu0">6</span><span class="br0">)</span><span class="sy0">;</span>  
      <span class="coMULTI">/*Más instrucciones*/</span>
      <span class="kw1">include</span> <span class="br0">(</span><span class="st0">"funciones.php"</span><span class="br0">)</span><span class="sy0">;</span>
<span class="sy1">?&gt;</span></pre></div><ul><li>Contenido del archivo funciones.php</li></ul><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw2">&lt;?php</span>
<span class="kw2">function</span> a<span class="br0">(</span><span class="re0">$a</span><span class="sy0">,</span> <span class="re0">$b</span><span class="br0">)</span><span class="br0">{</span>
          <span class="kw1">echo</span> <span class="st0">"Valor de <span class="es4">$a</span>"</span><span class="sy0">;</span>
          <span class="kw1">echo</span> <span class="st0">"Valor de <span class="es4">$b</span>"</span><span class="sy0">;</span>
<span class="br0">}</span>
<span class="sy1">?&gt;</span></pre></div></td></tr></tbody></table>

### Variables dentro de una función

-   Dentro de una función, las variables que declaremos son \*\*locales\*\* a esa función.
-   No se puede acceder a su valor fuera de la función.
-   Esto también implica que dentro de una función no se puede acceder al valor de una variable definida fuera de la función.
-   Observa el siguiente ejemplo:

```
<?php
 
function modifica\_valor(){
    echo "Valor de <b>var1</b> dentro de la función: -$var1\- <br />";
    $var1++;
    echo "Valor de <b>var1</b> dentro de la función, modificado: -$var1\- <br />";
}
 
$var1 \= 20;
 
echo "Valor de <b>var1</b> en el programa principal antes de invocar la función: -$var1\- <br />";
modifica\_valor();
echo "Valor de <b>var1</b> en el programa principal después de invocar la función: -$var1\- <br />";
?>
```

-   Genera la siguiente salida:

```
Valor de var1 en el programa principal antes de invocar la función: \-20- 
Valor de var1 dentro de la función: \-- 
Valor de var1 dentro de la función, modificado: \-1- 
Valor de var1 en el programa principal después de invocar la función: \-20-
```

-   Si queremos acceder al valor de _**$var1**_ dentro de la función, podemos usar la palabra reservada _**global**_:

```
<?php
 
function modifica\_valor(){
    global $var1; // Indicamos que esta variable se puede usar globalmente.
    echo "Valor de <b>var1</b> dentro de la función: -$var1\- <br />";
    $var1++;
    echo "Valor de <b>var1</b> dentro de la función, modificado: -$var1\- <br />";
}
 
$var1 \= 20;
 
echo "Valor de <b>var1</b> en el programa principal antes de invocar la función: -$var1\- <br />";
modifica\_valor();
echo "Valor de <b>var1</b> en el programa principal después de invocar la función: -$var1\- <br />";
?>
```

-   Ahora, observamos que el valor dentro de la función se puede acceder y modificar.

```
Valor de var1 en el programa principal antes de invocar la función: \-20- 
Valor de var1 dentro de la función: \-20- 
Valor de var1 dentro de la función, modificado: \-21- 
Valor de var1 en el programa principal después de invocar la función: \-21-
```

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

"Crear una función sobrecargada"

-   Quiero crear una función para mostrar un valor racional.
-   Para ello necesitamos una función sobrecargada para que funcione en los siguientes casos:

```
factorial("8/7"); // => Me mostrará 8/7
factorial(9,6);   // => Me mostrará 9/6
factorial(10);   // => Me mostrará 10/1
factorial();   // => Me mostrará 1/1
factorial("15");   // => Me mostrará 15/1
```

-   La función debe aceptar:  -   Una cadena con formato "a/b"
    -   Una cadena con formato "a"
    -   Dos números enteros separados
    -   Un número
    -   Ningún valor

-   Debe devolver siempre una fracción correctamente formateada.

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

"Login flexible con Union Types (email o ID)"

-   Vamos a crear un formulario de inicio de sesión donde el usuario podrá:  -   Iniciar sesión escribiendo su EMAIL
    -   O iniciar sesión escribiendo su ID numérico

-   El servidor deberá procesar ambos casos con una única función sobrecargada usando Union Types.
-   La función nos mostrará un texto u otro según el caso:

Has iniciado la sesión con tu cuenta de correo xxxxx@xxx

Has iniciado la sesión con tu cuenta de el ID

xxxx


}}