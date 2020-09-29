<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Services\Tasks\FormatTask\FormatTaskService;
use App\Services\Tasks\FormatTask\JsonFormatService;
use App\Services\Tasks\UpdateTaskService;

class TasksUpdateController extends Controller {

    /**
     * Update task
     * @param TaskUpdateRequest $request
     */
    public function __invoke(TaskUpdateRequest $request)
    {
        $attribute = $request->only('status', 'id');

        $taskService = new UpdateTaskService();
        $task = $taskService->update($attribute);

        $formatTask = new FormatTaskService(new JsonFormatService());
        return $formatTask->format($task);
    }
}
