<?php
class Database
{
    public $db; // handle of the db connexion    
    private static $dns = "mysql:host=localhost;dbname=colegio";
    private static $user = "root";
    private static $pass = "";
    private static $instance;

    public function __construct(){
        $this->db = new PDO(self::$dns, self::$user, self::$pass);
    }

    // Se crea la instancia de la clase Database.
    // Se instancia la clase para iniciarla y poder acceder a las propiedades.
    public static function getInstance(){
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

    public function DatosAutenticacion($username, $password){
        $conexion = Database::getInstance();
        $sql = "SELECT id,nombres,apellidos,username,role,identificacion from users where username=:username and password=:password";
        $result = $conexion->db->prepare($sql);
        $params = array("username" => $username, "password" => md5($password)); //Cambiar md5 por algo más seguro
        $result->execute($params);
        return ($result);
    }

    public function Registrar($username, $password, $nombres, $apellidos, $identificacion){

        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("INSERT INTO users (username,password,nombres,apellidos,identificacion, role) VALUES (:username, :password, :nombres, :apellidos, :identificacion, :role)");
            $result->execute(
                array(
                    'username' => $username,
                    'password' => md5($password), //Cambiar md5 por algo más seguro
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'identificacion' => $identificacion,
                    'role' => 3,
                    //Configurar rol por defecto
                )
            );
            return "5";
        } catch (PDOException $e) {
            return "0";
        }
    }


    public function ValidacionCorreo($username){
        $conexion = Database::getInstance();
        $sql = "SELECT id,nombres,apellidos,username,role from users where username=:username";
        $result = $conexion->db->prepare($sql);
        $params = array("username" => $username);
        $result->execute($params);
        return ($result);
    }

    public function DatosRoles(){
        $conexion = Database::getInstance();
        $sql = "SELECT * from roles";
        $result = $conexion->db->prepare($sql);
        $result->execute();
        return $result;
    }

