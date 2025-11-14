<?php

namespace sistema\Nucleo;

// Arquivo de funções auxiliares

class Helpers
{
    /**
     * Valida um CPF
     * 
     * @param string $cpf
     * @return string
     */
    public static function validarCpf(string $cpf): bool
    {
        $cpf = self::limparNumero($cpf);
        if (mb_strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public static function limparNumero(string $numero): string
    {
        return preg_replace('/[^0-9]/', '', $numero);
    }

    /**
     * Gera um slug a partir de uma string
     * 
     * @param string $string
     * @return string
     */
    public static function slug(string $string): string
    {
        $mapa['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ@#$%&*()_–+=|{}[]]/?¨!;:.,\\\"<>°ºª';
        $mapa['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyy                                   ';

        $string = mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8');
        $mapa_a = mb_convert_encoding($mapa['a'], 'ISO-8859-1', 'UTF-8');

        $slug = strtr($string, $mapa['a'], $mapa['b']);
        $slug = strip_tags(trim($slug));
        $slug = str_replace(' ', '-', $slug);
        $slug = str_replace(['-----', '-----', '---', '--', '-'], '-', $slug);

        return strtolower(mb_convert_encoding($slug, 'UTF-8', 'ISO-8859-1'));
    }

    /**
     * Retorna a data atual formatada em português
     * 
     * @return string
     */
    public static function dataAtual(): string
    {
        $diaMes = date('d');
        $diaSemana = date('w');
        $mes = date('m') - 1;
        $ano = date('Y');

        $diasSemana = [
            'Domingo',
            'Segunda-feira',
            'Terça-feira',
            'Quarta-feira',
            'Quinta-feira',
            'Sexta-feira',
            'Sábado'
        ];

        $nomesMeses = [
            'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro'
        ];

        $dataFormatada = $diasSemana[$diaSemana] . ', ' . $diaMes . ' de ' . $nomesMeses[$mes] . ' de ' . $ano;
        return $dataFormatada;
    }

    /**
     * Retorna a url completa de acordo com o ambiente
     * 
     * @param string $url
     * @return string
     */
    public static function url(?string $url = null): string
    {
        $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');
        $ambiente = ($servidor == 'localhost' ? URL_DESENVOLVIMENTO : URL_PRODUCAO);

        if (str_starts_with($url, '/')) {
            return $ambiente . $url;
        }

        return $ambiente . '/' . $url;
    }

    /**
     * Verifica se o servidor é localhost
     * 
     * @return bool
     */
    public static function localhost(): bool
    {
        $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');

        if ($servidor == 'localhost') {
            return true;
        }
        return false;
    }

    /**
     * Valida se realmente se trata de uma url
     * @param string $url
     * @return bool
     */
    public static function validarUrl(string $url): bool
    {
        if (mb_strlen($url) < 10) {
            return false;
        }
        if (!str_contains($url, '.')) {
            return false;
        }
        if (str_contains($url, 'http://') || str_contains($url, 'https://')) {
            return true;
        }
        return false;
    }

    public static function validarUrlComFiltro(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Valida se realmente é um email
     * @param string $email
     * @return bool
     */
    public static function validarEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Conta o tempo decorrido a partir de uma data
     * @param string $data
     * @return string
     */
    public static function contarTempo(string $data): string
    {
        $agora = strtotime(date('Y-m-d H:i:s'));
        $tempo = strtotime($data);
        $diferenca = $agora - $tempo;

        $segundos = $diferenca;
        $minutos = round($diferenca / 60);
        $horas = round($diferenca / 3600);
        $dias = round($diferenca / 86400);
        $semanas = round($diferenca / 604800);
        $meses = round($diferenca / 2419200);
        $anos = round($diferenca / 29030400);

        if ($segundos <= 60) {
            return 'agora';
        } elseif ($minutos <= 60) {
            return $minutos == 1 ? 'há um minuto' : 'há ' . $minutos . ' minutos';
        } elseif ($horas <= 24) {
            return $horas == 1 ? 'há uma hora' : 'há ' . $horas . ' horas';
        } elseif ($dias <= 7) {
            return $dias == 1 ? 'ontem' : 'há ' . $dias . ' dias';
        } elseif ($semanas <= 4) {
            return $semanas == 1 ? 'há uma semana' : 'há ' . $semanas . ' semanas';
        } elseif ($meses <= 12) {
            return $meses == 1 ? 'há um mês' : 'há ' . $meses . ' meses';
        } else {
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
    public static function formatarValor(?float $valor = null): string
    {
        return number_format(($valor ? $valor : 0), 2, ',', '.');
    }

    /**
     * Formata números com . e , de acordo com as casas decimais
     * 
     * @param int $numero opcional - recebe o número que será formatado
     * @return string número formatado
     */
    public static function formatarNumero(?int $numero = null): string
    {
        return number_format($numero ? $numero : 0, 0, '.', '.');
    }

    public static function saudacao(): string
    {
        $hora = date('H');

        $saudacao = match (true) {
            $hora >= 0 && $hora <= 5 => 'boa madrugada',
            $hora >= 6 && $hora <= 12 => 'bom dia',
            $hora >= 13 && $hora <= 18 => 'boa tarde',
            default => 'boa noite',
        };

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
    public static function resumirTexto(string $texto, int $limite, string $continue = '...'): string
    {
        $textoLimpo = trim(strip_tags($texto));
        if (mb_strlen($textoLimpo) <= $limite) {
            return $textoLimpo;
        }

        $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ' '));

        return $resumirTexto . $continue;
    }
}
