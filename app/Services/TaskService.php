<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Repositories\TaskRepository;
use App\Interfaces\UserInterface;
use App\Interfaces\TaskInterface;

class TaskService implements TaskInterface
{
    private $taskRepository;
    private $userService;

    public function __construct(TaskRepository $taskRepository, UserInterface $userService)
    {
        $this->taskRepository = $taskRepository;
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->taskRepository->index();
    }

    public function store(TaskRequest $request)
    {
        $this->taskRepository->create($this->mergeRequestWithUser($request->all()));
    }

    public function update($id_task, TaskRequest $request)
    {
        $this->taskRepository->update($id_task, $this->mergeRequestWithUser($request->all()));
    }

    public function destroy($id_task)
    {
        $this->taskRepository->destroy($id_task);
    }

    public function search($search)
    {
        return $this->taskRepository->search('name', $search);
    }

    public function mergeRequestWithUser(array $request)
    {
        $user = $this->userService->getMe();
        return
        array_merge($request,
            [
                'user_id' => $user->id,
                'created_by' => $user->name
            ]
        );
    }

    public function completeTask($task_id)
    {
        $user = $this->userService->getMe();
        $task = $this->taskRepository->findById($task_id);
        if($task->designated_for == $user->id) {
            $this->taskRepository->completeTask($task_id);
            return true;
        }
        return false;
    }

    public function show($task_id)
    {
        return $this->taskRepository->findById($task_id);
    }
}
