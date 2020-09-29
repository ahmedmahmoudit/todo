<?php


namespace App\Services\Tasks\FormatTask;


use Illuminate\Http\Response;

class JsonFormatService implements FormatTaskInterface {

    public function format($task)
    {
        return response($task, 200);
    }
}
