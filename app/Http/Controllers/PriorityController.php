<?php

namespace App\Http\Controllers;

use \App\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{

    public function index()
    {
        $response = Priority::all();

        return response()->json($response);
    }

    public function get($id)
    {
        $response = Priority::find($id);

        return response()->json($response);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->only('name');
        $response = Priority::create($input);

        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->only('name');
        $input = array_filter($input, 'strlen');

        try {
            $priority = Priority::findOrFail($id);
            $priority->update($input);

            $response = ['msg' => 'Priority was updated!'];
        } catch (\Exception $e) {
            $response = [
                'devMessage' => $e->getMessage(),
                'userMessage' => 'An error has ocurred! The priority has not been updated.',
                'status' => 404
            ];
        }

        return response()->json($response);
    }

    public function delete($id)
    {
        try {
            $priority = Priority::findOrFail($id);
            $priority->delete();

            $response = [
                'devMessage' => 'The priority was deleted!',
                'userMessage' => 'The priority was deleted!',
                'status' => 200
            ];
        } catch (\Exception $e) {
            $response = [
                'devMessage' => $e->getMessage(),
                'userMessage' => 'An error has ocurred! The priority has not been deleted.',
                'status' => 404
            ];
        }

        return response()->json($response);
    }

}
