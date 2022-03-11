<?php

require_once __DIR__ . "/vendor/autoload.php";

use fileUpload\app\classes\Base;
use fileUpload\app\classes\FileParser;

ini_set('display_errors', 1);
error_reporting(-1);

$base = new Base();

$fileParser = new FileParser();
echo $fileParser->getPre();


$fileList = $fileParser->getAllFilesFromFolder(__DIR__. "/upload")->getFileList();

echo ($fileParser->writeFile($fileList[0], "Hello cool dear" ));

echo ($fileParser->readFile($fileList[0]));


//var_dump([ $base->getBaseDirectory(), $base->getServerRoot()]); // root folder directory



