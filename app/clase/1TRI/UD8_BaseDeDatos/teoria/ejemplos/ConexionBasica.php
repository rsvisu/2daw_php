<?php
/**
 * CONEXIÓN BÁSICA A BASE DE DATOS CON MYSQLI (Orientado a Objetos)
 *
 * Este archivo muestra cómo conectarse a una base de datos MySQL usando MySQLi
 * siguiendo el patrón orientado a objetos, que es el más recomendado.
 *
 * Conceptos clave:
 * - Crear una instancia de mysqli (el objeto de conexión)
 * - Verificar errores de conexión con connect_errno y connect_error (para compatibilidad)
 * - Manejo de errores a través de try-catch.
 * - Cerrar la conexión explícitamente (close())
 */

use Exception;
use mysqli;
use mysqli_sql_exception;

class ConexionBasica
{
    // Propiedad privada para almacenar el objeto de conexión mysqli
    private mysqli $con;

    /**
     * Constructor que establece la conexión
     *
     * El constructor de mysqli recibe hasta 5 parámetros:
     * 1. $host - servidor (localhost, IP, null para local)
     * 2. $user - usuario de la base de datos
     * 3. $password - contraseña
     * 4. $database - nombre de la base de datos
     * 5. $port - puerto (opcional, por defecto 3306)
     */
    public function __construct()
    {

        // Variables de configuración de conexión
        $host = 'localhost';
        $user = 'root';
        $password = 'root';
        $database = 'dwes';

        try {
            // Crear la conexión usando el constructor de mysqli
            // La conexión se intenta establecer inmediatamente al llamar a 'new mysqli(...)'
            $this->con = new mysqli($host, $user, $password, $database);

            // **EXPLICACIÓN ADICIONAL DEL ERROR HANDLING**
            // En versiones modernas de PHP (8.0+), el constructor de mysqli está configurado
            // para lanzar automáticamente una mysqli_sql_exception si la conexión falla (p.ej., credenciales incorrectas).
            // Por eso, la comprobación manual de connect_errno/connect_error es menos necesaria
            // si confiamos en el bloque try/catch.

            /*
            // Bloque de compatibilidad y chequeo explícito (patrón antiguo):
            if ($this->con->connect_errno) {
                // Si connect_errno es distinto de 0, significa que hubo un error de conexión
                throw new mysqli_sql_exception(
                    "Error conectando: " . $this->con->connect_error,
                    $this->con->connect_errno
                );
            }
            */

            // Si llegamos aquí, la conexión fue exitosa.
            echo "✓ Conexión establecida correctamente.<br>";
            // Información sobre el entorno (opcional)
            echo "Servidor: " . $this->con->server_info . "<br>";
            echo "Host info: " . $this->con->host_info . "<br>";

        } catch (mysqli_sql_exception $e) {
            // Capturar la excepción si el constructor o el chequeo manual la lanzan.
            // Esta excepción maneja errores de red, credenciales o servidor caído.
            die("ERROR DE CONEXIÓN: " . $e->getMessage());

            /*
            // Alternativa (Mejor práctica POO):
            // En lugar de usar 'die()' (que detiene la ejecución del script),
            // se recomienda RE-LANZAR la excepción (throw $e;) si la clase actual
            // no puede manejar el error, permitiendo al código cliente (donde se
            // llama a new ConexionBasica()) decidir cómo gestionarlo (p.ej., mostrar
            // un mensaje bonito al usuario o registrar el error).
            */
        }
    }

    /**
     * Obtener la conexión
     *
     * Este método permite que otras clases (como ConsultasPreparadas) accedan
     * al objeto mysqli para realizar operaciones de base de datos.
     *
     * @return mysqli objeto de conexión ya establecido
     */
    public function getConexion(): mysqli
    {
        return $this->con;
    }

    /**
     * Cambiar de base de datos
     *
     * Si queremos cambiar a otra base de datos sin crear una nueva conexión.
     *
     * @param string $nuevaBD nombre de la nueva base de datos
     * @return bool true si el cambio fue exitoso, false en caso contrario
     */
    public function cambiarBaseDatos(string $nuevaBD): bool
    {
        // select_db() retorna true si la base de datos existe y se pudo cambiar
        if ($this->con->select_db($nuevaBD)) {
            echo "✓ Cambiado a base de datos: $nuevaBD<br>";
            return true;
        } else {
            // El error específico está en $this->con->error (p.ej., BD no existe)
            echo "✗ Error cambiando a: $nuevaBD. Detalle: " . $this->con->error . "<br>";
            return false;
        }
    }

    /**
     * Cerrar la conexión explícitamente
     *
     * MUY IMPORTANTE: Siempre cerrar la conexión cuando ya no se necesite
     * para liberar recursos del servidor y evitar la saturación de conexiones abiertas.
     */
    public function cerrarConexion(): void
    {
        if (isset($this->con)) { // Verificar que el objeto de conexión exista antes de cerrarla
            $this->con->close();
            echo "✓ Conexión cerrada correctamente<br>";
            // Opcionalmente, se puede anular la propiedad: unset($this->con);
        }
    }

    /**
     * Destructor - Se ejecuta automáticamente al destruir el objeto
     *
     * Asegura que la conexión se cierre incluso si el método cerrarConexion() no fue llamado
     * explícitamente en el código.
     */
    public function __destruct()
    {
        // Se utiliza isset para asegurarse de que el objeto $con fue inicializado antes de llamar a close()
        if (isset($this->con)) {
            $this->con->close();
        }
    }
}

// EJEMPLO DE USO

echo "<h2>Ejemplo de Conexión a Base de Datos</h2>";

try {
    // 1. Crear conexión (llama al constructor __construct())
    // Si la conexión falla, se detendrá el script debido al die() dentro del constructor.
    $db = new ConexionBasica();

    // 2. Obtener el objeto mysqli para hacer operaciones SELECT/INSERT/etc.
    $conexion = $db->getConexion();
    // Desde aquí se podría usar $conexion->query(...) o $conexion->prepare(...)

    // 3. Ejemplo: cambiar de base de datos
    // $db->cambiarBaseDatos('otra_bd');

    // 4. Al final, cerrar conexión explícitamente.
    // Aunque el destructor lo haría, es buena práctica llamarlo para liberar
    // los recursos en el punto exacto deseado.
    $db->cerrarConexion();

} catch (Exception $e) {
    // Este catch capturaría cualquier otra excepción que se pudiera lanzar
    // FUERA del constructor (si no usa die()).
    echo "Fallo de aplicación: " . $e->getMessage();
}


/**
 * NOTAS IMPORTANTES:
 *
 * 1. Manejo de Errores: En PHP moderno (8+), confíe en try-catch para atrapar la mysqli_sql_exception
 * lanzada automáticamente por el constructor de mysqli.
 * 2. Cierre de Conexión: Cerrar la conexión con close() es crucial. Se puede hacer explícitamente
 * o dejar que el método mágico __destruct() lo haga al final.
 * 3. Orientación a Objetos: La clase ConexionBasica encapsula la conexión ($this->con)
 * y solo la expone a través de getConexion(), lo cual es un buen patrón de diseño.
 * 4. El objeto mysqli no se puede serializar (es un recurso del sistema).
 *
 */
?>

