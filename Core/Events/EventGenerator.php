<?php namespace Ill\Core\Events;

trait EventGenerator
{

    protected $pendingEvents = [];

    public function releaseEvents()
    {

        $events = $this->pendingEvents;
        $this->pendingEvents = [];
        return $events;

    }

    protected function raise($event)
    {

        $this->pendingEvents[] = $event;

    }
}
