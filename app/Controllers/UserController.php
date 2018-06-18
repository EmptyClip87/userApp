<?php

namespace app\Controllers;

use app\Databases\IDatabaseHandler;
use app\Models\User;


class UserController extends BaseController
{
    private $database;

    public function __construct(IDatabaseHandler $database)
    {
        $this->database = $database;
        parent::__construct();
    }


    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        echo $this->twig->render("welcome.html");
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function getRegisterForm()
    {
        echo $this->twig->render("register.html");
    }


    /**
     * @throws \Exception
     */
    public function register()
    {
        $render =  $this->twig->render("welcome.html", ['name' => $_POST['name']]);

        try {
            $newUser = new User();
            $newUser->setName($_POST['name']);
            $newUser->setEmail($_POST['email']);
            $newUser->setPassword($_POST['password']);

            if ($_POST['password_confirmation'] !== $_POST['password']) {
                $render = $this->twig->render('error.html', ['msg' => 'Passwords must match.']);
            }

            $response = $this->database->register($newUser);
        } catch (\Exception $e) {
            $render = $this->twig->render('error.html', ['msg' => $e->getMessage()]);
        }

        echo $render;
    }

}