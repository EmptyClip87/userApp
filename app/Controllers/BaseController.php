<?php

namespace app\Controllers;

class BaseController
{
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/views/');
        $this->twig = new \Twig_Environment($loader);
    }
}