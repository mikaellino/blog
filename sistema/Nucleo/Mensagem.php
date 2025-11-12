<?php

namespace sistema\Nucleo;

/**
 * @author Mikael Rodrigues
 * Classe para manipulação de mensagens do sistema
 */
class Mensagem
{
    private $texto;
    private $css;

    public function __toString(): string
    {
        return $this->renderizar();
    }

    public function sucesso(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-success';
        $this->texto = $this->filtrar($mensagem);
        return $this;
    }

    public function erro(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-danger';
        $this->texto = $this->filtrar($mensagem);
        return $this;
    }

    public function alerta(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-warning';
        $this->texto = $this->filtrar($mensagem);
        return $this;
    }

    public function informa(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-primary ';
        $this->texto = $this->filtrar($mensagem);
        return $this;
    }

    /**
     * Renderiza a mensagem formatada
     * 
     * @return string
     */
    public function renderizar(): string
    {
        return "<div class='{$this->css}'>{$this->texto}</div>";
    }

    /**
     * Filtra a mensagem para evitar ataques XSS
     * 
     * @param string $mensagem
     * @return string
     */
    private function filtrar(string $mensagem): string
    {
        return filter_var($mensagem, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}