<?php
/**
 * CONSULTAS PREPARADAS (PREPARED STATEMENTS)
 *
 * Son la forma SEGURA de ejecutar consultas con datos del usuario.
 * Previenen inyecciones SQL automáticamente.
 *
 * Conceptos clave:
 * - mysqli_stmt: objeto de consulta preparada
 * - prepare(): preparar la consulta con placeholders (?)
 * - bind_param(): vincular valores a los placeholders
 * - execute(): ejecutar la consulta
 * - Tipos de parámetros: s (string), i (int), d (double), b (blob)
 */

use mysqli;
use mysqli_stmt;
use mysqli_sql_exception;

class ConsultasPreparadas {
    private mysqli $con;
    public function __construct(mysqli $con) {
        $this->con = $con;
    }


    /**
     * EJEMPLO 1: INSERT con consulta preparada
     *
     * Proceso:
     * 1. Crear objeto stmt con stmt_init()
     * 2. Preparar consulta con ? como placeholders
     * 3. Vincular valores con bind_param()
     * 4. Ejecutar con execute()
     * 5. Cerrar stmt
     */
    public function insertarFamilia(string $codigo, string $nombre): bool|string {
        // 1. Inicializar el statement (objeto que gestiona la consulta preparada)
        $stmt = $this->con->stmt_init();

        // 2. Preparar la consulta con ? como placeholders
        // Los ? serán reemplazados por los valores que vinculemos (bind_param)
        // La base de datos compila la consulta SQL en este punto.
        $sentencia = "INSERT INTO familia (cod, nombre) VALUES (?, ?)";

        // **EXPLICACIÓN ADICIONAL**
        // Se comprueba el resultado de prepare() porque la preparación podría fallar
        // si la sintaxis SQL es incorrecta (p. ej., nombre de tabla o columna errónea).
        // Si prepare() devuelve false, el proceso se detiene y se informa el error.
        if (!$stmt->prepare($sentencia)) {
            return "Error preparando: " . $stmt->error;
        }

        // 3. Vincular parámetros
        // Primer parámetro: tipos de datos ('ss' = 2 strings)
        // Siguientes parámetros: VARIABLES con los valores
        // IMPORTANTE: Deben ser VARIABLES, no valores directos. Esto permite a mysqli
        // gestionar correctamente la memoria y el flujo de datos.
        $stmt->bind_param('ss', $codigo, $nombre);

        // 4. Ejecutar la consulta
        try {
            // **EXPLICACIÓN ADICIONAL**
            // Se utiliza un bloque try-catch para capturar excepciones SQL.
            // Una excepción (mysqli_sql_exception) puede ocurrir por errores
            // de la base de datos durante la ejecución, como una violación
            // de clave única (duplicidad de 'cod' en este caso).
            if ($stmt->execute()) {
                echo "✓ Familia insertada correctamente<br>";
                echo "Filas afectadas: " . $stmt->affected_rows . "<br>";
                echo "ID generado: " . $stmt->insert_id . "<br>";
                // **EXPLICACIÓN ADICIONAL**
                // Es crucial llamar a close() en el objeto $stmt al finalizar,
                // ya sea que la ejecución haya tenido éxito o haya fallado.
                // Esto libera los recursos de memoria y los manejadores
                // de sentencia utilizados por la base de datos (tanto en el cliente
                // como en el servidor) para esta consulta.
                $stmt->close();
                return true;
            } else {
                $error = "Error ejecutando: " . $stmt->error;
                $stmt->close(); // Cerrar también en caso de error de ejecución
                return $error;
            }
        } catch (mysqli_sql_exception $e) {
            $stmt->close(); // Cerrar también si se lanza una excepción
            return "Excepción: " . $e->getMessage();
        }
    }

    /**
     * EJEMPLO 2: UPDATE con diferentes tipos de datos
     *
     * Tipos de parámetros en bind_param():
     * - 's': string (varchar, text, char, date, time)
     * - 'i': integer (int, tinyint, smallint, bigint)
     * - 'd': double (float, double, decimal)
     * - 'b': blob (binary data)
     */
    public function actualizarStock(string $producto, int $unidades): bool|string {
        $stmt = $this->con->stmt_init();

        // Consulta con 2 placeholders de diferentes tipos
        $sentencia = "UPDATE stock SET unidades = ? WHERE producto = ?";

        if (!$stmt->prepare($sentencia)) {
            return "Error preparando: " . $stmt->error;
        }

        // 'is' = primer parámetro integer, segundo string
        $stmt->bind_param('is', $unidades, $producto);

        try {
            if ($stmt->execute()) {
                echo "✓ Stock actualizado<br>";
                // affected_rows indica cuántas filas cambiaron (0 si no existe el producto)
                echo "Filas modificadas: " . $stmt->affected_rows . "<br>";
                $stmt->close();
                return true;
            } else {
                $error = $stmt->error;
                $stmt->close();
                return $error;
            }
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            return "Excepción: " . $e->getMessage();
        }
    }

