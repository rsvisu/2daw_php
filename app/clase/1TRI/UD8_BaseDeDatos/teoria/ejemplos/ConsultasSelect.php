<?php
/**
 * CONSULTAS SELECT CON QUERY()
 *
 * Cuando ejecutamos SELECT con query(), el método retorna un objeto mysqli_result
 * Este objeto contiene las filas resultado y métodos para recorrerlas.
 *
 * Conceptos clave:
 * - mysqli_result: objeto que contiene los resultados
 * - fetch_array(), fetch_assoc(), fetch_row(), fetch_object(), fetch_all()
 * - Atributos num_rows y field_count
 * - Liberar resultados con free()
 *
 * ADVERTENCIA: Este método (query() sin consultas preparadas) NO DEBE usarse
 * con datos proporcionados directamente por el usuario para evitar la inyección SQL.
 */

use mysqli;
use mysqli_result;
use mysqli_sql_exception;

class ConsultasSelect {
    private mysqli $con;
    public function __construct(mysqli $con) {
        $this->con = $con;
    }

    /**
     * FETCH_ARRAY() - Array mixto (indexado + asociativo)
     *
     * Retorna cada fila como un array que puede accederse:
     * - Por índice numérico: $fila[0], $fila[1], ...
     * - Por nombre de columna: $fila['nombre'], $fila['precio'], ...
     */
    public function ejemploFetchArray(): void {
        echo "<h3>1. fetch_array() - Array mixto</h3>";

        $sentencia = "SELECT * FROM producto WHERE pvp < 200";
        // mysqli::query() ejecuta la consulta y devuelve el resultado.
        $resultado = $this->con->query($sentencia);

        if (!$resultado) {
            // query() devuelve FALSE si hay un error en la sintaxis SQL
            echo "Error en SELECT: " . $this->con->error;
            return;
        }

        // Información sobre el objeto mysqli_result
        echo "Filas obtenidas: " . $resultado->num_rows . "<br>";
        echo "Columnas: " . $resultado->field_count . "<br><br>";

        // Recorrer las filas
        // fetch_array() retorna la siguiente fila o null cuando no hay más.
        // Por defecto, retorna un array que duplica los datos (índices numéricos y asociativos).
        echo "<table border='1'>";
        echo "<tr><th>Código</th><th>Nombre</th><th>Precio</th></tr>";

        while ($fila = $resultado->fetch_array()) {
            // Acceso por índice numérico (posición 0 de la consulta: cod)
            echo "<tr>";
            echo "<td>" . $fila[0] . "</td>";

            // Acceso por nombre de columna (asociativo)
            echo "<td>" . $fila['nombre_corto'] . "</td>";
            echo "<td>" . $fila['pvp'] . "€</td>";
            echo "</tr>";
        }
        echo "</table><br>";

        // IMPORTANTE: liberar el resultado para liberar memoria
        // Esto es esencial para consultas grandes o en bucles.
        $resultado->free();
        // Si no se llama a free(), PHP lo liberará automáticamente al final del script,
        // pero es mejor práctica hacerlo de forma manual.
    }

    /**
     * FETCH_ASSOC() - Array asociativo solamente
     *
     * Retorna cada fila como array asociativo (solo acceso por nombre de columna).
     * Es el más usado en PHP porque el código es más legible y robusto ante
     * cambios en el orden de las columnas en la sentencia SELECT.
     */
    public function ejemploFetchAssoc(): void {
        echo "<h3>2. fetch_assoc() - Array asociativo</h3>";

        $sentencia = "SELECT cod, nombre_corto, pvp FROM producto LIMIT 5";
        $resultado = $this->con->query($sentencia);

        if ($resultado) {
            echo "<ul>";

            // Solo podemos acceder por nombre de columna (clave)
            while ($fila = $resultado->fetch_assoc()) {
                echo "<li>";
                echo "Producto: {$fila['nombre_corto']} - ";
                echo "Precio: {$fila['pvp']}€";
                echo "</li>";
            }

            echo "</ul>";
            $resultado->free();
        }
    }

