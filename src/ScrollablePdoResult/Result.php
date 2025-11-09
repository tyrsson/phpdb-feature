<?php

declare(strict_types=1);

namespace Webware\Feature\ScrollablePdoResult;

use PhpDb\Exception\InvalidArgumentException;
use PhpDb\Adapter\Driver\Pdo;

use function get_class;
use function in_array;

final class Result extends Pdo\Result
{
    private const ALLOWED_MODES = [
        self::STATEMENT_MODE_SCROLLABLE,
        self::STATEMENT_MODE_FORWARD
    ];

    public function setStatementMode(string $mode): void
    {
        if (! in_array($mode, self::ALLOWED_MODES)) {
            throw new InvalidArgumentException(
                '$mode must be one of ' . get_class($this) . '::ALLOWED_MODES received: ' . $mode
            );
        }
        $this->statementMode = $mode;
    }
}
