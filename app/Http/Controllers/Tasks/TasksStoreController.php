<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Services\Tasks\CreateTaskService;
use App\Services\Tasks\FormatTask\FormatTaskService;
use App\Services\Tasks\FormatTask\JsonFormatService;

class TasksStoreController extends Controller {

    /**
     * Create task
     * @param TaskStoreRequest $request
     */
    public function __invoke(TaskStoreRequest $request)
    {
        $attribute = $request->only('task', 'category_id');

        $createTaskService = new CreateTaskService;
        $task = $createTaskService->store($attribute);

        $formatTask = new FormatTaskService(new JsonFormatService());
        return $formatTask->format($task);
    }
}
