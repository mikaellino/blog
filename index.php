<?php
//Arquivo index responsável pela inialização do sistema

require_once 'sistema/configuracao.php';
include_once 'Helpers.php';

echo saudacao() . ' ' . dataAtual();

// foreach ($meses as $indice => $valor){
//     echo $valor . '<br>';
// }

// echo '<hr>';
// echo $_SERVER['HTTP_HOST'];
// echo '<hr>';
// var_dump($_SERVER);