<?php
// Arquivo de funções auxiliares

/**
 * Conta o tempo decorrido a partir de uma data
 * @param string $data
 * @return string
 */
function contarTempo(string $data): string
{
    $agora = strtotime(date('Y-m-d H:i:s'));
    $tempo = strtotime($data);
    $diferenca = $agora - $tempo;

    $segundos = $diferenca;
    $minutos = round($diferenca/60);
    $horas = round($diferenca/3600);
    $dias = round($diferenca/86400); 
    $semanas = round($diferenca/604800);
    $meses = round($diferenca/2419200);
    $anos = round($diferenca/29030400);

    if($segundos <= 60) {
        return 'agora';
    }elseif($minutos<=60) {
        return $minutos == 1 ? 'há um minuto' : 'há ' . $minutos . ' minutos';
    }elseif($horas<=24) {
        return $horas == 1 ? 'há uma hora' : 'há ' . $horas . ' horas';
    }elseif($dias<=7) {
        return $dias == 1 ? 'ontem' : 'há ' . $dias . ' dias';
    }elseif($semanas<=4) {
        return $semanas == 1 ? 'há uma semana' : 'há ' . $semanas . ' semanas';
    }elseif($meses<=12) {
        return $meses == 1 ? 'há um mês' : 'há ' . $meses . ' meses';
    }else{
        return $anos == 1 ? 'há um ano' : 'há ' . $anos . ' anos';
    }

    echo '<hr>';
    var_dump($minutos);
}

/**
 * Formata valores, inserindo . e , de acordo com as casas decimais
 * 
 * @param float $valor opcional - valor de entrada que será formatado
 * @return string valor formatado
 */
function formatarValor(float $valor = null): string
{
    return number_format(($valor ? $valor : 0), 2, ',', '.');
}

/**
 * Formata números com . e , de acordo com as casas decimais
 * 
 * @param int $numero opcional - recebe o número que será formatado
 * @return string número formatado
 */
function formatarNumero(int $numero = null): string
{
    return number_format($numero ? $numero : 0, 0, '.', '.');
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
