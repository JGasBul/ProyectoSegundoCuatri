<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

//Aqui añadir todos los get que hagan falta de la tabla user

class ParcelaModel extends Database
{
    public function getParcela($id)
    {
        return $this->select("SELECT * FROM parcelas where id like ?", ["i", $id]);
    }

    public function getAllParcelas($limit)
    {
        return $this->select("SELECT * FROM parcelas ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }

    public function getUserParcelas($user)
    {
        return $this->select("SELECT * FROM vista_propiedad_parcelas WHERE usuario LIKE ?", ["s", $user]);
    }

    public function getVerticesParcelas($parcelas)
    {
        return $this->select("SELECT lat, lng  FROM vertices WHERE parcela LIKE ?", ["i", $parcelas]);
    }
}
