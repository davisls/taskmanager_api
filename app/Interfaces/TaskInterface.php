<?php

namespace App\Interfaces;

use App\Http\Requests\TaskRequest;

interface TaskInterface
{
    public function index();
    public function store(TaskRequest $request);
    public function update($id_task, TaskRequest $request);
    public function destroy($id_task);
    public function search($search);
    public function mergeRequestWithUser(array $request);
}
