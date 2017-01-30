<?php

namespace App\Http\Controllers;

use \App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $response = Task::with('user', 'priority')->get();

        return response()->json($response);
    }

    public function get($id)
    {
        $response = Task::with('user', 'priority')->where('id', $id)->first();

        return response()->json($response);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'user_id' => 'required|numeric',
            'priority_id' => 'required|numeric'
        ]);

        $input = $request->only('title', 'description', 'due_date', 'user_id', 'priority_id');
        $response = Task::create($input);

        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'user_id' => 'required|numeric',
            'priority_id' => 'required|numeric'
        ]);

        $input = $request->only('title', 'description', 'due_date', 'user_id', 'priority_id');
        $input = array_filter($input, 'strlen');

        try {
            $task = Task::findOrFail($id);
            $task->update($input);

            $response = ['msg' => 'Task was updated!'];
        } catch (\Exception $e) {
            $response = [
                'devMessage' => $e->getMessage(),
                'userMessage' => 'An error has ocurred! The task has not been updated.',
                'status' => 404
            ];
        }

        return response()->json($response);
    }

    public function delete($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            $response = [
                'devMessage' => 'The task was deleted!',
                'userMessage' => 'The task was deleted!',
                'status' => 200
            ];
        } catch (\Exception $e) {
            $response = [
                'devMessage' => $e->getMessage(),
                'userMessage' => 'An error has ocurred! The task has not been deleted.',
                'status' => 404
            ];
        }

        return response()->json($response);
    }

}
