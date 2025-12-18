<?php
namespace Clases\DB;
use mysqli;
use mysqli_sql_exception;

class BaseDatos {
    private static ?BaseDatos $instance=null;
    private string $user;
    private string  $password;
    private string  $host;
    private string  $database;
    private mysqli $con;

    private function __construct() {
        $this->user=$_ENV['DB_USER'];
        $this->password=$_ENV['PASSWORD'];
        $this->host=$_ENV['HOST'];
        $this->database=$_ENV['DATABASE'];
        try {
            $this->con = new mysqli($this->host, $this->user, $this->password, $this->database);
        }catch (mysqli_sql_exception $e){
            die("ERROR Conectando".$e->getMessage());
        }
    }
    public static function getInstance(): BaseDatos {
        if(self::$instance==null)
            self::$instance=new BaseDatos();
        return self::$instance;
    }

    public function getAllTables():array{
        $sentencia = "show tables";
        $res = $this->con->query($sentencia);
        $fila = $res->fetch_row();
        $tables = [];

        while ($fila) {
            $tables[] = $fila[0];
            $fila = $res->fetch_row();
        }
        return $tables;
    }

    /**
     * @param string $table
     * @return array un array indexado de arrays asociativo con las filas de la tabla
     */
    public function getContentTable(string $table):array{
        $filas = [];
        $sentencia = "select * from $table";
        $res = $this->con->query($sentencia);

        $fila = $res->fetch_assoc();



        while ($fila) {
            $filas[] = $fila;
            $fila = $res->fetch_assoc();
        }

        return $filas;
    }

    public function getFieldName(string $tabla)
    {
        $sentencia = "desc $tabla";
        $res = $this->con->query($sentencia);
        $fila = $res->fetch_row();
        while ($fila) {
            $filas[] = $fila[0];
            $fila = $res->fetch_row();
        }
        return $filas;

    }

    /**
     * @param string $usuario
     * @param string $password
     * @return bool | string con el error de la no inserción
     */
    public function registrar(string $usuario, string $password):bool |string
    {
        $sentencia = "insert into usuarios (nombre, password) values ('$usuario', '$password')";

        try {
            $res = $this->con->query($sentencia);
            if ($res) {
                return true;
            }
            return "No se ha podido insertar el usuario";
        } catch (mysqli_sql_exception $e) {
            return "Error insertadno usuario $usuario " . $e->getMessage();
        }
    }
    public function validar_usuario(string $usuario, string $password):bool |string {
        $sentencia = "select * from usuarios where nombre=? and password=? ";
        $stmt = $this->con->prepare($sentencia);
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $stmt->store_result();
        try {
            if ($stmt->num_rows > 0)
                return true;
            return "El usuario no existe en la base de datos";
        }
        catch (mysqli_sql_exception $e){
            return "Error insertadno usuario $usuario " . $e->getMessage();
        }
    }
}



