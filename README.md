Store Notifier
==============

PHP notifier based on Symfony EventDispatcher.

* Sends notification(s) when events are fired.
* Provides file storage to keep tracks of notifications.

Installation
------------

    $ composer install --dev

Store usage
----------

Store registration:

    use wooshell\storeNotifier\StoreNotifier;

    $myStoreDir = '/tmp/myStoreDir';
    $myStore = 'cars';
    $myStoreEntry = 'Smart Hayabusa';

    $storeNotifier = new StoreNotifier($myStoreDir);

    $storeNotifier->store($myStore);
    $storeNotifier->store(...);

    $store->log($myStoreEntry);

Store notification:

    if (false === $store->exists($myStore, $myStoreEntry)) {
        $summary = '...';
        $body = '...';
        $store->send($summary, $body);
    }

Store locking:

    $lockFilepath = '/tmp/storeNotifier.lock';
    $store->lock($lockFilepath );
    ...
    $store->unlock($lockFilepath );

Custom Notification
-------------------

Create a listener:

    use Symfony\Component\EventDispatcher\Event;
    use wooshell\storeNotifier\EventDispatcher\Events\SendEvent;
    use wooshell\storeNotifier\EventDispatcher\Listeners\ListenerInterface;

    class EchoListener implements ListenerInterface
    {
        /**
         * @param Event $event
         */
        public function send(Event $event)
        {
            /** @var SendEvent $event */
            echo($event->getSummary(), $event->getBody()));
        }
    }

Add a listener into the store notifier:

    $store->getDispatcher()->addListener(SendEvent::EVENT_SEND, array(new EchoListener() , 'send'));
