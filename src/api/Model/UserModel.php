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

    public function insertUser($email, $nombre, $empresa, $pass, $rol)
    {
        return $this->insert("INSERT INTO usuarios (email, nombre, empresa ,password, rol) VALUES (?, ?, ?, ?, ?)", ["s", &$email, &$nombre, &$empresa, &$pass, &$rol]);
    }

    public function deleteUser($email)
    {
        return $this->insert("DELETE FROM usuarios WHERE  email LIKE ?", ["s", &$email]);
    }

    public function editUser($email, $nombre, $empresa, $pass, $rol, $id)
    {
        return $this->insert("UPDATE usuarios SET email = ?, nombre = ?, empresa = ?, password = ?, rol = ? WHERE id = ?", ["s", &$email, &$nombre, &$empresa, &$pass, &$rol, &$id]);
    }

    public function buscarUser($param)
    {
        return $this->select("SELECT * FROM usuarios WHERE email LIKE ? OR nombre LIKE ? OR empresa LIKE ? OR rol LIKE ?", ["s", &$param, &$param, &$param, &$param]);
    }
}
