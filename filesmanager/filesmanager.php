<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Zest\Core\HookManager as Hook;

define('UPLOAD_PATH', CONTENT_PATH . 'upload' . DS);

define('FILESMANAGER_PATH', PLUGINS_PATH . 'filesmanager' . DS);

Hook::register_filter('add_content_to_editor', ["\Plugins\FilesManager\Hooks\Editor", "add_button"]);
Hook::register_filter('edit_admin_menu', ["\Plugins\FilesManager\Hooks\Menus", "add_links"]);
