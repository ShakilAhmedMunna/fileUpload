<?php

namespace fileUpload\app\classes;


class FileParser extends Base
{
    /**
     * @var array
     */
    public $fileList = [];
    /**
     * @var string
     */
    public $fileText;
    /**
     * @var null
     */
    private $fileDirectory = null;
    /**
     * @var int
     */
    private $fileSize = 1;
    /**
     * @var false|resource
     */
    private $file;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllFilesFromFolder($folderPathDirectory, $fileFilter = "/*.txt")
    {
        $this->fileList = glob($folderPathDirectory . $fileFilter);
        return $this;
    }

    public function getFileList()
    {
        return $this->fileList;
    }


    /**
     * @param null $fileDirectory
     */
    public function setFileDirectory($fileDirectory)
    {
        $this->fileDirectory = $fileDirectory;

        return $this;
    }

    public function fileWork($file, $mode = "r")
    {
        return fopen($file, $mode);
    }

    private function fileOpen($mode = "r")
    {
        $this->file = $this->fileWork($this->fileDirectory, $mode);

        return $this;
    }

    public function fileSize()
    {
        clearstatcache();

        $this->fileSize = filesize($this->fileDirectory);

        return $this;
    }

    private function fileRead()
    {
        if (flock($this->file, LOCK_EX)) {
            $this->fileText = fread($this->file, $this->fileSize);
            // release lock
            flock($this->file, LOCK_UN);
        }

    }

    private function fileWrite($setText)
    {
        if (flock($this->file, LOCK_EX)) {
            fwrite($this->file, $setText);
            // release lock
            flock($this->file, LOCK_UN);
        }

    }

    public function readFile($fileDirectory)
    {
        $this->setFileDirectory($fileDirectory)->fileOpen()->fileSize()->fileRead();

        fclose($this->file);

        return $this->fileText;
    }

    public function writeFile($fileDirectory, $setText = "")
    {
        $file = $this->setFileDirectory($fileDirectory)->fileOpen("w")->fileSize()->fileWrite($setText);

        fclose($this->file);

        return $file;
    }

}