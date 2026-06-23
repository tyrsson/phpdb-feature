<?php

declare(strict_types=1);

namespace Webware\PhpDb\Feature;

use PhpDb\Adapter\Driver\ResultInterface;
use PhpDb\Adapter\Driver\StatementInterface;
use PhpDb\ResultSet\ResultSetInterface;
use PhpDb\Sql\Delete;
use PhpDb\Sql\Insert;
use PhpDb\Sql\Select;
use PhpDb\Sql\Update;
use PhpDb\TableGateway\Feature\AbstractFeature;
use PhpDb\TableGateway\Feature\EventFeatureEventsInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Webware\PhpDb\Feature\EventDispatcher\TableGatewayEvent;

class EventDispatcherFeature extends AbstractFeature implements
    EventFeatureEventsInterface
{
    public function __construct(
        private ?EventDispatcherInterface $eventDispatcher = null
    ) {
    }

    /**
     * Retrieve composed event dispatcher instance
     *
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher(): ?EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }

    public function preInitialize(): void
    {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                static::EVENT_PRE_INITIALIZE,
                $this->tableGateway
            )
        );
    }

    public function postInitialize(): void
    {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                name: static::EVENT_POST_INITIALIZE
            )
        );
    }

    public function preSelect(Select $select): void
    {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                name:static::EVENT_PRE_SELECT,
                params: ['select' => $select]
            )
        );
    }

    public function postSelect(
        StatementInterface $statement,
        ResultInterface $result,
        ResultSetInterface $resultSet
    ): void {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                name:static::EVENT_POST_SELECT,
                params: [
                    'statement'  => $statement,
                    'result'     => $result,
                    'result_set' => $resultSet,
                ]
            )
        );
    }

    public function preInsert(Insert $insert): void
    {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                name: static::EVENT_PRE_INSERT,
                params: ['insert' => $insert]
            )
        );
    }

    public function postInsert(
        StatementInterface $statement,
        ResultInterface $result
    ): void {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                name: static::EVENT_POST_INSERT,
                params: [
                    'statement' => $statement,
                    'result'    => $result,
                ]
            )
        );
    }

    public function preUpdate(Update $update): void
    {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                name: static::EVENT_PRE_UPDATE,
                params: ['update' => $update]
            )
        );
    }

    public function postUpdate(StatementInterface $statement, ResultInterface $result): void
    {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                name: static::EVENT_POST_UPDATE,
                params: [
                    'statement' => $statement,
                    'result'    => $result,
                ]
            )
        );
    }

    public function preDelete(Delete $delete): void
    {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                name: static::EVENT_PRE_DELETE,
                params: ['delete' => $delete]
            )
        );
    }

    public function postDelete(StatementInterface $statement, ResultInterface $result): void
    {
        $this->eventDispatcher->dispatch(
            new TableGatewayEvent(
                name: static::EVENT_POST_DELETE,
                params: [
                    'statement' => $statement,
                    'result'    => $result,
                ]
            )
        );
    }
}
