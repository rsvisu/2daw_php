<?php
/**
 * PATRÓN SINGLETON PARA CONEXIÓN A BASE DE DATOS
 *
 * Este es el patrón que usa tu profesor. Asegura que solo exista
 * UNA instancia de la conexión a BD en toda la aplicación.
 * El objetivo es evitar la creación innecesaria de múltiples conexiones
 * a la base de datos, lo cual consume recursos del servidor.
 *
 * Conceptos clave:
 * - Constructor privado: nadie puede crear instancias directamente (new Singleton())
 * - Atributo estático $instance: guarda la única instancia creada
 * - Método estático getInstance(): punto de acceso global y controlado
 * - Variables de entorno con $_ENV (Separación de Configuración y Código)
 */

use mysqli;
use mysqli_sql_exception;

class Singleton {
    // 1. La única instancia de la clase (inicialmente null). Debe ser estática.
    private static ?BaseDatos $instance = null;

    // Credenciales de conexión
    private string $user;
    private string $password;
    private string $host;
    private string $database;

    // Objeto de conexión mysqli
    private mysqli $con;

    /**
     * CONSTRUCTOR PRIVADO
     *
     * Al ser privado, nadie puede hacer: new Singleton()
     * Solo se puede crear instancias desde dentro de esta clase (en getInstance()).
     * Esto es la CLAVE del patrón Singleton.
     */
    private function __construct() {
        // Leer credenciales desde variables de entorno ($_ENV)
        // Esto es más seguro que tenerlas hardcodeadas directamente en el código fuente.
        $this->user = $_ENV['DB_USER'] ?? 'root';
        $this->password = $_ENV['PASSWORD'] ?? 'root';
        $this->host = $_ENV['HOST'] ?? 'localhost';
        $this->database = $_ENV['DATABASE'] ?? 'dwes';

        try {
            // Intentar conectar
            $this->con = new mysqli(
                $this->host,
                $this->user,
                $this->password,
                $this->database
            );

            // Configurar para que mysqli lance excepciones en caso de error,
            // permitiendo capturarlas con try-catch (MYSQLI_REPORT_STRICT).
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            // Establecer charset UTF-8 (importante para caracteres especiales y codificación)
            $this->con->set_charset('utf8mb4');

        } catch (mysqli_sql_exception $e) {
            // Si falla la conexión, terminar la aplicación de forma controlada
            die("ERROR Conectando a BD: " . $e->getMessage());
        }
    }

    /**
     * MÉTODO ESTÁTICO getInstance()
     *
     * Esta es la única forma pública de obtener la instancia de la clase.
     * Implementa la lógica de "crear si no existe, devolver la existente si ya existe".
     *
     * @return BaseDatos la instancia única de la clase (y, por tanto, de la conexión)
     */
    public static function getInstance(): BaseDatos {
        // 2. Comprobar si la instancia aún no se ha creado (es null)
        if (self::$instance === null) {
            // Crear la instancia llamando al constructor privado (solo se hace esta vez)
            self::$instance = new BaseDatos();
            echo "🔵 Nueva instancia de BaseDatos creada (Conexión establecida)<br>";
        } else {
            echo "♻️ Reutilizando instancia existente (Conexión reutilizada)<br>";
        }

        return self::$instance;
    }

    /**
     * Obtener todas las tablas de la base de datos
     *
     * @return array nombres de las tablas
     */
    public function getAllTables(): array {
        // Consulta SQL para obtener los nombres de las tablas
        $sentencia = "SHOW TABLES";
        $res = $this->con->query($sentencia);

        $tables = [];

        // fetch_row() retorna array indexado (el nombre es el primer valor [0])
        while ($fila = $res->fetch_row()) {
            $tables[] = $fila[0];
        }

        $res->free(); // Liberar la memoria del resultado
        return $tables;
    }

