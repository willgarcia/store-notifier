<?php

namespace wooshell\storeNotifier\Store;

use SplFileInfo;

class StoreFile
{

    CONST FILE_EXTENSION = '.log';
    private $file;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $fileInfo = new SplFileInfo($path);
        $this->file = $fileInfo->openFile('a');
    }

    /**
     * @param $raw
     */
    public function log($raw)
    {
        $this->file->fwrite($raw . PHP_EOL);
    }
}