    /**
     * EJEMPLO 3: DELETE con consulta preparada
     */
    public function eliminarProducto(string $codigo): bool|string {
        $stmt = $this->con->stmt_init();
        $sentencia = "DELETE FROM producto WHERE cod = ?";

        if (!$stmt->prepare($sentencia)) {
            return "Error: " . $stmt->error;
        }

        // El parámetro es un string ('s')
        $stmt->bind_param('s', $codigo);

        try {
            if ($stmt->execute()) {
                echo "✓ Producto eliminado<br>";
                // affected_rows indica cuántas filas se eliminaron
                echo "Filas eliminadas: " . $stmt->affected_rows . "<br>";
                $stmt->close();
                return true;
            } else {
                $error = $stmt->error;
                $stmt->close();
                return $error;
            }
        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            return "Excepción: " . $e->getMessage();
        }
    }

    /**
     * EJEMPLO 4: SELECT con bind_result()
     *
     * Para SELECT tenemos 2 opciones:
     * A) bind_result() + fetch() - (Opción tradicional, necesita bind_result() después de execute())
     * B) get_result() + fetch_assoc() - (Opción moderna, requiere mysqlnd)
     *
     * Este ejemplo muestra la opción A
     */
    public function buscarProductosPorPrecio(float $precioMaximo): void {
        echo "<h3>Productos con precio menor a $precioMaximo €</h3>";

        $stmt = $this->con->stmt_init();
        $sentencia = "SELECT cod, nombre_corto, pvp FROM producto WHERE pvp < ?";

        if (!$stmt->prepare($sentencia)) {
            echo "Error: " . $stmt->error;
            return;
        }

        // 'd' porque el precio es decimal/double
        $stmt->bind_param('d', $precioMaximo);

        if (!$stmt->execute()) {
            echo "Error ejecutando: " . $stmt->error;
            $stmt->close();
            return;
        }

        // Inicializar para evitar la advertencia del IDE/Linter
        $cod = $nombre = $pvp = null;

        // Vincular variables para recibir los resultados
        // IMPORTANTE: Una variable por cada columna del SELECT, en el orden exacto.
        $stmt->bind_result($cod, $nombre, $pvp);

        // Recorrer los resultados con fetch()
        // fetch() obtiene la siguiente fila y la coloca en las variables vinculadas
        echo "<ul>";
        while ($stmt->fetch()) {
            // Las variables $cod, $nombre, $pvp contienen los valores de cada fila
            echo "<li>$cod - $nombre: $pvp €</li>";
        }
        echo "</ul>";

        $stmt->close();
    }

    /**
     * EJEMPLO 5: SELECT con get_result() (más fácil y flexible)
     *
     * IMPORTANTE: Requiere que PHP tenga instalado mysqlnd
     * Esta es la forma preferida y más similar a query()
     */
    public function buscarProductosPorFamilia(string $familia): array {
        // prepare() es un atajo para stmt_init() + prepare()
        $stmt = $this->con->prepare(
            "SELECT cod, nombre_corto, pvp FROM producto WHERE familia = ?"
        );

        if (!$stmt) {
            // El error está en $this->con->error si prepare falla
            return [];
        }

        $stmt->bind_param('s', $familia);
        $stmt->execute();

        // get_result() retorna un mysqli_result como query()
        $resultado = $stmt->get_result();

        $productos = [];

        // Ahora podemos usar fetch_assoc() como siempre
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }

