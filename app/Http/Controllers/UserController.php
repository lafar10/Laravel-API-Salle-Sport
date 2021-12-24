<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{

    public function show()
    {
        $user = User::all();

        if ($user) {
            return response()->json([
                'status' => 200,
                'users' => $user,
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Table Empty !!',
            ]);
        }
    }

    public function edit($id)
    {
        $users = User::find($id);

        if ($users) {
            return response()->json([
                'status' => 200,
                'users' => $users,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => '404 not found',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'tele' => 'required|min:8',
            'adresse' => 'required|max:191',
            'age' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages(),
            ]);
        } else {
            $user = User::find($id);

            if ($user) {

                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->adresse = $request->input('adresse');
                $user->tele = $request->input('tele');
                $user->age = $request->input('age');
                $user->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Updated With Successfully ^-^',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => '404 not found',
                ]);
            }
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Deleted With Successfully ^-^',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => '404 Not Found',
            ]);
        }
    }

    public function update_profile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:191',
            'tele' => 'required|min:8',
            'adresse' => 'required|max:191',
            'age' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages(),
            ]);
        } else {
            $user = User::find($id);

            if ($user) {

                $user->name = $request->input('name');
                $user->adresse = $request->input('adresse');
                $user->tele = $request->input('tele');
                $user->age = $request->input('age');
                $user->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Updated With Successfully ^-^',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => '404 not found',
                ]);
            }
        }
    }

    public function profile($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json([
                'status' => 200,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => '404 Not Found',
            ]);
        }
    }
}
