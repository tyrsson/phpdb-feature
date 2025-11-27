<?php

declare(strict_types=1);

namespace Webware\Feature\EventDispatcher;

use Webware\Event\MutableEvent;
use Webware\Feature\EventDispatcher\Event;

final class TableGatewayEvent extends MutableEvent
{
    public function __construct(
        private ?Event $event = null,
        ?object $target = null,
        ?array $params = null
    ) {
        //return parent::__construct($name, $target, $params);
        parent::__construct($event?->value, $target, $params);
    }

    public function setEvent(Event $event): void
    {
        $this->event = $event;
        $this->setName($event->value);
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }
}
