<?php

namespace App\Services\Tasks\FormatTask;


class FormatTaskService {

    public $formatTask;

    public function __construct(FormatTaskInterface $formatTask)
    {
        $this->formatTask = $formatTask;
    }

    public function format($task)
    {
        return $this->formatTask->format($task);
    }
}
