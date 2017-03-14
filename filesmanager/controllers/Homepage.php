<?php

/**
 * Homepage
 *
 * @author  Maxence CAUDERLIER
 * @link    https://github.com/ZestCMS/ZestCMS
 * @license http://opensource.org/licenses/MIT The MIT License
 */

namespace Plugins\FilesManager\Controllers;

/**
 * Homepage
 */
class Homepage extends \Zest\Core\AdminController
{

    public function view()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return $this->view_ajax();
        }

        $files = \Plugins\FilesManager\Util\Manager::getFilesMetas();
        foreach ($files as $id => &$file) {
            $file['is_pic']    = in_array($file['ext'], ['png', 'jpg']);
            $file['deleteurl'] = ROOT_URL . 'admin/filesmanager/delete/' . $id;
        }
        $tpl = new \Zest\Templates\PluginTemplate('filesmanager', 'filesview.tpl');
        $tpl->set('files', $files);

        $response = new \Zest\Responses\Admin();
        $response->addTemplate($tpl);

        return $response;
    }

    protected function view_ajax()
    {
        $files = \Plugins\FilesManager\Util\Manager::getFilesMetas();
        foreach ($files as $id => &$file) {
            if (in_array($file['ext'], ['png', 'jpg'])) {
                $file['is_pic']      = true;
                $file['insert_code'] = '![' . $file['name'] . '](' . ROOT_URL . $file['urlpath'] .
                        ' \\\'' . $file['name'] . '\\\')';
            }
            else {
                $file['insert_code'] = '[' . $file['name'] . '](' . ROOT_URL . $file['urlpath'] . ')';
            }
        }
        $tpl = new \Zest\Templates\PluginTemplate('filesmanager', 'filesview_ajax.tpl');
        $tpl->set('files', $files);
        $tpl->set('textareaid', $_POST['textareaid']);
        return $tpl;
    }

    public function addFile()
    {
        $response = new \Zest\Responses\Admin();
        $tpl      = new \Zest\Templates\PluginTemplate('filesmanager', 'upload.tpl');
        if (isset($_POST['upload_file']) && isset($_FILES['uploaded_file'])) {
            $originalFile = $_FILES['uploaded_file'];
            if ($originalFile['error'] > 0) {
                $tpl->set('error', 'Error during transfert file');
            }
            else {
                $fileName = \Zest\Utils\ArticleHelper::normalizeString(pathinfo($originalFile['name'], PATHINFO_FILENAME));
                $fileExt  = pathinfo($originalFile['name'], PATHINFO_EXTENSION);
                $filePath = $this->createFileDirectories();

                $result = move_uploaded_file($originalFile['tmp_name'], $filePath . $fileName . '.' . $fileExt);
                if ($result === true) {
                    $tpl->set('success', 'File was uploaded');
                    $infosFile = [
                        'path'    => $filePath,
                        'name'    => $fileName,
                        'ext'     => $fileExt,
                        'urlpath' => str_replace(DS, '/', $filePath . $fileName . '.' . $fileExt),
                    ];
                    \Plugins\FilesManager\Util\Manager::addFile($infosFile);
                }
                else {
                    $tpl->set('error', 'Impossible to create directory in Upload dir');
                }
            }
        }

        $tpl->set('MAX_FILE_SIZE', ini_get('upload_max_filesize'));
        $response->addTemplate($tpl);
        $response->setTitle('Upload file');

        return $response;
    }

    private function createFileDirectories()
    {
        $year     = date('Y');
        $yearPath = UPLOAD_PATH . $year;
        if (!is_dir($yearPath)) {
            mkdir($yearPath);
        }

        $month     = date('m');
        $monthPath = $yearPath . DS . $month;
        if (!is_dir($monthPath)) {
            mkdir($monthPath);
        }

        return $monthPath . DS;
    }

    public function deleteFile($id)
    {
        \Plugins\FilesManager\Util\Manager::deleteFile($id);
        return $this->view();
    }

}
