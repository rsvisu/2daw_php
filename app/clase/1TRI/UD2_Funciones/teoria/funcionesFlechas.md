https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/Flecha

# Usuario:ManuelRomero/ProgramacionWeb/Funciones/Flecha - WikiEducator

De WikiEducator

Saltar a: [navegación](#mw-navigation), [buscar](#p-search)

[![Funciones php.png](https://es.wikieducator.org/images/thumb/4/4e/Funciones_php.png/100px-Funciones_php.png)](https://es.wikieducator.org/Archivo:Funciones_php.png)

LENGUAJE PHP: **FUNCIONES EN PHP**

**¡El servidor te responde**

**PHP Un lenguaje de script al lado del servidor**

[Conceptos básicos](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/Introduccion "Usuario:ManuelRomero/ProgramacionWeb/Funciones/Introduccion")  | [Funciones Recursivas](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/Recursivas "Usuario:ManuelRomero/ProgramacionWeb/Funciones/Recursivas") | **Funciones Flecha**  | [Ejercicios](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/ejercicios "Usuario:ManuelRomero/ProgramacionWeb/Funciones/ejercicios")  | [Prácticas](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/practica "Usuario:ManuelRomero/ProgramacionWeb/Funciones/practica")  | [Volver](https://es.wikieducator.org/Usuario:ManuelRomero/NewPHP/Distancia "Usuario:ManuelRomero/NewPHP/Distancia")

-   [1 Funciones Anónimas](#Funciones_An.C3.B3nimas)  -   [1.1 Variables de Función](#Variables_de_Funci.C3.B3n)
    -   [1.2 Comparación con Funciones Nombradas](#Comparaci.C3.B3n_con_Funciones_Nombradas)
    -   [1.3 Pasar Funciones Anónimas como Parámetros en Otras Funciones](#Pasar_Funciones_An.C3.B3nimas_como_Par.C3.A1metros_en_Otras_Funciones)
    -   [1.4 Uso de \`call\_user\_func\` para Invocar Funciones Anónimas](#Uso_de_.60call_user_func.60_para_Invocar_Funciones_An.C3.B3nimas)
    -   [1.5 Mejorar la Legibilidad Usando Variables](#Mejorar_la_Legibilidad_Usando_Variables)
    -   [1.6 Acceso a Variables del Entorno: \`use\` vs. \`global\`](#Acceso_a_Variables_del_Entorno:_.60use.60_vs._.60global.60)
    -   [1.7 Uso de \`use\` para Capturar Variables del Entorno](#Uso_de_.60use.60_para_Capturar_Variables_del_Entorno)

## Funciones Anónimas

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

¿Qué son?

Son funciones que no tienen nombre.

También se conocen como **funciones de clausura** o **funciones cierre**. En PHP, las funciones anónimas implementan la clase \`Closure\` (\[documentación de Closure\]([https://www.php.net/manual/es/class.closure.php](https://www.php.net/manual/es/class.closure.php))).

Para crear una función anónima en PHP, se usa la siguiente estructura

```
function () {
    return "Hola desde una función anónima";
};
```

[![Icon qmark.gif](https://es.wikieducator.org/images/c/c6/Icon_qmark.gif)](https://es.wikieducator.org/Archivo:Icon_qmark.gif)

Pregunta

Puede parecer paradójico, pero ¿para qué sirve una función anónima y cómo podemos invocarla?

En PHP, existen dos formas principales de invocar una función anónima

1\. A través de variables de función.

2\. Como argumento en otra función. Es decir, pasamos la función anónima como parámetro a otra función.

#### Variables de Función

-   En PHP, podemos asignar una función anónima a una **variable** y luego invocar la función a través de esa variable. Esta técnica permite trabajar con funciones de forma similar a las variables, lo que puede ser cómodo en ciertos casos.
-   Usar variables de función requiere tener presente que no podemos invocar la función antes de la asignación, ya que hasta ese punto, la función no existe en la variable.
-   Para asignar una función anónima a una variable, simplemente declaramos la variable y le asignamos la función. Para invocarla, solo tenemos que llamar a la variable como si fuera una función, usando paréntesis \`()\`.

```
<?php
$mi\_funcion \= function () {
    return "hola caracola";
};
 
echo $mi\_funcion(); // Imprime: hola caracola
?>
```

-   Si intentamos invocar la función antes de asignarla a la variable, obtendremos un error.\*

```
// Error: La función no existe antes de la asignación
echo $mi\_funcion();
 
$mi\_funcion \= function () {
    return "hola caracola";
};
```

#### Comparación con Funciones Nombradas

En cambio, si usáramos una **función nombrada** en lugar de una función anónima, PHP podría procesarla sin importar el orden, debido a su interpretación en dos pasadas:

```
<?php
echo mi\_funcion(); // Esto funcionará debido a la doble pasada de PHP
 
function mi\_funcion() {
    return "hola caracola";
}
?>
```

#### Pasar Funciones Anónimas como Parámetros en Otras Funciones

-   Otra manera de usar funciones anónimas es pasarlas como **parámetros en otras funciones**. En PHP, hay varias funciones del sistema que aceptan una función de clausura como argumento. Al usar funciones anónimas en estos casos, podemos crear lógica personalizada que se ejecuta en el contexto de la función de nivel superior.

Algunos ejemplos de funciones del sistema que aceptan funciones de clausura como argumentos son: - \[\`spl\_autoload\_register\`\]([https://www.php.net/manual/es/function.spl-autoload-register.php](https://www.php.net/manual/es/function.spl-autoload-register.php)) - \[\`array\_walk\`\]([https://www.php.net/manual/es/function.array-walk.php](https://www.php.net/manual/es/function.array-walk.php)) - \[\`array\_map\`\]([https://www.php.net/manual/es/function.array-map.php](https://www.php.net/manual/es/function.array-map.php)) - \[\`array\_reduce\`\]([https://www.php.net/manual/es/function.array-reduce.php](https://www.php.net/manual/es/function.array-reduce.php))

#### Uso de \`call\_user\_func\` para Invocar Funciones Anónimas

-   Otra forma de invocar una función anónima es mediante la función **\`call\_user\_func\`**. Esta función acepta una función anónima como primer argumento y, opcionalmente, otros argumentos que serán pasados a la función anónima.

```
<?php
call\_user\_func(function ($nombre) {
    echo "Hola $nombre";
}, "Manuel");
// Este código imprimirá: Hola Manuel
?>
```

#### Mejorar la Legibilidad Usando Variables

-   En lugar de escribir la función anónima directamente en **call\_user\_func**, podemos asignarla a una variable para mejorar la legibilidad del código.

```
<?php
$saludar \= function ($nombre) {
    echo "Hola $nombre";
};
 
call\_user\_func($saludar, "Manuel");
// Este código imprimirá: Hola Manuel
?>
```

#### Acceso a Variables del Entorno: \`use\` vs. \`global\`

-   Cuando trabajamos con funciones anónimas en PHP, hay una característica importante sobre cómo acceder a las variables del entorno.
-   En PHP, las funciones anónimas _no tienen acceso directo_ a las variables del entorno en el que se crean.
-   Si necesitamos usar esas variables dentro de la función anónima, tenemos dos opciones: _usar \`use\`_ o _declarar las variables como \`global\`_.

#### Uso de \`use\` para Capturar Variables del Entorno

-   El _operador \`use\`_ permite capturar variables del entorno en el momento en que se define la función anónima.
-   Esto es útil cuando queremos hacer referencia a valores específicos del entorno externo sin modificarlos (o incluso, modificarlos en algunos casos específicos).
-   \`use\` permite pasar variables del entorno a la función anónima **por valor**, aunque también es posible pasarlas por referencia si se indica con \`&\`.
-   Cuando usamos \`use\`, la variable queda "capturada" en el estado en el que estaba al momento de declarar la función anónima.

Ejemplo con \`use\`

```
$mensaje \= "Hola";
 
$mi\_funcion \= function() use ($mensaje) {
    echo $mensaje;
};
 
$mi\_funcion(); // Imprime: Hola
```

-   En este ejemplo, '_$mensaje_ se pasa a la función anónima con use y puede ser utilizada dentro de la función.
-   Sin embargo, cualquier cambio en _$mensaje_ dentro de la función no afectará a la variable $mensaje fuera de la función a menos que la pasemos por referencia.
-   Para modificar la variable del entorno, podemos hacerlo pasando la variable por referencia con use (&$variable):

```
$contador \= 1;
 
$incrementar \= function() use (&$contador) {
    $contador++;
};
 
$incrementar();
echo $contador; // Imprime: 2
```

-   En este ejemplo, _$contador_ se pasa por referencia a la función anónima, por lo que cualquier modificación dentro de la función afectará también al valor de $contador fuera de ella.