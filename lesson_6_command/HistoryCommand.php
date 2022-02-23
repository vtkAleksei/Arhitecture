<?php


class HistoryCommand
{
    private array $history;

    public function push(Command $command)
    {
        $this->history[] = $command;
    }
    public function pop(): Command
    {
        return array_pop($this->history);
    }
}
