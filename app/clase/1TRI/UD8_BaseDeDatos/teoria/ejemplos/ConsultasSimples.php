<?php
/**
 * CONSULTAS SIMPLES CON QUERY() - INSERT, UPDATE, DELETE
 *
 * Este archivo muestra cómo ejecutar sentencias DML (Data Manipulation Language)
 * que NO devuelven resultados (INSERT, UPDATE, DELETE) usando el mét0do query().
 *
 * Conceptos clave:
 * - Mét0do query() para ejecutar SQL (retorna TRUE/FALSE para DML)
 * - Atributo affected_rows: número de filas afectadas
 * - Atributo insert_id: último ID autogenerado
 * - Escapar caracteres con real_escape_string() (MEDIDA DE SEGURIDAD MÍNIMA)
 *
 * ADVERTENCIA: La concatenación directa de variables en la consulta
 * es altamente insegura (VULNERABLE A SQL INJECTION).
 */

use mysqli;
use mysqli_sql_exception;

class ConsultasSimples {
    private mysqli $con;
    public function __construct(mysqli $con) {
        $this->con = $con;
    }

    /**
     * INSERTAR datos en la tabla
     *
     * El mét0do query() retorna:
     * - true si la inserción fue exitosa
     * - false si hubo algún error (p.ej., violar una restricción NOT NULL)
     */
    public function insertarTienda(string $nombre, string $telefono): bool|string {
        // IMPORTANTE: Los valores string (varchar) deben ir entre comillas simples en SQL
        // Al concatenar la variable, la hacemos parte de la sentencia SQL,
        // lo que la hace vulnerable si $nombre contiene código malicioso.
        $sentencia = "INSERT INTO tienda (nombre, tlf) 
                      VALUES ('$nombre', '$telefono')";

        try {
            // Ejecutar la consulta
            $resultado = $this->con->query($sentencia);

            if ($resultado) {
                // affected_rows: Atributo de la conexión que indica cuántas filas cambiaron (1 en INSERT simple)
                $filasAfectadas = $this->con->affected_rows;

                // insert_id: Atributo de la conexión que obtiene el valor del campo AUTO_INCREMENT
                $idGenerado = $this->con->insert_id;

                echo "✓ Inserción exitosa<br>";
                echo "Filas insertadas: $filasAfectadas<br>";
                echo "ID generado: $idGenerado<br>";

                return true;
            } else {
                // Si el query() falla (retorna false), el error está en $this->con->error
                return "Error en INSERT: " . $this->con->error;
            }

        } catch (mysqli_sql_exception $e) {
            // Captura errores graves del motor MySQL (p.ej., clave duplicada, desconexión)
            return "Excepción INSERT: " . $e->getMessage();
        }
    }

    /**
     * ACTUALIZAR datos en la tabla
     *
     * UPDATE funciona igual que INSERT con query().
     * Usa affected_rows para saber cuántas filas se modificaron (puede ser 0 si no encuentra el WHERE).
     */
    public function actualizarTienda(string $nombreActual, string $nuevoNombre): bool|string {
        $sentencia = "UPDATE tienda 
                      SET nombre = '$nuevoNombre' 
                      WHERE nombre = '$nombreActual'";

        try {
            $resultado = $this->con->query($sentencia);

            if ($resultado) {
                // affected_rows es crucial para saber si la operación tuvo efecto
                $filasModificadas = $this->con->affected_rows;
                echo "✓ Actualización exitosa<br>";
                echo "Filas modificadas: $filasModificadas<br>";
                return true;
            } else {
                return "Error en UPDATE: " . $this->con->error;
            }

        } catch (mysqli_sql_exception $e) {
            return "Excepción UPDATE: " . $e->getMessage();
        }
    }

