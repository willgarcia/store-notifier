<?php

namespace wooshell\storeNotifier;

use Symfony\Component\EventDispatcher\EventDispatcher;
use wooshell\storeNotifier\EventDispatcher\Events\LoggerEvent;
use wooshell\storeNotifier\EventDispatcher\Events\SendEvent;
use wooshell\storeNotifier\EventDispatcher\Listeners\Drivers\FileLoggerListener;
use wooshell\storeNotifier\Store\StoreFile;

class StoreEventDispatcher extends EventDispatcher
{
    public $storeDir;

    public function __construct($storeDir)
    {
        $this->storeDir = $storeDir;
    }

    /**
     * @param $error
     * @return \Symfony\Component\EventDispatcher\Event
     */
    public function error($error)
    {
        return $this->dispatch(
            SendEvent::EVENT_ERROR,
            new SendEvent($error)
        );
    }

    /**
     * @param $log
     * @return \Symfony\Component\EventDispatcher\Event
     */
    public function log($log)
    {
        return $this->dispatch(
            LoggerEvent::EVENT_LOG,
            new LoggerEvent($log)
        );
    }

    /**
     * @param $summary
     * @param $body
     * @return \Symfony\Component\EventDispatcher\Event
     */
    public function send($summary, $body)
    {
        return $this->dispatch(
            SendEvent::EVENT_SEND,
            new SendEvent($summary, $body)
        );
    }

    /**
     * @param $filename
     */
    public function store($filename)
    {
        $this->addListener(LoggerEvent::EVENT_LOG,
            array(
                new FileLoggerListener(
                    new StoreFile($this->storeDir . DIRECTORY_SEPARATOR . $filename . StoreFile::FILE_EXTENSION)
                ),
                'send'
            )
        );
    }
}
