<?php

namespace Class\DataBase;

use mysqli;
use mysqli_sql_exception;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../..");
$dotenv->load();

class BaseDatos
{
    private static BaseDatos|null $instancia = null; // Se inicia a null y puede ser o de BaseDatos o null.
    private string $user;
    private string $password;
    private string $host;
    private string $database;
    private mysqli $con;

    private function __construct()
    {
        $this->user = $_ENV["DB_USER"];
        $this->password = $_ENV["DB_PASSWORD"];
        $this->host = $_ENV["DB_HOST"];
        $this->database = $_ENV["DB_NAME"];

        try {
            $this->con = new mysqli($this->host, $this->user, $this->password, $this->database);
        } catch (mysqli_sql_exception $e) {
            die("Error: " . $e->getMessage() . "</br>");
        }

    }

    public static function getInstance(): BaseDatos
    {
        if (self::$instancia == null) {
            self::$instancia = new BaseDatos();
        }
        return self::$instancia;
    }

    public function getAllTables(): array
    {
        $sentencia = "SHOW TABLES";
        $res = $this->con->query($sentencia);

        $tabla = [];
        $fila = $res->fetch_row();
        while ($fila) {
            $tabla[] = $fila[0];
            $fila = $res->fetch_row();
        }

        return $tabla;
    }

    public function getContentTable(string $tabla): array
    {
        $sentencia = "SELECT * FROM $tabla";
        $res = $this->con->query($sentencia);

        $tabla = $res->fetch_all(MYSQLI_ASSOC);
        return $tabla;
    }

    // FIX: modificar para usar variables parametrizadas para evitar inyecciones mysql
    public function registrarse(string $usuario, string $contrasena) : bool | string
    {
        $sentencia = "INSERT INTO usuarios (nombre, password) VALUES ('$usuario', '$contrasena')";
        try {
            $res = $this->con->query($sentencia);
            if ($res) {
                return true;
            }
            return "No se pudo insertar el usuario.";
        } catch (mysqli_sql_exception $e) {
            return "Error insertando datos: " . $e->getMessage() . "</br>";
        }
    }

    // FIX: modificar para usar variables parametrizadas para evitar inyecciones mysql
    // FIX: ver si el try catch sirve o no
    public function validarUsuario(string $usuario, string $contrasena) : bool | string {
        $sentencia = "SELECT * FROM usuarios WHERE nombre = '$usuario' AND password = '$contrasena'";
        try {
            $res = $this->con->query($sentencia);
            if ($res->num_rows > 0) {
                return true;
            }
            return "El usuario no existe o la contraseña no es correcta.";
        } catch (mysqli_sql_exception $e) {
            return "Error validando datos: " . $e->getMessage() . "</br>";
        }
    }
}
