<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return [
    '/admin/filesmanager'              => ['Plugins\FilesManager\Controllers\Homepage', 'view'],
    '/admin/filesmanager/upload'       => ['Plugins\FilesManager\Controllers\Homepage', 'addFile'],
    '/admin/filesmanager/delete/<#id>' => ['Plugins\FilesManager\Controllers\Homepage', 'deleteFile'],
];
