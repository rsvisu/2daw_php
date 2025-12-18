<?php
/**
 * INYECCIÓN SQL (SQL INJECTION)
 *
 * Es una vulnerabilidad de seguridad crítica donde un atacante puede
 * manipular las consultas SQL inyectando código malicioso a través
 * de campos de entrada (formularios, URL, etc.).
 *
 * Conceptos clave:
 * - Qué es SQL Injection y cómo funciona (concatenación de código y datos)
 * - Código vulnerable vs código seguro
 * - Métodos de prevención: prepared statements (RECOMENDADO) y real_escape_string()
 * - Ejemplos reales de ataques
 */

use mysqli;
use mysqli_sql_exception;

class InyeccionSQL {
    private mysqli $con;
    public function __construct(mysqli $con) {
        $this->con = $con;
    }

    /**
     * ❌ CÓDIGO VULNERABLE - NO USAR NUNCA
     *
     * Este código es vulnerable a SQL Injection porque concatena
     * directamente los valores del usuario en la consulta SQL.
     * El servidor MySQL trata el valor completo de $sentencia como una única instrucción SQL.
     */
    public function loginVulnerable(string $usuario, string $password): bool {
        echo "<h3>❌ Login VULNERABLE (NO USAR)</h3>";

        // PELIGRO: Concatenación directa sin validación. Si $usuario contiene una comilla simple,
        // rompe la estructura de la consulta y permite la inyección.
        $sentencia = "SELECT * FROM usuarios 
                      WHERE nombre = '$usuario' AND password = '$password'";

        echo "SQL generado: <code>$sentencia</code><br><br>";

        $resultado = $this->con->query($sentencia);

        if ($resultado && $resultado->num_rows > 0) {
            echo "✓ Login exitoso<br>";
            return true;
        } else {
            echo "✗ Usuario o contraseña incorrectos<br>";
            return false;
        }
    }

    /**
     * DEMOSTRACIÓN: Ataque SQL Injection (Autenticación Bypass)
     *
     * Un atacante puede inyectar código SQL para saltarse la autenticación.
     *
     */
    public function demostrarAtaque(): void {
        echo "<h2>🔴 DEMOSTRACIÓN DE ATAQUE SQL INJECTION</h2>";

        echo "<h3>Escenario 1: Login normal (usuario 'maria')</h3>";
        $this->loginVulnerable('maria', '12345');

        echo "<hr><h3>Escenario 2: Ataque - Entrar sin conocer la contraseña (Bypass)</h3>";
        echo "<p>Atacante introduce en el campo usuario: <strong>maria' OR '1'='1</strong></p>";
        echo "<p>Y en el campo password cualquier cosa (p.ej., 'noImporta')</p><br>";

        // El usuario inyecta: maria' OR '1'='1
        $usuarioMalicioso = "maria' OR '1'='1";
        $passwordCualquiera = "noImporta";

        echo "<strong>SQL generado (PHP concatena):</strong><br>";
        echo "<code>SELECT * FROM usuarios WHERE nombre = '$usuarioMalicioso' AND password = '$passwordCualquiera'</code><br><br>";

        echo "<strong>SQL que ejecuta el servidor (tras resolver variables):</strong><br>";
        // La consulta se reescribe de forma lógica:
        // WHERE (nombre = 'maria') OR ('1'='1' AND password = 'noImporta')
        // Como '1'='1' es verdadero, el WHERE completo se resuelve a TRUE, retornando la primera fila (admin).
        echo "<code>SELECT * FROM usuarios WHERE nombre = 'maria' OR '1'='1' AND password = 'noImporta'</code><br><br>";

        echo "<p>🚨 La condición <code>'1'='1'</code> es siempre verdadera, anulando la necesidad de una contraseña correcta.</p>";
        echo "<p>🚨 Resultado: El atacante entra al sistema sin conocer la contraseña.</p>";

        // Demostrar el ataque
        $this->loginVulnerable($usuarioMalicioso, $passwordCualquiera);
    }

