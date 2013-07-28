<?php

namespace wooshell\storeNotifier\EventDispatcher\Events;

use Symfony\Component\EventDispatcher\Event;

final class LoggerEvent extends Event
{
    const EVENT_LOG = 'notify.log';

    protected $raw;

    /**
     * @param $raw
     */
    public function __construct($raw)
    {
        $this->raw = $raw;
    }

    /**
     * @return mixed
     */
    public function getRaw()
    {
        return $this->raw;
    }
}
