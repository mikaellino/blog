<?php

namespace sistema\Model;

use sistema\Nucleo\Conexao;

class NewsModel
{
    public function read(): array
    {
        $query = "SELECT * FROM `divulgacoes`";
        $stmt = Conexao::getInstancia()->query($query);
        $result = $stmt->fetchAll();

        return $result;
    }
}
