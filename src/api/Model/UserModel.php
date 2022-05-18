<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

//Aqui añadir todos los get que hagan falta de la tabla user

class UserModel extends Database
{
    public function getAllUsers()
    {
        return $this->select("SELECT * FROM usuarios ORDER BY id ASC");
    }

    public function getUser($user)
    {
        return $this->select("SELECT * FROM usuarios WHERE email LIKE ?", ["s", &$user]);
    }

    public function insertUser($email, $nombre, $pass, $rol)
    {
        return $this->insert("INSERT INTO usuarios (email, nombre, password, rol) VALUES (?, ?, ?, ?)", ["s", &$email, &$nombre, &$pass, &$rol]);
    }
}
