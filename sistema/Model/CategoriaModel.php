<?php

namespace sistema\Model;

use sistema\Nucleo\Conexao;

class CategoriaModel
{
    public function busca(): array
    {
        $query = "SELECT * FROM `categorias` WHERE `status` = 1 ORDER BY `titulo` ASC";
        $stmt = Conexao::getInstancia()->query($query);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function buscaPorId(int $id): bool|object
    {
        $query = "SELECT * FROM `categorias` WHERE `id` = {$id}";
        $stmt = Conexao::getInstancia()->query($query);
        $result = $stmt->fetch();

        return $result;
    }

    public function publicacoes(int $id): array
    {
        $query = "SELECT * FROM `publicacoes` WHERE `categoria_id` = {$id} AND status = 1 ORDER BY `id` DESC";
        $stmt = Conexao::getInstancia()->query($query);
        $result = $stmt->fetchAll();

        return $result;
    }
}