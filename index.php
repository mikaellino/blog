<?php
//Arquivo index responsável pela inialização do sistema

require_once 'sistema/configuracao.php';
include_once 'Helpers.php';

$data = date('H/m/Y H:i:s');

echo $data;