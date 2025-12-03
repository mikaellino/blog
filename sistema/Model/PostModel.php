<?php

namespace sistema\Model;

use sistema\Nucleo\Conexao;

class PostModel
{
    public function busca(): array
    {
        $query = "SELECT * FROM `publicacoes` WHERE `status` = 1 ORDER BY `id` DESC";
        $stmt = Conexao::getInstancia()->query($query);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function buscaPorId(int $id): bool|object
    {
        $query = "SELECT * FROM `publicacoes` WHERE `id` = {$id}";
        $stmt = Conexao::getInstancia()->query($query);
        $result = $stmt->fetch();

        return $result;
    }

    public function pesquisa(string $busca): array
    {
        $query = "SELECT * FROM publicacoes WHERE `status` = 1 AND titulo LIKE '%{$busca}%'";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }
}