    /**
     * OTROS EJEMPLOS DE ATAQUES
     */
    public function ejemplosDeAtaques(): void {
        echo "<h2>🔴 MÁS EJEMPLOS DE ATAQUES SQL INJECTION</h2>";

        echo "<h3>Ataque 1: Borrar toda una tabla (Stacking Queries)</h3>";
        // El punto y coma (;) permite encadenar comandos en MySQL
        // -- es el inicio de un comentario, ignorando el resto de la consulta original
        $inputMalicioso = "'; DROP TABLE usuarios; --";
        echo "Input del atacante: <code>$inputMalicioso</code><br>";
        echo "SQL resultante: <br>";
        // La consulta original es cerrada por la comilla simple inyectada, luego ejecuta el DROP.
        echo "<code>SELECT * FROM usuarios WHERE nombre = ''; DROP TABLE usuarios; --'</code><br>";
        echo "🚨 Esto eliminaría toda la tabla usuarios (si el usuario de BD tiene permisos)<br><br>";

        echo "<h3>Ataque 2: Obtener todos los datos (Condición siempre verdadera)</h3>";
        $inputMalicioso = "' OR 1=1 --";
        echo "Input del atacante: <code>$inputMalicioso</code><br>";
        echo "SQL resultante: <br>";
        // El '--' anula el resto de la sentencia, incluyendo la comilla de cierre.
        echo "<code>SELECT * FROM productos WHERE cod = '' OR 1=1 --'</code><br>";
        echo "🚨 Retornaría todos los productos, exponiendo datos masivamente.<br><br>";

        echo "<h3>Ataque 3: Union-based (obtener datos de otras tablas)</h3>";
        // UNION SELECT permite combinar el resultado de la consulta original con otra consulta
        $inputMalicioso = "' UNION SELECT nombre, password FROM usuarios --";
        echo "Input del atacante: <code>$inputMalicioso</code><br>";
        echo "🚨 Permite al atacante inyectar un SELECT para extraer contraseñas de usuarios u otra información sensible.<br><br>";
    }

    /**
     * ✅ SOLUCIÓN 1: CONSULTAS PREPARADAS (PREPARED STATEMENTS) - RECOMENDADO
     *
     * Las consultas preparadas separan la estructura SQL de los datos.
     * El servidor trata los placeholders (?) como una plantilla, y los valores vinculados
     * siempre son tratados como **DATOS**, nunca como código ejecutable.
     *
     */
    public function loginSeguroConPrepared(string $usuario, string $password): bool|string {
        echo "<h3>✅ Login SEGURO con Prepared Statements</h3>";

        // Los ? son placeholders. La consulta se envía a MySQL SÓLO con la estructura.
        $stmt = $this->con->prepare(
            "SELECT * FROM usuarios WHERE nombre = ? AND password = ?"
        );

        if (!$stmt) {
            return "Error preparando: " . $this->con->error;
        }

        // Los valores se vinculan como DATOS (ss: dos strings), NO como código.
        $stmt->bind_param('ss', $usuario, $password);
        $stmt->execute();
        $stmt->store_result();

        echo "Usuario intentando: <code>$usuario</code><br>";
        echo "Password intentando: <code>$password</code><br>";
        // Si el atacante usa ' OR '1'='1, el servidor lo busca como UN ÚNICO nombre de usuario literal.

        if ($stmt->num_rows > 0) {
            echo "✓ Login exitoso<br>";
            $stmt->close();
            return true;
        } else {
            echo "✗ Usuario o contraseña incorrectos<br>";
            echo "🛡️ El ataque fue bloqueado. El valor inyectado se trató como texto plano.<br>";
            $stmt->close();
            return false;
        }
    }

    /**
     * ✅ SOLUCIÓN 2: real_escape_string() (menos recomendado)
     *
     * Escapa caracteres peligrosos (como la comilla simple ') para que sean
     * interpretados como parte del string de datos, y no como parte de la sintaxis SQL.
     * Solo usar si no es posible usar prepared statements.
     */
    public function loginConEscape(string $usuario, string $password): bool {
        echo "<h3>⚠️ Login con real_escape_string() (Medida de mitigación)</h3>";

        // Escapar caracteres peligrosos
        $usuarioSeguro = $this->con->real_escape_string($usuario); // Convierte ' en \'
        $passwordSeguro = $this->con->real_escape_string($password);

        $sentencia = "SELECT * FROM usuarios 
                      WHERE nombre = '$usuarioSeguro' AND password = '$passwordSeguro'";

        echo "Input original: <code>$usuario</code><br>";
        echo "Input escapado: <code>$usuarioSeguro</code><br>";
        echo "SQL: <code>$sentencia</code><br>";
        // Si el atacante inyecta: admin' OR '1'='1
        // El SQL generado se convierte en: ... WHERE nombre = 'admin\' OR \'1\'=\'1' ...
        // Todo es tratado como una sola cadena de texto.

        $resultado = $this->con->query($sentencia);

        if ($resultado && $resultado->num_rows > 0) {
            echo "✓ Login exitoso<br>";
            return true;
        } else {
            echo "✗ Usuario o contraseña incorrectos<br>";
            echo "🛡️ El ataque fue bloqueado por el escape de caracteres<br>";
            return false;
        }
    }

