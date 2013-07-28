<?php
namespace wooshell\storeNotifier\EventDispatcher\Listeners\Drivers;

use Symfony\Component\EventDispatcher\Event;
use wooshell\storeNotifier\EventDispatcher\Events\LoggerEvent;
use wooshell\storeNotifier\EventDispatcher\Listeners\ListenerInterface;
use wooshell\storeNotifier\Store\Store;
use wooshell\storeNotifier\Store\StoreFile;

class FileLoggerListener implements ListenerInterface
{
    /**
     * @var Store
     */
    private $storeFile;

    /**
     * @param StoreFile $storeFile
     */
    public function __construct(StoreFile $storeFile)
    {
        $this->storeFile = $storeFile;
    }

    /**
     * @param Event $event
     */
    public function send(Event $event)
    {
        /** @var LoggerEvent $event */
        $this->storeFile->log($event->getRaw());
    }
}
