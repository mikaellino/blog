<?php

use Pecee\SimpleRouter\SimpleRouter;
use sistema\Nucleo\Helpers;

try {
    SimpleRouter::setDefaultNamespace('sistema\Controller');

    SimpleRouter::get(URL_SITE, 'ControllerDAO@index');
    SimpleRouter::get(URL_SITE . 'sobre-nos', 'ControllerDAO@sobre');
    SimpleRouter::get(URL_SITE . 'home', 'ControllerDAO@home');
    SimpleRouter::get(URL_SITE . 'myPage', 'ControllerDAO@myPage');
    SimpleRouter::get(URL_SITE . 'publicacao/{id}', 'ControllerDAO@publicacao');
    SimpleRouter::get(URL_SITE . 'categoria/{id}', 'ControllerDAO@categoria');

    SimpleRouter::get(URL_SITE . '404', 'ControllerDAO@erro404');

    SimpleRouter::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    if(Helpers::localhost()){
        echo $e;
    } else{
        Helpers::redirecionar('404');
    }
}
