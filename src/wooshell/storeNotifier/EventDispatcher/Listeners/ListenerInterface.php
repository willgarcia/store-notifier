<?php

namespace wooshell\storeNotifier\EventDispatcher\Listeners;

use Symfony\Component\EventDispatcher\Event;

interface ListenerInterface
{
    public function send(Event $event);
}
