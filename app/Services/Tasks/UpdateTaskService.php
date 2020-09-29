<?php

namespace App\Services\Tasks;


use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class UpdateTaskService {

    public function update($data)
    {
        $task = Task::where('id', $data['id'])
                    ->where('user_id', Auth::user()->id)->first();
        $task->status = $data['status'];
        $task->save();
        return $task;
    }
}
