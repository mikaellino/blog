<?php
//Arquivo index responsável pela inialização do sistema

require_once 'sistema/configuracao.php';
include_once 'Helpers.php';

$cpf = '12345678910';

var_dump(validarCpf($cpf));

//echo $limparNumero = preg_replace('/[^0-9]/', '', $cpf);