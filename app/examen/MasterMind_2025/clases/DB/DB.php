<?php
namespace Clases\DB;

use mysqli;
use mysqli_sql_exception;

class DB
{
    private static DB|null $instance = null;
    private mysqli|null $con;

    private function __construct()
    {
        // Variables de conexión recuperadas del .env
        $hostname = $_ENV["HOST"];
        $username = $_ENV["DB_USER"];
        $password = $_ENV["PASSWORD"];
        $database = $_ENV["DATABASE"];

        // Creamos la conexión
        try {
            $this->con = new mysqli($hostname, $username, $password, $database);
        } catch (mysqli_sql_exception $e) {
            $this->con = null;
            die("Error: " . $e->getMessage() . "</br>");
        }
    }

    // Implementamos patron "singleton" para obtener la instancia de la base de datos
    public static function getInstance(): DB
    {
        if (self::$instance == null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    // Verifica si un usuario existe en la base de datos
    private function existe_usuario(string $usuario): bool
    {
        $stmt = $this->con->prepare("SELECT id FROM usuarios WHERE nombre = ?");

        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("s", $usuario);

        try {
            if (!$stmt->execute()) {
                return false;
            }

            $res = $stmt->get_result();
            return $res->num_rows > 0;
        } catch (mysqli_sql_exception $e) {
            return false;
        } finally {
            $stmt->close();
        }
    }

    // Registra un nuevo usuario en la base de datos
    public function registrar_usuario(string $usuario, string $password): bool|string
    {
        // Verificamos si el usuario ya existe
        if ($this->existe_usuario($usuario)) {
            return "El usuario ya existe";
        }

        // Hasheamos la contraseña antes de guardarla
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->con->prepare("INSERT INTO usuarios (nombre, password) VALUES (?, ?)");

        if ($stmt === false) {
            return "Error preparando la consulta";
        }

        $stmt->bind_param("ss", $usuario, $password_hash);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                return "No se ha podido insertar el usuario: " . $stmt->error;
            }
        } catch (mysqli_sql_exception $e) {
            return "Error insertando usuario: " . $e->getMessage();
        } finally {
            $stmt->close();
        }
    }

    // Valida las credenciales de un usuario
    public function validar_usuario(string $usuario, string $password): bool|string
    {
        // Verificamos primero si el usuario existe
        if (!$this->existe_usuario($usuario)) {
            return "El usuario no existe.";
        }

        // Obtenemos el hash de la contraseña del usuario
        $stmt = $this->con->prepare("SELECT password FROM usuarios WHERE nombre = ?");

        if ($stmt === false) {
            return "Error preparando la consulta";
        }

        $stmt->bind_param("s", $usuario);

        try {
            if (!$stmt->execute()) {
                return "Error ejecutando la consulta: " . $stmt->error;
            }

            $res = $stmt->get_result();
            $row = $res->fetch_assoc();
            $password_hash = $row['password'];

            // Verificamos la contraseña con el hash
            if (password_verify($password, $password_hash)) {
                return true;
            } else {
                return "Contraseña incorrecta.";
            }
        } catch (mysqli_sql_exception $e) {
            return "Error buscando usuario: " . $e->getMessage();
        } finally {
            $stmt->close();
        }
    }
}

?>
