<?php

namespace sistema\Controller;

use sistema\Nucleo\Controlador;
use sistema\Model\PostModel;
use sistema\Nucleo\Helpers;
use sistema\Model\CategoriaModel;

class ControllerDAO extends Controlador
{

    public function __construct()
    {
        parent::__construct('templates/site/views');
    }

    public function index(): void
    {
        $publicacoes = (new PostModel())->busca();

        echo $this->template->renderizar('index.html', [
            'publicacoes' => $publicacoes,
            'categorias' => $this->categorias()
        ]);
    }

    public function buscar(): void
    {
        $busca = filter_input(INPUT_POST, 'busca',  FILTER_DEFAULT);
        if(isset($busca) && !empty(trim($busca))) {
            $publicacoes = (new PostModel())->pesquisa(trim($busca));

            if(count($publicacoes) > 0) {
                foreach($publicacoes as $publicacao) {
                    echo "<a href='" . Helpers::url('publicacao/' . $publicacao->id) . "' class='d-block p-2 text-decoration-none text-dark border-bottom' style='color: #333 !important;'>";
                    echo "<strong>" . htmlspecialchars($publicacao->titulo) . "</strong>";
                    echo "</a>";
                }
            }
        }
    }

    public function publicacao(int $id): void
    {
        $post = (new PostModel())->buscaPorId($id);
        if(!$post) {
            Helpers::redirecionar('404');
        }

        echo $this->template->renderizar('post.html', [
            'post' => $post,
            'categorias' => $this->categorias()
        ]);
    }

    public function categorias ()
    {
        return (new CategoriaModel ())->busca();
    }

    public function categoria( int $id): void
    {
        $publicacoes = (new CategoriaModel())->publicacoes($id);

        echo $this->template->renderizar('categoria.html', [
            'publicacoes' => $publicacoes,
            'categorias' => $this->categorias()
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

    public function myPage(): void
    {
        echo $this->template->renderizar('mikael.html', []);
    }

    public function erro404(): void
    {
        echo $this->template->renderizar('404.html', [
            'titulo' => 'Página não encontrada!'
        ]);
    }
}