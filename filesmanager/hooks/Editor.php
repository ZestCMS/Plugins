<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Plugins\FilesManager\Hooks;

/**
 * Description of Editor
 *
 * @author Toss
 */
class Editor
{

    public function add_button($content, $params)
    {

        $tpl = new \Zest\Templates\PluginTemplate('filesmanager', 'button.tpl');
        $tpl->set('textareaID', $params['textareaID']);
        return $content . $tpl->output();
    }

}