        $stmt->close();
        return $productos;
    }

    /**
     * EJEMPLO 6: Verificar usuario (como tu profesor)
     *
     * Ejemplo real de validación de login con consultas preparadas
     */
    public function validarUsuario(string $usuario, string $password): bool|string {
        $stmt = $this->con->prepare(
        // Cuidado: la contraseña debe estar hasheada en un entorno real.
            "SELECT * FROM usuarios WHERE nombre = ? AND password = ?"
        );

        if (!$stmt) {
            return "Error preparando: " . $this->con->error;
        }

        $stmt->bind_param('ss', $usuario, $password);
        $stmt->execute();

        // store_result() almacena el resultado en memoria
        // Necesario para poder usar num_rows (cuántas filas se devolvieron)
        $stmt->store_result();

        try {
            if ($stmt->num_rows > 0) {
                $stmt->close();
                return true; // Usuario encontrado
            }
            $stmt->close();
            return "Usuario o contraseña incorrectos"; // No se encontró coincidencia

        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            return "Error: " . $e->getMessage();
        }
    }

    /**
     * EJEMPLO 7: Múltiples ejecuciones de la misma consulta
     *
     * Una ventaja de las preparadas: se pueden ejecutar múltiples veces
     * eficientemente cambiando solo los parámetros. La preparación (compilación)
     * solo se hace una vez.
     */
    public function insertarVariosProductos(): void {
        echo "<h3>Insertar múltiples productos con la misma consulta</h3>";

        $stmt = $this->con->prepare(
            "INSERT INTO producto (cod, nombre_corto, pvp, familia) VALUES (?, ?, ?, ?)"
        );

        if (!$stmt) {
            echo "Error: " . $this->con->error;
            return;
        }

        // Array de productos a insertar
        $productos = [
            ['PROD1', 'Producto 1', 99.99, 'ELECTRO'],
            ['PROD2', 'Producto 2', 149.99, 'ELECTRO'],
            ['PROD3', 'Producto 3', 199.99, 'ELECTRO']
        ];

        foreach ($productos as $prod) {
            // Reutilizar la misma consulta preparada
            // Se re-vinculan los parámetros para los nuevos valores
            $stmt->bind_param('ssds', $prod[0], $prod[1], $prod[2], $prod[3]);

            if ($stmt->execute()) {
                echo "✓ Insertado: {$prod[1]}<br>";
            } else {
                echo "✗ Error: {$stmt->error}<br>";
            }
        }

        $stmt->close();
    }

    public function __destruct() {
        if (isset($this->con)) {
            // Es buena práctica cerrar la conexión de la base de datos
            // cuando el objeto ya no se va a usar.
            $this->con->close();
        }
    }
}

// EJEMPLOS DE USO
echo "<h2>Consultas Preparadas (Prepared Statements)</h2>";

// ASUMIMOS que se ha establecido una conexión $con a la base de datos
// y se pasa al constructor de ConsultasPreparadas.
// Este código de ejemplo es meramente ilustrativo para la clase.
// $db = new ConsultasPreparadas($con); // DESCOMENTAR en un entorno real

// 1. INSERT
echo "<h3>1. INSERT preparado</h3>";
// $db->insertarFamilia('TABLET', 'Tablets');

// 2. UPDATE
echo "<h3>2. UPDATE preparado</h3>";
// $db->actualizarStock('PAPNOTE01', 50);

// 3. SELECT con bind_result()
// $db->buscarProductosPorPrecio(200);

// 4. SELECT con get_result()
echo "<h3>4. SELECT con get_result()</h3>";
// $productos = $db->buscarProductosPorFamilia('PORT');
/*
foreach ($productos as $p) {
    echo "{$p['nombre_corto']} - {$p['pvp']}€<br>";
}
*/

// 5. Validar usuario
echo "<h3>5. Validar usuario</h3>";
// $resultado = $db->validarUsuario('admin', 'password123');
/*
echo is_bool($resultado) ? '✓ Login correcto' : "✗ $resultado";
echo "<br>";
*/

/**
 * RESUMEN IMPORTANTE:
 *
 * PROCESO DE CONSULTAS PREPARADAS:
 * 1. $stmt = $con->stmt_init() o $con->prepare()
 * 2. $stmt->prepare($sql_con_?)  <- La base de datos compila la consulta
 * 3. $stmt->bind_param('tipos', $var1, $var2, ...) <- Se vinculan los valores
 * 4. $stmt->execute() <- Se ejecuta la consulta ya compilada con los valores vinculados
 * 5. Para SELECT:
 * - Opción A: $stmt->bind_result() + fetch()
 * - Opción B: $stmt->get_result() + fetch_assoc()
 * 6. $stmt->close() <- LIBERAR RECURSOS
 *
 * TIPOS EN bind_param():
 * - 's' = string (varchar, text, char, date)
 * - 'i' = integer (int, bigint)
 * - 'd' = double (float, decimal)
 * - 'b' = blob (datos binarios)
 *
 * VENTAJAS:
 * - Previenen SQL Injection automáticamente (el valor no es interpretado como código SQL)
 * - Más eficientes si se ejecutan múltiples veces
 * - Separan claramente datos de la estructura SQL
 *
 * IMPORTANTE:
 * - bind_param() requiere VARIABLES, no valores directos
 * - Para usar num_rows con SELECT: llamar store_result() antes
 * - get_result() requiere extensión mysqlnd
 */
?>