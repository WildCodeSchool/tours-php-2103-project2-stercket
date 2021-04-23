<?php

namespace App\Controller;

use App\Model\Stercket;
use App\Model\ItemManager;

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
    public function battle(): string
    {
        $stercketUser = new Stercket('D.va', 'branchia', 'lancier', 'player');
        $stercketEnnemy = new Stercket('Zigzerg', 'frostblob', 'mage', 'wood');
        return $this->twig->render('Item/battle.html.twig', [
            "stercketUser" => $stercketUser,
            "nameStercketUser" => $stercketUser->getName(),
            "typeStercketUser" => $stercketUser->getType(),
            "specieStercketUser" => $stercketUser->getSpecie(),
            "attackStercketUser" => $stercketUser->getAttack(),
            "defenseStercketUser" => $stercketUser->getDefense(),
            "healthStercketUser" => $stercketUser->getHealth(),
            "stercketEnnemy" => $stercketEnnemy,
            "nameSterketEnnemy" => $stercketEnnemy->getName(),
            "typeStercketEnnemy" => $stercketEnnemy->getType(),
            "specieStercketEnnemy" => $stercketEnnemy->getSpecie(),
            "attackStercketEnnemy" => $stercketEnnemy->getAttack(),
            "defenseStercketEnnemy" => $stercketEnnemy->getDefense(),
            "healthStercketEnnemy" => $stercketEnnemy->getHealth(),
            "combat" => $stercketUser->combat($stercketEnnemy)
        ]);
    }
}