    /**
     * FETCH_ROW() - Array indexado solamente
     *
     * Retorna cada fila como array indexado (solo acceso por número).
     * Útil cuando no importan los nombres de las columnas o para un rendimiento ligeramente superior.
     */
    public function ejemploFetchRow(): void {
        echo "<h3>3. fetch_row() - Array indexado</h3>";

        $sentencia = "SELECT nombre_corto, pvp FROM producto LIMIT 3";
        $resultado = $this->con->query($sentencia);

        if ($resultado) {
            echo "<ol>";

            // Solo acceso por índice numérico: $fila[0] para nombre_corto, $fila[1] para pvp
            while ($fila = $resultado->fetch_row()) {
                echo "<li>{$fila[0]} cuesta {$fila[1]}€</li>";
            }

            echo "</ol>";
            $resultado->free();
        }
    }

    /**
     * FETCH_OBJECT() - Objeto con propiedades
     *
     * Retorna cada fila como un objeto estándar de PHP donde cada columna
     * es una propiedad pública de ese objeto (p. ej., $objeto->columna).
     */
    public function ejemploFetchObject(): void {
        echo "<h3>4. fetch_object() - Objeto</h3>";

        $sentencia = "SELECT cod, nombre_corto, pvp FROM producto LIMIT 3";
        $resultado = $this->con->query($sentencia);

        if ($resultado) {
            echo "<ul>";

            // Cada fila es un objeto ($producto) con propiedades que coinciden
            // con los nombres de las columnas.
            while ($producto = $resultado->fetch_object()) {
                echo "<li>";
                echo "Código: $producto->cod - ";
                echo "Nombre: $producto->nombre_corto - ";
                echo "Precio: $producto->pvp€";
                echo "</li>";
            }

            echo "</ul>";
            $resultado->free();
        }
    }

    /**
     * FETCH_ALL() - Carga el resultado completo en un array
     *
     * Retorna todas las filas como un único array multidimensional.
     * IMPORTANTE: Requiere la extensión MySQL Native Driver (mysqlnd).
     * No se recomienda para resultados muy grandes por riesgo de agotar la memoria.
     */
    public function ejemploFetchAll(): void {
        echo "<h3>5. fetch_all() - Array completo</h3>";

        $sentencia = "SELECT cod, nombre_corto FROM producto LIMIT 4";
        $resultado = $this->con->query($sentencia);

        if ($resultado) {
            // El primer parámetro define el formato:
            // MYSQLI_ASSOC (asociativo), MYSQLI_NUM (indexado), MYSQLI_BOTH (ambos)
            $productos = $resultado->fetch_all(MYSQLI_ASSOC);

            echo "<p>Cargadas " . count($productos) . " filas completas en memoria.</p>";
            echo "<ul>";
            foreach ($productos as $producto) {
                echo "<li>{$producto['cod']} - {$producto['nombre_corto']}</li>";
            }
            echo "</ul>";

            $resultado->free(); // Liberar el objeto mysqli_result
            // $productos sigue existiendo en memoria de PHP como un array.
        } else {
            echo "Error en SELECT: " . $this->con->error;
        }
    }

