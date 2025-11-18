<?php
//Arquivo index responsável pela inialização do sistema

// require 'rotas.php';

require_once 'sistema/Nucleo/conexao.php';
require_once 'sistema/configuracao.php';

use sistema\Nucleo\Conexao;

$conn = Conexao::getInstancia();

