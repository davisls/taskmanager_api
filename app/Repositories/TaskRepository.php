<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends BaseRepository
{
    private $task;

    public function __construct(Task $task)
    {
        parent::__construct($task);
    }

    public function completeTask($id)
    {
        $task = $this->findById($id);
        $task->completed = true;
        $task->save();
    }
}
