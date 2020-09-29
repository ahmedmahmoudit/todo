<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use Illuminate\Support\Facades\Auth;

class TasksListController extends Controller {

    /**
     * Create task
     * @param TaskStoreRequest $request
     * @return collection
     */
    public function __invoke()
    {
        $tasks = Auth::user()->tasks;

        return $tasks;
    }
}