    /**
     * Obtener todo el contenido de una tabla
     *
     * CUIDADO: Esta función es vulnerable si $table viene del usuario.
     * Aquí se asume que $table es pasado por código seguro.
     *
     * @param string $table nombre de la tabla
     * @return array array de arrays asociativos con las filas
     */
    public function getContentTable(string $table): array {
        $filas = [];

        // Para evitar inyección SQL en el nombre de la tabla, idealmente
        // se debería validar o listar en una "lista blanca".
        $sentencia = "SELECT * FROM $table";
        $res = $this->con->query($sentencia);

        if (!$res) {
            return []; // Retorna vacío si la tabla no existe o la query falla
        }

        // Obtener todas las filas como arrays asociativos
        while ($fila = $res->fetch_assoc()) {
            $filas[] = $fila;
        }

        $res->free();
        return $filas;
    }

    /**
     * Obtener los nombres de los campos de una tabla
     *
     * @param string $tabla nombre de la tabla
     * @return array nombres de los campos
     */
    public function getFieldNames(string $tabla): array {
        $sentencia = "DESCRIBE $tabla";
        $res = $this->con->query($sentencia);

        $campos = [];

        while ($fila = $res->fetch_row()) {
            // El nombre del campo está en el índice 0 de la descripción
            $campos[] = $fila[0];
        }

        $res->free();
        return $campos;
    }

    /**
     * REGISTRAR un nuevo usuario
     *
     * IMPORTANTE: Aquí el password debería estar ya hasheado (p.ej., con password_hash())
     * antes de llamar a esta función, NUNCA se debe guardar la contraseña en texto plano.
     *
     * @param string $usuario nombre de usuario
     * @param string $password password (ya hasheado)
     * @return bool|string true si éxito, mensaje de error si falla
     */
    public function registrar(string $usuario, string $password): bool|string {
        // Usar consulta preparada para prevenir SQL injection (es esencial aquí)
        $stmt = $this->con->prepare(
            "INSERT INTO usuarios (nombre, password) VALUES (?, ?)"
        );

        if (!$stmt) {
            return "Error preparando consulta: " . $this->con->error;
        }

        $stmt->bind_param('ss', $usuario, $password);

        try {
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }

            $error = "No se pudo insertar el usuario";
            $stmt->close();
            return $error;

        } catch (mysqli_sql_exception $e) {
            $stmt->close();

            // Manejar error específico de duplicado (violación de UNIQUE KEY o PRIMARY KEY)
            if ($e->getCode() === 1062) { // Código de error MySQL para 'Duplicate entry'
                return "El usuario '$usuario' ya existe";
            }

            return "Error insertando usuario: " . $e->getMessage();
        }
    }

    /**
     * VALIDAR USUARIO - Verificar login
     *
     * Este es el método que usa tu profesor para validar (asumiendo password en texto plano
     * para simplificar el ejemplo, pero en producción, SÓLO se guarda el hash y se usa password_verify()).
     *
     * @param string $usuario nombre de usuario
     * @param string $password password a verificar
     * @return bool|string true si válido, mensaje de error si no
     */
    public function validar_usuario(string $usuario, string $password): bool|string {
        // Consulta preparada (OBLIGATORIO) para prevenir SQL injection
        $stmt = $this->con->prepare(
            "SELECT * FROM usuarios WHERE nombre = ? AND password = ?"
        );

        if (!$stmt) {
            return "Error preparando consulta: " . $this->con->error;
        }

        $stmt->bind_param('ss', $usuario, $password);
        $stmt->execute();

        // store_result() es necesario para poder usar num_rows
        $stmt->store_result();

        try {
            if ($stmt->num_rows > 0) {
                $stmt->close();
                return true; // Usuario y contraseña coinciden
            }

            $stmt->close();
            return "El usuario no existe en la base de datos o credenciales incorrectas";

        } catch (mysqli_sql_exception $e) {
            $stmt->close();
            return "Error validando usuario: " . $e->getMessage();
        }
    }

    /**
     * Obtener la conexión mysqli
     *
     * Permite acceder al objeto mysqli subyacente (por si se necesitan métodos
     * que no están implementados en esta clase wrapper, p.ej., transacciones).
     *
     * @return mysqli objeto de conexión
     */
    public function getConexion(): mysqli {
        return $this->con;
    }

    /**
     * EVITAR CLONACIÓN
     *
     * Parte del patrón Singleton: impide que se cree una nueva instancia
     * por clonación del objeto existente.
     */
    private function __clone() {
        // Vacío intencionadamente - Lanzar una excepción aquí es otra alternativa.
    }

    /**
     * EVITAR DESERIALIZACIÓN
     *
     * Evita que se cree otra instancia al deserializar el objeto,
     * manteniendo la unicidad del Singleton.
     */
    public function __wakeup() {
        throw new \Exception("No se puede deserializar un Singleton");
    }

    // Nota: La conexión mysqli no necesita cerrarse aquí manualmente si es un Singleton
    // de larga vida, pero se cerrará automáticamente al finalizar el script.
}