    public function EliminarRol($id){
        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("DELETE FROM roles WHERE id=?");
            $result->execute(array($id));

            return "1";
        } catch (PDOException $e) {
            return "0";
        }
    }

    public function CrearRol($nombre){

        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("INSERT INTO roles (nombre) VALUES (:nombre)");
            $result->execute(
                array(
                    ':nombre' => $nombre
                )
            );
            return "2";
        } catch (PDOException $e) {
            return "0";
        }
    }

    public function editRol($id){
        $conexion = Database::getInstance();
        $sql = "SELECT * from roles where id=:id";
        $result = $conexion->db->prepare($sql);
        $params = array("id" => $id);
        $result->execute($params);
        return $result;
    }

    public function updateRol($nombre, $id){

        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("UPDATE roles set nombre=:nombre where id=:id ");
            $result->execute(
                array(
                    'nombre' => $nombre,
                    'id' => $id
                )
            );
            return "3";
        } catch (PDOException $e) {
            return "0";
        }
    }

    public function DatosUsuarios(){
        $conexion = Database::getInstance();
        $sql = "SELECT users.id,users.nombres,users.apellidos,users.username,users.role,roles.nombre as role from users ";
        $sql .= "LEFT JOIN roles on (users.role=roles.id) ";
        $result = $conexion->db->prepare($sql);
        $result->execute();
        return $result;
    }

    public function editUsuario($id)
    {
        $conexion = Database::getInstance();
        $sql = "SELECT id,nombres,apellidos,username,password,role,identificacion from users where id=:id";
        $result = $conexion->db->prepare($sql);
        $params = array("id" => $id);
        $result->execute($params);
        return $result;
    }

    public function updateUsuario($id, $nombres, $apellidos, $username, $role, $password, $identificacion) {

        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("UPDATE users set nombres=:nombres,apellidos=:apellidos,username=:username,role=:role,password=:password,identificacion=:identificacion where id=:id ");
            $result->execute(
                array(
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'username' => $username,
                    'role' => $role,
                    'password' => md5($password),
                    'identificacion' => $identificacion,
                    'id' => $id
                )
            );
            return "3";
        } catch (PDOException $e) {
            return "0";
        }
    }


    public function EliminarUsuario($id)
    {
        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("DELETE FROM users WHERE id=?");
            $result->execute(array($id));

            return "1";
        } catch (PDOException $e) {
            return "0";
        }
    }

    public function DatosEstudiantes()
    {
        $conexion = Database::getInstance();
        $sql = "SELECT * from estudiantes";
        $result = $conexion->db->prepare($sql);
        $result->execute();
        return $result;
    }

    public function CrearEstudiante($identificacion, $fnacimiento, $nombres, $apellidos, $email, $telefono, $direccion)
    {

        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("INSERT INTO estudiantes (identificacion,fnacimiento,nombres,apellidos,email,telefono,direccion) VALUES (:identificacion,:fnacimiento,:nombres,:apellidos,:email,:telefono,:direccion)");
            $result->execute(
                array(
                    'identificacion' => $identificacion,
                    'fnacimiento' => $fnacimiento,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'email' => $email,
                    'telefono' => $telefono,
                    'direccion' => $direccion
                )
            );
            return "2";
        } catch (PDOException $e) {
            return "0";
        }
    }

    public function editEstudiante($identificacion)
    {
        $conexion = Database::getInstance();
        $sql = "SELECT * from estudiantes where identificacion=:identificacion";
        $result = $conexion->db->prepare($sql);
        $params = array("identificacion" => $identificacion);
        $result->execute($params);
        return $result;
    }

    public function updateEstudiante($nombres, $apellidos, $email, $telefono, $fnacimiento, $direccion, $identificacion,)
    {

        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("UPDATE estudiantes set nombres=:nombres,apellidos=:apellidos,email=:email,telefono=:telefono,fnacimiento=:fnacimiento,direccion=:direccion where identificacion=:identificacion");
            $result->execute(
                array(
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'email' => $email,
                    'telefono' => $telefono,
                    'fnacimiento' => $fnacimiento,
                    'direccion' => $direccion,
                    'identificacion' => $identificacion,
                )
            );
            return "3";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function EliminarEstudiante($identificacion)
    {
        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("DELETE FROM estudiantes WHERE identificacion=?");
            $result->execute(array($identificacion));

            return "1";
        } catch (PDOException $e) {
            return "0";
        }
    }


    public function DatosMaterias()
    {
        $conexion = Database::getInstance();
        $sql = "SELECT * from materias";
        $result = $conexion->db->prepare($sql);
        $result->execute();
        return $result;
    }

    public function EliminarMateria($id)
    {
        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("DELETE FROM materias WHERE id=?");
            $result->execute(array($id));

            return "1";
        } catch (PDOException $e) {
            return "0";
        }
    }

    public function CrearMateria($nombre, $horario, $docente, $descripcion)
    {

        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("INSERT INTO materias (nombre, horario, docente, descripcion) VALUES (:nombre, :horario, :docente,:descripcion)");
            $result->execute(
                array(
                    'nombre' => $nombre,
                    'horario' => $horario,
                    'docente' => $docente,
                    'descripcion' => $descripcion


                )
            );
            return "2";
        } catch (PDOException $e) {
            return $e -> getMessage();
        }
    }

    public function editMateria($id)
    {
        $conexion = Database::getInstance();
        $sql = "SELECT * from materias where id=:id";
        $result = $conexion->db->prepare($sql);
        $params = array("id" => $id);
        $result->execute($params);
        return $result;
    }

    public function updateMateria($nombre, $horario, $docente, $descripcion, $id)
    {

        try {
            $conexion = Database::getInstance();
            $result = $conexion->db->prepare("UPDATE materias set nombre=:nombre, horario=:horario, docente=:docente, descripcion=:descripcion where id=:id ");
            $result->execute(
                array(
                    'nombre' => $nombre,
                    'horario' => $horario,
                    'docente' => $docente,
                    'descripcion' => $descripcion,
                    'id' => $id
                )
            );
            
            return "3";
        } catch (PDOException $e) {
            return $e -> getMessage();
        }
    }
}




?>