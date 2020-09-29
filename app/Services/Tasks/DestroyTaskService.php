<?php

namespace App\Services\Tasks;

use App\Models\Task;

class DestroyTaskService {

    public function destroy($data, $id)
    {
        $task = Task::where('id', $data['id'])
                    ->where('user_id', $id)->first();

        return $task->delete();
    }
}
