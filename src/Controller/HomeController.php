<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\Stercket;
use App\Model\StercketManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Home/index.html.twig');
    }

    public function initialise()
    {
        $stercketManager = new StercketManager();
        $stercketManager->deleteAllSterckets();
        $userStercket = new Stercket();
        $userStercket->initialise('player');
        $stercketManager->insert($userStercket);
        for (
            $nbWoodStercket = 0;
            $nbWoodStercket < Stercket::MAX_WOOD_SIZE;
            $nbWoodStercket++
        ) {
            $woodStercket = new Stercket();
            $woodStercket->initialise('wood');
            $stercketManager->insert($woodStercket);
        }
        header("Location: /Game/play");
    }
}
