<?php

namespace wooshell\storeNotifier\EventDispatcher\Listeners;

use Symfony\Component\EventDispatcher\Event;

interface NotifyListenerInterface
{
    public function send(Event $event);
}
