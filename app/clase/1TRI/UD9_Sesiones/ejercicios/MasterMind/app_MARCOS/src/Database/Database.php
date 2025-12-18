<?php

namespace MasterBind\Database;

use mysqli;
use mysqli_sql_exception;

class Database
{
    private static ?Database $instance = null;
    private ?mysqli $con;
    private string $hostname;
    private string $username;
    private string $password;
    private string $database;

    private function __construct(
    ) {
        $this->hostname = $_ENV["DB_HOST"];
        $this->username = $_ENV["DB_USER"];
        $this->password = $_ENV["DB_PASSWORD"];
        $this->database = $_ENV["DB_NAME"];

        try {
            $this->con = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        } catch(mysqli_sql_exception $e) {
            $this->con = null;
            die ("Error: ".$e->getMessage()."</br>");
        }
    }

    public static function getInstance(): Database {
        if(self::$instance ==null){
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function registrarse(string $usuario, string $password):bool|string{
        // Con PreparedStatement para evitar problemas de inyección SQL
        $stmt = $this->con->prepare("INSERT INTO usuarios (nombre, password) VALUES (?, ?)");

        // Validación de sintaxis
        if ($stmt === false) {
            return "Error preparando la consulta: " . $this->con->error;
        }

        $stmt->bind_param("ss", $usuario, $password); // "ss" indica que ambos son strings

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                return "No se ha podido insertar el usuario: " . $stmt->error;
            }
        } catch (mysqli_sql_exception $e) {
            return "Error insertando usuario: " . $e->getMessage();
        } finally {
            $stmt->close(); // Siempre cerrar el statement
        }
    }

    public function login(string $usuario, string $password): bool|string{

        // 1. Preparar la sentencia SQL con placeholders (?)
        $stmt = $this->con->prepare("SELECT id FROM usuarios WHERE nombre = ? AND password = ?");

        if ($stmt === false) {
            return "Error preparando la consulta: " . $this->con->error;
        }

        // 2. Enlazar los parámetros ("ss" = dos strings)
        $stmt->bind_param("ss", $usuario, $password);

        try {
            if (!$stmt->execute()) {
                // Si la ejecución falla por un problema de MySQL
                return "Error ejecutando la consulta: " . $stmt->error;
            }

            // 3. Obtener el resultado de la consulta
            $res = $stmt->get_result();

            // 4. Contar el número de filas devueltas
            if ($res->num_rows === 1) {
                return true; // Éxito: Usuario encontrado
            } else {
                return "El usuario no existe en la base de datos o credenciales incorrectas.";
            }
        } catch (mysqli_sql_exception $e) {
            return "Error buscando usuario: " . $e->getMessage();
        } finally {
            $stmt->close(); // Siempre cerrar el statement
        }
    }
}