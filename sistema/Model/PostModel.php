<?php

namespace sistema\Model;

use sistema\Nucleo\Conexao;

class PostModel
{
    public function read(): array
    {
        $query = "SELECT * FROM `publicacoes` WHERE id=2 AND (status=1 or status=0)";
        $stmt = Conexao::getInstancia()->query($query);
        $result = $stmt->fetchAll();

        return $result;
    }
}