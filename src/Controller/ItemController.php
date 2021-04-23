<?php

namespace App\Controller;

use App\Model\Stercket;
use App\Model\ItemManager;
use App\Model\StercketManager;

class ItemController extends AbstractController
{
    /**
     * List items
     */
    public function index(): string
    {
        $itemManager = new ItemManager();
        $items = $itemManager->selectAll('title');

        return $this->twig->render('Item/index.html.twig', ['items' => $items]);
    }

    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneById($id);

        return $this->twig->render('Item/show.html.twig', ['item' => $item]);
    }


    /**
     * Edit a specific item
     */
    public function edit(int $id): string
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $item = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $itemManager->update($item);
            header('Location: /item/show/' . $id);
        }

        return $this->twig->render('Item/edit.html.twig', [
            'item' => $item,
        ]);
    }


    /**
     * Add a new item
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $item = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $itemManager = new ItemManager();
            $id = $itemManager->insert($item);
            header('Location:/item/show/' . $id);
        }

        return $this->twig->render('Item/add.html.twig');
    }


    /**
     * Delete a specific item
     */
    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemManager = new ItemManager();
            $itemManager->delete($id);
            header('Location:/item/index');
        }
    }

    /**
     * List items
     */
    public function battle()
    {
        $stercketUser = new Stercket();
        $stercketEnnemy = new Stercket();
        $stercketUser->initialise('player');
        $stercketEnnemy->initialise('wood');
        return $this->twig->render('Item/battle.html.twig', [
            "stercketUser" => $stercketUser,
            "healthStercketUser" => $stercketUser->getHealth(),
            "stercketEnnemy" => $stercketEnnemy,
            "healthStercketEnnemy" => $stercketEnnemy->getHealth(),
            "combat" => $stercketUser->combat($stercketEnnemy)
        ]);
    }
}
