<?php

namespace App\Services\Tasks;


use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class CreateTaskService {

    public function store($task)
    {
        return Task::create([
            'user_id' => Auth::user()->id,
            'task' => $task['task'],
            'category_id' => $task['category_id'],
            'status'    => 0
        ]);
    }
}
