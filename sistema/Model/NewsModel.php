<?php

namespace sistema\Model;

use sistema\Nucleo\Conexao;

class NewsModel
{
    public function read(?int $id): array
    {
        $where = ($id ? "WHERE id = {$id}" : '');

        $query = "SELECT * FROM `divulgacoes` {$where}";
        $stmt = Conexao::getInstancia()->query($query);
        $result = $stmt->fetchAll();

        return $result;
    }
}
