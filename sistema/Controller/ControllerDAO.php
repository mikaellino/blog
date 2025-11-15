<?php

namespace sistema\Controller;

use sistema\Nucleo\Controlador;

class ControllerDAO extends Controlador
{

    public function __construct()
    {
        parent::__construct('templates/site/views');
    }

    public function index(): void
    {
        echo $this->template->renderizar('index.html', [
            'titulo' => 'teste de título',
            'subtitulo' => 'teste de subtitulo'
        ]);
    }

    public function sobre(): void
    {
        echo $this->template->renderizar('sobre.html', [
            'titulo' => 'Página de sobre',
            'subtitulo' => 'teste de subtítulo da página sobre'
        ]);
    }

    public function home(): void
    {
        echo $this->template->renderizar('home.html', [
            'titulo' => 'Página Home',
            'subtitulo' => 'Subtítulo da Página Home'
        ]);
    }
}