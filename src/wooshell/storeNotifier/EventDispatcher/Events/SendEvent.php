<?php

namespace wooshell\storeNotifier\EventDispatcher\Events;

use Symfony\Component\EventDispatcher\Event;

final class SendEvent extends Event
{
    const EVENT_SEND = 'notify.send';
    const EVENT_ERROR = 'notify.error';

    protected $summary;
    protected $body;

    /**
     * @param $summary
     * @param $body
     */
    public function __construct($summary, $body = null)
    {
        $this->summary = $summary;
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
}