    /**
     * COMPARACIÓN: Código vulnerable vs seguro
     */
    public function comparacionSeguridad(): void {
        echo "<h2>📊 COMPARACIÓN: VULNERABLE VS SEGURO</h2>";

        $atacante = "admin' OR '1'='1";

        echo "<h3>Probando con input malicioso: <code>$atacante</code></h3><br>";

        // Vulnerable
        echo "═══════════════════════════════════════════<br>";
        $this->loginVulnerable($atacante, 'cualquiera');

        // Seguro con prepared
        echo "<br>═══════════════════════════════════════════<br>";
        $this->loginSeguroConPrepared($atacante, 'cualquiera');

        // Seguro con escape
        echo "<br>═══════════════════════════════════════════<br>";
        $this->loginConEscape($atacante, 'cualquiera');
    }

    /**
     * VALIDACIÓN ADICIONAL: Buenas prácticas
     */
    public function loginConValidacion(string $usuario, string $password): bool|string {
        echo "<h3>🛡️ Login con VALIDACIÓN + Prepared Statements</h3>";

        // 1. VALIDACIÓN de entrada (primera línea de defensa)
        // Se asegura de que el valor sea del formato esperado (e.g., alfanumérico)
        if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $usuario)) {
            return "Usuario inválido (solo letras, números y _ de 3-20 caracteres)";
        }

        if (strlen($password) < 6) {
            return "Contraseña muy corta (mínimo 6 caracteres)";
        }

        // 2. CONSULTA PREPARADA (segunda y principal línea de defensa)
        $stmt = $this->con->prepare(
            "SELECT * FROM usuarios WHERE nombre = ? AND password = ?"
        );

        if (!$stmt) {
            return "Error: " . $this->con->error;
        }

        $stmt->bind_param('ss', $usuario, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "✓ Login exitoso<br>";
            $stmt->close();
            return true;
        } else {
            echo "✗ Credenciales incorrectas<br>";
            $stmt->close();
            return false;
        }
    }

    public function __destruct() {
        if (isset($this->con)) {
            $this->con->close();
        }
    }
}

// EJEMPLOS Y DEMOSTRACIONES
// $con = new mysqli("localhost", "root", "root", "dwes");
// $demo = new InyeccionSQL($con);

/*
// 1. Demostrar el ataque
$demo->demostrarAtaque();

echo "<hr>";

// 2. Más ejemplos de ataques
$demo->ejemplosDeAtaques();

echo "<hr>";

// 3. Comparar seguridad
$demo->comparacionSeguridad();
*/

/**
 * RESUMEN SQL INJECTION:
 *
 * QUÉ ES:
 * - Vulnerabilidad donde el atacante inyecta código SQL malicioso
 * - Puede robar datos, modificar/borrar información, saltarse autenticación
 *
 *
 * CÓDIGO VULNERABLE (Causante):
 * ❌ $sql = "SELECT * FROM users WHERE name = '$user'";
 * ❌ Concatenación directa de valores del usuario
 *
 * PREVENCIÓN (en orden de preferencia):
 *
 * 1. ✅ CONSULTAS PREPARADAS (prepared statements) - RECOMENDADO
 * - Separa estructura SQL de los datos (la defensa más fuerte).
 * - El servidor nunca interpreta los datos como código.
 *
 * 2. ⚠️ real_escape_string() - Solo si no puedes usar prepared
 * - Escapa caracteres peligrosos (', ", \, etc).
 * - No previene todos los tipos de ataques (ej. LIMIT o integer injection).
 *
 * 3. 🛡️ VALIDACIÓN DE ENTRADA - Defensa adicional (Defensa en Profundidad)
 * - Validar formato (regex)
 * - Limitar longitud
 * - Lista blanca de caracteres permitidos
 *
 * BUENAS PRÁCTICAS:
 * - SIEMPRE usar prepared statements para queries con datos de usuario.
 * - Usar principio de mínimo privilegio en usuarios de BD (ej. el usuario web solo debe tener SELECT/INSERT/UPDATE).
 * - Mantener errores SQL OCULTOS al usuario final.
 *
 * ATAQUES COMUNES:
 * - ' OR '1'='1    : Autenticación bypass
 * - '; DROP TABLE  : Borrado de datos (Stacking Queries)
 * - ' UNION SELECT : Extracción de datos
 * - ' AND SLEEP(5) : Timing attacks (para inferir datos)
 */
?>