https://es.wikieducator.org/Usuario:ManuelRomero/ProgramacionWeb/Objetos/introduccion

# Usuario:ManuelRomero/ProgramacionWeb/Objetos/introduccion - WikiEducator

[![DWES Tema6 .png](https://es.wikieducator.org/images/8/81/DWES_Tema6_.png)](https://es.wikieducator.org/Archivo:DWES_Tema6_.png)

-   [1 Conceptos básicos de la Programación Orientada a Objetos (OOP o POO)](#Conceptos_b.C3.A1sicos_de_la_Programaci.C3.B3n_Orientada_a_Objetos_.28OOP_o_POO.29)
-   [2 Conceptos básicos de la Programación Orientada a Objetos (OOP o POO)](#Conceptos_b.C3.A1sicos_de_la_Programaci.C3.B3n_Orientada_a_Objetos_.28OOP_o_POO.29_2)  -   [2.1 OOP vs. Programación estructurada](#OOP_vs._Programaci.C3.B3n_estructurada)

-   [3 Elementos en la Programación Orientada a Objetos](#Elementos_en_la_Programaci.C3.B3n_Orientada_a_Objetos)
-   [4 OPP En php](#OPP_En_php)  -   [4.1 Pilares básicos de la POO](#Pilares_b.C3.A1sicos_de_la_POO)    -   [4.1.1 Encapsulación: Acceso a los componentes](#Encapsulaci.C3.B3n:_Acceso_a_los_componentes)      -   [4.1.1.1 Visibilidad](#Visibilidad)

    -   [4.2 Declarando objetos: Operador _**new**_](#Declarando_objetos:_Operador_new)
    -   [4.3 $this](#.24this)
    -   [4.4 self](#self)
    -   [4.5 Acceso al contenido del objeto](#Acceso_al_contenido_del_objeto)
    -   [4.6 Propiedades](#Propiedades)
    -   [4.7 Métodos](#M.C3.A9todos)    -   [4.7.1 Métodos contructor y destructor](#M.C3.A9todos_contructor_y_destructor)
        -   [4.7.2 Métodos mágicos](#M.C3.A9todos_m.C3.A1gicos)

    -   [4.8 Sobrecarga](#Sobrecarga)    -   [4.8.1 Sobrecargando el constructor](#Sobrecargando_el_constructor)
        -   [4.8.2 Sobrecarga con \_\_call(...)](#Sobrecarga_con_call.28....29)
        -   [4.8.3 Métodos _static_ vs _no static_](#M.C3.A9todos_static_vs_no_static)

    -   [4.9 Herencia](#Herencia)    -   [4.9.1 Clases Abstractas](#Clases_Abstractas)

### Conceptos básicos de la Programación Orientada a Objetos (OOP o POO)

### Conceptos básicos de la Programación Orientada a Objetos (OOP o POO)

#### OOP vs. Programación estructurada

-   La **programación orientada a objetos (POO)** surge como una evolución de la programación estructurada.
-   Busca modelar los problemas del mundo real utilizando objetos que combinan **datos** y **comportamientos**.
-   En programación, _el paradigma imperativo_ se basa en **funciones y datos**.
-   _El paradigma orientado a objetos_ se basa en **objetos**.
-   Los **objetos** son el elemento básico y central de la **programación orientada a objetos (OOP o POO)**.

([![Comment.gif](https://es.wikieducator.org/images/d/db/Comment.gif)](https://es.wikieducator.org/Archivo:Comment.gif): Cada objeto en el programa representa algo del mundo real: una persona, una cuenta bancaria, un pedido, una factura, etc.)

-   Podemos hablar de un **universo de discurso**, entendido como el sistema que queremos automatizar mediante software.
-   Un **objeto** es una entidad (concreta o abstracta) que desarrolla una actividad en un entorno determinado, dentro de un universo de discurso específico.

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Definición

**Objeto:** cada elemento activo que identificamos dentro de un determinado universo de discurso.

Serán nuestros componentes _software_ para construir y ensamblar nuestros programas.

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Ejemplo</p></td></tr><tr><td></td><td><dl><dt>En un banco hay cuentas bancarias (objeto)</dt><dd></dd><dd>Las cuentas bancarias se identifican con un número y un titular (nombre, apellidos y DNI) → <i><b>atributos</b></i>.</dd><dd>Las cuentas pueden darse de alta o de baja, hacer extracciones, ingresos y transferencias → <i><b>métodos</b></i>.</dd></dl></td></tr></tbody></table>

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Ejemplo</p></td></tr><tr><td></td><td><dl><dt>En la gestión de una empresa, a nivel de información tenemos</dt><dd></dd></dl><ul><li>Empleados</li><li>Nóminas</li><li>Bases de datos</li><li>Proveedores</li><li>Facturas</li><li>Pedidos</li></ul><p><a class="image" href="/Archivo:UNIVERSO_DISCUROS_OBJETOS.png"><img srcset="/images/thumb/0/0a/UNIVERSO_DISCUROS_OBJETOS.png/750px-UNIVERSO_DISCUROS_OBJETOS.png 1.5x, /images/0/0a/UNIVERSO_DISCUROS_OBJETOS.png 2x" height="258" width="500" src="/images/thumb/0/0a/UNIVERSO_DISCUROS_OBJETOS.png/500px-UNIVERSO_DISCUROS_OBJETOS.png" alt="UNIVERSO DISCUROS OBJETOS.png"></a></p></td></tr></tbody></table>

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Comparativa con la aplicación del juego Mastermind</p></td></tr><tr><td></td><td><div class="center"><p><a class="image" href="/Archivo:Comparativa_oo_estructurado.png"><img srcset="/images/9/9b/Comparativa_oo_estructurado.png 1.5x, /images/9/9b/Comparativa_oo_estructurado.png 2x" height="326" width="600" src="/images/thumb/9/9b/Comparativa_oo_estructurado.png/600px-Comparativa_oo_estructurado.png" alt="Comparativa oo estructurado.png"></a></p></div></td></tr></tbody></table>

-   Puede parecer una forma más compleja de programar, pero en realidad es una manera de **dividir la naturaleza del problema** en **unidades independientes** que pueden interactuar entre sí.
-   Cada una de ellas tendrá una **identidad propia**, definida por los valores de sus **atributos**.
-   Cada una tendrá también un **comportamiento concreto**, es decir, lo que sabe hacer y que el resto del programa o de los objetos podrá utilizar.

### Elementos en la Programación Orientada a Objetos

-   De lo dicho anteriormente deducimos que en la POO tenemos dos elementos fundamentales:
1.  Los _**atributos**_ o características de la clase.
2.  Los _**métodos**_ o comportamientos de la clase.
-   Para crear objetos, previamente hay que **definir su estructura**.
-   La definición de la estructura **(atributos y métodos)** de los componentes _software_ se denomina _**clase**_.

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Clase

La descripción y especificación de los componentes _software_ para su posterior uso en los programas.

-   **Una clase** es la estructura o plantilla que define un tipo concreto de objetos.
-   **Los objetos** son elementos concretos de mi sistema: instancias de esa clase, cargadas en memoria para ser utilizadas por un programa.

Elementos de la POO

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Atributo

-   Son las características o datos de un objeto.
-   Sus valores determinan el **estado** del objeto en un momento dado.
-   Normalmente, al instanciar un objeto en memoria, lo primero que hacemos es asignar valores a sus atributos.
-   Es recomendable que los atributos estén **encapsulados**, es decir, que sólo sean accesibles dentro del propio objeto (_privados_).

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Método

-   Especifican el **comportamiento** de los objetos.
-   Permiten modificar o conocer el estado de un objeto mediante _**métodos getter y setter**_.
-   Permiten que un objeto realice acciones dentro del sistema y se comunique con otros objetos.
-   _**Los métodos**_ representan las acciones que el objeto sabe hacer, los _**servicios**_ que ofrece al sistema.
-   También pueden incluir acciones internas que facilitan el funcionamiento del propio objeto.
-   En PHP, los métodos se definen dentro de la clase y se invocan mediante el operador **\->**.

[![Clase.png](https://es.wikieducator.org/images/thumb/4/4d/Clase.png/300px-Clase.png)](https://es.wikieducator.org/Archivo:Clase.png)

## OPP En php

-   PHP no se diseñó como lenguaje orientado a objetos, por lo que muchas de las características de este paradigma se han ido incorporando en las últimas versiones, especialmente a partir de la versión 5.3.
-   PHP Almacena el valor de un objeto como una referencia (dirección de memoria), no guarda el valor.
-   Esto implica que si queremos pasar un objeto a través de la red, debemos _**serializarlo**_, para que _viaje_ también el valor del mismo y no solo la dirección de memoria que en destino carecería de sentido. Veremos este concepto más adelante.

En php las clases tienen métodos y propiedades

1.  propiedades: son los atributos o características de la clase.
2.  métodos: representan el comportamiento de la misma.

Definir una clase en php

```
class NombreClase{
//propiedades
//métodos
}
```

-   _**NombreClase**_ es un identificador válido con la siguiente expresión regular

```
^\[a-zA-Z\_\]\[a-zA-Z0-9\_\]\*$
```

-   El nombre de las clases se recomienda que empiece por mayúsculas
-   Los nombres de las clases no son sensibles a los casos (sensitive-case), pero es muy recomendado utilizarlo como si lo fuera.-
-   Es _**muy recomendable**_ guardar las clases en ficheros cuyo nombre sea el propio de la clase, esto permitirá la autocarga de estos ficheros y forma parte de las buenas prácticas de programación

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Importante la visibilidad

-   Veremos más adelante la visibilidad
-   En php es _**obligatorio**_ especificar la visibilidad de los atributos
-   Las buenas prácticas de programación marcan poner _**private**_ a los atributos (o _**protected**_)
-   Los métodos por defecto son públicos,_**public**_ siendo preferible especificarlo de forma explícita

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Ejemplo</p></td></tr><tr><td></td><td><p>Vamos a crear una clase llamada fecha</p><ul><li>Atributos de la clase (dia, mes, year)</li><li>Métodos <i>verFecha</i> (obtener la fecha como una cadena de caracteres)</li></ul><ul><li>En el programa principal</li></ul><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw2">&lt;?php</span>
          <span class="kw1">require</span> <span class="st0">"Fecha.php"</span><span class="sy0">;</span>
          <span class="re0">$f1</span> <span class="sy0">=</span> <span class="kw2">new</span> Fecha<span class="br0">(</span><span class="nu0">10</span><span class="sy0">,</span><span class="nu0">12</span><span class="sy0">,</span><span class="nu0">2016</span><span class="br0">)</span><span class="sy0">;</span>
          <span class="kw1">echo</span> <span class="st0">"La fecha es "</span><span class="sy0">.</span><span class="re0">$f1</span><span class="sy0">-&gt;</span><span class="me1">verFecha</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span>
<span class="co1">// put your code here</span>
<span class="sy1">?&gt;</span></pre></div><ul><li>Y la salida que se produce</li></ul><p>La fecha es 10/12/2016</p></td></tr></tbody></table>

-   Iremos entendiendo cada parte de esta declaración y uso a lo largo del tema

### Pilares básicos de la POO

-   Son 4 las características o principios de la programación orientada a objetos

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Puntos clave

Encapsulación

Abstracción

Polimorfismo

Herencia

#### Encapsulación: Acceso a los componentes

-   A la hora de definir tanto las propiedades como los métodos, especificaremos el nivel de acceso que se tiene a ese elemento
-   Es una buena práctica de programación no dejar acceso directo a los atributos de una clase, sino acceder a ellos a través de los métodos

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Puntos clave

-   La encapsulación es uno de los pilares de la programación orientada a objetos

permite o restringe la visibilidad de sus componentes

##### Visibilidad

-   Implementa el principio de encapsulación.
-   Permite especificar desde qué ámbito se tiene acceso a un determinado elemento. Básicamente tenemos tres tipos de ámbitos desde lo que podemos querer acceder.
1.  Desde la propia clase
2.  Desde otra sección de código (otra clase sin ninguna relación de herencia o en el programa dónde se está usando un objeto de esa clase.
3.  Desde otra clase que se ha extendido (dónde hay una relación de herencia

Visibilidad

-   Son tres los tipos de visibilidad que podemos especificar:
1.  public
2.  private
3.  protected

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** _**public**_ tipo de visibilidad asignada por defecto a los _**métodos**_, en caso de no especificarla.

-   En el caso de los atributos hay que declararlo de forma explícita.
-   Las funciones podemos no declararlo tomando el valor por defecto **public**
-   Por herencia podemos usar la palabra reservada **var** para declarar los atributos en cuyo caso son public, pero su uso está depreciado

public

-   Los elementos públicos pueden ser accesibles desde cualquier ámbito dónde se pueda acceder al objeto
-   Recordemos que para acceder a un elemento debemos especificar el objeto o clase al que pertenece el elemento al que queremos acceder
-   Si el elemento es estático o constante usaremos el operador _**::**_ llamado operador de especificación ámbito [#::](#::)
-   Si el elemento es no estático accedemos a través del operador _**\->**_

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Ejemplo</p></td></tr><tr><td></td><td><ul><li>En el código anterior ver el método <i><b>verFecha()</b></i> que es <b>públic</b></li><li>Sin embargo las propiedades <i><b>dia</b></i>, <i><b>mes</b></i>,<i><b>year</b></i>, son <b>private</b></li><li>Esto implica que en el programa principal puedo hacer</li></ul><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="sy0">....</span>
<span class="re0">$f</span> <span class="sy0">=</span> <span class="kw2">new</span> Fecha<span class="br0">(</span><span class="nu0">5</span><span class="sy0">,</span><span class="nu0">10</span><span class="sy0">,</span><span class="nu0">2017</span><span class="br0">)</span>
<span class="sy0">...</span>
<span class="re0">$f</span><span class="sy0">-&gt;</span><span class="me1">verFecha</span><span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span>
<span class="sy0">...</span></pre></div><ul><li>Pero no puedo hacer</li></ul><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="sy0">....</span>
<span class="re0">$f</span> <span class="sy0">=</span> <span class="kw2">new</span> Fecha<span class="br0">(</span><span class="nu0">5</span><span class="sy0">,</span><span class="nu0">10</span><span class="sy0">,</span><span class="nu0">2017</span><span class="br0">)</span>
<span class="sy0">...</span>
<span class="re0">$f</span><span class="sy0">-&gt;</span><span class="me1">dia</span><span class="sy0">=</span> <span class="nu0">5</span><span class="sy0">;</span>
<span class="sy0">...</span></pre></div><p><a class="image" href="/Archivo:Icon_present.gif"><img height="48" width="48" src="/images/1/1c/Icon_present.gif" alt="Icon present.gif"></a></p><p><b>Tip:</b> En el caso de que las propiedades fueran <b>public</b>, sí podría hacerlo</p></td></tr></tbody></table>

private

-   Los elementos especificado con este modificador de acceso hace que su visibilidad se reduzca al interior de la clase, no pudiendo acceder a ellos desde fuera (ni siquiera desde clases que sean una herencia, o clases heredadas).
-   En OOP es una tendencia hacer todos los atributos privados y acceder a ellos por los métodos _**setter**_ and _**getter**_.

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

ejemplo usando get and set method

-   Realiza un programa que implemente un usuario con usuario y password
-   Se puede crear un objeto sin pasar password, en cuyo caso se asignará el mismo password que usuario
-   El password ha de tener un mínimo de 8 caracteres y al menos un número
-   Si no se crea la password se generará un mensaje de que no se ha podido crear el usuario con dichas credenciales

 \[[▼](#)\]posible solución |
| --- |

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** A un elemento _**private**_ de una clase, tampoco podrá acceder desde clases que deriven de ésta, pero en php, dentro de una clase, se puede acceder a los elementos privados de otro objeto de la misma clase.

```
class A{
  private $foo
 
.........
 
   public function compara (A $b){
    //Voy a acceder directamente a un atributo privado del objeto $b
    //Como este objeto es de la clase A, sí que puedo hacerlo
    //Esto ocurre en php
         if $this\->foo \==$b\->foo
   }
 .....
 
}
 
}
```

protected

-   Este tipo de visibilidad implica que los elementos así especificados solo son accesible por la propia clase y por las clases derivadas, con las que se establezca una relación de herencia.
-   Para ello hay que ver la herencia que veremos más adelante dónde propondremos un ejemplo

```
    <?php
class persona{
    protected $nombre;
    protected $fNac;
    //....
}
//.....
class medico extends persona{
    private $numColegiado;
 
    public function \_\_construct($nombre, $fechaNacimiento, $colegiado) {
        $this\->nombre\=$nombre;
        $this\->fNac\=$fechaNacimiento;
        $this\->numColegiado\=$colegiado;
 
    }
    public function visualiza(){
        echo "Medico $this->nombre";
    }
}
$medicoPueblo1\= new medico("pedro", "1/1/1969","123456");
$medicoPueblo1\->visualiza();
 
?>
```

### Declarando objetos: Operador _**new**_

-   Permite crear instancias de un objeto en memoria.
-   Una clase describe la estructura común de determinados objetos, su composición o podríamos verlo como una plantilla .
-   Las clases en principio no se usan durante la ejecución, salvo si queremos acceder a **métodos o propiedades estáticas** como veremos un poco más adelante
-   En un programa crearemos _**objetos**_ (instancias de la clase).
-   Para _instanciar_ objetos de las clases usaremos el operador **new**
-   Una vez **instanciando** ya tenemos la referencia del objeto y lo podemos utilizar.
-   En php los objetos internamente se manejan como direcciones de memoria, por ese motivo, cuando queremos acceder a un elemento del objeto, tendremos que indireccionar su posición a partir de la dirección base del propio objeto, por lo que se utiliza el operador de indireccion _**\->**_, como ya venimos haciendo en este tema.
-   Hay que ser consciente que en memoria tenemos **toda** la estructura del la clase por cada objeto (es decir si tengo un método concreto y 5 objetos, tendré en memoria los 5 métodos, uno por cada objeto, y cada método pertenece a su objeto).

[![Objetos4.png](https://es.wikieducator.org/images/3/38/Objetos4.png)](https://es.wikieducator.org/Archivo:Objetos4.png)

### $this

-   Para poder acceder a los atributos, o métodos de un objeto en una clase usaremos la seudovariable **$this**.
-   _**$this**_ es una seudovariable que referencia al objeto del ámbito en el cual se está usado.
-   Se utiliza dentro de la definición de la propia clase y hará referencia a un objeto concreto en un momento dado;
-   Cuando en un método de una clase se quiere acceder a un atributo de la misma, hay que usar la $this, ya que en caso contrario estaría accediendo a una variable local al método

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Observa el siguiente código

```
<?php
 
class Persona{  
    public  $nombre;
    public  $apellido;
 
    public function \_\_construct( string $n,  string $a){
        //No estoy asignando los valores a los atributos
        //Sino a unas variables locales a este método
        $nombre \= $n;
        $apellido \= $a;
    }
}
$p \= new Persona ("María", "Ruíz");
//Los atributos no tienen valor
echo "<h1>Nombre -$p->nombre\-</h1>";
echo "<h1>Apelido -$p->apellido\-</h1>";
```

---
-   La forma correcta de escribir el constructor

```
    public function \_\_construct( string $n,  string $a){
        //Ahora sí que asigno los  valores a los atributos de la clase
        $this\->nombre \= $n;
        $this\->apellido \= $a;
    }
```

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Puntos clave

-   La lectura de la seudovariable _**$this**_ sería : **cuando exista una instancia de objeto de esta clase, quiero acceder a la propiedad o atributo** _atributo\_x_ **o ejecutar el método** _metodo\_y_ **de ese objeto**.

### self

-   Cuando queremos acceder a un elemento estático o una constante, éstos son valores que no se establecen en memoria para cada objeto que declare, sino que son compartidos por todos los objetos de la clase, habiendo en memoria un solo valor de los mismos.

Cuando queremos acceder a ellos dentro de la clase (en la declaración de la estructura), los referenciaremos con el operador _**self'**, que se podría traducir como **yo mismo**_

-   Por ejemplo si tengo una constante declarada

```
    <?php
class Constantes{
  const K \= 10;
  const IVA \= 0.21;
  function getValores(){
     echo "Valor de la constante --".self::K."--<br/>";
     echo "Valor del producto de 235 euros base . cuyo iva es ".
           (self::IVA\*235);
  }
}
```

### Acceso al contenido del objeto

-   Ya hemos visto que para acceder a un elemento de un objeto usamos operadores _**\->**_ o bien _**::**_

Operador de indirección \->

-   Este operador es un operador de indirección
-   Los objetos son direcciones de memoria, cuando se quiere acceder al contenido de una dirección de memoria se usa un operador de **indirección**, que en el caso de php como en otros muchos lenguajes es _**\->**_ .
-   Observar que se suele acompañar de una variable objeto o de la seudovariable _**$this**_ , por ese motivo si se quiere acceder a una propiedad del objeto, ya no hay que especificar el _**$**_ en el nombre de la propiedad

```
class Clase1{
 public $propiedad1;
 ....
 public function \_\_construct($valor){
//la variable o propiedad de la clase no lleva $ al acceder a ella.
       $this\->propiedad1 \= $valor; 
 
 }
....
 $obj1 \= new Clase1("verde");
 $obj1\->propiedad1 \="azul";
...
```

Operador de resolución de ámbito ::

-   [http://php.net/manual/es/language.oop5.paamayim-nekudotayim.php](http://php.net/manual/es/language.oop5.paamayim-nekudotayim.php)
-   Se utiliza para poder acceder a los elementos estáticos de la clase
-   En la parte de la izquierda hay que especificar el dominio o elemento al que pertenece la propiedad o método estático.
-   Podremos usar;
1.  nombre de clase,
2.  nombre del objeto
3.  _**self**_ : si es dentro de la misma clase
4.  _**parent**_ : si el elemento pertenece a la clase de la que heredo
5.  _**static**_ Al igual que self se puede usar la palabra reservada static, para acceder a un elemento estático de la clase.

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Resolución de ámbito</p></td></tr><tr><td></td><td><p>El siguiente código aclara de forma completa estas posibilidades:</p><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw2">class</span> Clase1 <span class="br0">{</span>
  <span class="kw2">const</span>  IVA <span class="sy0">=</span> <span class="nu0">21</span><span class="sy0">;</span>
  <span class="kw2">public</span> static <span class="re0">$numObj</span> <span class="sy0">;</span>
  <span class="kw2">public</span> <span class="kw2">function</span> __construct<span class="br0">(</span><span class="br0">)</span> <span class="br0">{</span>
     <span class="kw2">self</span><span class="sy0">::</span><span class="re0">$numObj</span><span class="sy0">++;</span>
     <span class="kw1">echo</span> <span class="st0">"En total hay "</span><span class="sy0">.</span>Clase1<span class="sy0">::</span><span class="re0">$numObj</span><span class="sy0">.</span>
                        <span class="st0">"objetos de esta clase e IVA = "</span>
                        <span class="sy0">.</span>static<span class="sy0">::</span><span class="me2">IVA</span><span class="sy0">.</span><span class="st0">"&lt;br /&gt;"</span> <span class="sy0">;</span>
    <span class="br0">}</span>
&nbsp;
<span class="br0">}</span>
&nbsp;
<span class="re0">$obj1</span> <span class="sy0">=</span> <span class="kw2">new</span> Clase1<span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span>
<span class="re0">$obj2</span> <span class="sy0">=</span> <span class="kw2">new</span> Clase1<span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span>
<span class="re0">$obj3</span> <span class="sy0">=</span> <span class="kw2">new</span> Clase1<span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span>
<span class="kw1">echo</span> <span class="st0">"&lt;hr /&gt;"</span><span class="sy0">;</span>
<span class="kw1">echo</span> <span class="st0">"El valor del atributo estático numObj lo
 puedo ver desde cualquier objeto de la clase &lt;br /&gt;"</span><span class="sy0">;</span>
<span class="kw1">echo</span> <span class="st0">"NumObj desde obj1 "</span><span class="sy0">.</span><span class="re0">$obj1</span><span class="sy0">::</span><span class="re0">$numObj</span><span class="sy0">.</span> <span class="st0">"&lt;br /&gt;"</span><span class="sy0">;</span>
<span class="kw1">echo</span> <span class="st0">"NumObj desde obj2 "</span><span class="sy0">.</span><span class="re0">$obj2</span><span class="sy0">::</span><span class="re0">$numObj</span><span class="sy0">.</span> <span class="st0">"&lt;br /&gt;"</span><span class="sy0">;</span>
<span class="kw1">echo</span> <span class="st0">"NumObj desde obj3 "</span><span class="sy0">.</span><span class="re0">$obj3</span><span class="sy0">::</span><span class="re0">$numObj</span><span class="sy0">.</span> <span class="st0">"&lt;br /&gt;"</span><span class="sy0">;</span>
<span class="kw1">echo</span> <span class="st0">"NumObj desde en nombre de la clase "</span><span class="sy0">.</span>Clase1<span class="sy0">::</span><span class="re0">$numObj</span><span class="sy0">.</span> <span class="st0">"&lt;br /&gt;"</span><span class="sy0">;</span>
<span class="sy1">?&gt;</span></pre></div><p>La salida que produciría el código sería</p><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"> En total hay <span class="nu0">1</span> objetos de esta clase e IVA <span class="sy0">&lt;</span>nowiki<span class="sy0">&gt;=&lt;/</span>nowiki<span class="sy0">&gt;</span> <span class="nu0">21</span>
 En total hay <span class="nu0">2</span> objetos de esta clase e IVA <span class="sy0">&lt;</span>nowiki<span class="sy0">&gt;=&lt;/</span>nowiki<span class="sy0">&gt;</span> <span class="nu0">21</span>
 En total hay <span class="nu0">3</span> objetos de esta clase e IVA <span class="sy0">&lt;</span>nowiki<span class="sy0">&gt;=&lt;/</span>nowiki<span class="sy0">&gt;</span> <span class="nu0">21</span>
 El valor del atributo estático numObj
   lo puedo ver desde cualquier  objeto de la clase 
 NumObj desde obj1 <span class="nu0">3</span>
 NumObj desde obj2 <span class="nu0">3</span>
 NumObj desde obj3 <span class="nu0">3</span>
 NumObj desde en nombre de la clase <span class="nu0">3</span></pre></div></td></tr></tbody></table>

### Propiedades

-   Al igual que en el código estructurado los valores que almaceno en memoria, las propiedades de los objetos pueden ser.
1.  Variables
2.  Constantes

Constantes

-   Para definir constantes se usa la palabra reservada _**const**_. Como ya sabemos este valor no puede ser modificado durante la ejecución.
-   El identificador de las constantes no empieza por $.
-   A una constante hay que asignarle un valor no pudiendo asignar expresiones.
-   Todos los objetos de la misma clase comparte el valor de la constante. Por lo que se tomará como un valor estático.
-   Antes de la versión 7.1, incluyendo la 7.0, las constantes siempre eran públicas
-   A partir de la versión 7.1 se puede especificar la visibilidad (public, protected o private)

Accediendo al valor de una constante

1.- Dentro de la clase:

-   Operador [_**self**_](#self) junto con el **_[operador de resolución de ámbito  ::](#::)_**
-   Nombre de la clase

2.- En el programa:

-   Nombre de la clase
-   Nombre de cualquier objeto de la clase  -   En ambos casos, junto con el operador de resolución de ámbito _**::**_, seguido del identificador de la constante.

-   Vemos un ejemplo de su uso

```
    <?php
class Constantes{
      const K \= 10;
      const IVA \= 0.21;
      function getValores(){
              echo "Valor de la constante --".self::K."--<br/>";
              echo "Valor del producto de 235 euros base ".((self::IVA\*235)+235);
      }
}
 
$a\=new Constantes();
//Mostramos los valores de las constantes
$a\->getValores();
 
echo "<br/>valor de la constante con el nombre de la clase ".Constantes::K;
echo "<br/>valor de la constante con el nombre del objeto".$a::K;
?>
```

Variables

-   Estas propiedades son como las variables pero de la clase.
-   Siguen la misma regla de construcción que vistas anteriormente.
-   Las propiedades de la clase al igual que los métodos se les puede especificar una determinada [#visibilidad](#visibilidad) o alcance, siendo el valor por defecto _**public**_.
-   También puedes ser [#static](#static) o estáticas;Este **especificador**, establece que estos elementos sean conocidas como propiedades o métodos de la clase, si se especifica con la palabra reservada _**[#static](#static)**_.

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Es importante recordar que para acceder dentro de la clase a los métodos o propiedades de ella, hay que usar la seudovariable _**[#$this](#.24this)'**_

-   Esto es debido a que php es de tipado dinámico, si no lo hiciéramos estaríamos accediendo a una variable local al método

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Recordar que en este caso no podremos el _**$**_ delante del nombre de la propiedad.

```
<?php
class Propiedades{
   public $propiedad \= "rojo";
   public function getPropiedad(){
     echo "\\$propiedad ahora es una variable local
     al método y no tiene valor: --$propiedad\--<br/>";
     $propiedad\="azul";
     echo "Ahora visualizo el valor de \\$propiedad 
           del método:  --$propiedad\--<br/>";
     echo "Ahora visualizo el valor de \\$propiedad 
           de la clase:  --$this->propiedad\--<br/>";
     } 
}
 
$a \= new Propiedades();
$a\->getPropiedad();
?>
```

### Métodos

-   Es la forma de especificar el comportamiento de la clase
-   Es lo que el objeto va a saber hacer dentro del programa
-   Los métodos de detallan usando la palabra reservada _**function**_
-   En php dentro de la programación orientada a objetos tenemos una serie o tipo de métodos que es muy importante conocer y se llaman [#métodos mágicos](#m.C3.A9todos_m.C3.A1gicos), que posteriormente estudiaremos.
-   Los métodos mágicos son métodos de la clase que son invocados de manera implícita cuando ocurre alguna circunstancia concreto.
-   Por ejemplo como vamos a ver en el párrafo siguiente, cuando se instancia un objeto se invoca (si está implementado), al método mágico \_\_construct. a continuación se explica.

#### Métodos contructor y destructor

-   En php, a diferencia de Java, no podemos tener un método con el mismo nombre que la clase (Versiones anteriores a la 7.4 sí que se podía, pero actualmente genera un error).
-   El constructor en php corresponde a un [#método mágico](#m.C3.A9todo_m.C3.A1gico) llamado _**\_\_construct()'** que es invocado y ejecutado siempre que se instancie un nuevo objeto de la clase (si lo hemos escrito en la clase). En este caso no se ejecutará el método con el nombre de la clase si es que existiera._
-   El igual que tenemos un método que se ejecuta cuando instanciamos un objeto de la clase, _**\_\_construct()'**, existe otro [#método mágico](#m.C3.A9todo_m.C3.A1gico) que se ejecuta siempre que se destruya una instancia de una clase u objeto, y es el método_ **\_\_destruct()**
-   Las implementaciones de estos dos métodos, lógicamente son libre para cada clase,
-   Su invocación es transparente para el programador (esto es cómo ocurre en todos los [#métodos mágicos](#m.C3.A9todos_m.C3.A1gicos) y se realiza siempre respectivamente al crear el objeto, y cuando este es destruido,
-   En el caso de _**\_\_construct**_, podemos pasarle argumentos, que serían los valores que aportamos al construir un objeto de la clase

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Usando constructores</p></td></tr><tr><td></td><td><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw2">class</span> Clase1 <span class="br0">{</span>
    <span class="co1">//put your code here</span>
&nbsp;
    <span class="kw2">public</span> <span class="kw2">function</span> Clase1<span class="br0">(</span><span class="re0">$m</span><span class="br0">)</span><span class="br0">{</span>
        <span class="kw1">echo</span> <span class="st0">"Estoy en constructor de Clase1, método Clase1,
           y he recibido el parámetro &lt;strong&gt;<span class="es4">$m</span>&lt;/strong&gt;"</span><span class="sy0">;</span>
    <span class="br0">}</span>
&nbsp;
&nbsp;
<span class="br0">}</span>
<span class="re0">$obj1</span> <span class="sy0">=</span> <span class="kw2">new</span> Clase1<span class="br0">(</span><span class="st0">"Mensaje pasado al constructor "</span><span class="br0">)</span><span class="sy0">;</span></pre></div><pre>   *La salida de este código
Estoy en constructor de Clase1, métdo Clase1,
y he recibido el parámetro Mensaje pasado al constructor
</pre><p>Alternativamente de forma más correcta establecemos el constructor con el método mágico <i><b>__construct()</b></i></p><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw2">class</span> Clase1 <span class="br0">{</span>
    <span class="co1">//put your code here</span>
&nbsp;
    <span class="kw2">public</span> <span class="kw2">function</span> __construct<span class="br0">(</span><span class="re0">$m</span><span class="br0">)</span><span class="br0">{</span>
        <span class="kw1">echo</span> <span class="st0">"Estoy en constructor de Clase1, método __construct, 
              y he recibido el paŕametro &lt;strong&gt;<span class="es4">$m</span>&lt;/strong&gt;"</span><span class="sy0">;</span>
    <span class="br0">}</span>
&nbsp;
<span class="br0">}</span>
&nbsp;
<span class="re0">$obj1</span> <span class="sy0">=</span> <span class="kw2">new</span> Clase1<span class="br0">(</span><span class="st0">"Mensaje pasado al constructor "</span><span class="br0">)</span><span class="sy0">;</span>
<span class="sy1">?&gt;</span></pre></div><pre>   *La salida del código anterior
Estoy en constructor de Clase1, método __construct, 
y he recibido el paŕametro Mensaje pasado al constructor
</pre><p><a class="image" href="/Archivo:Icon_present.gif"><img height="48" width="48" src="/images/1/1c/Icon_present.gif" alt="Icon present.gif"></a></p><p><b>Tip:</b> El constructor puede (en la mayoría de los casos <i><b>debe</b></i>)recibir parámetros pasados al crear la instancia del objeto con el operador '<b>new'</b></p></td></tr></tbody></table>

-   El método constructor es un método que típicamente se suele sobrecargar, es decir, tener código diferente en función de los parámetros que aporte en su invicación. Ver el tema de [#Sobrecarga](#Sobrecarga) dónde se explica este concepto con un ejemplo

Promoción de propiedades (property promotion)

-   La versión 8 de php presenta esta gran utilidad, que permite una declaración muy compacta de constructor y atributos.
-   El la delcaración del constructor se realizan las siguientes acciones:
1.  Declarar los atributos de la clase,
2.  Definición de constructor
3.  Asignaciones valores a los atributos .
-   Por ejemplo

```
class Poligono
{
 
    public function \_\_construct(private  float $altura,private float  $base, private int $lados ){}
}
.....
 
$cuadrado \= new Poligono(5,5,4);
```

#### Métodos mágicos

-   Una serie de métodos cuyos nombres están reservados y se pueden usar con cualquier objeto de cualquier clase.
-   Su nombre siempre empieza por \_\_
-   Estos métodos que se invocan automáticamente cuando ocurre algo, en php se conocen como métodos mágicos.
-   Un ejemplo son el \_\_construct(...) y \_\_destruct(...)
```
[http://php.net/manual/es/language.oop5.magic.php](http://php.net/manual/es/language.oop5.magic.php)
   

```
-   Otro ejemplo importante son los métodos \_\_toString() y \_\_call($function, $paramters)

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>__toString()</p></td></tr><tr><td></td><td><ul><li>Este método es invocado si queremos convertir el objeto en un string</li><li>No recibe parámetros , pues no se invoca de forma explícita</li><li>Lo correcto es que retorne un string</li></ul><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw2">class</span> Racional <span class="br0">{</span>
    <span class="co1">//put your code here</span>
    <span class="kw2">private</span> <span class="re0">$num</span><span class="sy0">;</span>
    <span class="kw2">private</span> <span class="re0">$den</span><span class="sy0">;</span>
&nbsp;
    <span class="kw2">public</span> <span class="kw2">function</span> __construct<span class="br0">(</span><span class="re0">$num</span><span class="sy0">,</span> <span class="re0">$den</span><span class="br0">)</span><span class="br0">{</span>
        <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">num</span> <span class="sy0">=</span> <span class="re0">$num</span><span class="sy0">;</span>
        <span class="re0">$this</span><span class="sy0">-&gt;</span><span class="me1">den</span> <span class="sy0">=</span> <span class="re0">$den</span><span class="sy0">;</span>
    <span class="br0">}</span>
    <span class="kw2">public</span> <span class="kw2">function</span> __toString<span class="br0">(</span><span class="br0">)</span><span class="br0">{</span>
        <span class="kw1">return</span> <span class="br0">(</span><span class="st0">"<span class="es4">$this-&gt;num</span>/<span class="es4">$this-&gt;den</span>"</span><span class="br0">)</span><span class="sy0">;</span>
    <span class="br0">}</span>
<span class="br0">}</span>
&nbsp;
<span class="re0">$r1</span> <span class="sy0">=</span> <span class="kw2">new</span> Racional <span class="br0">(</span><span class="nu0">8</span><span class="sy0">,</span><span class="nu0">5</span><span class="br0">)</span><span class="sy0">;</span>
<span class="kw1">echo</span> <span class="st0">"Valor del objeto r1 = <span class="es4">$r1</span>"</span><span class="sy0">;</span>
<span class="sy1">?&gt;</span></pre></div><pre>   *La salida de este código
Valor del objeto r1 = 8/5 
</pre></td></tr></tbody></table>

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

\_\_call($metodo, $parametros )

-   Este método es invocado siempre que invoquemos a un método de la clase que no exista
-   Recibe los siguientes parámetros

1.- _**$metodo**_ es el nombre del método invocado 1.- _**$parametros**_ es un array indexado con la lista de los parámetros con los que invocamos a la función


{{MRM\_Ejemplo|Title=uso de \_\_call($metodo, $parametros )|

```
class Racional {
    //put your code here
    private $num;
    private $den;
 
    public function \_\_construct($num, $den){
        $this\->num \= $num;
        $this\->den \= $den;
    }
    public function \_\_call($funcion, $argumentos){
           echo "<h2>Has invocado a un método que no existe en esta clase </h2>";
           echo "Nombre de la función <strong>$funcion</strong><br />";
           echo "Lista de parámetros<br />";
           foreach ($argumentos as $param \=> $valor){
 
             echo "parámetro <strong>$param</strong> = <strong>".print\_r($valor, true).
                   "</strong> <br />";
//Poner en print\_r el segundo parámetro a true, 
//hace que esa función en lugar de imprimir, retorna el valor.
           }
    }
 
    }
}
$r1 \= new Racional(5,4);
$r1\->metodoInventado1(5,4,5,6,7);
$r1\->otroMetodoSinParametros();
$r1\->otroMetodo(\[1,2,3\],"parametro2", 5,"ultimo parametro");
?>
```

```
   \*La salida de este código

```

[![SalidaCall.png](https://es.wikieducator.org/images/8/87/SalidaCall.png)](https://es.wikieducator.org/Archivo:SalidaCall.png)

### Sobrecarga

Es un concepto muy importante y básico en la programación orientada a objetos. La sobrecarga es una concreción del principio de **polimorfismo**.

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Polimorfismo

-   Podemos tener varios métodos con el mismo nombre, pero con diferente número de parámetros o con parámetros de distinto tipo.
-   En tiempo de ejecución se ejecutará uno u otro en función de los parámetros reales que pasemos en la invocación del método.

-   Sin embargo, este aspecto en PHP no es del todo intuitivo: no existe la sobrecarga como la entendemos en otros lenguajes.
-   No obstante, disponemos de técnicas para poder _simular_ la sobrecarga.
-   En muchos casos resulta fundamental, especialmente al sobrecargar el **constructor** de una clase.
-   Para simular la sobrecarga en **PHP**, aprovechamos que una variable que no tenga valor se considera del tipo **null**.
-   Lo veremos con una serie de ejemplos para dejar claro este concepto.
-   Tomamos como ejemplo una función:

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Ejemplo</p></td></tr><tr><td></td><td><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw2">function</span> verTipoParametros<span class="br0">(</span><span class="re0">$a</span> <span class="sy0">=</span> <span class="kw4">null</span><span class="sy0">,</span> <span class="re0">$b</span> <span class="sy0">=</span> <span class="kw4">null</span><span class="sy0">,</span> <span class="re0">$c</span> <span class="sy0">=</span> <span class="kw4">null</span><span class="br0">)</span><span class="br0">{</span>
    <span class="kw1">echo</span> <span class="st0">"Primer parámetro: "</span><span class="sy0">;</span>
    <span class="kw3">var_dump</span><span class="br0">(</span><span class="re0">$a</span><span class="br0">)</span><span class="sy0">;</span>
    <span class="kw1">echo</span> <span class="st0">"Segundo parámetro: "</span><span class="sy0">;</span>
    <span class="kw3">var_dump</span><span class="br0">(</span><span class="re0">$b</span><span class="br0">)</span><span class="sy0">;</span>
    <span class="kw1">echo</span> <span class="st0">"Tercer parámetro: "</span><span class="sy0">;</span>
    <span class="kw3">var_dump</span><span class="br0">(</span><span class="re0">$c</span><span class="br0">)</span><span class="sy0">;</span>
<span class="br0">}</span></pre></div></td></tr></tbody></table>

-   Ahora la invocamos de diferentes maneras y observamos el resultado:

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Invocar sin parámetros reales</p></td></tr><tr><td></td><td><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw1">echo</span> <span class="st0">"Invocando a &lt;strong&gt;verTipoParametros()&lt;/strong&gt;&lt;hr /&gt;"</span><span class="sy0">;</span>
verTipoParametros<span class="br0">(</span><span class="br0">)</span><span class="sy0">;</span></pre></div><ul><li>A pesar de que tiene tres parámetros, la invocamos sin argumentos.</li><li>El resultado será que cada parámetro, al ejecutar la función, será de tipo <b>null</b> con valor <b>null</b> (es un tipo válido en PHP).</li></ul><p><a class="image" href="/Archivo:FuncionSinParametrosReales.png"><img height="206" width="375" src="/images/c/c9/FuncionSinParametrosReales.png" alt="FuncionSinParametrosReales.png"></a></p></td></tr></tbody></table>

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Invocar con 1 parámetro real</p></td></tr><tr><td></td><td><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw1">echo</span> <span class="st0">"Invocando a &lt;strong&gt;verTipoParametros(5)&lt;/strong&gt;&lt;hr /&gt;"</span><span class="sy0">;</span>
verTipoParametros<span class="br0">(</span><span class="nu0">5</span><span class="br0">)</span><span class="sy0">;</span></pre></div><ul><li>En este caso invocamos con un solo parámetro de tipo entero.</li></ul><p><a class="image" href="/Archivo:Funcion1ParametrosReal.png"><img height="206" width="380" src="/images/d/d5/Funcion1ParametrosReal.png" alt="Funcion1ParametrosReal.png"></a></p></td></tr></tbody></table>

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Invocar con 2 parámetros reales</p></td></tr><tr><td></td><td><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw1">echo</span> <span class="st0">"Invocando a &lt;strong&gt;verTipoParametros(5,7)&lt;/strong&gt;&lt;hr /&gt;"</span><span class="sy0">;</span>
verTipoParametros<span class="br0">(</span><span class="nu0">5</span><span class="sy0">,</span><span class="nu0">7</span><span class="br0">)</span><span class="sy0">;</span></pre></div><ul><li>En este caso invocamos con dos parámetros de tipo entero.</li><li>Los parámetros dentro de la función serán tres: dos con valor entero y el tercero con valor y tipo <b>null</b>.</li></ul><p><a class="image" href="/Archivo:Funcion2ParametrosReal.png"><img height="214" width="375" src="/images/3/39/Funcion2ParametrosReal.png" alt="Funcion2ParametrosReal.png"></a></p></td></tr></tbody></table>

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Invocar con 3 parámetros reales</p></td></tr><tr><td></td><td><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw1">echo</span> <span class="st0">"Invocando a &lt;strong&gt;verTipoParametros('pedro',5,9)&lt;/strong&gt;&lt;hr /&gt;"</span><span class="sy0">;</span>
verTipoParametros<span class="br0">(</span><span class="st_h">'pedro'</span><span class="sy0">,</span><span class="nu0">5</span><span class="sy0">,</span><span class="nu0">9</span><span class="br0">)</span><span class="sy0">;</span></pre></div><ul><li>En este caso pasamos tres parámetros: el primero de tipo string y los otros dos de tipo entero.</li></ul><p><a class="image" href="/Archivo:Funcion3ParametrosReal.png"><img height="208" width="498" src="/images/8/85/Funcion3ParametrosReal.png" alt="Funcion3ParametrosReal.png"></a></p></td></tr></tbody></table>

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Invocar con 3 parámetros reales, uno de ellos un <b>array</b></p></td></tr><tr><td></td><td><div dir="ltr" class="mw-geshi mw-code mw-content-ltr"><pre class="de1"><span class="kw1">echo</span> <span class="st0">"Invocando a &lt;strong&gt;verTipoParametros([1,4,'maría'], true, 'sonia')&lt;/strong&gt;&lt;hr /&gt;"</span><span class="sy0">;</span>
verTipoParametros<span class="br0">(</span><span class="br0">[</span><span class="nu0">1</span><span class="sy0">,</span><span class="nu0">4</span><span class="sy0">,</span><span class="st_h">'maría'</span><span class="br0">]</span><span class="sy0">,</span> <span class="kw4">true</span><span class="sy0">,</span> <span class="st_h">'sonia'</span><span class="br0">)</span><span class="sy0">;</span></pre></div><ul><li>Ahora igualmente pasamos tres parámetros, pero uno de ellos es un array.</li></ul><p><a class="image" href="/Archivo:FuncionParametroRealArray.png"><img height="270" width="467" src="/images/f/fd/FuncionParametroRealArray.png" alt="FuncionParametroRealArray.png"></a></p></td></tr></tbody></table>

#### Sobrecargando el constructor

-   Usando esta forma de trabajar, vamos a _sobrecargar_ el constructor de una clase.
-   Tomemos como ejemplo una clase **Racional**. Un número racional es un objeto que tiene numerador y denominador.

[![ClaseRacional.png](https://es.wikieducator.org/images/3/33/ClaseRacional.png)](https://es.wikieducator.org/Archivo:ClaseRacional.png)

-   Queremos permitir crear el objeto de distintas formas:

```
$r1 \= new Racional("8/5"); /\* 8/5 \*/
$r2 \= new Racional(5,4);   /\* 5/4 \*/
$r3 \= new Racional(5);     /\* 5/1 \*/
$r4 \= new Racional();      /\* 1/1 \*/
```

-   Necesitamos que el constructor pueda responder a todas las situaciones.
-   Aplicando los conceptos vistos, solo tenemos que comprobar **de qué tipo** son los parámetros.

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** Recordar que _null_ también es un tipo.

-   Vemos que podemos tener 0, 1 o 2 parámetros.

Por lo tanto, el constructor tendrá dos parámetros opcionales.

```
public function \_\_construct($num \= 1, $den \= 1) {
    ...
}
```

-   Especificamos el código de cómo se podría implementar:

```
class Racional {
 
    private $num;
    private $den;
 
    public function \_\_construct($num \= 1, $den \= 1) {
        // opciones:
        // new Racional()       => 1/1
        // new Racional(5)      => 5/1
        // new Racional("5/2")  => 5/2
        // new Racional(5,2)    => 5/2
        // Otra situación: no se instancia correctamente
 
        if (is\_string($num)) {
            $numero \= explode("/", $num);
            $num \= $numero\[0\];
            $den \= $numero\[1\];
        }
        $this\->num \= $num; 
        $this\->den \= $den;
    }
 
    /\* Método para visualizar el objeto como cadena de caracteres \*/
    public function \_\_toString() {
        return ($this\->num . "/" . $this\->den);
    }
 
    // Métodos privados para asignar valores según la forma de invocación
    private function racionalNum($num) {
        $this\->num \= $num;
        $this\->den \= 1;
    }
 
    /\*\*
     \* @param string $num número racional del tipo "a/b"
     \* Hay muchas formas de poder descomponer esa cadena en dos números.
     \*/
    public function racionalCadena($num) {
        $partes \= explode("/", $num);
        $this\->num \= (int) $partes\[0\];
        $this\->den \= (int) $partes\[1\];
    }
 
    public function racionalVacio() {
        $this\->num \= 1;
        $this\->den \= 1;
    }
 
    /\* En este caso, si los valores son incorrectos, asigno el racional 1/1 \*/
    public function racionalNumDen($num, $den) {
        if (is\_numeric($num) && is\_numeric($den)) {
            $this\->num \= $num;
            $this\->den \= $den;
        } else {
            $this\->num \= 1;
            $this\->den \= 1;
        }
    }
}
```

Esta sería una posibilidad, pero podemos crear un código más compacto.

En la siguiente versión inicializamos los parámetros con un valor por defecto (1). Posteriormente, si el primer parámetro es una cadena, se divide en numerador y denominador. Hecho esto, solo queda asignar los valores a los atributos.

```
public function \_\_construct($num \= 1, $den \= 1){
    if (is\_string($num)){
        $numero \= explode("/", $num);
        $num \= $numero\[0\];
        $den \= $numero\[1\];
    }
    $this\->num \= $num;
    $this\->den \= $den;
}
```

-   Probamos este constructor con el siguiente código:

```
$a \= new Racional();
$b \= new Racional(5);
$c \= new Racional(5,6);
$d \= new Racional("6/6");
 
echo "Valor del racional \\$a = $a <br />";
echo "Valor del racional \\$b = $b <br />";
echo "Valor del racional \\$c = $c <br />";
echo "Valor del racional \\$d = $d <br />";
```

-   Mostrando los siguientes resultados:
```
Valor del racional $a = 1/1  
Valor del racional $b = 5/1  
Valor del racional $c = 5/6  
Valor del racional $d = 6/6  

```

#### Sobrecarga con \_\_call(...)

-   Otra forma de lograr un comportamiento similar es usando el método mágico **\_\_call($funcion, $parametros)**.

[![Icon present.gif](https://es.wikieducator.org/images/1/1c/Icon_present.gif)](https://es.wikieducator.org/Archivo:Icon_present.gif)

**Tip:** El método mágico \_\_call(...) se ejecuta cuando invocamos un método que no existe en la clase.

-   Queremos usar un método llamado **asigna()** que nos permita cambiar el valor de un racional.
-   La forma de aportar el nuevo valor será la misma que la de construir el objeto.

```
$r1 \= new Racional();      // construye el objeto 1/1
$r1\->asigna("6/4");        // ahora el objeto vale 6/4
$r1\->asigna();             // ahora el objeto vale 1/1
$r1\->asigna(8);            // ahora el objeto vale 8/1
$r1\->asigna(124, 6);       // ahora el objeto vale 124/6
```

-   La forma de proceder será usando los métodos privados creados anteriormente.
-   El siguiente código implementa la solución:

```
public function \_\_call($metodo, $argumentos) {
    if ($metodo \== "asigna") {
        switch (count($argumentos)) {
            case 0:
                $this\->racionalVacio();
                break;
            case 2:
                $this\->racionalNumDen($argumentos\[0\], $argumentos\[1\]);
                break;
            case 1:
                if (is\_int($argumentos\[0\])) {
                    $this\->racionalNum($argumentos\[0\]);
                } else {
                    $this\->racionalCadena($argumentos\[0\]);
                }
                break;
        }
    }
}
```

#### Métodos _static_ vs _no static_

-   En PHP, la idea de **static** es igual que en cualquier lenguaje de programación orientado a objetos.
-   Cuando un elemento (atributo o método) es estático, ese elemento es compartido por todos los objetos de la clase y persiste en memoria con su contenido mientras exista al menos un objeto de esa clase.
-   Como no pertenece a cada objeto individual, sino a la clase en general, también se les llama **atributos o métodos de clase**.
-   Para acceder a un elemento estático, necesitamos nombrar la clase (no el objeto). En PHP podemos hacerlo usando el operador **self** o el propio nombre de la clase junto con el operador de resolución de ámbito **::**.

[![Icon activity.jpg](https://es.wikieducator.org/images/4/4e/Icon_activity.jpg)](https://es.wikieducator.org/Archivo:Icon_activity.jpg)

Usar constantes y elementos estáticos

Como ejemplo, vamos a implementar una clase **Factura** con los siguientes requisitos

-   La factura tendrá una constante llamada **IVA**.
-   Tendremos un atributo estático que especificará el número de facturas creadas.
-   Los atributos de cada factura serán **importe\_bruto** y **fecha**.
-   Tendrá un método **generarFactura()** que mostrará:
1.  Factura de XXXX (el nombre se recibirá como argumento).
2.  Fecha (atributo).
3.  Importe base (atributo).
4.  IVA aplicado (constante de la clase).
5.  Total bruto (importe base más el IVA).
-   En el archivo **index.php** crearemos 5 facturas, visualizaremos el número de facturas, eliminaremos dos de ellas y volveremos a visualizar el número de facturas. Finalmente imprimiremos las dos facturas restantes.

 \[[▼](#)\]Posible solución |
| --- |

-   Es muy común tener un atributo **static** que cuente cuántos objetos existen de una clase.
-   En la siguiente imagen se ilustra cómo al crear varios objetos, cada uno se instancia por separado en memoria:

[![Estatico1.png](https://es.wikieducator.org/images/thumb/3/33/Estatico1.png/400px-Estatico1.png)](https://es.wikieducator.org/Archivo:Estatico1.png)

-   Cuando añadimos un elemento estático, solo habrá **una copia** en memoria, compartida por todos los objetos de la clase:

[![Estatico2.png](https://es.wikieducator.org/images/thumb/c/ca/Estatico2.png/600px-Estatico2.png)](https://es.wikieducator.org/Archivo:Estatico2.png)

-   Vemos el código y cómo se accede al elemento estático:

```
<?php
class Racional {
    static public $cuenta\_racionales \= 0;
 
    private $num; // Numerador
    private $den; // Denominador
 
    public function \_\_construct($num, $den) {
        self::$cuenta\_racionales++;
        $this\->num \= $num;
        $this\->den \= $den;
    }
}
?>
```

-   El uso:

```
<?php
require\_once "Racional.php";
 
$r1 \= new Racional(5,4);
$r2 \= new Racional(5,4);
$r3 \= new Racional(5,4);
 
echo "<h1>Ahora tenemos " . Racional::$cuenta\_racionales . " objetos Racional</h1>";
 
$r4 \= new Racional(5,4);
$r5 \= new Racional(5,4);
 
echo "<h1>Ahora tenemos " . Racional::$cuenta\_racionales . " objetos Racional</h1>";
 
$r6 \= new Racional(5,4);
$r7 \= new Racional(5,4);
 
// Observa (y esto es propio de PHP) que puedo acceder a un elemento estático
// tanto a través del nombre de la clase como desde un objeto
echo "<h2>Podemos acceder con los objetos:</h2>";
echo "<h3>Según r1: " . $r1::$cuenta\_racionales . "</h3>";
echo "<h3>Según r2: " . $r2::$cuenta\_racionales . "</h3>";
echo "<h3>Según r3: " . $r3::$cuenta\_racionales . "</h3>";
echo "<h3>Según la clase: " . Racional::$cuenta\_racionales . "</h3>";
?>
```

-   La salida:

[![AppEstatica1.png](https://es.wikieducator.org/images/e/ed/AppEstatica1.png)](https://es.wikieducator.org/Archivo:AppEstatica1.png)

\---

-   Vamos a implementar las operaciones con números racionales.

Antes, recordemos las operaciones básicas:

Sumar

[![Suma racionales.png](https://es.wikieducator.org/images/0/07/Suma_racionales.png)](https://es.wikieducator.org/Archivo:Suma_racionales.png)

Restar

[![Resta racionales.png](https://es.wikieducator.org/images/b/b9/Resta_racionales.png)](https://es.wikieducator.org/Archivo:Resta_racionales.png)

Multiplicar

[![Mult racionales.png](https://es.wikieducator.org/images/d/d3/Mult_racionales.png)](https://es.wikieducator.org/Archivo:Mult_racionales.png)

Dividir

[![Division racional.png](https://es.wikieducator.org/images/3/38/Division_racional.png)](https://es.wikieducator.org/Archivo:Division_racional.png)

-   Si la operación la implementamos como un método **no estático**, lo que estaremos haciendo es sumar al objeto actual otro objeto **Racional** que pasamos como argumento.

Podemos modificar el objeto actual o devolver un nuevo objeto (lo más correcto).

```
/\*\*
 \* Suma al racional actual el racional recibido como parámetro.
 \* @param Racional $n1
 \* @return Racional
 \*/
public function sumar(Racional $n1) {
    $den \= $this\->den \* $n1\->getDen();
    $num \= $this\->num \* $n1\->getDen() + $this\->den \* $n1\->getNum();
    return new Racional($num, $den);
}
```

-   Para usarlo:

```
$r1 \= new Racional(7,6);
$r2 \= new Racional(9,4);
 
$r3 \= $r1\->sumar($r2);
echo "$r1 + $r2 = $r3";
```

-   La salida:

[![SumarNoEstatico.png](https://es.wikieducator.org/images/8/83/SumarNoEstatico.png)](https://es.wikieducator.org/Archivo:SumarNoEstatico.png)

\---

-   Si la operación la realizamos como un método **estático**, estaremos sumando **dos objetos Racional** y devolviendo un nuevo objeto como resultado:

```
static public function sum\_static(Racional $r1, Racional $r2){
    $n \= $r1\->getNum() \* $r2\->getDen() + $r1\->getDen() \* $r2\->getNum();
    $d \= $r1\->getDen() \* $r2\->getDen();
    return new Racional($n, $d);
}
```

-   Para usarlo:

```
$r1 \= new Racional(7,6);
$r2 \= new Racional(9,4);
 
$r3 \= Racional::sum\_static($r1, $r2);
echo "$r1 + $r2 = $r3";
```

-   La salida:

[![SumarEstatico.png](https://es.wikieducator.org/images/a/ae/SumarEstatico.png)](https://es.wikieducator.org/Archivo:SumarEstatico.png)

### Herencia

-   La herencia es un mecanismo de programación que permite crear una jerarquía en los componentes _software_, que se van especializando.
-   Es un principio de abstracción mediante el cual podemos crear una jerarquía de clases, con una raíz que contiene los elementos comunes y nodos que representan clases especializadas.
-   La idea es definir una clase con ciertas características comunes (atributos, métodos). Posteriormente, crearemos otras clases a partir de la ya existente, heredando implícitamente los atributos y métodos como parte de su estructura o composición.
-   Es una característica muy natural. Por ejemplo:
```
 - Personas → (Médicos, Bailarines)  
 - Vehículos → (Terrestres → Coche, Moto) / (Acuáticos → Barco, Lancha)  

```

[![Herencia.png](https://es.wikieducator.org/images/3/35/Herencia.png)](https://es.wikieducator.org/Archivo:Herencia.png)

-   La herencia es una forma de obtener características comunes por separado y luego especializarlas, evitando redundancias.
-   Facilita la reutilización y la adaptación del código.

La herencia implica declarar jerarquías de clases

-   En la raíz de la jerarquía establecemos la parte o estructura común a todas las clases, y posteriormente vamos especializando las diferencias de cada una.

[![Jerarquia clases 1.png](https://es.wikieducator.org/images/5/5d/Jerarquia_clases_1.png)](https://es.wikieducator.org/Archivo:Jerarquia_clases_1.png)

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Puntos clave

Todos los atributos y métodos de una clase superior (supertipo) que sean públicos o **protegidos** son heredados por todas las clases derivadas (subtipos).

-   Para establecer una jerarquía, usamos la palabra reservada **extends** en las clases que heredan.
-   Vamos a verlo con un ejemplo:

[![Jerarquia ambulatoria 1.png](https://es.wikieducator.org/images/c/cd/Jerarquia_ambulatoria_1.png)](https://es.wikieducator.org/Archivo:Jerarquia_ambulatoria_1.png)

-   Primero establecemos la clase **Persona**:

```
<?php
class Persona {
    protected $nombre;
    protected $direccion;
    protected $edad;
    protected $frase;
 
    public function \_\_construct(string $n, string $d, int $e){
        $this\->nombre \= $n;
        $this\->direccion \= $d;
        $this\->edad \= $e;
    }
 
    public function establecer\_frase(string $frase){
        $this\->frase \= $frase;
    }
 
    public function hablar(){
        echo $this\->frase;
    }
}
?>
```

-   Ahora establecemos la clase que hereda de Persona:

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Principios del uso de la herencia

Todos los atributos y métodos públicos y protegidos del supertipo **Persona** son también de **Sanitario**.

En un momento dado, podemos invocar métodos del supertipo usando el operador **parent** junto con el operador de resolución de ámbito **::**.

```
<?php
class Sanitario extends Persona {
    protected $centroSalud;
    protected $yearTitulacion;
 
    public function \_\_construct(string $n, string $d, int $e, string $centro, int $year) {
        parent::\_\_construct($n, $d, $e);
        $this\->centroSalud \= $centro;
        $this\->yearTitulacion \= $year;
    }
 
    public function mostrarInfo(){
        echo "$this->nombre trabaja en $this->centroSalud y obtuvo su título en $this->yearTitulacion.";
    }
}
?>
```

\---

-   Vemos dos ejemplos para explicar de forma práctica este concepto.

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Herencia: gestión de personal en un ambulatorio</p></td></tr><tr><td></td><td><ul><li>Se pide gestionar un ambulatorio.</li><li>Para ello haremos solo el diagrama de clases y su implementación a nivel básico (sin entrar en detalles).</li><li>Tras realizar el análisis, se determina que se pretende gestionar los datos de los empleados y anotar las acciones básicas que realizan.</li></ul><dl><dt>Encontramos los siguientes elementos, que especificamos como clases</dt><dd></dd></dl><ul><li>Conserjes</li><li>Enfermeras</li><li>Médicas</li></ul><p>Las propiedades (atributos) y métodos de cada clase se representan en los siguientes diagramas:</p><ul class="gallery mw-gallery-traditional"><li class="gallerybox"><div><div class="thumb"><p><a class="image" href="/Archivo:ClaseConserje.png"><img height="120" width="100" src="/images/thumb/4/42/ClaseConserje.png/100px-ClaseConserje.png" alt=""></a></p></div><p>Clase Conserje</p></div></li><li class="gallerybox"><div><div class="thumb"><p><a class="image" href="/Archivo:ClaseEnfermera.png"><img height="120" width="99" src="/images/thumb/0/0c/ClaseEnfermera.png/99px-ClaseEnfermera.png" alt=""></a></p></div><p>Clase Enfermera</p></div></li><li class="gallerybox"><div><div class="thumb"><p><a class="image" href="/Archivo:ClaseMedica.png"><img height="120" width="99" src="/images/thumb/5/53/ClaseMedica.png/99px-ClaseMedica.png" alt=""></a></p></div><p>Clase Médica</p></div></li></ul><ul><li>Claramente vemos que todos ellos comparten varios elementos comunes.</li><li>Esto nos permite crear una clase genérica, por ejemplo <b>personalAmbulatorio</b>.</li><li>Posteriormente crearemos especializaciones de esta clase con los elementos particulares.</li></ul><p>El diagrama podría quedar así:</p><div class="center"><p><a class="image" href="/Archivo:JerarquiaPersonaAmbulatorio.png"><img srcset="/images/thumb/1/19/JerarquiaPersonaAmbulatorio.png/600px-JerarquiaPersonaAmbulatorio.png 1.5x, /images/1/19/JerarquiaPersonaAmbulatorio.png 2x" height="245" width="400" src="/images/thumb/1/19/JerarquiaPersonaAmbulatorio.png/400px-JerarquiaPersonaAmbulatorio.png" alt="JerarquiaPersonaAmbulatorio.png"></a></p></div><ul><li>Ver la aplicación ejecutándose:</li></ul><p><a href="http://manuel.infenlaces.com/dwes/ejercicios/T6_Ambulatorio/" class="external free" rel="nofollow">http://manuel.infenlaces.com/dwes/ejercicios/T6_Ambulatorio/</a></p><table id="collapsibleTable2" class="tws collapsible collapsed"><tbody><tr><th><span>[<a href="#" id="collapseButton2">▼</a>]</span>Posible index de uso</th></tr></tbody></table><hr></td></tr></tbody></table>

#### Clases Abstractas

-   Cuando realizamos jerarquías, muchas veces encontramos métodos comunes a varias clases.

Esto implicaría que ese método debería pertenecer a una superclase (o clase padre), de la que luego se heredará.

-   Pero puede ocurrir que, aunque el concepto del método sea común a todas las clases, la forma de implementarlo sea diferente en cada una.

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>Clase abstracta</p></td></tr><tr><td></td><td><ul><li>Ejemplo ilustrativo:</li></ul><p><a title="Archivo:ClaseAbstracta.png" class="new" href="/Special:UploadWizard?wpDestFile=ClaseAbstracta.png">Archivo:ClaseAbstracta.png</a></p></td></tr></tbody></table>

-   En este caso, la forma correcta de proceder es especificar el método en la clase superior y dejar su implementación a las clases derivadas.
-   El método especificado en la clase superior será un método sin código, conocido como **método abstracto**, y la clase donde se define pasa a ser una **clase abstracta**.

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Clase abstracta

-   Es aquella clase que tiene uno o más métodos abstractos.

[![Icon define.gif](https://es.wikieducator.org/images/f/f0/Icon_define.gif)](https://es.wikieducator.org/Archivo:Icon_define.gif)

Método abstracto

-   Es un método que no tiene código asociado.
-   Su implementación se realizará en las clases derivadas.

[![Icon key points.gif](https://es.wikieducator.org/images/2/25/Icon_key_points.gif)](https://es.wikieducator.org/Archivo:Icon_key_points.gif)

Puntos clave

Nunca podremos instanciar un objeto de una clase abstracta.

-   Esto es lógico, ya que ese objeto no tendría instrucciones para ejecutar sus métodos abstractos.

-   Vamos a plantear un ejemplo práctico:

<table><tbody><tr><td><p><a class="image" href="/Archivo:Icon_casestudy.gif"><img height="48" width="48" src="/images/6/61/Icon_casestudy.gif" alt="Icon casestudy.gif"></a></p></td><td><p>App de Geometría</p></td></tr><tr><td></td><td>{{{1}}}</td></tr></tbody></table>