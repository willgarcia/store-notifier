<?php

namespace wooshell\storeNotifier;

use Exception;
use Symfony\Component\Finder\Finder;
use wooshell\storeNotifier\Store\Store;
use wooshell\storeNotifier\Store\StoreFile;

class StoreNotifier
{
    /**
     * @var StoreEventDispatcher
     */
    private $dispatcher;

    /**
     * @var Store
     */
    private $store;

    /**
     * @param $storeDir
     */
    public function __construct($storeDir)
    {
        $finder = new Finder();
        $storeFiles = $finder
            ->files()
            ->name('*' . StoreFile::FILE_EXTENSION)
            ->depth(0)
            ->in($storeDir);

        $store = new Store();

        foreach ($storeFiles as $file) {
            /** @var \SplFileObject $file */
            $store->add(
                basename($file->getRealpath(), StoreFile::FILE_EXTENSION),
                file($file->getRealpath(), FILE_IGNORE_NEW_LINES)
            );
        }

        $this->store = $store;
        $this->dispatcher = new StoreEventDispatcher($storeDir);
    }

    /**
     * @return StoreEventDispatcher
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * @return Store
     * @throws \Exception
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param $filepath
     * @return int
     * @throws \Exception
     */
    public function lock($filepath)
    {
        if (file_exists($filepath)) {
            throw new \Exception('Process locked by an other transaction' );
        } else {
            return file_put_contents($filepath, date('d-M-Y h:i:s A') . PHP_EOL);
        }
    }

    /**
     * @param $filepath
     * @return bool
     */
    public function unlock($filepath)
    {
        return unlink($filepath);
    }

    //// SHORTCUTS

    public function exists($key, $value)
    {
        return $this->getStore()->exists($key, $value);
    }
    public function store($key)
    {
        $this->getDispatcher()->store($key);
    }

    public function send($summary, $body)
    {
        return $this->getDispatcher()->send($summary, $body);
    }

    public function log($summary)
    {
        return $this->getDispatcher()->log($summary);
    }

    public function error($message)
    {
        return $this->getDispatcher()->error($message);
    }
}
