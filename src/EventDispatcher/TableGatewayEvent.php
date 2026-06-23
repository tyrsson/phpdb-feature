<?php

declare(strict_types=1);

namespace Webware\PhpDb\Feature\EventDispatcher;

use Webware\Event\Event;

final class TableGatewayEvent extends Event
{
    public function __construct(
        private ?string $name = null,
        private ?object $target = null,
        private array $params = [],
    ) {}
}
