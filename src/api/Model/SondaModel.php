<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class SondaModel extends Database
{
    public function getAllSondas($limit)
    {
        return $this->select("SELECT * FROM sondas ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }

    public function getSondaByUser($userId)
    {
        return $this->select("SELECT * FROM sondas WHERE usuario LIKE ?", ["s", $userId]);
    }
}
