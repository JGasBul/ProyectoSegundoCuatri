<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
//Aqui añadir todos los get que hagan falta de la tabla user

class UserModel extends Database
{
    public function getAllUsers($limit)
    {
        return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }
    
    public function getUser($user)
    {
        return $this->select("SELECT * FROM users WHERE username LIKE ?", ["s", $user]);
    }
}