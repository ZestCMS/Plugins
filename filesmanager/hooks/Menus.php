<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Plugins\FilesManager\Hooks;

/**
 * Description of Menus
 *
 * @author Toss
 */
class Menus
{

    /**
     *
     * @param \Zest\Menus\Menu $menu
     * @return \Zest\Menus\Menu
     */
    public function add_links($menu)
    {
        $filesmanager = $menu->addItem('Files', [
            'id'  => 'filesmanager',
            'url' => \Zest\Utils\URLBuilder::getURLAdminHomePage() . 'filesmanager'
        ]);
        $filesmanager->addItem('Add', ['url' => \Zest\Utils\URLBuilder::getURLAdminHomePage() . 'filesmanager/upload']);
        $filesmanager->addItem('See all files', ['url' => \Zest\Utils\URLBuilder::getURLAdminHomePage() . 'filesmanager']);
        return $menu;
    }

}
