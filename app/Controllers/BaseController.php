<?php

namespace App\Controllers;

use \Twig_Loader_Filesystem;

class BaseController {
    protected $templateEngine;

    public function __construct() {
        $loader = new Twig_Loader_Filesystem('../views');
        $this->templateEngine = new \Twig_Environment($loader, array(
            'debug' => true,
            'cache' => false,
        ));
    }

    public function renderHTML($fileName, $data = []) {
        return $this->templateEngine->render($fileName, $data);
    }
}