    /**
     * ELIMINAR datos de la tabla
     *
     * DELETE también usa query() y affected_rows.
     * Si affected_rows es 0, significa que la condición WHERE no coincidió con ninguna fila.
     */
    public function eliminarTienda(string $nombre): bool|string {
        $sentencia = "DELETE FROM tienda WHERE nombre = '$nombre'";

        try {
            $resultado = $this->con->query($sentencia);

            if ($resultado) {
                $filasEliminadas = $this->con->affected_rows;
                echo "✓ Eliminación exitosa<br>";
                echo "Filas eliminadas: $filasEliminadas<br>";
                return true;
            } else {
                return "Error en DELETE: " . $this->con->error;
            }

        } catch (mysqli_sql_exception $e) {
            return "Excepción DELETE: " . $e->getMessage();
        }
    }

    /**
     * ESCAPAR CARACTERES ESPECIALES (También como Prevención de Inyección SQL)
     *
     * Si el texto contiene comillas simples ('), la consulta SQL se rompe
     * y se abre la puerta a la inyección SQL, o simplemente a la rotura no intencionada.
     * Ejemplo problemático: "Technology's House" rompe la cadena SQL.
     *
     * Solución temporal/mínima: usar real_escape_string() antes de concatenar.
     */
    public function insertarConEscape(string $nombre, string $telefono): bool|string {
        // Escapar caracteres peligrosos
        // real_escape_string() añade una barra invertida (\) antes de caracteres como ', ", \ y NUL.
        // Esto asegura que los datos sean tratados como datos y no como parte de la sintaxis SQL.
        $nombreSeguro = $this->con->real_escape_string($nombre);
        $telefonoSeguro = $this->con->real_escape_string($telefono);

        $sentencia = "INSERT INTO tienda (nombre, tlf) 
                      VALUES ('$nombreSeguro', '$telefonoSeguro')";

        try {
            $resultado = $this->con->query($sentencia);

            if ($resultado) {
                echo "✓ Inserción con escape exitosa<br>";
                echo "ID generado: " . $this->con->insert_id . "<br>";
                return true;
            } else {
                return "Error: " . $this->con->error;
            }

        } catch (mysqli_sql_exception $e) {
            return "Excepción: " . $e->getMessage();
        }
    }

    public function __destruct() {
        if (isset($this->con)) {
            // Cierra la conexión al destruir el objeto
            $this->con->close();
        }
    }
}

// EJEMPLOS DE USO
echo "<h2>Ejemplos de INSERT, UPDATE, DELETE (query())</h2>";

// EJEMPLO: Se asume que $con es una conexión válida a mysqli
// $con = new mysqli("localhost", "usuario", "password", "database");
// $db = new ConsultasSimples($con);

// 1. Insertar una tienda
echo "<h3>1. INSERT</h3>";
// $db->insertarTienda('Tienda Centro', '111-155226');

// 2. Actualizar una tienda
echo "<h3>2. UPDATE</h3>";
// $db->actualizarTienda('Tienda Centro', 'Tienda Principal');

// 3. Insertar con caracteres especiales (comillas)
echo "<h3>3. INSERT con escape</h3>";
// El uso de real_escape_string es vital aquí para evitar la inyección
// $db->insertarConEscape("Technology's House", "555-1234");

// 4. Eliminar una tienda
echo "<h3>4. DELETE</h3>";
// $db->eliminarTienda('Tienda Principal');

/**
 * RESUMEN IMPORTANTE:
 *
 * query() retorna:
 * - true/false para INSERT, UPDATE, DELETE (operaciones DML que no devuelven datos)
 * - mysqli_result para SELECT (operación DQL que sí devuelve datos)
 *
 * Atributos útiles después de query():
 * - $con->affected_rows: filas modificadas/insertadas/eliminadas. Clave para verificar el éxito.
 * - $con->insert_id: último ID autogenerado. Clave para obtener la clave primaria de un nuevo registro.
 * - $con->error: descripción del error si falló.
 * - $con->errno: código numérico del error.
 *
 * **RIESGO DE SEGURIDAD (SQL INJECTION)**:
 * El uso de query() con concatenación directa ($sentencia = "...")
 * permite que un atacante inyecte código SQL a través de las variables.
 *
 * SOLUCIÓN PROFESIONAL:
 * Usar **Consultas Preparadas** (Prepared Statements) con `prepare()` y `bind_param()`.
 * Esto separa la lógica SQL de los datos, eliminando el riesgo de inyección.
 *
 */
?>