    /**
     * EJEMPLO COMPLETO: Tabla HTML con todos los productos
     *
     * Muestra un ejemplo realista de cómo presentar datos en una tabla
     */
    public function mostrarTablaProductos(): void {
        // La numeración ha cambiado debido a la inserción de fetch_all()
        echo "<h3>6. Tabla completa de productos</h3>";

        $sentencia = "SELECT cod, nombre_corto, pvp, familia 
                      FROM producto 
                      WHERE pvp < 500 
                      ORDER BY pvp DESC";

        $resultado = $this->con->query($sentencia);

        if (!$resultado) {
            echo "Error: " . $this->con->error;
            return;
        }

        // Verificar si hay resultados usando num_rows
        if ($resultado->num_rows === 0) {
            echo "<p>No se encontraron productos</p>";
            $resultado->free();
            return;
        }

        echo "<p>Total de productos: {$resultado->num_rows}</p>";

        echo "<table border='1' cellpadding='5'>";
        echo "<thead>";
        echo "<tr style='background-color: #ddd;'>";
        // Los encabezados de la tabla usan los nombres de las columnas seleccionadas.
        echo "<th>Código</th><th>Producto</th><th>Precio</th><th>Familia</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // fetch_assoc() es ideal para este tipo de recorrido (bajo consumo de memoria)
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$fila['cod']}</td>";
            echo "<td>{$fila['nombre_corto']}</td>";
            echo "<td style='text-align: right;'>{$fila['pvp']}€</td>";
            echo "<td>{$fila['familia']}</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        // Siempre liberar los resultados
        $resultado->free();
    }

    /**
     * MÉT0DO GENÉRICO para obtener todas las filas como array
     * Similar al que usa tu profesor: getContentTable()
     *
     * Utiliza fetch_assoc() para crear un array de arrays asociativos.
     */
    public function obtenerFilasTabla(string $tabla): array {
        $filas = [];
        // CUIDADO: La variable $tabla es un nombre de tabla, que generalmente no viene
        // del usuario final, pero si lo hiciera, esta sentencia sería vulnerable.
        $sentencia = "SELECT * FROM $tabla";
        $resultado = $this->con->query($sentencia);

        if ($resultado) {
            // Guardar todas las filas en un array
            // ALTERNATIVA: return $resultado->fetch_all(MYSQLI_ASSOC) si mysqlnd está disponible.
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            $resultado->free();
        }

        return $filas; // Retorna un array vacío si falla la consulta
    }

    public function __destruct() {
        if (isset($this->con)) {
            // Cierra la conexión de base de datos cuando el objeto ConsultasSelect sea destruido
            $this->con->close();
        }
    }
}

// EJEMPLOS DE USO
echo "<h2>Consultas SELECT con query()</h2>";

// EJEMPLO: Se asume que $con es una conexión válida a mysqli
// $con = new mysqli("localhost", "usuario", "password", "database");
// $db = new ConsultasSelect($con);

/*
// Probar todos los métodos fetch
$db->ejemploFetchArray();
$db->ejemploFetchAssoc();
$db->ejemploFetchRow();
$db->ejemploFetchObject();
$db->ejemploFetchAll();
$db->mostrarTablaProductos();
*/

// Usar el mét0do genérico
echo "<h3>7. Método genérico obtenerFilasTabla()</h3>";
// $productos = $db->obtenerFilasTabla('producto');
/*
echo "<p>Total filas obtenidas: " . count($productos) . "</p>";
// foreach ($productos as $p) { print_r($p); echo "<br>"; }
*/

/**
 * RESUMEN IMPORTANTE:
 *
 * query() con SELECT retorna mysqli_result (o false si hay error)
 *
 * Métodos fetch para recorrer filas:
 * - fetch_array()  : array mixto (índice + asociativo)
 * - fetch_assoc()  : array asociativo (más usado para bucles)
 * - fetch_row()    : array indexado
 * - fetch_object() : objeto con propiedades
 * - fetch_all()    : array multidimensional completo (Requiere mysqlnd)
 *
 * Atributos de mysqli_result:
 * - $resultado->num_rows    : número de filas obtenidas
 * - $resultado->field_count : número de columnas
 *
 * IMPORTANTE:
 * - Siempre usar free() para liberar memoria del resultado en el cliente PHP.
 * - Usar fetch_all() con precaución en resultados muy grandes por el consumo de memoria.
 *
 * PROBLEMA: query() con concatenación directa es vulnerable a SQL Injection.
 * SOLUCIÓN: Usar consultas preparadas (Prepared Statements).
 */
?>

