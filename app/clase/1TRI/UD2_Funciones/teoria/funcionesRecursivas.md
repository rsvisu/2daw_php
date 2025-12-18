https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/Recursivas

# Usuario:ManuelRomero/ProgramacionWeb/Funciones/Recursivas - WikiEducator

De WikiEducator

Saltar a: [navegación](#mw-navigation), [buscar](#p-search)

[![Funciones php.png](https://es.wikieducator.org/images/thumb/4/4e/Funciones_php.png/100px-Funciones_php.png)](https://es.wikieducator.org/Archivo:Funciones_php.png)

LENGUAJE PHP: **FUNCIONES EN PHP**

**¡El servidor te responde**

**PHP Un lenguaje de script al lado del servidor**

[Conceptos básicos](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/Introduccion "Usuario:ManuelRomero/ProgramacionWeb/Funciones/Introduccion")  | **Funciones Recursivas** | [Funciones Flecha](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/Flecha "Usuario:ManuelRomero/ProgramacionWeb/Funciones/Flecha")  | [Ejercicios](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/ejercicios "Usuario:ManuelRomero/ProgramacionWeb/Funciones/ejercicios")  | [Prácticas](https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Funciones/practica "Usuario:ManuelRomero/ProgramacionWeb/Funciones/practica")  | [Volver](https://es.wikieducator.org/Usuario:ManuelRomero/NewPHP/Distancia "Usuario:ManuelRomero/NewPHP/Distancia")

## Funciones recursivas

-   Al igual que en otros lenguajes de programación, en PHP el uso de funciones recursivas es una opción muy interesante cuando necesitamos **obtener valores que dependen de cálculos repetitivos sobre sí mismos**
-   Claros ejemplos son casos de factoriales, secuencias de Fibonacci, o procesamiento de estructuras de datos jerárquicas (por ejemplo, árboles o directorios anidados).

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

¿Qué es una Función Recursiva?

Una función recursiva es aquella que se llama a sí misma para resolver un problema que puede dividirse en subproblemas más pequeños y de la misma naturaleza.

-   La idea principal es que la función continúe llamándose a sí misma, resolviendo cada vez una parte más pequeña del problema, hasta que alcanza una condición base que detiene las llamadas recursivas.

Ejemplo de Factorial con Recursividad

El cálculo del factorial de un número n es un ejemplo clásico de recursividad. El factorial de n (representado como n!) se calcula multiplicando n por el factorial de n - 1 hasta llegar a 1. En términos matemáticos:

```
𝑛!=𝑛 × (𝑛−1) × (𝑛−2)×...× 1

```

Podemos implementar esto en PHP usando una función recursiva:

```
function factorial($num) {
    return $num <= 1 ? 1 : $num \* factorial($num \- 1);
}
echo factorial(5); // Salida: 120
```

-   Analicemos este caso
1.  La condición base es cuando num es igual a 1, devolviendo 1 y deteniendo la recursión.
2.  Si num es mayor que 1, la función llama a factorial de nuevo con el valor num - 1, multiplicándolo por num.

#### Ventajas y Desventajas de la Recursión

Ventajas

-   Código más limpio y legible: Las soluciones recursivas suelen ser más compactas y fáciles de entender que sus equivalentes iterativas.
-   Ideal para problemas jerárquicos: La recursión es muy útil para trabajar con datos que tienen una estructura de árbol o jerárquica, como explorar directorios o manejar datos de tipo árbol (DOM, menús anidados, etc.).

Desventajas

-   Consumo de memoria: Cada llamada recursiva agrega un nuevo nivel al stack de llamadas de PHP, lo cual puede llevar a un error de desbordamiento si la recursión es profunda o si no se define correctamente la condición base.
-   Complejidad de depuración: Las funciones recursivas pueden ser más difíciles de depurar debido a la cantidad de llamadas anidadas que se realizan.

### Consideraciones Importantes al Usar Recursividad en PHP

-   Podríamos generalizar para cualquier lenguaje de programación

Establecer una condición base clara

-     -   Sin una condición base, la función entrará en un ciclo infinito de llamadas hasta que se agote la memoria.

Evaluar el caso iterativo

-     -   A veces, una solución iterativa (usando bucles) puede ser más eficiente y evitar problemas de memoria.

Controlar la profundidad

-     -   PHP establece un límite en la profundidad de recursión por defecto (generalmente 100 o 1000 niveles), aunque este límite puede configurarse. Sin embargo, es importante considerar la eficiencia y el consumo de memoria.