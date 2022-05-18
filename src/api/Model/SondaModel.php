<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class SondaModel extends Database
{
    public function getAllSondas()
    {
        return $this->select("SELECT * FROM sondas ORDER BY id ASC");
    }

    public function getMarcadores($userId, $parcelaId)
    {
        return $this->select("SELECT * FROM vista_propiedad_sondas WHERE usuario LIKE ? AND parcela LIKE ?", ["i", &$userId, &$parcelaId]);
    }

    public function getMediciones($sondaId)
    {
        return $this->select("SELECT * FROM mediciones_sonda WHERE id_sonda LIKE ? ORDER BY hora ASC", ["i", &$sondaId]);
    }
}
