<?php

/**
 * Manager
 *
 * @author  Maxence CAUDERLIER
 * @link    https://github.com/ZestCMS/ZestCMS
 * @license http://opensource.org/licenses/MIT The MIT License
 */

namespace Plugins\FilesManager\Util;

/**
 * Manager to work with uploaded files
 */
class Manager
{

    /**
     * JSON File
     */
    const FILE = 'upload.json';

    /**
     * Get all files metasdata, as an associative array where key is uploaded
     * file timestamp
     *
     * @return array
     */
    public static function getFilesMetas()
    {
        return json_decode(file_get_contents(FILESMANAGER_PATH . self::FILE), true);
    }

    /**
     * Add a file into the manager
     *
     * File will be automatically saved
     * Param must be an associative array
     *
     * @param array $infos
     */
    public static function addFile($infos)
    {
        $metas         = self::getFilesMetas();
        $metas[time()] = $infos;
        self::saveJsonFile($metas);
    }

    /**
     * Delete a file with his ID
     *
     * His ID is timestamp when he was uploaded
     *
     * @param int $id
     */
    public static function deleteFile($id)
    {
        $files    = self::getFilesMetas();
        $fileName = $files[$id]['path'] . $files[$id]['name'] . '.' . $files[$id]['ext'];
        if (file_exists($fileName)) {
            unset($files[$id]);
            self::saveJsonFile($files);
            unlink($fileName);
        }
    }

    /**
     * Save JSON Manager file
     *
     * Param must be an associative array, where ID is timestamp
     * Return true if JSON file is correctly saved
     *
     * @param array $rawContent
     * @return bool
     */
    protected static function saveJsonFile($rawContent)
    {
        return file_put_contents(FILESMANAGER_PATH . self::FILE, json_encode($rawContent, JSON_NUMERIC_CHECK + JSON_PRETTY_PRINT));
    }

}
