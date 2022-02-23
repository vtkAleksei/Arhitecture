<?php


class CopyCommand extends Command
{

    public function execute(): bool
    {
        $this->selectedTextToClipboard();
        return false;
    }
    public function undo()
    {
    }
}
