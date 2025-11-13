<?php 

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace('sistema\Controller');

SimpleRouter::get(URL_SITE, 'ControllerDAO@index');
SimpleRouter::get(URL_SITE . 'sobre-nos', 'ControllerDAO@sobre');
SimpleRouter::get(URL_SITE . 'home', 'ControllerDAO@home');

SimpleRouter::start();