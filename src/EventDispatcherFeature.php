<?php

declare(strict_types=1);

namespace Webware\Feature;

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
use Webware\Feature\EventDispatcher\Event;

class EventDispatcherFeature extends AbstractFeature implements EventFeatureEventsInterface
{
    public function __construct(
        private ?EventDispatcherInterface $eventDispatcher,
        private ?EventDispatcher\TableGatewayEvent $tableGatewayEvent = new EventDispatcher\TableGatewayEvent()
    ) {
    }

    /**
     * Retrieve composed event dispatcher instance
     */
    public function getEventDispatcher(): ?EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }

    /**
     * Retrieve composed event instance
     */
    public function getEvent(): EventDispatcher\TableGatewayEvent
    {
        return $this->tableGatewayEvent;
    }

    /**
     * Initialize feature and dispatch "preInitialize" event
     *
     * Ensures that the composed TableGateway has identifiers based on the
     * class name, and that the event target is set to the TableGateway
     * instance. It then triggers the "preInitialize" event.
     */
    public function preInitialize(): void
    {
        $this->tableGatewayEvent->setEvent(Event::PreInitialize);
        $this->tableGatewayEvent->setTarget($this->tableGateway);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }

    /**
     * Dispatch the "postInitialize" event
     */
    public function postInitialize(): void
    {
        $this->tableGatewayEvent->setEvent(Event::PostInitialize);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }

    /**
     * Dispatch the "preSelect" event
     *
     * Dispatches the "preSelect" event mapping the following parameters:
     * - $select as "select"
     *
     * @return void
     */
    public function preSelect(Select $select): void
    {
        $this->tableGatewayEvent->setEvent(Event::PreSelect);
        $this->tableGatewayEvent->setParams(['select' => $select]);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }

    /**
     * Dispatch the "postSelect" event
     *
     * Dispatches the "postSelect" event mapping the following parameters:
     * - $statement as "statement"
     * - $result as "result"
     * - $resultSet as "result_set"
     */
    public function postSelect(
        StatementInterface $statement,
        ResultInterface $result,
        ResultSetInterface $resultSet
    ): void {
        $this->tableGatewayEvent->setEvent(Event::PostSelect);
        $this->tableGatewayEvent->setParams([
            'statement'  => $statement,
            'result'     => $result,
            'result_set' => $resultSet,
        ]);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }

    /**
     * Dispatch the "preInsert" event
     *
     * Dispatches the "preInsert" event mapping the following parameters:
     * - $insert as "insert"
     */
    public function preInsert(Insert $insert): void
    {
        $this->tableGatewayEvent->setEvent(Event::PreInsert);
        $this->tableGatewayEvent->setParams(['insert' => $insert]);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }

    /**
     * Dispatch the "postInsert" event
     *
     * Dispatches the "postInsert" event mapping the following parameters:
     * - $statement as "statement"
     * - $result as "result"
     */
    public function postInsert(
        StatementInterface $statement,
        ResultInterface $result
    ): void {
        $this->tableGatewayEvent->setEvent(Event::PostInsert);
        $this->tableGatewayEvent->setParams([
            'statement' => $statement,
            'result'    => $result,
        ]);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }

    /**
     * Dispatch the "preUpdate" event
     *
     * Dispatches the "preUpdate" event mapping the following parameters:
     * - $update as "update"
     */
    public function preUpdate(Update $update): void
    {
        $this->tableGatewayEvent->setEvent(Event::PreUpdate);
        $this->tableGatewayEvent->setParams(['update' => $update]);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }

    /**
     * Dispatch the "postUpdate" event
     *
     * Dispatches the "postUpdate" event mapping the following parameters:
     * - $statement as "statement"
     * - $result as "result"
     */
    public function postUpdate(
        StatementInterface $statement,
        ResultInterface $result
    ): void {
        $this->tableGatewayEvent->setEvent(Event::PostUpdate);
        $this->tableGatewayEvent->setParams([
            'statement' => $statement,
            'result'    => $result,
        ]);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }

    /**
     * Dispatch the "preDelete" event
     *
     * Dispatches the "preDelete" event mapping the following parameters:
     * - $delete as "delete"
     */
    public function preDelete(Delete $delete): void
    {
        $this->tableGatewayEvent->setEvent(Event::PreDelete);
        $this->tableGatewayEvent->setParams(['delete' => $delete]);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }

    /**
     * Dispatch the "postDelete" event
     *
     * Dispatches the "postDelete" event mapping the following parameters:
     * - $statement as "statement"
     * - $result as "result"
     */
    public function postDelete(
        StatementInterface $statement,
        ResultInterface $result
    ): void {
        $this->tableGatewayEvent->setEvent(Event::PostDelete);
        $this->tableGatewayEvent->setParams([
            'statement' => $statement,
            'result'    => $result,
        ]);
        $this->eventDispatcher->dispatch($this->tableGatewayEvent);
    }
}
