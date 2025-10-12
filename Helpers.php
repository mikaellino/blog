<?php
// Arquivo de funções auxiliares

/**
 * Formata valores, inserindo . e , de acordo com as casas decimais
 * 
 * @param float $valor opcional - valor de entrada que será formatado
 * @return string valor formatado
 */
function formatarValor(float $valor = null) : string
{
    return number_format(($valor ? $valor : 0), 2, ',', '.');
}

/**
 * Formata números com . e , de acordo com as casas decimais
 * 
 * @param int $numero opcional - recebe o número que será formatado
 * @return string número formatado
 */
function formatarNumero(int $numero = null) : string
{
    return number_format($numero ? $numero : 0,0,'.','.');
}

function saudacao(): string
{
    $hora = date('H');

    if ($hora >= 0 && $hora <= 5) {
        $saudacao = 'boa madrugada';
    } elseif ($hora >= 6 && $hora <= 12) {
        $saudacao = 'bom dia';
    } elseif ($hora >= 13 && $hora <= 18) {
        $saudacao = 'boa tarde';
    } else {
        $saudacao = 'boa noite';
    }

    return $saudacao;
}

/**
 * Resume um texto
 * 
 * @param string $texto texto para resumir
 * @param int $limite quantidade de caracteres
 * @param string $continue opcional - o que deve ser exibido ao final do resmuo
 * @return string texto resumido
 */
function resumirTexto(string $texto, int $limite, string $continue = '...'): string
{
    $textoLimpo = trim(strip_tags($texto));
    if (mb_strlen($textoLimpo) <= $limite) {
        return $textoLimpo;
    }

    $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ' '));

    return $resumirTexto . $continue;
}
