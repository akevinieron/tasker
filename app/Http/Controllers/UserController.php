<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $response = User::with('tasks')->get();

        return response()->json($response);
    }

    public function get($id)
    {
        $response = User::with('tasks')->where('id', $id)->first();

        return response()->json($response);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);

        $input = $request->only('firstname', 'lastname', 'email', 'password');
        $response = User::create($input);

        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users,email,' . $id . '|email',
            'password' => 'required|min:6'
        ]);

        $input = $request->only(['firstname', 'lastname', 'email', 'password']);
        $input = array_filter($input, 'strlen');

        try {
            $user = User::findOrFail($id);
            $user->update($input);

            $response = ['msg' => 'User was updated!'];
        } catch (\Exception $e) {
            $response = [
                'devMessage' => $e->getMessage(),
                'userMessage' => 'An error has ocurred! The user has not been updated.',
                'status' => 404
            ];
        }

        return response()->json($response);
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            $response = [
                'devMessage' => 'The user was deleted!',
                'userMessage' => 'The user was deleted!',
                'status' => 200
            ];
        } catch (\Exception $e) {
            $response = [
                'devMessage' => $e->getMessage(),
                'userMessage' => 'An error has ocurred! The user has not been deleted.',
                'status' => 404
            ];
        }

        return response()->json($response);
    }

}
