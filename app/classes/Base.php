<?php

namespace fileUpload\app\classes;


class Base
{
    public $folderRoot = null;

    public function __construct()
    {
        $this->setFolderRoot($this->getServerRoot() . "/upload");
    }

    /**
     * @param string $folderRoot
     */
    public function setFolderRoot($folderRoot = null)
    {
        $this->folderRoot = is_null($folderRoot) ? $this->getBaseDirectory() . "/upload" : $folderRoot;
    }

    public function getPre()
    {
        return "<pre>";
    }

    public function getBaseDirectory()
    {
        return __DIR__;
    }

    public function getServerRoot()
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

}




