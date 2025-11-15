<?php

declare(strict_types=1);

namespace Webware\Feature\EventDispatcher;

use Webware\Event\MutableEvent;
use Webware\Feature\EventDispatcher\Event;

final class TableGatewayEvent extends MutableEvent
{
    public function __construct(
        ?string $name = self::class,
        ?object $target = null,
        ?array $params = null
    ) {
        return parent::__construct($name, $target, $params);
    }
}
