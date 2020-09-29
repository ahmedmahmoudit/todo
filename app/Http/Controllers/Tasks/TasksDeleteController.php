<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Services\Tasks\DestroyTaskService;
use App\Services\Tasks\FormatTask\FormatTaskService;
use App\Services\Tasks\FormatTask\JsonFormatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksDeleteController extends Controller {

    /**
     * Update task
     * @param  $request
     * @return string
     */
    public function __invoke(Request $request)
    {
        $attribute = $request->only('id');

        $taskService = new DestroyTaskService();
        return $taskService->destroy($attribute, Auth::user()->id);

    }
}
