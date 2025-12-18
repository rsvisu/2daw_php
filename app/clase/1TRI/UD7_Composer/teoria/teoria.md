https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Composer

# Usuario:ManuelRomero/ProgramacionWeb/Composer - WikiEducator

De WikiEducator

Saltar a: [navegación](#mw-navigation), [buscar](#p-search)

-   [1 Composer](#Composer)  -   [1.1 Usando Composer con _classmap_](#Usando_Composer_con_classmap)

-   [2 Usando PSR-4](#Usando_PSR-4)  -   [2.1 Declarar un namespace](#Declarar_un_namespace)
    -   [2.2 PSR-4 en Composer](#PSR-4_en_Composer)
    -   [2.3 Comparativa: _classmap_ vs _PSR-4_](#Comparativa:_classmap_vs_PSR-4)
    -   [2.4 Ejemplo visual: cómo piensan los dos sistemas](#Ejemplo_visual:_c.C3.B3mo_piensan_los_dos_sistemas)

## Composer

[https://medium.com/tech-tajawal/php-composer-the-autoloader-d676a2f103aa](https://medium.com/tech-tajawal/php-composer-the-autoloader-d676a2f103aa)

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

¿Qué es Composer?

Del mismo modo que un _**director de orquesta**_ coordina a todos los instrumentos para que la música suene de forma armoniosa, _**Composer**_ actúa como un _**orquestador del proyecto PHP**_. Su función principal es gestionar de forma unificada todos los _**paquetes, librerías y dependencias**_ que una aplicación necesita para funcionar correctamente.

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

¿Qué hace Composer?

Entre sus funciones principales, **Composer me permite**:

-   Gestionar automáticamente la _**autocarga (autoload) de las clases**_, evitando tener que hacer _includes_ o _requires_ manuales.
-   Instalar _**librerías y paquetes de terceros**_ dentro de mi proyecto de forma rápida, segura y organizada.

{{MRM\_Definicion|Title=Otras funcionalidades importantes de Composer| Además del autoload y la instalación de dependencias, Composer también:

-   Mantiene un fichero de _metainformación_ del proyecto en **composer.json**, donde se define:

```
get\_included\_files()
```

-   Sería ideal tener un sistema que nos permitiera indicar dónde se encuentran las clases, generar automáticamente la autocarga y mantenerlo todo organizado.\*

Para eso existe **Composer**, que incorpora diferentes estrategias para el _autoload_: **classmap** y **PSR-4**.

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Puntos clave

-   Cada clase en su propio fichero\*
-   El fichero debe llamarse igual que la clase\*

### Usando Composer con _classmap_

-   Creamos una estructura de directorios, por ejemplo:\*

[![Directorios autoload.png](https://es.wikieducator.org/images/8/84/Directorios_autoload.png)](https://es.wikieducator.org/Archivo:Directorios_autoload.png)

-   Ejemplo de clase:\*

```
<?php
class B {
    public function \_\_toString() {
        return "Hola desde la clase B";
    }
}
```

-   Creamos el fichero **composer.json** indicando que Composer debe escanear el directorio _Clases/_:\*

```
{
  "autoload": {
    "classmap": \[
      "Clases"
    \]
  }
}
```

-   Actualizamos Composer para generar la carga automática:\*

```
composer update
```

-   Composer crea automáticamente la carpeta **vendor/** y genera el fichero de autocarga.\*

[![Autoload composer.png](https://es.wikieducator.org/images/3/36/Autoload_composer.png)](https://es.wikieducator.org/Archivo:Autoload_composer.png)

-   Ahora sólo tenemos que incluir el autoload en nuestro proyecto:\*

```
<?php
require "vendor/autoload.php";
```

-   Si añadimos nuevos ficheros, recuerda regenerar el autoload:\*

```
composer dumpautoload
```

\---

## Usando PSR-4

-   PSR-4 es el método moderno y recomendado de autocarga. Usa los **namespaces** para localizar las clases automáticamente sin necesidad de regenerar el autoload cada vez.\*
-   Referencias recomendadas:\*

[https://styde.net/curso-de-laravel-5-que-es-psr-4-y-uso-de-los-namespaces/](https://styde.net/curso-de-laravel-5-que-es-psr-4-y-uso-de-los-namespaces/) [https://diego.com.es/namespaces-en-php](https://diego.com.es/namespaces-en-php) [https://www.php.net/manual/es/language.namespaces.php](https://www.php.net/manual/es/language.namespaces.php)

Espacio de nombres

-   Un **namespace** es una forma de organizar clases, funciones e interfaces evitando conflictos entre nombres.\*
-   Es equivalente a la organización en directorios del sistema de ficheros.\*

Ejemplo equivalente en archivos reales:

```
/home/profesor/dwes/notas.ods
/home/profesor/bd/notas.ods
```

Puedes tener dos clases con el mismo nombre si pertenecen a distintos namespaces.

[![Icon summary.gif](https://es.wikieducator.org/images/c/c7/Icon_summary.gif)](https://es.wikieducator.org/Archivo:Icon_summary.gif)

Objetivo

Los namespaces de PHP permiten agrupar clases, funciones, interfaces y constantes relacionadas.

### Declarar un namespace

-   El namespace debe ser la primera línea del fichero (sin espacios previos).\*

```
<?php
namespace MiProyecto;
```

-   También puede tener varios niveles separados por barras invertidas _\\'_:\*

```
<?php
namespace MiProyecto\\Nivel1\\Subnivel2;
```

[![Icon summary.gif](https://es.wikieducator.org/images/c/c7/Icon_summary.gif)](https://es.wikieducator.org/Archivo:Icon_summary.gif)

Comentarios sobre namespaces

-   Cada namespace suele corresponder a un directorio.
-   No es obligatorio que coincidan exactamente, pero es buena práctica.\*

\---

### PSR-4 en Composer

-   PSR-4 es más potente y elegante que _classmap_, y no requiere regenerar el autoload cuando se añaden nuevas clases.\*
-   Se basa completamente en los **namespaces**.\*

Ejemplo de configuración en **composer.json**:

```
{
  "autoload": {
    "psr-4": {
      "MiProyecto\\\\": "src/"
    }
  }
}
```

Esto significa:

-   Las clases con namespace \*\*MiProyecto\*\* se cargarán desde la carpeta \*\*src/\*\*
-   La clase:

```
namespace MiProyecto\\Modelos;
```

se ubica en

```
src/Modelos/Usuario.php
```

-   Tras crear o modificar el composer.json, sólo debes ejecutar:\*

```
composer dumpautoload
```

PSR-4 permite:

-   Organizar clases por módulos y carpetas
-   Crear proyectos escalables
-   Evitar conflictos de nombres
-   Mejorar la legibilidad y mantenibilidad del código

y es el estándar moderno utilizado por:

-   Laravel
-   Symfony
-   CodeIgniter 4
-   Doctrine
-   La mayoría del ecosistema PHP actual

### Comparativa: _classmap_ vs _PSR-4_

A la hora de configurar la carga automática de clases con Composer, existen dos métodos principales: **classmap** y **PSR-4**. Ambos funcionan, pero sirven para necesidades diferentes.

 Método | Cómo funciona | Ventajas | Inconvenientes |
| --- | --- | --- | --- |
 **classmap** | Composer escanea directorios y genera una lista interna (mapa) con todas las clases y su fichero correspondiente. | -   Muy sencillo de configurar
-   Funciona sin namespaces
-   Útil para proyectos heredados
    | -   No escala bien
-   Requiere ejecutar
    ```
    composer dumpautoload
    ```
    o
    ```
    composer update
    ```
    al añadir nuevas clases
-   No organiza la estructura del proyecto
    |
    **PSR-4** | La autocarga se basa en los namespaces: cada namespace corresponde a una carpeta.
    Composer encuentra automáticamente las clases según su ruta.

| -   Estándar moderno y recomendado
-   No requiere regenerar el autoload al añadir nuevas clases
-   Organización clara y modular
-   Muy usado en Laravel y frameworks modernos
-   Facilita evitar conflictos de nombres
    | -   Requiere usar namespaces
-   Necesita estructura organizada desde el principio
    |

### Ejemplo visual: cómo piensan los dos sistemas

Classmap (método antiguo o heredado)

Composer crea un “mapa” con las rutas exactas.

```
{
  "autoload": {
    "classmap": \["Clases/"\]
  }
}
```

Resultado interno:

```
B =\> Clases/B.php
C =\> Clases/C.php
MiClaseEspecial =\> Clases/OtraCarpeta/MiClaseEspecial.php
```

Cada vez que añades una clase nueva → **composer dumpautoload**

\---

PSR-4 (método moderno)

Mapea namespaces a carpetas:

```
{
  "autoload": {
    "psr-4": {
      "MiProyecto\\\\": "src/"
    }
  }
}
```

Reglas:

```
namespace MiProyecto\\Modelos;
 
src/Modelos/Usuario.php
```

Añades una clase → no hace falta hacer nada (Composer la encontrará automáticamente).