// ============================================================================
// EJEMPLOS DE USO DEL SINGLETON
// ============================================================================

echo "<h2>Patrón Singleton - Conexión única a BD</h2>";

// 1. Obtener la instancia (primera vez - se crea)
echo "<h3>1. Primera llamada a getInstance()</h3>";
// El método estático llama al constructor privado internamente
$db1 = BaseDatos::getInstance();

// 2. Obtener la instancia de nuevo (se reutiliza la existente)
echo "<h3>2. Segunda llamada a getInstance()</h3>";
// La conexión no se intenta de nuevo; se devuelve la misma que $db1.
$db2 = BaseDatos::getInstance();

// 3. Verificar que son la misma instancia
echo "<h3>3. Verificar que es la misma instancia</h3>";
if ($db1 === $db2) {
    echo "✓ Confirmado: \$db1 y \$db2 son LA MISMA instancia (misma conexión).<br>";
    echo "Solo hay UNA conexión a la base de datos, ahorrando recursos.<br>";
} else {
    echo "✗ ERROR: Las instancias NO son idénticas (el patrón falló).<br>";
}

// 4. Usar los métodos de la clase
echo "<hr><h3>4. Obtener todas las tablas</h3>";
$tablas = $db1->getAllTables();
echo "Tablas en la BD: " . implode(', ', $tablas) . "<br>";

// 5. Obtener contenido de una tabla
echo "<hr><h3>5. Obtener campos de una tabla</h3>";
$campos = $db1->getFieldNames('usuarios');
echo "Campos de 'usuarios': " . implode(', ', $campos) . "<br>";

// 6. Registrar un usuario
echo "<hr><h3>6. Registrar nuevo usuario</h3>";
// En un sistema real, NUNCA se hace así. Usar password_hash().
$passwordHash = password_hash('miPassword123', PASSWORD_DEFAULT);
$resultado = $db1->registrar('juanperez_test', $passwordHash);

if ($resultado === true) {
    echo "✓ Usuario registrado correctamente<br>";
} else {
    echo "✗ Error: $resultado<br>";
}

// 7. Validar usuario
echo "<hr><h3>7. Validar login</h3>";
// Nota: Aquí se asume que la BD NO usa password_hash (solo para ejemplo).
// En producción, usarías password_verify() después de un SELECT.
$resultado = $db1->validar_usuario('admin', 'admin123');

if ($resultado === true) {
    echo "✓ Login correcto<br>";
} else {
    echo "✗ Login incorrecto: $resultado<br>";
}

/**
 * RESUMEN DEL PATRÓN SINGLETON:
 *
 * ESTRUCTURA:
 * - Constructor privado: private __construct()
 * - Atributo estático: private static \$instance
 * - Método estático (Factory): public static getInstance()
 * - Métodos anti-copia: private __clone(), public __wakeup()
 *
 *
 * VENTAJAS CLAVE (para la BD):
 * ✓ Control de Recursos: Garantiza que solo exista UNA conexión al servidor DB.
 * ✓ Eficiencia: Ahorra el tiempo y los recursos del servidor en reconexiones.
 * ✓ Punto de Acceso Único: Toda la aplicación usa la misma configuración.
 *
 * USO:
 * // Obtener la conexión única desde cualquier archivo o clase:
 * $db = Singleton::getInstance();
 *
 * CONFIGURACIÓN (Seguridad):
 * - Leer credenciales desde $_ENV (variables de entorno)
 * - NUNCA hardcodear en código de producción.
 *
 * IMPORTANTE:
 * - Es la forma canónica de gestionar la base de datos en aplicaciones
 * sin un framework ORM avanzado.
 */
?>