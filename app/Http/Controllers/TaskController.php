<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\TaskInterface;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        try {
            $tasks = $this->taskService->index();

            return response()->json([
                'success' => true,
                'tasks' => $tasks
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function store(TaskRequest $request)
    {
        try {
            $this->taskService->store($request);

            return response()->json([
                'success' => true,
                'message' => 'task registered succesfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function update($id_task, TaskRequest $request)
    {
        try {
            $this->taskService->update($id_task, $request);

            return response()->json([
                'success' => true,
                'message' => 'task updated succesfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function destroy($id_task)
    {
        try {
            $this->taskService->destroy($id_task);

            return response()->json([
                'success' => true,
                'message' => 'task deleted succesfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function search($search)
    {
        try {
            $tasks = $this->taskService->search($search);

            if(count($tasks) > 0) {
                return response()->json([
                    'success' => true,
                    'tasks' => $tasks
                ]);
            }
            return response()->json([
                'success' => true,
                'tasks' => 'no tasks found with the search field'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function completeTask($task_id)
    {
        try {
            $complete = $this->taskService->completeTask($task_id);

            if($complete) {
                return response()->json([
                    'success' => true,
                    'message' => 'this task has been completed'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'you are not the person assigned to this task'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    public function show($task_id)
    {
        try {
            $task = $this->taskService->show($task_id);

            if($task){
                return response()->json([
                    'success' => true,
                    'task' => $task
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'this task was not found'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }
}
